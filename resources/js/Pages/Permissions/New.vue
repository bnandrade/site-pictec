<template>

    <jet-form-section @submitted="store">

        <template #form>

            <div class="col-span-6 sm:col-span-12">
                <jet-label for="nome" value="Nome" />
                <jet-input id="nome" type="text" class="mt-1 block w-full" v-model="form.name" autofocus  />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-12">
                <jet-label for="nome" class="font-bold mb-2" value="Atribuir esta permissão aos grupos:" />
                <div class="flex " v-for="role in roles" :key="role.id">
                    <input type="checkbox" name="roles[]" :value="role"  v-model="form.roles"
                           class="mr-2 rounded border-gray-500 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <jet-label :value="role.name" />
                    <jet-input-error :message="form.errors.roles" class="mt-2" />

                </div>
            </div>

        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Permissão criada
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

export default {
    name: "New",
    props: {
        roles: Array
    },
    components: {
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetActionMessage,
        JetSecondaryButton,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                roles: [],
            }),

        }
    },

    methods: {
        store() {
            this.form.post(route('permission.store'), {
                errorBag: 'permissionStore',
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                }
            });
        },
    },
}
</script>

<style scoped>

</style>
