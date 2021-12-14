<template>
    <div>
        <Navbar />

        <div class="w-full container mx-auto flex flex-col max-w-6xl bg-white my-4 px-6 py-4 text-gray-500 rounded-t-lg">

            <!-- IMAGEM DE CAPA -->
            <div class="bg-gray-200 w-full pt-6 mx-auto ">
                <div class=" h-64 items-center text-center">FOTO</div>
            </div>
            <!-- IMAGEM DE CAPA -->

            <div class="mt-4 border-b">
                <p class="text-2xl">Números da edição</p>
            </div>

            <div class="p-4 flex flex-wrap justify-center">

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-blue-200 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números A</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-blue-400 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números B</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-red-400 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números C</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-green-400 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números D</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-red-200 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números E</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-yellow-400 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números F</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-yellow-200 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números G</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

                <!-- Ícone números -->
                <div class="flex flex-col text-center mx-4">
                    <div class="bg-pink-400 rounded-full w-24 h-24 "></div>
                    <p class="border-b">Números H</p>
                    <p class="text-gray-700 text-xl font-bold">999</p>
                </div>
                <!-- Ícone números -->

            </div>


            <div class="mt-8 border-b">
                <p class="text-2xl">Idéias contempladas</p>
            </div>

            <div class="p-4 flex grid grid-cols-1 gap-4">

                <search-filter v-model="form.search" :placeholder="'Buscar pelo Título da ideia ou coordenador/instituição/cidade'" class="block" @reset="reset">

                </search-filter>

            </div>


            <div class="p-4 flex grid grid-cols-3 gap-8">
                <!-- GRID PROJETO -->
                <div v-for="(projeto, index) in projetos.data" :key="projeto.id" class="bg-white border rounded shadow p-2 flex flex-col cursor-pointer"
                     v-tooltip="{
                        content: asyncMethod(projeto.instituicao, projeto.cidade, projeto.coordenador),
                        loadingContent: 'Por favor aguarde...',
                        loadingClass: 'carregando conteúdo',
                        html: true
                      }"
                    >
                    <!-- <img :src="projeto.url_foto">-->
                    <h1 class="my-4 font-bold text-gray-800 border-b">{{ projeto.titulo }}</h1>
                    <p class="text-gray-400">{{ projeto.resumo }}</p>
                </div>
                <!-- GRID PROJETO -->




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
    name: "Home",
    props: {
        projetos: Object,
        filters: Object
    },
    components: {
        Navbar,
        SearchFilter,
        Footer
    },
    data(){
        return {
            form: {
                search: this.filters.search,
                order: this.filters.order,
            },
        }
    },
    methods: {
        asyncMethod(instituicao, municipio, coordenador){
            return "<div class='bg-gray-600 max-w-xs p-4 border text-white shadow rounded-md'>" +
                "Instituição: " + instituicao +
                "<br>" +
                "Município: " + municipio +
                "<br>" +
                "Coordenador: " + coordenador +
                "</div>"
        },
        order(ord) {
            this.form.order = ord
        },
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },
    watch: {
        form: {
            handler: _.debounce(function() {
                let query = pickBy(this.form);
                let route = this.route('home', Object.keys(query).length ? query : { remember: 'forget' });
                this.$inertia.get(route, {}, { preserveScroll: true, preserveState: true })
            }, 150),
            deep: true,
        },
    },
}
</script>

<style scoped>

</style>
