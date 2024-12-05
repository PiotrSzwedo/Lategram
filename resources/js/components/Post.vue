<template>
    <div class="row pt-5" v-html="addPostHTML"></div>
    <button class="btn btn-gray" @click="getPost" v-show="showMoreButton">
        Show more
    </button>
</template>

<script>
export default {
    props: ["firstPostNumber", "csrf", "profile_id", "offset"],

    data() {
        return {
            html: "",
            offset2: this.offset,
            isMore: true,
        };
    },

    methods: {
        async getPost() {
            const response = await fetch("/post/get", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": `${this.csrf}`,
                },
                body: JSON.stringify({
                    post_id: this.firstPostNumber,
                    profile_id: this.profile_id,
                    offset: this.offset2,
                    limit: 9,
                }),
            });

            if (!response.ok || !response.headers.get("Content-Type")?.includes("application/json")) {
                this.isMore = false;
            } else {
                const data = await response.json();

                if (data.posts) {
                    const completePosts = data.total;
                    this.html += data.posts;

                    console.log(completePosts);

                    this.offset2 += completePosts;
                } else {
                    console.log("No more posts to load.");
                }
            }
        },
    },

    computed: {
        addPostHTML() {
            return this.html ? this.html : "";
        },

        showMoreButton() {
            return this.isMore;
        },
    },

    mounted() {
        this.getPost(); 
    }
};
</script>