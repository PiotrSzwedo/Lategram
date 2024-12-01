<template>
    <button class="d-flex p-2 bg-transparent border-0" type="button" role="button" @click="toggleLike">
        <p v-text="getLikesCount" class="m-0 me-1"></p>
        <img :src="setImage" alt="like or liked">
    </button>
</template>

<script>
export default {
    props: ["isLiked", "likeCount", "postId", "csrf"],

    data() {
        return {
            status: this.isLiked || false,
            count: this.likeCount
        };
    },

    methods: {
        async toggleLike() {
            if (!this.status) {
                await this.setLikeRequest("like/add");
            } else {
                await this.setLikeRequest("like/un");
            }
        },

        async setLikeRequest(action) {
            try {
                console.log(this.csrf);
                const response = await fetch(`/${action}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": this.csrf,
                    },
                    body: JSON.stringify({
                        post_id: this.postId,
                    }),
                });
                if (response.ok) {
                    this.status = !this.status;

                    if (this.status) {
                        this.count++;
                    } else {
                        this.count--;
                    }
                } else {
                    console.error(`Failed to perform action (${action}):`, await response.text());
                }
            } catch (error) {
                console.error(`Error performing action (${action}):`, error);
            }
        },
    },

    computed: {
        setImage() {
            return "/storage/res/" + (this.status ? "liked" : "like") + ".svg";
        },

        getLikesCount() {
            return this.count;
        },
    },
};
</script>