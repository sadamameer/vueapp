<template>

<AppLayout>
    <div class="row">
        <div class="col">
            <h1>Posts</h1>
        </div>
        <div class="col text-end ">
            <inertia-link :href="route('createposts')"><button class="btn btn-primary mx-2">Create</button></inertia-link>
            <button class="btn btn-success" @click="fetchPosts()">Refresh</button>
        </div>
    </div>

    <hr>

    <div class="row" v-if="posts.length">
        <div class="col-4 mb-3" v-for="(post) in posts" :key="post.id">
            <div class="card" style="min-height: 25em;">
                <img :src="getSrc(post.title)" class="w-25 mx-3 mt-3 rounded">
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.body }}</p>
                    <span class="badge bg-success">{{ usersNames[post.userId] }}</span>
                    <hr>
                    <a href="#" class="btn btn-danger btn-sm">Delete Post</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 p-5 text-center" v-else>
        <img src="https://cdn.dribbble.com/users/453325/screenshots/5573953/empty_state.png" class="w-50">
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

            fetchPosts : function () {
                let _this = this;

                _this.posts = [];
             
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