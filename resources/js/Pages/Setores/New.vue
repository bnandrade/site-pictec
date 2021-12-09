<template>

    <jet-form-section @submitted="store">

        <template #form>

            <div class="col-span-6 ">
                <jet-label for="nome" value="Nome do setor" />
                <jet-input id="nome" type="text" class="mt-1 block w-full" v-model="form.nome_setor" autofocus  />
                <jet-input-error :message="form.errors.nome_setor" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <jet-label for="nome" value="Telefone" />
                <jet-input id="nome" type="text" class="mt-1 block w-full" v-model="form.telefone"   />
                <jet-input-error :message="form.errors.telefone" class="mt-2" />
            </div>


        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Setor criado
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
                nome_setor: '',
                telefone: '',
            }),

        }
    },

    methods: {
        store() {
            this.form.post(route('setor.store'), {
                errorBag: 'setorStore',
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
