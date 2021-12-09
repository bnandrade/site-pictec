<template>
    <div>
        <Navbar />

        <!-- EtiquetasEscolares Content-->
        <div>
            <!--Hero-->
            <div class="pt-2">
                <div class="container mt-4 px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
                    <!--Left Col-->
                    <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
                        <p class="uppercase tracking-loose w-full">Volta às aulas 2022</p>
                        <h1 class="my-2 text-5xl font-bold leading-tight">
                            Etiquetas Escolares
                        </h1>
                        <p class="leading-normal text-2xl mb-4">
                            Etiqueta autoadesiva escolar, com corte preciso em máquina de corte. Centenas de temas personalizados.
                        </p>
                        <a href="https://wa.me/5567996251135?text=Olá!%20Vim%20através%20de%20seu%20site.%20Gostaria%20de%20fazer%20um%20orçamento." target="_blank"
                           class="mx-auto lg:mx-0  bg-green-500 text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">

                            <font-awesome-icon :icon="[ 'fab', 'whatsapp' ]" /> Fale conosco
                        </a>
                    </div>
                    <!--Right Col-->
                    <div class="w-full md:w-3/5 py-6 text-center items-center justify-center p-4">

                        <carousel
                            v-bind:autoplay="true"
                            v-bind:loop="true"
                            v-bind:autoplayTimeout="3000"
                            v-bind:paginationEnabled="false"
                            v-bind:autoplayHoverPause="false"
                            :per-page="1" :mouse-drag="true">
                            <slide class=" cursor-pointer p-2 ">
                                <img class="w-full md:w-4/5 z-50 rounded-xl" src="img/tema-ladybug.png" />
                            </slide>
                            <slide class=" cursor-pointer p-2 ">
                                <img class="w-full md:w-4/5 z-50 rounded-xl" src="img/tema-naruto.png" />
                            </slide>

                        </carousel>

                    </div>
                </div>
            </div>
            <div class="relative -mt-12 lg:-mt-24">
                <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                            <path
                                d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                                opacity="0.100000001"
                            ></path>
                            <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
                        </g>
                        <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <path
                                d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
                            ></path>
                        </g>
                    </g>
                </svg>
            </div>
            <section class="bg-white border-b py-8">
                <div class="container max-w-5xl mx-auto m-8">
                    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Escolha qualquer tema que desejar
                    </h1>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>
                    <div class="flex flex-wrap items-center border-b">
                        <div class="w-full sm:w-1/2 p-6">
                            <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                                Centenas de temas
                            </h3>
                            <p class="text-gray-600 mb-8">
                                Temos uma lista com centenas de temas para você escolher, mas se preferir, pode nos enviar o tema de
                                sua preferência que personalizamos suas etiquetas.
                            </p>
                        </div>
                        <div class="w-full sm:w-1/2 p-6">
                            <img class="w-full items-center mx-auto my-4 rounded-xl" src="img/temas.jpeg" />
                        </div>
                    </div>
                    <div class="flex flex-wrap flex-col-reverse sm:flex-row items-center">
                        <div class="w-full sm:w-1/2 p-2 mt-1">
                            <img class="w-full items-center mx-auto my-4 rounded-xl" src="img/alta-qualidade.jpg" />
                        </div>
                        <div class="w-full sm:w-1/2 p-6 mt-1">
                            <div class="align-middle">
                                <h3 class="text-3xl text-gray-800 font-bold leading-none mb-3">
                                    Materiais de alta qualidade
                                </h3>
                                <p class="text-gray-600 mb-2">
                                    Todas as nossas artes digitais contam com conteúdos de alta resolução, deixando suas etiquetas
                                    personalizadas com uma excelente qualidade.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-white border-b py-8">
                <div class="container mx-auto flex flex-wrap pt-4 pb-12">
                    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Tamanhos
                    </h1>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>
                    <div class="w-full px-10 md:px-64 mx-auto block  mt-2 mb-4">
                        <div class="align-middle text-center">

                            <p class="text-gray-600 mb-8">
                                Por padrão, nossas etiquetas personalizadas possuem 4 tamanhos diferentes, o que já atende a praticamente
                                todos os materiais escolares de suas crianças. Mesmo assim, caso deseje algum tamanho específico,
                                entre em contato conosco que ficaremos muito felizes em te atender.
                            </p>
                        </div>
                    </div>

                    <div class="w-full md:w-1/4 p-6 flex flex-col flex-grow flex-shrink">
                        <div class="flex-1 bg-gray-100 rounded-t rounded-b-none overflow-hidden shadow-lg border-2">

                            <div class="w-full font-bold text-2xl text-gray-800 px-6 mt-2">
                                Tamanho 1
                            </div>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Adesivos 5,0 x 1,5 cm
                            </p>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Ideal para lápis e canetinhas.
                            </p>
                            <img class="w-40 items-center mx-auto my-4 rounded-xl" src="img/etiqueta-tamanho-1.png" />
                        </div>
                    </div>
                    <div class="w-full md:w-1/4 p-6 flex flex-col flex-grow flex-shrink">
                        <div class="flex-1 bg-gray-100 rounded-t rounded-b-none overflow-hidden  shadow-lg border-2">
                            <div class="w-full font-bold text-2xl text-gray-800 px-6 mt-2">
                                Tamanho 2
                            </div>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Adesivos 6,0 x 3,0 cm
                            </p>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Ideal para borrachas e apontadores.
                            </p>
                            <img class="w-48 items-center mx-auto my-4 rounded-xl" src="img/etiqueta-tamanho-2.png" />
                        </div>

                    </div>
                    <div class="w-full md:w-1/4 p-6 flex flex-col flex-grow flex-shrink">
                        <div class="flex-1 bg-gray-100 rounded-t rounded-b-none overflow-hidden  shadow-lg border-2">
                            <div class="w-full font-bold text-2xl text-gray-800 px-6 mt-2">
                                Tamanho 3
                            </div>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Adesivos 7,0 x 3,5 cm
                            </p>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Ideal dicionários e agendas.
                            </p>
                            <img class="w-56 items-center mx-auto my-4 rounded-xl" src="img/etiqueta-tamanho-3.png" />
                        </div>

                    </div>
                    <div class="w-full md:w-1/4 p-6 flex flex-col flex-grow flex-shrink">
                        <div class="flex-1 bg-gray-100 rounded-t rounded-b-none overflow-hidden  shadow-lg border-2">
                            <div class="w-full font-bold text-2xl text-gray-800 px-6 mt-2">
                                Tamanho 4
                            </div>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Adesivos 9,0 x 4,7 cm
                            </p>
                            <p class="text-gray-800 text-base px-6 my-2">
                                Ideal para cadernos e livros.
                            </p>
                            <img class="w-64 items-center mx-auto my-4 rounded-xl" src="img/etiqueta-tamanho-4.png" />
                        </div>

                    </div>
                </div>
            </section>
            <section class="bg-gray-100 py-8">
                <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
                    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Nossos Kit's
                    </h1>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4">
                        <div class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4">
                            <div class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow">
                                <div class="p-8 text-3xl font-bold text-center border-b-4">
                                    Kit 1
                                    <span class="block text-base">(54 etiquetas)</span>
                                </div>
                                <ul class="w-full text-center text-sm">
                                    <li class="border-b py-4">28 unidades - Tamanho 1</li>
                                    <li class="border-b py-4">12 unidades - Tamanho 2</li>
                                    <li class="border-b py-4">10 unidades - Tamanho 3</li>
                                    <li class="border-b py-4">04 unidades - Tamanho 4</li>
                                </ul>
                            </div>
                            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                                <div class="w-full pt-6 text-3xl text-gray-600 font-bold text-center">
                                    R$ 24,00
                                </div>
                                <div class="flex items-center justify-center">
                                    <a href="https://wa.me/5567996251135?text=Olá!%20Vim%20através%20de%20seu%20site.%20Tenho%20interesse%20no%20Kit%201." target="_blank"
                                       class="mx-auto lg:mx-0  bg-green-500 text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        <font-awesome-icon :icon="[ 'fab', 'whatsapp' ]" /> Tenho interesse
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-5/6 lg:w-1/3 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10">
                            <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                                <div class="w-full p-8 text-3xl font-bold text-center">Kit 2
                                    <span class="block text-base">(75 etiquetas)</span></div>
                                <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
                                <ul class="w-full text-center text-base font-bold">
                                    <li class="border-b py-4">31 unidades - Tamanho 1</li>
                                    <li class="border-b py-4">21 unidades - Tamanho 2</li>
                                    <li class="border-b py-4">17 unidades - Tamanho 3</li>
                                    <li class="border-b py-4">06 unidades - Tamanho 4</li>
                                </ul>
                            </div>
                            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                                <div class="w-full pt-6 text-4xl font-bold text-center">
                                    R$ 36,50
                                </div>
                                <div class="flex items-center justify-center">
                                    <a href="https://wa.me/5567996251135?text=Olá!%20Vim%20através%20de%20seu%20site.%20Tenho%20interesse%20no%20Kit%202." target="_blank"
                                       class="mx-auto lg:mx-0  bg-green-500 text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        <font-awesome-icon :icon="[ 'fab', 'whatsapp' ]" />  Tenho interesse
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4">
                            <div class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow">
                                <div class="p-8 text-3xl font-bold text-center border-b-4">
                                    Kit 3
                                    <span class="block text-base">(106 etiquetas)</span>
                                </div>
                                <ul class="w-full text-center text-sm">
                                    <li class="border-b py-4">55 unidades - Tamanho 1</li>
                                    <li class="border-b py-4">24 unidades - Tamanho 2</li>
                                    <li class="border-b py-4">17 unidades - Tamanho 3</li>
                                    <li class="border-b py-4">10 unidades - Tamanho 4</li>
                                </ul>
                            </div>
                            <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                                <div class="w-full pt-6 text-3xl text-gray-600 font-bold text-center">
                                    R$ 48,67
                                </div>
                                <div class="flex items-center justify-center">
                                    <a href="https://wa.me/5567996251135?text=Olá!%20Vim%20através%20de%20seu%20site.%20Tenho%20interesse%20no%20Kit%203." target="_blank"
                                       class="mx-auto lg:mx-0  bg-green-500 text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                        <font-awesome-icon :icon="[ 'fab', 'whatsapp' ]" />  Tenho interesse
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Change the colour #f8fafc to match the previous section colour -->
            <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                        <g class="wave" fill="#f8fafc">
                            <path
                                d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"
                            ></path>
                        </g>
                        <g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
                            <g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
                                <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                                <path
                                    d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                                    opacity="0.100000001"
                                ></path>
                                <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" opacity="0.200000003"></path>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>

            <!-- Change the colour #f8fafc to match the previous section colour -->
            <section class="container mx-auto text-center py-6 mb-12">
                <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
                    Chama a gente no Whats!
                </h1>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
                </div>
                <h3 class="my-4 text-3xl leading-tight">
                    Teremos o maior prazer em lhe atender!
                </h3>
                <div class="mt-10">
                    <a href="https://wa.me/5567996251135?text=Olá!%20Vim%20através%20de%20seu%20site.%20Gostaria%20de%20fazer%20um%20orçamento." target="_blank"
                       class="mx-auto lg:mx-0  bg-green-500 text-white font-bold rounded-full py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">

                        <font-awesome-icon :icon="[ 'fab', 'whatsapp' ]" /> Fale conosco
                    </a>
                </div>
            </section>
        </div>
        <!-- EtiquetasEscolares Content-->

        <Footer />
    </div>
</template>

<script>

import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'

import { Carousel, Slide } from 'vue-carousel';

export default {
    name: "Home",
    components: {
        Navbar,
        Carousel,
        Slide,
        Footer
    }
}
</script>

<style scoped>

</style>
