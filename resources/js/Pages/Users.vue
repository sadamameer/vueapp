<template>

<AppLayout>
    <h1>Users</h1>

    <inertia-link :href="route('create')"><button class="btn btn-primary" @click="createUser()">Create</button></inertia-link>
    <button class="btn btn-primary mx-2" @click="fetchUsers()">Refresh</button>

    <table class="table table-hover" v-if="users.length">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th>name</th>
                <th>username</th>
                <th>email</th>
                <th>address</th>
                <th>phone</th>
                <th>website</th>
                <th>company</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.username }}</td>
                <td><span class="badge bg-success">{{ user.email }}</span></td>
                <td>{{ user.address.street }}, {{ user.address.suite }}, {{ user.address.city }}, {{ user.address.zipcode }}</td>
                <td>{{ user.phone }}</td>
                <td><a :href="'http://' + user.website" target="_blank">{{ user.website }}</a></td>
                <td>{{ user.company.name }}</td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
        </tbody>
    </table>

    <div class="container mt-5 p-5 text-center" v-else>
        <h1>Nothing found!</h1>
    </div>
</AppLayout>

</template>

<script>

    import AppLayout from '@/Layouts/AppLayout.vue'

    export default ({

        components: {
            AppLayout
        },

        data() {
            return {
                users : []
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
            
            deleteUser : function (id) {

                let _this = this;

                _this.users = [];
                
                let config = {
                    method: 'delete',
                    url: 'https://jsonplaceholder.typicode.com/users/' + id
                };

                axios(config)
                .then(function (response) {
                    _this.users = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

        },

        watch: {
        },

        computed: {
        },
    })
</script>