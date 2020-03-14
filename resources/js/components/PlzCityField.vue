<template>
    <div>
        <slot></slot>
        <input type="text" class="form-control" :class="errorClass" v-model="searchstring" @keyup="maybeSearch"
               required>
        <div class="position-relative" style="z-index:1;">
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
        <input type="hidden" v-model="plz" name="plz" readonly>
        <input type="hidden" v-model="city" name="city" readonly>
        <input type="hidden" v-model="lat" name="lat" readonly>
        <input type="hidden" v-model="lng" name="lng" readonly>
    </div>
</template>

<script>
    import CoronaSearchResult from "./CoronaSearchResult";

    export default {
        components: {CoronaSearchResult},
        props: {
            'errorClass': String,
        },
        data() {
            return {
                searchstring: '',
                plz: '',
                city: '',
                lat: '',
                lng: '',
                locations: {}
            }
        },
        methods: {
            isAlphanumeric(char) {
                return "0123456789abcdefghijklmnopqrstuvwxyzäöüABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÜ".indexOf(char) > -1;
            },
            selectLocation(location) {
                this.locations = {};
                this.plz = location.postleitzahl;
                this.city = location.ortbez18;
                this.lat = location.geo_point_2d[0];
                this.lng = location.geo_point_2d[1];
                this.searchstring = `${location.postleitzahl} ${location.ortbez18}`;
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
