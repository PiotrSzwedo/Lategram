<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser">Follow</button>
    </div>

    <div>
        <button class="btn btn-dark ml-4" @click="unFollowUser">Followed</button>
    </div>
</template>

<script>
export default {
    methods: {
        async followUser(){
            alert("folowed");
        },

        unFollowUser(){
            alert("unfolowed");
        }
    }
}
</script>
