<template>
    <div>
        <button class="btn btn-primary ml-4" @click="toggleFollow" v-text="buttonText"></button>
    </div>
</template>

<script>
export default {
    props: ["profileId", "csrf", "followed"],

    data() {
        return {
            status: this.followed ? true : false,
        };
    },

    methods: {
        async toggleFollow() {
            if (!this.status) {
                await this.sendFollowRequest("follow");
            } else {
                await this.sendFollowRequest("follow/un");
            }
        },

        async sendFollowRequest(action) {
            try {
                const response = await fetch(`/${action}/${this.profileId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": this.csrf,
                    },
                    body: JSON.stringify({
                        profile_id: this.profileId,
                    }),
                });

                if (response.ok) {
                    this.status = !this.status;
                } else {
                    console.error(`Failed to perform action (${action}):`, await response.text());
                }
            } catch (error) {
                console.error(`Error performing action (${action}):`, error);
            }
        },
    },

    computed: {
        buttonText() {
            return this.status ? "Unfollow" : "Follow";
        },
    },
};
</script>
