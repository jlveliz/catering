<template>
    <component v-bind:is="layout"></component>
</template>

<script>

    import AppLayout from './../layouts/app';
    import SimpleLayout from './../layouts/simple';

    export default {
        computed : {
            layout(){
                return this.$store.getters.layout
            }
        },
        components: {
            'simple-layout' : SimpleLayout,
            'app-layout': AppLayout
        }
    }
</script>
