<template>
    <form v-on:submit.prevent="signUp">
        <h1 class="title">Sign Up</h1>
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
        <button type="submit" class="btn">Sign Up</button>
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
            signUp: function () {
                firebase.auth().createUserWithEmailAndPassword(this.email, this.password).then(() => {
                    firebase.auth().signInWithEmailAndPassword(this.email, this.password).then(() => {
                        this.$store.commit('SET_USER', firebase.auth().currentUser);
                        this.$router.push('/stores');
                    }).catch((err) => {
                        this.error = 'Write correct email and password';
                    });
                }).catch((err) => {
                    if (err.code === 'auth/email-already-in-use') {
                        this.error = 'This email already exists';
                    } else {
                        this.error = 'Write correct email and password';
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
