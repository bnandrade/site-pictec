<template>
    <div class="flex justify-center">

        <button
            class="cursor-pointer text-sm text-gray-400 focus:outline-none mx-2"
            @click="updating = true" v-tooltip="'Editar permissão'"
            v-if="$page.props.auth.user.can['permissao-editar'] || $page.props.auth.user.role['Super.Admin']">
            <i class="far fa-edit"></i>
        </button>
        <button
            class="cursor-pointer text-sm text-red-200 focus:outline-none mx-2"
            v-else
            v-tooltip="'Você não tem permissão de Editar'">
            <i class="fas fa-lock"></i>
        </button>

        <button
            class="cursor-pointer  text-sm text-red-500 focus:outline-none mx-2"
            @click="destroying = true" v-tooltip="'Excluir permissão'"
            v-if="$page.props.auth.user.can['permissao-deletar'] || $page.props.auth.user.role['Super.Admin']">
            <i class="far fa-trash-alt"></i>
        </button>
        <button
            class="cursor-pointer text-sm text-red-200 focus:outline-none mx-2"
            v-else
            v-tooltip="'Você não tem permissão de Deletar'">
            <i class="fas fa-lock"></i>
        </button>

        <jet-dialog-modal :show="updating" @close="updating = false">
            <template #title>
                Atualizar Permissão
            </template>

            <template #content>

                <div class="col-span-6 sm:col-span-4">

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Nome" />
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="updateForm.name"  />
                        <jet-input-error :message="updateForm.errors.name" class="mt-2" />
                    </div>

                    <jet-section-border></jet-section-border>

                    <div class="col-span-6 sm:col-span-12">
                        <jet-label for="nome" class="font-bold mb-2" value="Atribuir esta permissão aos grupos:" />

                            <div class="flex " v-for="role in roles" :key="role.id">

                                <input type="checkbox" :value="role"  v-model="updateForm.roles"
                                       class="mr-2 rounded border-gray-500 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                                <jet-label :value="role.name" />
                                <jet-input-error :message="updateForm.errors.roles" class="mt-2" />
                            </div>


                    </div>

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
                Deletar Permissão
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
        'permission': Object,
        'roles': Array,
        'roles_checked': Array,
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
                name: this.permission.name,
                roles: this.roles_checked,
            }),
            updating: false,

            destroyForm: this.$inertia.form(),
            destroying: false,

        }
    },

    methods: {
        update() {

            this.updateForm.put(route('permission.update', this.permission),  {
                errorBag: 'permissionUpdate',
                preserveScroll: true,
                onSuccess: () => {
                    this.updating = false
                }
            })

        },

        destroy() {
            this.destroyForm.delete(route('permission.destroy', this.permission), {
                errorBag: 'default',
                preserveScroll: true,
                onSuccess: () => {
                    this.destroying = false

                    this.destroyForm.reset()
                }
            })
        },

        isExist(rl){
            for(var i=0; i < this.roles_checked.length; i++){
                if( this.roles_checked[i].id === rl){
                    return true
                }
            }
            return false
        },
    },
}
</script>
