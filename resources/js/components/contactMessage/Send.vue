<template>
    <form class="col-md-3" v-on:submit.prevent="handleSubmit">
        <p class="success" v-if="successed"><b>Contact message send</b></p>
        <h1 class="title">Contact Us</h1>
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" class="form-control" id="name" v-model="form.name"
                   :class="{'is-invalid': errors.name}">
            <div class="invalid-feedback" v-if="errors.name">
                <p class="error">{{errors.name[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="text" class="form-control" id="email" v-model="form.email"
                   :class="{'is-invalid': errors.email}">
            <div class="invalid-feedback" v-if="errors.email">
                <p>{{errors.email[0]}}</p>
            </div>
        </div>
        <div class="form-group">
            <label for="age" class="control-label">Age</label>
            <input type="number" class="form-control" id="age" v-model="form.age"
                   :class="{'is-invalid': errors.age}">
            <div class="invalid-feedback" v-if="errors.age">
                <p class="error">{{errors.age[0]}}</p>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: 'Send',
        data() {
            return {
                form: {
                    name: "",
                    email: "",
                    age: 18
                },
                successed: false,
                errors: {}
            }
        },
        methods: {
            ...mapActions(['send']),
            ...mapGetters({
                validationMessages: 'getContactMessageValidationErrors'
            }),
            handleSubmit: function (e) {
                this.errors = {};
                e.preventDefault();
                this.send({form: this.form}).then(() => {
                    this.successed = true;
                }).catch(() => {
                    this.errors = this.validationMessages();
                });
            }
        }
    }
</script>
