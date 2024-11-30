<template>
    <button type="button" role="button">
        <img :src="setImage" alt="like or liked">
    </button>
</template>

<script>
export default {
    props: ["isLiked"],

    data() {
        return {
            status: this.isLiked || false,
        };
    },

    computed: {
        setImage() {
            return "/storage/res/" + (this.status ? "like" : "liked") + ".svg";
        }
    },

    watch: {
        isLiked(newVal) {
            this.status = newVal;
        }
    }
};
</script>