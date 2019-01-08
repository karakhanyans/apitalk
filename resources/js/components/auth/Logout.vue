<template>

</template>

<script>
    import firebase from 'firebase';

    export default {
        mounted() {
            firebase.auth().signOut().then(() => {
                this.$store.commit('UNSET_USER', null);
                this.$router.push('/auth/signin');
            }).catch((err)=>{
                console.log(err);
            });
        }
    }
</script>

<style scoped>

</style>
