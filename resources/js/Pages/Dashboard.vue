<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>


        <div class="w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome :documentos="documentos" :setores="setores" :cardapio="cardapio" :avisos="avisos" :filters="filters"/>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

export default {
    props: {
        avisos: Array,
        cardapio: Object,
        setores: Array,
        documentos: Array,
        filters: Object,
    },
    components: {
        AppLayout,
        Welcome,
    },
}
</script>
