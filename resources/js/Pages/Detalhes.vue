<template>
    <div>
        <Navbar />

        <div class="w-full container mx-auto flex flex-col max-w-6xl bg-white my-4 px-6 py-4 text-gray-500 rounded-t-lg">

            <a href="/" class="hover:underline text-red-400"><font-awesome-icon :icon="[ 'far', 'arrow-alt-circle-left' ]" /> Voltar</a>

            <div class="mt-4 border-b">
                <p class="text-2xl">Detalhes do Projeto</p>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="p-4 w-full md:w-3/5">
                    <img class="w-24" :src="$page.props.projeto[0].capa" />
                </div>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="p-4 w-full md:w-3/5">
                    <span class="font-bold">Titulo:</span><br>{{ $page.props.projeto[0].titulo }}
                </div>
                <div class="p-4 w-full md:w-1/5">
                    <span class="font-bold">Instituição:</span><br> {{ $page.props.projeto[0].instituicao }}
                </div>
                <div class="p-4 w-full md:w-1/5">
                    <span class="font-bold">Cidade:</span><br> {{ $page.props.projeto[0].cidade }}
                </div>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="p-4 w-full md:w-3/6">
                    <span class="font-bold">Resumo:</span><br>{{ $page.props.projeto[0].resumo }}
                </div>
                <div class="p-4 w-full md:w-1/6">
                    <span class="font-bold">Coordenador:</span><br> {{ $page.props.projeto[0].coordenador }}
                </div>
                <div class="p-4 w-full md:w-2/6">
                    <span class="font-bold">Bolsistas:</span><br> {{ $page.props.projeto[0].bolsistas }}
                </div>
            </div>

            <div class="flex flex-col md:flex-row">
                <div class="p-4 w-full md:w-3/6">
                    <span class="font-bold">Vídeo:</span><br>
                    <a :href="$page.props.projeto[0].url_video" target="_blank" class="text-blue-600 hover:text-gray-500">{{ $page.props.projeto[0].url_video }}</a>
                </div>
                <div class="p-4 w-full md:w-3/6">
                    <span class="font-bold">Fotos:</span><br>
                    <a :href="$page.props.projeto[0].url_foto" target="_blank" class="text-blue-600 hover:text-gray-500">{{ $page.props.projeto[0].url_foto }}</a>
                </div>
            </div>


        </div>

        <Footer />
    </div>
</template>

<script>

import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import SearchFilter from '@/Components/SearchFilter'
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";

export default {
    name: "Detalhes",
    props: {
        projeto: Array,
    },
    components: {
        Navbar,
        SearchFilter,
        Footer
    },
    data(){
        return {
        }
    },

}
</script>

<style scoped>

</style>
