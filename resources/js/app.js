import ('./bootstrap');

// import * as Vue from 'vue';
// import FollowButton from './components/FollowButton.vue';

// window.Vue = Vue;

// Vue.component('follow-button', FollowButton.default);

import { createApp } from '/node_modules/vue/dist/vue.esm-bundler.js';
import FollowButton from './components/FollowButton.vue';

const app = createApp({
    components:{
        FollowButton
    },
});

app.mount(".container")
