<template>

    <jet-form-section @submitted="store">

        <template #form>


            <div class="col-span-12">
                <label class="block font-medium text-sm text-gray-700">Imagem de capa do projeto:</label>
                <input type="file" class="form-input rounded-md shadow-sm block mt-1 p-2 w-full border focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-transparent " @change="onImageChange" >

                <div v-if="imagePreview" class="w-1/2 mx-auto">
                    <img :src="imagePreview" class="w-full" />
                </div>

            </div>
            <div class="col-span-6 ">
                <jet-label for="titulo" value="Titulo do Projeto" />
                <jet-input id="titulo" type="text" class="mt-1 block w-full" v-model="form.titulo" autofocus  />
                <jet-input-error :message="form.errors.titulo" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <jet-label for="instituicao" value="Instituição" />
                <jet-input id="instituicao" type="text" class="mt-1 block w-full" v-model="form.instituicao"   />
                <jet-input-error :message="form.errors.instituicao" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <jet-label for="cidade" value="Cidade" />
                <jet-input id="cidade" type="text" class="mt-1 block w-full" v-model="form.cidade" autofocus  />
                <jet-input-error :message="form.errors.cidade" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <jet-label for="coordenador" value="Coordenador" />
                <jet-input id="coordenador" type="text" class="mt-1 block w-full" v-model="form.coordenador"   />
                <jet-input-error :message="form.errors.coordenador" class="mt-2" />
            </div>

            <div class="col-span-12 ">
                <jet-label for="bolsistas" value="Bolsistas" />
                <jet-input id="bolsistas" type="text" class="mt-1 block w-full" v-model="form.bolsistas"   />
                <jet-input-error :message="form.errors.bolsistas" class="mt-2" />
            </div>

            <div class="col-span-12 ">
                <jet-label for="resumo" value="Resumo" />
                <jet-input id="resumo" type="text" class="mt-1 block w-full" v-model="form.resumo"   />
                <jet-input-error :message="form.errors.resumo" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <jet-label for="url_video" value="Url do Vídeo" />
                <jet-input id="url_video" type="text" class="mt-1 block w-full" v-model="form.url_video"   />
                <jet-input-error :message="form.errors.url_video" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <jet-label for="url_foto" value="Url da Foto" />
                <jet-input id="url_foto" type="text" class="mt-1 block w-full" v-model="form.url_foto"   />
                <jet-input-error :message="form.errors.url_foto" class="mt-2" />
            </div>


        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Projeto criado
            </jet-action-message>
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Criar
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>

import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetSectionBorder from '@/Jetstream/SectionBorder'

export default {
    name: "New",
    props: {
    },
    components: {
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetActionMessage,
        JetSecondaryButton,
        JetSectionBorder,
    },
    data() {
        return {
            form: this.$inertia.form({
                capa: '',
                titulo: '',
                instituicao: '',
                cidade: '',
                coordenador: '',
                bolsistas: '',
                resumo: '',
                url_video: '',
                url_foto: '',
                ano: '',
            }),

            imagePreview: '',

        }
    },

    methods: {
        store() {
            this.form.post(route('projeto.store'), {
                errorBag: 'projetoStore',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                }
            });
        },

        onImageChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.form.capa = files[0];
        },
    },
}
</script>

<style scoped>

</style>
