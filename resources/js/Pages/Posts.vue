<template>
<AppLayout>
    <div class="row">
        <div class="col">
            <h1>{{ (posts.length) ? posts.length : "" }} Posts</h1>
        </div>
        <div class="col text-center" v-if="posts.length">
            <select class="form-control" v-model="selectedUser">
                <option value="">-- Select User --</option>
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name}}</option>
            </select>
        </div>
        <div class="col text-end ">
            <inertia-link :href="route('createposts')"><button class="btn btn-primary mx-2">Create New Post</button></inertia-link>
            <button class="btn btn-success" @click="fetchPosts()">Refresh</button>
        </div>
    </div>

    <hr>

    <div class="row" v-if="posts.length">
        <div class="col-4 mb-3" v-for="(post, i) in posts" :key="post.id">
            <div class="card" style="min-height: 25em;">
                <img :src="getSrc(post.title)" class="w-25 mx-3 mt-3 rounded">
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.body }}</p>
                    <span class="badge bg-success">{{ usersNames[post.userId] }}</span>
                    <hr>
                    <td><button  @click="deleteUser(post.id, i)" class="btn btn-danger">Delete</button></td>
                </div>
            </div>
        </div>
    </div>
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
                selectedUser : "",
                usersNames : [],
            }
        },
        mounted() {
            this.fetchUsers();
        },

        methods: {
            getSrc : function (title) {
                return "https://ui-avatars.com/api/?name="+ title +"&color=F05430&background=000";
            },



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

            fetchPosts : function (flag = false) {
                let _this = this;
                _this.posts = [];

                let apiUrl = 'https://jsonplaceholder.typicode.com/posts';

                if (flag && this.selectedUser) {
                    apiUrl = apiUrl + '?userId=' + this.selectedUser;
                }
             
                let config = {
                method: 'get',
                    url: apiUrl
                };
                axios(config)
                .then(function (response) {
                    _this.posts = response.data;

                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            fetchUserPosts : function () {
                let _this = this;
                _this.posts = [];
             
                let config = {
                method: 'get',
                    url: 'https://jsonplaceholder.typicode.com/posts?userId=' + this.selectedUser
                };
                axios(config)
                .then(function (response) {
                    _this.posts = response.data;

                })
                .catch(function (error) {
                    console.log(error);
                });
            },


            deleteUser : function (id, i) {

                let _this = this;
                
                let config = {
                    method: 'delete',
                    url: 'https://jsonplaceholder.typicode.com/posts/' + id
                };

                axios(config)
                .then(function (response) {
                    _this.posts.splice(i, 1);
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        },

        watch : {
            selectedUser : function () {
                this.fetchPosts(true);
            }
        }
    })
</script>