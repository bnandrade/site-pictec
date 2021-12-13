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
                <label class="block">
                    <input type="text" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    text-gray-500
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Título da ideia ou proponente/instituição/município">
                </label>

            </div>


            <div class="p-4 flex grid grid-cols-3 gap-8">



                <!-- GRID PROJETO -->
                <div v-for="value in items" :key="value.id" class="bg-white border rounded shadow p-2 flex flex-col cursor-pointer"
                     v-tooltip="{
            content: asyncMethod(value.instituicao, value.municipio, value.coordenador),
            loadingContent: 'Por favor aguarde...',
            loadingClass: 'carregando conteúdo',
            html: true
          }"
                >
                    <img :src="value.img">
                    <h1 class="my-4 font-bold text-gray-800 border-b">{{ value.title }}</h1>
                    <p class="text-gray-400">{{ value.description }}</p>
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

export default {
    name: "Home",
    components: {
        Navbar,
        Footer
    },
    data(){
        return {
            items: [
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/10',
                    title: 'AGRISEC - Tecnologia Agrícola',
                    description: 'Empresa voltada ao desenvolvimento de tecnologia agrícola, atuando na área de agrometeorologia.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/17',
                    title: 'Artificum Studio',
                    description: 'Startup de base tecnológica voltada ao desenvolvimento de games e simuladores virtuais para a formação profissional.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/39',
                    title: 'BR GARDENS',
                    description: 'A BR GARDENS trabalha com a produção e venda de plantas nativas.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/10',
                    title: 'AGRISEC - Tecnologia Agrícola',
                    description: 'Empresa voltada ao desenvolvimento de tecnologia agrícola, atuando na área de agrometeorologia.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/17',
                    title: 'Artificum Studio',
                    description: 'Startup de base tecnológica voltada ao desenvolvimento de games e simuladores virtuais para a formação profissional.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/39',
                    title: 'BR GARDENS',
                    description: 'A BR GARDENS trabalha com a produção e venda de plantas nativas.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/10',
                    title: 'AGRISEC - Tecnologia Agrícola',
                    description: 'Empresa voltada ao desenvolvimento de tecnologia agrícola, atuando na área de agrometeorologia.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/17',
                    title: 'Artificum Studio',
                    description: 'Startup de base tecnológica voltada ao desenvolvimento de games e simuladores virtuais para a formação profissional.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/39',
                    title: 'BR GARDENS',
                    description: 'A BR GARDENS trabalha com a produção e venda de plantas nativas.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/10',
                    title: 'AGRISEC - Tecnologia Agrícola',
                    description: 'Empresa voltada ao desenvolvimento de tecnologia agrícola, atuando na área de agrometeorologia.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/17',
                    title: 'Artificum Studio',
                    description: 'Startup de base tecnológica voltada ao desenvolvimento de games e simuladores virtuais para a formação profissional.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
                {
                    img: 'https://ms.programacentelha.com.br/empresa/logotipo/39',
                    title: 'BR GARDENS',
                    description: 'A BR GARDENS trabalha com a produção e venda de plantas nativas.',
                    instituicao: 'IFMS',
                    municipio: 'Dourados',
                    coordenador: 'Bruno Andrade'
                },
            ]
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
    }
}
</script>

<style scoped>

</style>
