<template>
    <Link :href="'/'">
        <img src="https://smartlane.pk/assets/images/logo.png">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
