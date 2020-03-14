<template>
    <li class="list-group-item" v-if="isVisible">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{need.title}}</h5>
            <small>{{need.user.city}}</small>
        </div>
        <p class="mb-1">{{need.preview}}</p>
        <small>{{need.user.name}}</small>
    </li>
</template>

<script>
    export default {
        props: {
            'location': Object,
            'need': Object,
            'map': Object
        },
        computed: {
            isVisible() {
                if (this.location === null) {
                    return true;
                }

                let distance = this.map.distance(this.location.geo_point_2d, [this.need.lat, this.need.lng]);

                if (distance <= 30000) {
                    return true;
                }

                return false;
            }
        },
        methods: {},
    };
</script>
