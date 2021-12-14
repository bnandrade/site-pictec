<template>
    <jet-action-section class="sm:mt-0">

        <template #content>
            <div class="flex justify-between mb-4">
                <h1 class="my-2 font-semibold">Números</h1>

                <search-filter v-model="form.search" class="w-2/5 max-w-md" @reset="reset">

                </search-filter>
            </div>

            <div class="space-y-6" v-if="numeros.data.length > 0">
                <div class="flex" >
                    <div class="w-full flex flex-col items-start ">
                        <table class="table-fixed text-left w-full">
                            <thead>
                            <tr>
                                <th class="w-2/6 border border-light-blue-500 px-4 py-2 text-light-blue-600">
                                    <div class="flex justify-between">
                                        Imagem
                                    </div>
                                </th>
                                <th class="w-2/6 border border-light-blue-500 px-4 py-2 text-light-blue-600">
                                    <div class="flex justify-between">
                                        Título
                                    </div>
                                </th>
                                <th class="w-2/6 border border-light-blue-500 px-4 py-2 text-light-blue-600">
                                    <div class="flex justify-between">
                                        Número
                                    </div>
                                </th>
                                <th class="w-1/6 border border-light-blue-500 px-4 py-2 text-light-blue-600 text-center">Ações</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="(numero, index) in numeros.data" class="hover:bg-gray-100" :key="numero.id" >
                                <td class=" border border-light-blue-500 px-4 py-2 text-light-blue-600 font-medium"><img :src="numero.imagem"></td>
                                <td class=" border border-light-blue-500 px-4 py-2 text-light-blue-600 font-medium">{{ numero.titulo }}</td>
                                <td class=" border border-light-blue-500 px-4 py-2 text-light-blue-600 font-medium">{{ numero.valor }}</td>
                                <td class=" border border-light-blue-500 px-4 py-2 text-light-blue-600 font-medium text-center"><item :numero="numero"></item></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="flex justify-center">
                    <pagination :links="numeros.links"></pagination>
                </div>
            </div>
        </template>

    </jet-action-section>
</template>

<script>

import JetActionSection from '@/Jetstream/ActionSection'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import Pagination from '@/Components/Pagination'
import SearchFilter from '@/Components/SearchFilter'
import mapValues from 'lodash/mapValues'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import JetInput from '@/Jetstream/Input'
import Item from "./Item"

export default {
    components: {
        JetActionSection,
        JetSectionBorder,
        Pagination,
        SearchFilter,
        JetInput,
        Item,
    },
    props: {
        'numeros': Object,
        'filters': Object
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                order: this.filters.order,
            },
        }
    },
    watch: {
        form: {
            handler: _.debounce(function() {
                let query = pickBy(this.form);
                let route = this.route('numeros', Object.keys(query).length ? query : { remember: 'forget' });
                this.$inertia.get(route, {}, { preserveScroll: true, preserveState: true })
            }, 150),
            deep: true,
        },
    },



    methods: {
        order(ord) {
            this.form.order = ord
        },
        reset() {
            this.form = mapValues(this.form, () => null)
        },
    },


}
</script>

<style scoped>

</style>
