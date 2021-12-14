<template>
    <div>
        <div class="mx-1 px-2 sm:p-2 sm:px-20 bg-white border-b border-gray-200">

        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-12 border-b border-gray-200">
            <div class="p-2 md:col-span-6  md:border-b">
                <div class="flex items-center ml-2">
                    <i class="far fa-comment-dots"></i>
                    <div class="ml-2 text-lg text-gray-600 leading-7 font-semibold">Central de Avisos</div>
                </div>

                <carousel
                    v-bind:autoplay="true"
                    v-bind:loop="true"
                    v-bind:autoplayTimeout="4000"
                    v-bind:autoplayHoverPause="true"
                    :per-page="1" :mouse-drag="true">
                    <slide

                        v-for="(aviso, index) in avisos" :key="aviso.id" @slideclick="showModal(aviso.titulo, aviso.conteudo, aviso.imagem, aviso.anexo)"
                        class=" cursor-pointer p-2 h-72">
                        <h1 class="block bg-black opacity-75 text-bold text-white p-2 text-lg" >{{ aviso.titulo }}</h1>
                        <img v-if="aviso.imagem" :src="aviso.imagem" class="w-full" />
                    </slide>

                </carousel>


                <modal name="my-first-modal">
                    This is my first modal
                </modal>

            </div>


        </div>

    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import SearchFilter from '@/Components/SearchFilter'
    import throttle from 'lodash/throttle'

    import { Carousel, Slide } from 'vue-carousel';
    import pickBy from "lodash/pickBy";
    import mapValues from "lodash/mapValues";

    export default {
        props: {
            filters: Object
        },
        components: {
            JetApplicationLogo,
            JetDialogModal,
            JetSecondaryButton,
            SearchFilter,
            Carousel,
            Slide,
        },
        data() {
            return {
                form: {
                    search: this.filters.search,
                    order: this.filters.order,
                },
            }
        },
        methods: {
            showModal(title, content, image = null, attach = null) {
                console.log(attach)
                this.$modal.show(
                    {
                        template: `
                                  <div class="px-4 py-2 rounded-xl">
                                    <h1 class="text-bold text-gray-500 mb-4 text-2xl">{{ title }}</h1>
                                    <img v-if="image" :src="image" class="w-full rounded" />
                                    <p v-html="content" class="my-2"></p>
                                    <p><a v-if="attach" :href="attach" target="_blank" class="text-blue-500 hover:text-blue-300">Clique aqui para visualizar o anexo</a></p>
                                  </div>
                                `,
                        props: ['title', 'content', 'image', 'attach']
                    },
                    {
                        title: title,
                        content: content,
                        image: image,
                        attach: attach,
                    },
                    {height: 'auto'},
                    {
                        'before-close': event => {
                        }
                    }
                )
            },
            hide() {
                this.$modal.hide('my-first-modal');
            },
            order(ord) {
                this.form.order = ord
            },
            reset() {
                this.form = mapValues(this.form, () => null)
            },
        },
        mount() {
            this.show()
        },
        watch: {
            form: {
                handler: _.debounce(function() {
                    let query = pickBy(this.form);
                    let route = this.route('dashboard', Object.keys(query).length ? query : { remember: 'forget' });
                    this.$inertia.get(route, {}, { preserveScroll: true, preserveState: true })
                }, 150),
                deep: true,
            },
        },

    }
</script>
