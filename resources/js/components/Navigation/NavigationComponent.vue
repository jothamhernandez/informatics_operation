<template>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item" v-for="link in links" :key="link" @click="displayComponent(link)"><a href="#" class="nav-link">{{link}}</a></li>
    </ul>
</template>

<script>
export default {
    props: ['links'],
    methods: {
        displayComponent(link){
            this.$root.$emit('navigation-click', link);
        }
    }
}
</script>

<style>

</style>
