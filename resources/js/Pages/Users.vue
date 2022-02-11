<template>

<AppLayout>
    <div class="row">
        <div class="col">
            <h1>Users</h1>
        </div>
        <div class="col text-end ">
            <inertia-link :href="route('create')"><button class="btn btn-primary" @click="createUser()">Create</button></inertia-link>
            <button class="btn btn-success mx-2" @click="fetchUsers()">Refresh</button>
        </div>
    </div>

    <hr>

    <div v-if="deleted" class="alert alert-danger">
        User Data  Delete
    </div>
    <table class="table table-hover" v-if="users.length">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Website</th>
                <th>Company</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user, i) in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td><span class="badge bg-primary">{{ user.username }}</span></td>
                <td><span class="badge bg-success">{{ user.email }}</span></td>
                <td>{{ user.address.street }}, {{ user.address.suite }}, {{ user.address.city }}, {{ user.address.zipcode }}  {{ user.address.geo.lat }} {{ user.address.geo.lng }}</td>
                <td>{{ user.phone }}</td>
                <td><a :href="'http://' + user.website" target="_blank">{{ user.website }}</a></td>
                <td>{{ user.company.name }}</td>
                <td><button  @click="deleteUser(user.id, i)" class="btn btn-danger">Delete</button></td>
            </tr>
        </tbody>
    </table>
    <div class="container mt-5 p-5 text-center" v-else>
        <img src="https://cdn.dribbble.com/users/453325/screenshots/5573953/empty_state.png" class="w-50">
    </div>
</AppLayout>

</template>

<script>

    import AppLayout from '@/Layouts/AppLayout.vue'
    import axios from 'axios';

    export default ({

        components: {
            AppLayout
        },

        data() {
            return {
                users : [],
            }
        },
        

        watch:{
            count(val){
               if(val>5){
                   alert("stop counting")
               }
            }
        },


        mounted() {
            this.fetchUsers()
        },

        methods: {

            fetchUsers : function () {

                let _this = this;

                _this.users = [];
                
                let config = {
                    method: 'get',
                    url: 'https://jsonplaceholder.typicode.com/users/'
                };

                axios(config)
                .then(function (response) {
                    _this.users = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            deleteUser : function (id, i) {

                let _this = this;
                
                let config = {
                    method: 'delete',
                    url: 'https://jsonplaceholder.typicode.com/users/' + id
                };

                axios(config)
                .then(function (response) {
                    _this.users.splice(i, 1);
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },

    })
</script>