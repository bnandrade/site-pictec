<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white shadow rounded">
            <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm relative w-full px-6 py-3 rounded-r focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Busca…" :value="value" @input="$emit('input', $event.target.value)">

        </div>
        <button class="z-30 -ml-6 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500" type="button" @click="$emit('reset')" v-tooltip="'Limpar busca'"><i class="far fa-times-circle"></i></button>
    </div>
</template>

<script>

import JetInput from '@/Jetstream/Input'

export default {
    name: "SearchFilter",
    components: {
        JetInput
    },
    props: {
        value: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
}
</script>
