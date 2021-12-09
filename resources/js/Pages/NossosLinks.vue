<template>
    <div class="flex h-screen">
        <div class="m-auto w-96 px-4 py-4 bg-white border-2 rounded-xl text-gray-700 text-center flex flex-col items-center">
            <div class="">
                <img class="g-gradient-to-r from-aqua-pink to-aqua-blue border rounded-full  w-32 h-32 mb-8" src="img/logo-icone.png" />
            </div>
            <a href="https://aquarelapersonalizados.com.br" target="_blank" class="bg-white w-full shadow border rounded px-8 py-4 mb-4 hover:bg-gray-100">Nosso site</a>
            <a href="https://www.instagram.com/aquarela.personalizado" target="_blank" class="bg-white w-full shadow border rounded px-8 py-4 mb-4 hover:bg-gray-100">Instagram</a>
            <div class="bg-white w-full shadow border rounded px-8 py-4 mb-4">Facebook</div>
            <a href="https://wa.me/5567996251135?text=Olá!%20Vim%20através%20de%20seu%20site.%20Gostaria%20de%20fazer%20um%20orçamento." target="_blank" class="bg-white w-full shadow border rounded px-8 py-4 mb-4 hover:bg-gray-100"><font-awesome-icon :icon="[ 'fab', 'whatsapp' ]" /> Fale conosco</a>
            <div class="bg-white w-full shadow border rounded px-8 py-4 mb-4">Nossa loja <span class="text-sm italic">(em breve)</span></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NossosLinks"
}
</script>

<style scoped>

</style>
