<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-3 py-2 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
            <inertia-link v-else :key="key" class="mr-1 mb-1 px-3 py-2 text-sm leading-4 border rounded hover:bg-sistema-primary hover:text-white focus:border-red-900 focus:text-red-900" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
        </template>
        </div>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array,
    }
}
</script>

<style scoped>

</style>
