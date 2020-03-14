<template>
    <li class="list-group-item" @click="select">
        {{location.postleitzahl}} {{location.ortbez18}}
    </li>
</template>

<script>
    export default {
        props: {
            'location': Object,
        },
        methods: {
            select() {
                this.$emit('corona-location-selected', this.location);
            },
        },
    };
</script>
