<template>
    <div>
        <h1>{{store.name}}</h1>
        <p><b>Brand:</b>{{store.brand ? store.brand.name : null}}</p>
        <p><b>Number:</b>{{store.number}}</p>
        <p><b>Name:</b>{{store.name}}</p>
        <p><b>Type:</b>{{store.type}}</p>
        <p><b>Address:</b>{{store.address}}</p>
        <p><b>Phone Number:</b>{{store.phone_number}}</p>
        <p><b>Timezone:</b>{{store.timezone}}</p>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'

    export default {
        data() {
            return {
                store: {}
            }
        },
        methods: {
            ...mapActions({
                get: 'getStore',
            }),
            ...mapGetters({
                getStore: 'getStore',
            })
        },
        mounted() {
            this.get({id: this.$route.params['id']}).then(() => {
                this.store = this.getStore();
            });
        }
    }
</script>
