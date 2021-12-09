<template>
    <transition name="slide-fade">
        <div v-if="toast.message && visible && !popstate" class="fixed flex max-w-xs w-full mt-10 mr-4 top-0 right-0 bg-white rounded shadow p-4" :class="{ 'bg-green-500': style == 'success', 'bg-red-500': style == 'danger' }">
            <div class="mr-2">
                <svg v-if="style == 'success'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <svg v-if="style == 'danger'" class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="flex-1 text-white">{{ toast.message }}</div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Toast",
    props: {
        toast: Object,
        popstate: Boolean,
    },
    data(){
        return {
            visible:false,
            timeout: null,
        }
    },
    watch: {
        toast: {
            deep: true,
            handler(){
                this.visible = true;

                if(this.timeout){
                    clearTimeout(this.timeout);
                }

                this.timeout = setTimeout(() => this.visible=false, 1500);
            }
        }
    },

    computed: {
        style() {
            return this.toast?.style || 'success'
        },

        message() {
            return this.toast?.message || ''
        },

    }
}
</script>

<style scoped>
.slide-fade-enter-active {
    transition: all .3s ease;
}
.slide-fade-leave-active {
    transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(150px);
    opacity: 0;
}
</style>
