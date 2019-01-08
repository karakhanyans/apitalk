<template>
    <form class="col-md-3" v-on:submit.prevent="handleSubmit">
        <h1 class="title">Create Store</h1>
        <div class="form-group">
            <label for="brand" class="control-label">Brand</label>
            <select class="form-control" v-model="form.brand_id" id="brand" :class="{'is-invalid': errors.brand_id}">
                <option :value="0">Select Brand</option>
                <option v-for="brand in brands" :value="brand.id" :key="brand.id">{{brand.name}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.brand_id">
                <p class="error">{{errors.brand_id[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="number" class="control-label">Number</label>
            <input type="number" class="form-control" id="number" v-model="form.number"
                   :class="{'is-invalid': errors.number}">
            <div class="invalid-feedback" v-if="errors.number">
                <p class="error">{{errors.number[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" id="name" v-model="form.name"
                   :class="{'is-invalid': errors.name}">
            <div class="invalid-feedback" v-if="errors.name">
                <p class="error">{{errors.name[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="type" class="control-label">Type</label>
            <select class="form-control" v-model="form.type" id="type" :class="{'is-invalid': errors.type}">
                <option :value="0">Not Licensed</option>
                <option :value="1">Licensed</option>
            </select>
            <div class="invalid-feedback" v-if="errors.type">
                <p class="error">{{errors.type[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="phone_number" class="control-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" v-model="form.phone_number"
                   :class="{'is-invalid': errors.phone_number}">
            <div class="invalid-feedback" v-if="errors.phone_number">
                <p class="error">{{errors.phone_number[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="timezone" class="control-label">Timezones</label>
            <select class="form-control" v-model="form.timezone" id="timezone" :class="{'is-invalid': errors.timezone}">
                <option :value="0">Select Timezone</option>
                <option v-for="timezone in timezones" :value="timezone">{{timezone}}</option>
            </select>
            <div class="invalid-feedback" v-if="errors.timezone">
                <p class="error">{{errors.timezone[0]}}</p>
            </div>
        </div>
        <div :class="addressErrorClass">
            <label for="address" class="control-label">Address</label>
            <vue-google-autocomplete
                ref="address"
                id="address"
                classname="form-control"
                placeholder="Start typing"
                v-on:placechanged="getAddressData"
            >
            </vue-google-autocomplete>
            <p class="error">
                {{errors.country ? errors.country[0] : ''}}
                <br/>
                {{errors.city ? errors.city[0] : ''}}
            </p>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'
    import VueGoogleAutocomplete from 'vue-google-autocomplete'

    export default {
        name: 'ListForStore',
        components: {VueGoogleAutocomplete},
        data() {
            return {
                brands: {},
                timezones: {},
                form: {
                    brand_id: 0,
                    number: null,
                    name: null,
                    type: 0,
                    phone_number: null,
                    timezone: 0
                },
                addressErrorClass: "form-group",
                teams: {},
                errors: {}
            }
        },
        mounted() {
            this.brands = this.brandsGetter();
            this.timezones = this.timezonesGetter();
            if (!this.brands[0].id) {
                this.getBrands().then(() => {
                    this.brands = this.brandsGetter();
                });
            }
            if (!this.timezones[1]) {
                this.getTimezones().then(() => {
                    this.timezones = this.timezonesGetter();
                });
            }
        },
        methods: {
            ...mapActions({
                create: 'createStore',
                getBrands: 'getBrands',
                getTimezones: 'getTimezones'
            }),
            ...mapGetters({
                brandsGetter: 'getBrands',
                timezonesGetter: 'getTimezones',
                validationMessages: 'getStoreValidationErrors'
            }),
            getAddressData: function (addressData) {
                this.form.postcode = addressData.postal_code;
                this.form.city = addressData.locality;
                this.form.country = addressData.country;
                this.form.latitude = addressData.latitude;
                this.form.longitude = addressData.longitude;
                this.form.street = addressData.street_number;
            },
            handleSubmit: function (e) {
                this.errors = {};
                this.addressErrorClass = 'form-group';
                e.preventDefault();
                this.create({form: this.form}).then(() => {
                    this.$router.push('/stores');
                }).catch(() => {
                    this.errors = this.validationMessages();
                    if (this.errors.country || this.errors.city || this.errors.street) {
                        this.addressErrorClass = 'form-group has-error';
                    }
                });
            }
        }
    }
</script>
