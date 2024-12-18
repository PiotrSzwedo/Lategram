<template>
    <div v-html="addPostHTML"></div>
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
                    this.html += data.posts;    
                    this.offset2 += data.total;
                }
                
                
                this.isMore = data.has_more;
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