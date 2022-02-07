<template>

<AppLayout>
    <h1>Posts</h1>

    <inertia-link :href="route('create')"><button class="btn btn-primary" @click="createUser()">Create</button></inertia-link>
    <inertia-link :href="route('createposts')"><button class="btn btn-primary  mx-2"  @click="createPosts()">Create Posts</button></inertia-link>

    <table class="table table-hover" v-if="posts.length">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th>Author name</th>
                <th>title</th>
                <th>body</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(post) in posts" :key="post.userId">
                <td>{{ post.id }}</td>
                <td><span class="badge bg-success">{{ usersNames[post.userId] }}</span></td>
                <td>{{ post.title }}</td>
                <td>{{ post.body }}</td>
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
                users : [],
                posts : [],
                usersNames : []
            }
        },
        mounted() {
            this.fetchUsers();
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
                    _this.transformUsers();
                })
                .catch(function (error) {
                    console.log(error);
                    alert("Unable to get users.")
                });
            },

            transformUsers : function () {
                for (let index = 0; index < this.users.length; index++) {
                    this.usersNames[this.users[index].id] = this.users[index].name;
                }

                this.fetchPosts();
            },

            fetchPosts : function () {
                let _this = this;
             
                let config = {
                method: 'get',
                    url: 'https://jsonplaceholder.typicode.com/posts/'
                };
                axios(config)
                .then(function (response) {
                    _this.posts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },
    })
</script>