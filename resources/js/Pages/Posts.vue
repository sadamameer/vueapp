<template>

<AppLayout>
    <h1>Posts</h1>

    <inertia-link :href="route('create')"><button class="btn btn-primary" @click="createUser()">Create</button></inertia-link>
    <inertia-link :href="route('createposts')"><button class="btn btn-primary  mx-2"  @click="createPosts()">Create Posts</button></inertia-link>

    <table class="table table-hover" v-if="posts.length">
        <thead>
            <tr>
                <th scope="col">userId</th>
                <th>id</th>
                <th>title</th>
                <th>body</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(post) in posts" :key="post.userId">
                <td>{{ post.userId }}</td>
                <td>{{ post.id }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.body }}</td>
                <td><button class="btn btn-primary">Delete</button></td>
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
                posts : []
            }
        },
        mounted() {
            this.fetchPosts()
        },

        methods: {
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