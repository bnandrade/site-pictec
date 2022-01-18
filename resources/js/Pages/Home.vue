<template>
    <div>
        <Navbar />

        <div class="w-full container mx-auto flex flex-col max-w-6xl bg-white my-4 px-6 py-4 text-gray-500 rounded-t-lg">

            <!-- IMAGEM DE CAPA -->
            <div class="bg-gray-200 w-full pt-6 mx-auto ">
                <div class=" my-4 items-center text-center">
                    <img :src="$props.banner">
                </div>
            </div>
            <!-- IMAGEM DE CAPA -->

            <div class="mt-4 border-b">
                <p class="text-2xl">Números da Edição 2021</p>
            </div>

            <div class="p-4 flex flex-wrap justify-center">

                <!-- Ícone números -->
                <div v-for="(numero, index) in numeros.data" :key="numero.id" class="flex flex-col text-center mx-4">
                    <img :src="numero.imagem" class="w-24 my-2 mx-auto rounded-full">
                    <p class="border-b">{{ numero.titulo }}</p>
                    <p class="text-gray-700 text-xl font-bold">{{ numero.valor }}</p>
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


            <div class="p-4 flex flex-col sm:grid sm:grid-cols-3 sm:gap-8">
                <!-- GRID PROJETO -->
                <div v-for="(projeto, index) in projetos.data" :key="projeto.id" class="my-4 sm:my-0 bg-white border rounded shadow p-2 flex flex-col cursor-pointer"
                     v-tooltip="{
                        content: asyncMethod(projeto.instituicao, projeto.cidade, projeto.coordenador),
                        loadingContent: 'Por favor aguarde...',
                        loadingClass: 'carregando conteúdo',
                        html: true
                      }"
                    >
                    <a :href="route('detalhes.projeto', projeto.id)" class="cursor-pointer">
                        <!-- <img :src="projeto.url_foto">-->
                        <h1 class="my-4 font-bold text-gray-800 border-b"><img class="w-full" :src="projeto.capa" /></h1>
                        <h1 class="my-4 font-bold text-gray-800 border-b">{{ projeto.titulo }}</h1>
                        <p class="text-gray-400">{{ projeto.resumo }}</p>
                    </a>

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
        banner: String,
        numeros: Object,
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
