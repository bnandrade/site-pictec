<template>
    <div class="md:grid md:grid-cols-12 md:gap-6">

        <div class="mt-2 md:mt-0 col-span-12">
            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                <jet-banner />
                <jet-section-title>
                    <template #title><slot name="title"></slot></template>
                    <template #description><slot name="description"></slot></template>
                </jet-section-title>
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

<script>
import JetSectionTitle from './SectionTitle'
import JetBanner from '@/Jetstream/Banner'

export default {
    components: {
        JetSectionTitle,
        JetBanner
    }
}
</script>
