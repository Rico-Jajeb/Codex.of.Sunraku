<template>
  <button @click="uploadDb"  class="bg-orange-500 text-white py-1 px-4 rounded-md hover:bg-orange-400 hover:text-black"  v-tooltip.top="'Save Database to google drive'">DB Backup</button>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
  import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'

    const page = usePage()
    const toast = useToast()

        function uploadDb() {
        router.post('/upload-drive-manual', {}, {
            preserveScroll: true,
            forceFormData: true,
            onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success message',
                detail: 'Database uploaded successfully!',
                life: 10000,
            });
            },
            onError: (errors) => {
            console.error("Form submission failed.", errors);
            },
        });
        }

</script>
