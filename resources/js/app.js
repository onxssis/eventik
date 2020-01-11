/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import VueModal from "vue-js-modal";
import * as VueGoogleMaps from "vue2-google-maps";
import VueRouter from "vue-router";
import { Datetime } from "vue-datetime";
import "vue-datetime/dist/vue-datetime.css";

Vue.use(VueRouter);

Vue.use(VueModal, { dynamic: true, injectModalsContainer: true });

Vue.use(Datetime);

Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.MIX_GOOGLE_MAPS_API,
        libraries: "places" // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)

        //// If you want to set the version, you can do so:
        // v: '3.26',
    }

    //// If you intend to programmatically custom event listener code
    //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
    //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
    //// you might need to turn this on.
    // autobindAllEvents: false,

    //// If you want to manually install components, e.g.
    //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
    //// Vue.component('GmapMarker', GmapMarker)
    //// then disable the following:
    // installComponents: true,
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "attend-event",
    require("./components/AttendEventButton.vue").default
);
Vue.component("login-modal", require("./components/AuthModal.vue").default);
Vue.component("bookmark", require("./components/BookmarkButton.vue").default);
Vue.component("google-maps", require("./components/GoogleMap.vue").default);
Vue.component("browse", require("./components/Browse.vue").default);
Vue.component("datetime", Datetime);
Vue.component(
    "category-card",
    require("./components/CategoryCard.vue").default
);

const BrowseIndex = require("./components/browse/Index.vue").default;

const routes = [{ path: "/b", component: BrowseIndex, name: "browse.index" }];

const router = new VueRouter({
    mode: "history",
    routes
});

const app = new Vue({
    el: "#app",
    router
    // data: window.App,
});

$("input.search-bar")
    .on("focus", function() {
        $(this)
            .parent()
            .animate({ width: "460px" }, "slow");
    })
    .on("blur", function() {
        $(this)
            .parent()
            .animate({ width: "252px" }, "slow");
    });

require("./modules/fileInput");
