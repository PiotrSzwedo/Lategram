import { createApp } from 'vue';
import FollowButton from './components/FollowButton.vue';

const app = createApp();
app.component("followbutton", FollowButton);

app.mount("#app");
