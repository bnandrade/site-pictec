<template>
    <div class="flex justify-center">

        <button
            class="cursor-pointer text-sm text-gray-400 focus:outline-none mx-2"
            @click="updating = true" v-tooltip="'Editar usuário'">
            <i class="far fa-edit"></i>
        </button>

        <jet-dialog-modal :show="updating" @close="updating = false">
            <template #title>
                Atualizar Usuário
            </template>


            <template #content>

                <div class="col-span-6 sm:col-span-4">
                    <p class="w-full border-b mb-3">Usuário: <b>{{ updateForm.name }}</b></p>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-6">

                    <p class=" border-b  border-gray-200"><b>Grupos de Permissões</b></p>


                    <div  class="grid grid-cols-3">
                        <div class="flex my-2" v-for="role in roles" :key="role.id">

                            <input type="checkbox" :value="role.id"  v-model="updateForm.role" @click="check(role.id,$event)"
                                   class="mr-2 rounded border-gray-500 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                            <jet-label :value="role.name" />
                            <jet-input-error :message="updateForm.errors.role" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-4 mt-6">

                    <p class=" border-b  border-gray-200"><b>Permissões</b></p>

                    <div  class="grid grid-cols-4">
                        <div class="flex my-2" v-for="permission in permissions" :key="permission.id">

                            <input type="checkbox" :value="permission.id"  v-model="updateForm.permission"
                                   class="mr-1 rounded border-gray-500 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                            <jet-label :value="permission.name" />
                            <jet-input-error :message="updateForm.errors.permission" class="mt-2" />
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



    </div>
</template>


<script>
import JetButton from '@/Jetstream/Button'
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
        user: Object,
        roles: Array,
        permissions: Array,
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
    },

    data() {
        return {
            sel: this.user.permissions_user,
            updateForm: this.$inertia.form({
                name: this.user.name,
                role: this.user.roles_user,
                permission: this.user.permissions_user,
            }),

            updating: false,


        }
    },

    methods: {
        update() {

            this.updateForm.put(route('user.update', this.user),  {
                errorBag: 'userUpdate',
                preserveScroll: true,
                onSuccess: () => {
                    this.updating = false
                }
            })

        },
        check(role, e) {
            var map = this.roles

            if(e.target.checked){
                // Adiciona no array 'sel[]' todas as Permissions referentes ao Role selecionado
                for( var i = 0; i < map.length; i++){
                    if(role === map[i]['id'])
                        for( var j = 0; j < map[i]['permissions'].length; j++){
                            this.sel.push(map[i]['permissions'][j]['id'])
                        }
                }
            }else{
                // Remove do array 'sel[]' todas as Permissions referentes ao Role desmarcado
                for( var i = 0; i < map.length; i++){
                    if(role === map[i]['id']){
                        for( var j = 0; j < map[i]['permissions'].length; j++){
                            const index = this.sel.indexOf(map[i]['permissions'][j])
                            this.sel.splice(index, 1)
                        }
                    }
                }
            }
            this.updateForm.permission = this.sel
        },
    },
}
</script>
