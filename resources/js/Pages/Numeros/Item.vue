<template>
    <div class="flex justify-center">

        <button
            class="cursor-pointer text-sm text-gray-400 focus:outline-none mx-2"
            @click="updating = true" v-tooltip="'Editar número'"
            v-if="$page.props.auth.user.can['numero-editar'] || $page.props.auth.user.role['Super.Admin']">
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
            @click="destroying = true" v-tooltip="'Excluir número'"
            v-if="$page.props.auth.user.can['numero-deletar'] || $page.props.auth.user.role['Super.Admin']">
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
                Atualizar Número
            </template>

            <template #content>

                <div class="">
                    <jet-label for="titulo" value="Título" />
                    <jet-input id="titulo" type="text" class="mt-1 block w-full" v-model="updateForm.titulo"  />
                    <jet-input-error :message="updateForm.errors.titulo" class="mt-2" />
                </div>

                <div class=" mt-4">
                    <jet-label for="valor" value="Número" />
                    <jet-input id="valor" type="text" class="mt-1 block w-full" v-model="updateForm.valor"  />
                    <jet-input-error :message="updateForm.errors.valor" class="mt-2" />
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
                Deletar Número
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
        'numero': Object,
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
                titulo: this.numero.titulo,
                valor: this.numero.valor,
            }),
            updating: false,

            destroyForm: this.$inertia.form(),
            destroying: false,

        }
    },

    methods: {
        update() {

            this.updateForm.put(route('numero.update', this.numero),  {
                errorBag: 'numeroUpdate',
                preserveScroll: true,
                onSuccess: () => {
                    this.updating = false
                }
            })

        },

        destroy() {
            this.destroyForm.delete(route('numero.destroy', this.numero), {
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
