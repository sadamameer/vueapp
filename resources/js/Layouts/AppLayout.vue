<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <inertia-link class="navbar-brand" href="/">VueBlog</inertia-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <inertia-link :class="(currentRoute == 'users') ? 'active' : ''" class="nav-link" aria-current="page" :href="route('users')">Users</inertia-link>
                        </li>
                        <li class="nav-item">
                            <inertia-link :class="(currentRoute == 'posts') ? 'active' : ''" class="nav-link" aria-current="page" :href="route('posts')">Posts</inertia-link>
                        </li>
                    </ul>
                </div>
                <div class="d-flex" v-if="$page.props.user">
                    <h6 class="mt-2 mx-4">Welcome, {{ $page.props.user.name }}</h6>
                    <button class="btn btn-danger" @click="logout">Logout</button>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default ({
        props: {
            title: String,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },
        },

        computed: {
            currentRoute : function () {
                return route().current();
            }
        },
    })
</script>
