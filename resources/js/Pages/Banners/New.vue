<template>

    <jet-form-section @submitted="store">

        <template #form>

            <div class="col-span-12">
                <label class="block font-medium text-sm text-gray-700">Banner principal do site:</label>
                <input type="file" class="form-input rounded-md shadow-sm block mt-1 p-2 w-full border focus:outline-none focus:ring-2 focus:ring-red-200 focus:border-transparent " @change="onImageChange" >

                <div v-if="imagePreview" class="w-1/2 mx-auto">
                    <img :src="imagePreview" class="w-full" />
                </div>

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
                imagem: '',
            }),

            imagePreview: '',

        }
    },

    methods: {
        store() {
            this.form.post(route('banner.store'), {
                errorBag: 'bannerStore',
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
            this.form.imagem = files[0];
        },
    },
}
</script>

<style scoped>

</style>
