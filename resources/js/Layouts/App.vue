<template>
    <v-app>
        <v-app-bar :elevation="20">
            <v-btn @click="navigate('home')" text="Home"></v-btn>
            <v-btn @click="navigate('hotpoints.index')" text="Hotpoints"></v-btn>
        </v-app-bar>
        <slot></slot>
    </v-app>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3';

export default {
    components: {Link},
    methods:{
        navigate(routeName) {
            router.get(route(routeName));
        }
    },
}
</script>

<style scoped>
    .v-application {
        padding-top: 64px;
    }
</style>
