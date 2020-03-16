<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="PLZ / Ort" v-model="searchstring" autofocus
                   @keyup="maybeSearch">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="button-addon2" @click="search">Suchen</button>
            </div>
        </div>
        <div class="position-relative mb-4" style="z-index:1;">
            <ul class="list-group position-absolute"
                style="top: 0; left:0; width:100%;max-height: 152px; overflow:auto;"
                v-show="Object.keys(locations).length">
                <corona-search-result v-for="location in locations"
                                      style="cursor:pointer;"
                                      :key="`${location.postleitzahl}${location.ortbez18}`"
                                      :location="location"
                                      @corona-location-selected="selectLocation"></corona-search-result>

            </ul>
        </div>
        <!--<ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" :class="{'active':view === 'list'}"
                   style="cursor:pointer;"
                   @click.default="switchView('list')">Liste</a>
            </li>
            <li class="nav-item">
                <span class="nav-link" :class="{'active':view === 'map'}"
                      style="cursor:pointer;"
                      @click.default="switchView('map')">Karte</span>
            </li>
        </ul>-->
        <div class="tab-content pt-4">
            <div class="tab-pane fade" :class="{'active show':view === 'list'}">
                <ul class="list-group" v-if="filteredNeeds.length > 0">
                    <li class="list-group-item"
                        v-for="need of filteredNeeds" :key="need.id">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-9">
                                <p class="mb-1">{{need.plz}} {{need.city}}</p>
                                <h4 class="mb-1">{{need.title}}</h4>
                                <p>{{need.preview}}</p>
                            </div>
                            <div class="col-12 col-sm-3 d-sm-flex justify-content-sm-end">
                                <a :href="`/gesuch/${need.id}`" class="btn btn-outline-success">helfen</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <p v-else class="lead">Im Umkreis von 30 Kilometern benötigt niemand deine Hilfe.</p>
            </div>
            <div class="tab-pane fade" :class="{'active show':view === 'map'}">
                <div style="height: 800px; z-index:0;" class="mb-3 position-relative">
                    <l-map
                        ref="map"
                        style="height: 100%; width: 100%"
                        :zoom="zoom"
                        :center="center"
                        @update:zoom="zoomUpdated"
                        @update:center="centerUpdated"
                        @update:bounds="boundsUpdated"
                    >
                        <!--<l-tile-layer :url="url"></l-tile-layer>
                        <l-marker v-for="need of needs" :key="need.id" :lat-lng="[need.lat,need.lng]">
                            <l-popup>
                                <h6 class="display-6">{{need.title}}</h6>
                                <p>{{need.preview}}</p>
                            </l-popup>
                        </l-marker>-->
                    </l-map>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    require('axios');
    import {LMap} from 'vue2-leaflet';
    import 'leaflet-providers';

    import 'leaflet/dist/leaflet.css';
    import CoronaSearchResult from './CoronaSearchResult';

    export default {
        components: {
            CoronaSearchResult,
            LMap,
        },
        data() {
            return {
                view: 'list',
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                zoom: 13,
                bounds: null,
                center: [47.46152, 9.04552],
                searchstring: '',
                locations: {},
                location: null,
                timeout: null,
                needs: [],
                map: null
            };
        },
        computed: {
            filteredNeeds() {
                let needs = [];

                if (this.location === null) {
                    return this.needs;
                }

                this.needs.map((need) => {
                    let distance = this.map.distance(this.location.geo_point_2d, [need.lat, need.lng]);

                    if (distance <= 30000) {
                        needs.push(need);
                    }
                });
                return needs;
            }
        },
        mounted() {
            let self = this;
            axios.get('/raw/needs')
                .then(function (response) {
                    self.needs = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

            this.$nextTick(() => {
                this.map = this.$refs.map.mapObject;
                L.tileLayer.provider('Wikimedia').addTo(this.map);
            });
        },
        methods: {
            zoomUpdated(zoom) {
                this.zoom = zoom;
            },
            centerUpdated(center) {
                this.center = center;
            },
            boundsUpdated(bounds) {
                this.bounds = bounds;
            },
            selectLocation(location) {
                this.locations = {};
                this.location = location;
                this.searchstring = `${location.postleitzahl} ${location.ortbez18}`;
                if (this.view === 'map') {
                    this.map.flyTo(location.geo_point_2d);
                    return;
                }
                this.map.panTo(location.geo_point_2d);
            },
            switchView(view) {
                this.view = view === 'map' ? 'map' : 'list';
                if (view === 'map') {
                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 100);
                }
            },
            isAlphanumeric(char) {
                return "0123456789abcdefghijklmnopqrstuvwxyzäöüABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÜ".indexOf(char) > -1;
            },
            maybeSearch(event) {
                clearTimeout(this.timeout);
                if (!this.isAlphanumeric(event.key)) {
                    return;
                }
                if (this.searchstring.length < 3) {
                    return;
                }
                this.locations = {};
                this.timeout = setTimeout(() => {
                    this.search();
                }, 300);
            },
            search() {
                const self = this;
                axios.get(`https://swisspost.opendatasoft.com/api/records/1.0/search/?dataset=plz_verzeichnis_v2&q=${this.searchstring}`)
                    .then(function (response) {
                        self.locations = {};
                        response.data.records.map((data) => {
                            if (data.fields.plz_coff !== 'J') {
                                return;
                            }

                            if (`${data.fields.postleitzahl}${data.fields.ortbez18}` in self.locations) {
                                return;
                            }
                            self.locations[`${data.fields.postleitzahl}${data.fields.ortbez18}`] = data.fields;
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        },
    };
</script>
