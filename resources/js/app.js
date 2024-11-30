import ("./bootstrap.js");

import { createApp } from 'vue';
import FollowButton from './components/FollowButton.vue';
import LikeButton  from './components/LikeButton.vue';

const app = createApp();
app.component("likebutton", LikeButton);
app.component("followbutton", FollowButton);

app.mount("#app");