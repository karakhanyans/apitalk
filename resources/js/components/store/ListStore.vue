<template>
    <div>
        <h1 class="title">Stores</h1>
        <div class="form-group">
            <input type="text" v-model="searchKeyword"
                   @keyup="filterList"
                   placeholder="Search by Address..." class="form-control search-input"/>
        </div>
        <div>
            <router-link to="/store/create" class="btn">Create</router-link>
        </div>
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Number</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="store in stores" :key="store.id">
                <td>{{store.brand.name}}</td>
                <td>{{store.number}}</td>
                <td>{{store.name}}</td>
                <td>{{store.address}}</td>
                <td>
                    <router-link :to="{path:'/store/'+store.id}" class="btn">Detail</router-link>
                    <router-link :to="{path:'/store/edit/'+store.id}" class="btn">Edit</router-link>
                    <button type="button" @click="deleteItem(store.id)" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button type="button" class="btn" @click="prevPage()">Prev</button>
            <button type="button" class="btn" @click="nextPage()">Next</button>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: 'ListStores',
        data() {
            return {
                staticData: {},
                stores: {},
                searchKeyword: "",
                teamId: 0,
                page: 1
            }
        },
        mounted() {
            this.getAll({page: this.page}).then(() => {
                this.staticData = this.getList();
                this.stores = this.staticData;
            });
        },
        methods: {
            ...mapActions({
                getAll: 'getStores',
                deleteStore: 'deleteStore'
            }),
            ...mapGetters({
                getList: 'getStores'
            }),
            prevPage: function () {
                if (this.page > 1) {
                    this.page -= 1;
                    this.getAll({page: this.page}).then(() => {
                        this.staticData = this.getList();
                        this.stores = this.staticData;
                    });
                }
            },
            nextPage: function () {
                this.page += 1;
                this.getAll({page: this.page}).then(() => {
                    this.staticData = this.getList();
                    this.stores = this.staticData;
                });
            },
            deleteItem: function (id) {
                swal({
                    title: "Are you sure?",
                    text: "You want delete this store?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            this.deleteStore({id}).then(() => {
                                this.staticData = this.getList();
                                this.stores = this.staticData;
                            });
                        }
                    });
            },
            filterList() {
                this.stores = this.staticData.filter(store => {
                    return store.address.toLowerCase().includes(this.searchKeyword.toLowerCase());
                });
            }
        }
    }
</script>
