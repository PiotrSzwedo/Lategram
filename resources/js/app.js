import ("./bootstrap.js");

import { createApp } from 'vue';
import FollowButton from './components/FollowButton.vue';
import LikeButton from './components/LikeButton.vue';
import Post from './components/Post.vue';

const app = createApp();
app.component("post", Post);
app.component("like", LikeButton);
app.component("followbutton", FollowButton);

app.mount("#app");