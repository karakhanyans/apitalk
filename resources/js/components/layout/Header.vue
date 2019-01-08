<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Test Task</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <div v-if="logged">
                    <div class="logged-menu">
                        <router-link to="/stores" tag="li" class="nav-item" exactActiveClass="active">
                            <a class="nav-link">Stores</a>
                        </router-link>
                    </div>
                    <div class="menu-for-auth">
                        <router-link to="/auth/logout" tag="li" class="nav-item logout" exactActiveClass="active">
                            <a class="nav-link">Log Out</a>
                        </router-link>
                    </div>
                </div>
                <div v-if="!logged">
                    <div class="menu-for-auth">
                        <router-link to="/auth/signin" tag="li" class="nav-item" exactActiveClass="active">
                            <a class="nav-link">Sign In</a>
                        </router-link>
                        <router-link to="/auth/signup" tag="li" class="nav-item" exactActiveClass="active">
                            <a class="nav-link">Sign Up</a>
                        </router-link>
                    </div>
                </div>
                    <div class="menu-for-auth">
                        <router-link to="/contact" tag="li" class="nav-item" exactActiveClass="active">
                            <a class="nav-link">Contact Us</a>
                        </router-link>
                    </div>
            </ul>
        </div>
    </nav>
</template>
<script>
    import {mapGetters} from 'vuex';
    import firebase from 'firebase';

    export default {
        mounted() {
            const firebaseUser = firebase.auth().currentUser;
            if (firebaseUser) {
                this.$store.commit('SET_USER', firebaseUser);
            }
        },
        computed: {
            logged() {
                let logged = false;
                if ((this.getUser() && this.getUser().email)) {
                    logged = true;
                }
                return logged;
            }
        },
        methods: {
            ...mapGetters([
                'getUser'
            ])
        }
    }
</script>
