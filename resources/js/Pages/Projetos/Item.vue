<template>
    <div class="flex justify-center">

        <button
            class="cursor-pointer text-sm text-gray-400 focus:outline-none mx-2"
            @click="updating = true" v-tooltip="'Editar projeto'"
            v-if="$page.props.auth.user.can['projeto-editar'] || $page.props.auth.user.role['Super.Admin']">
            <font-awesome-icon :icon="[ 'far', 'edit' ]" />
        </button>
        <button
            class="cursor-pointer text-sm text-red-200 focus:outline-none mx-2"
            v-else
            v-tooltip="'Você não tem permissão de Editar'">
            <font-awesome-icon :icon="[ 'far', 'times-circle' ]" />
        </button>

        <button
            class="cursor-pointer  text-sm text-red-500 focus:outline-none mx-2"
            @click="destroying = true" v-tooltip="'Excluir projeto'"
            v-if="$page.props.auth.user.can['projeto-deletar'] || $page.props.auth.user.role['Super.Admin']">
            <font-awesome-icon :icon="[ 'far', 'trash-alt' ]" />
        </button>
        <button
            class="cursor-pointer text-sm text-red-200 focus:outline-none mx-2"
            v-else
            v-tooltip="'Você não tem permissão de Deletar'">
            <font-awesome-icon :icon="[ 'far', 'times-circle' ]" />
        </button>

        <jet-dialog-modal :show="updating" @close="updating = false">
            <template #title>
                Atualizar Projeto
            </template>

            <template #content>


                <div class="col-span-6 my-4 flex gap-4 items-center">
                    <div class="w-3/6">
                        <label class="block font-medium text-sm text-gray-700">Imagem de capa:</label>
                        <input type="file" class="form-input rounded-md shadow-sm block mt-1 p-2 w-full border focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-transparent " @change="onImageChange" >
                    </div>
                    <div class="w-3/6">
                        <div v-if="imagePreview">
                            <img class="rounded" :src="imagePreview"/>
                        </div>
                    </div>

                </div>

                <div class="">
                    <jet-label for="titulo" value="Título do projeto" />
                    <jet-input id="titulo" type="text" class="mt-1 block w-full" v-model="updateForm.titulo"  />
                    <jet-input-error :message="updateForm.errors.titulo" class="mt-2" />
                </div>

                <div class=" mt-4">
                    <jet-label for="instituicao" value="Instituição" />
                    <jet-input id="instituicao" type="text" class="mt-1 block w-full" v-model="updateForm.instituicao"  />
                    <jet-input-error :message="updateForm.errors.instituicao" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="cidade" value="Cidade" />
                    <jet-input id="cidade" type="text" class="mt-1 block w-full" v-model="updateForm.cidade"  />
                    <jet-input-error :message="updateForm.errors.cidade" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="coordenador" value="Coordenador" />
                    <jet-input id="coordenador" type="text" class="mt-1 block w-full" v-model="updateForm.coordenador"  />
                    <jet-input-error :message="updateForm.errors.coordenador" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="bolsistas" value="Bolsistas" />
                    <jet-input id="bolsistas" type="text" class="mt-1 block w-full" v-model="updateForm.bolsistas"  />
                    <jet-input-error :message="updateForm.errors.bolsistas" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="resumo" value="Resumo" />
                    <jet-input id="resumo" type="text" class="mt-1 block w-full" v-model="updateForm.resumo"  />
                    <jet-input-error :message="updateForm.errors.resumo" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="url_video" value="Url do vídeo" />
                    <jet-input id="url_video" type="text" class="mt-1 block w-full" v-model="updateForm.url_video"  />
                    <jet-input-error :message="updateForm.errors.url_video" class="mt-2" />
                </div>

                <div class="mt-4">
                    <jet-label for="url_foto" value="Url da foto" />
                    <jet-input id="url_foto" type="text" class="mt-1 block w-full" v-model="updateForm.url_foto"  />
                    <jet-input-error :message="updateForm.errors.url_foto" class="mt-2" />
                </div>

            </template>

            <template #footer>
                <jet-secondary-button @click.native="updating = false">
                    Cancelar
                </jet-secondary-button>

                <jet-button class="ml-2" @click.native="update" :class="{ 'opacity-25': updateForm.processing }" :disabled="updateForm.processing">
                    Salvar
                </jet-button>
            </template>

        </jet-dialog-modal>

        <jet-confirmation-modal :show="destroying" @close="destroying = false">
            <template #title>
                Deletar Projeto
            </template>

            <template #content>
                Você tem certeza que deseja deletar?
            </template>

            <template #footer>
                <jet-secondary-button @click.native="destroying = false">
                    Cancelar
                </jet-secondary-button>


                <jet-danger-button class="ml-2" @click.native="destroy" :class="{ 'opacity-25': updateForm.processing }" :disabled="updateForm.processing">
                    Deletar
                </jet-danger-button>
            </template>

        </jet-confirmation-modal>


    </div>
</template>


<script>
import JetButton from '@/Jetstream/Button'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'


export default {
    props: {
        'projeto': Object,
    },

    components: {
        JetButton,
        JetConfirmationModal,
        JetDangerButton,
        JetDialogModal,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetSectionBorder
    },

    data() {
        return {
            updateForm: this.$inertia.form({
                capa: '',
                titulo: this.projeto.titulo,
                instituicao: this.projeto.instituicao,
                cidade: this.projeto.cidade,
                coordenador: this.projeto.coordenador,
                bolsistas: this.projeto.bolsistas,
                resumo: this.projeto.resumo,
                url_video: this.projeto.url_video,
                url_foto: this.projeto.url_foto,
                ano: this.projeto.ano,
            }),
            capa: '',
            imagePreview: this.projeto.capa,

            updating: false,

            destroyForm: this.$inertia.form(),
            destroying: false,

        }
    },

    methods: {
        update() {

            const data = {
                _method : 'PUT',
                capa: this.capa,
                titulo: this.updateForm.titulo,
                instituicao: this.updateForm.instituicao,
                cidade: this.updateForm.cidade,
                coordenador: this.updateForm.coordenador,
                bolsistas: this.updateForm.bolsistas,
                resumo: this.updateForm.resumo,
                url_video: this.updateForm.url_video,
                url_foto: this.updateForm.url_foto,
                ano: this.updateForm.ano,
            }

            this.$inertia.post(this.route('projeto.update', this.projeto), data, {
                errorBag: 'projetoUpdate',
                preserveScroll: true,
                onSuccess: () => {
                    this.updateForm.reset()
                    this.updateForm.capa = ''
                    this.updateForm.titulo = ''
                    this.updateForm.instituicao = ''
                    this.updateForm.cidade = ''
                    this.updateForm.coordenador = ''
                    this.updateForm.bolsistas = ''
                    this.updateForm.resumo = ''
                    this.updateForm.url_video = ''
                    this.updateForm.url_foto = ''
                    this.updateForm.ano = ''
                    this.formNewVisible = false
                    this.updating = false

                },
            })

        },
        onImageChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.capa = files[0];
            // this.createImage(files[0]);
        },

        destroy() {
            this.destroyForm.delete(route('projeto.destroy', this.projeto), {
                errorBag: 'default',
                preserveScroll: true,
                onSuccess: () => {
                    this.destroying = false

                    this.destroyForm.reset()
                }
            })
        },

    },
}
</script>
