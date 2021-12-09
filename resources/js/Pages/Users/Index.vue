<template>
    <app-layout>
        <div class="w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <list
                    :users="users"
                    :filters="filters"
                    :roles="roles"
                    :permissions="permissions"
                    v-if="$page.props.auth.user.can['usuario-listar'] || $page.props.auth.user.role['Super.Admin']"
                ></list>
                <p v-else>
                    <button
                        class="cursor-pointer text-sm text-red-200 focus:outline-none mx-2"
                        v-tooltip="'Você não tem permissão de Listar'">
                        <i class="fas fa-lock"></i>
                    </button>
                </p>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import List from "./List"

export default {
    props: {
        users: Object,
        filters: Object,
        roles: Array,
        permissions: Array,
    },

    components: {
        AppLayout,
        JetSectionBorder,
        List,
    },
}
</script>
