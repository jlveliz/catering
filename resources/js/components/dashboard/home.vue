<template>
    <div>
        <button @click="setLayout('simple-layout')">Simple layout</button>
        <button @click="setLayout('app-layout')">App layout</button>
    </div>
</template>

<script>
export default {
    name:'Dashboard',
    methods: {
        setLayout(layout){
            this.$store.commit('SET_LAYOUT',layout)
        }
    }
}
</script>

<style>

</style>