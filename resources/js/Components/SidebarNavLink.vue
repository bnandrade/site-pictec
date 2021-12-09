<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
export default {
    props: ['href', 'active'],

    computed: {
        classes() {
            return this.active
                ? 'flex items-center px-2 py-1 mt-2 text-gray-700 bg-gray-200 rounded-md dark:bg-gray-700 dark:text-gray-200'
                : 'flex items-center px-2 py-1 mt-2 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700'
        }
    }
}
</script>
