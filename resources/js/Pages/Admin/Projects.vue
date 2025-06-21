<template>

    <AppLayout title="Projects">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                System Projects
            </h2>
        </template>

        <main class="pt-10">
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg">
                <h1>Projects</h1>
            </section>
        </main>
    </AppLayout>

</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FileUpload from 'primevue/fileupload';
    import InputText from 'primevue/inputtext';
    import { ref } from "vue";
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import Divider from 'primevue/divider';
    import { computed, watch } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'
    import Card from 'primevue/card';
    import SystemForm from '@/Pages/Admin/Forms/SystemForm.vue';
    import Image from 'primevue/image';
    
</script>