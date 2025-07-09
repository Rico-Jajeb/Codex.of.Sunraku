<template>
      <AppLayout title="System Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                System User
            </h2>
        </template>

        
        <main class="pt-10">
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg pt-10">
                <DataTable v-model:selection="TechSkill" dataKey="id" :value="data"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">  
                    <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                    <Column field="name" header="Username" sortable />
                    <Column field="email" header="Email" sortable />
                    <Column field="created_at" header="Created At" sortable />
                </DataTable>                
            </section>
        </main>
    </AppLayout>
   
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { computed, ref, watchEffect , watch, onMounted     } from 'vue';
    import 'primeicons/primeicons.css'
     import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
     import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';

    const prop = defineProps({
        data: Array,
    });


    const form = useForm({
        name: null,
        email: null,
        created_at: null,
    })

    











</script>