<template>
    <form v-on:submit.prevent="signIn">
        <h1 class="title">Sign In</h1>
        <div v-if="error">
            <p class="error">{{error}}</p>
        </div>
        <div class="form-group">
            <label class="control-label">E-mail</label>
            <input type="text" v-model="email" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input type="password" v-model="password" class="form-control">
        </div>
        <button type="submit" class="btn">Sign In</button>
    </form>
</template>

<script>
    import firebase from 'firebase'

    export default {
        data() {
            return {
                error: false,
                email: "",
                password: ""
            }
        },
        methods: {
            signIn: function () {
                this.error = false;
                firebase.auth().signInWithEmailAndPassword(this.email, this.password).then((user) => {
                    this.$store.commit('SET_USER', firebase.auth().currentUser);
                    this.$router.push('/stores');
                }).catch((err) => {
                    this.error = "Wrong E-mail and Password";
                });
            }
        }
    }
</script>

<style scoped>

</style>
