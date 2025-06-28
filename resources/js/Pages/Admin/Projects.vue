<template>

    <AppLayout title="Projects">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                System Projects
            </h2>
        </template>

        <main class="pt-10">
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg">
                <!-- <button type="button" @click="projModal(data)">Click me</button> -->
                
                <nav class=" mt-8  flex justify-end ">
                    <button type="button" @click="projModal()" class="md:mr-8 mr-0"  v-tooltip.top="'Add New Skill'"><i class="pi pi-plus" style="font-size: 1.1rem"></i></button>                   
                </nav>

    
                <DataTable v-model:selection="TechSkill" dataKey="id" :value="data"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">
                        
                            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                            <Column field="proj_name" header="Skill" sortable />
                            <Column field="img" header="Image" sortable>
                                <template #body="{ data }">
                                <Image 
                                    alt="user header"
                                    loading="lazy"
                                    
                                    :src="`/storage/output/${data.img}`"
                                preview  imageClass="h-16 object-cover rounded-md"  />
                                </template>
                            </Column>
                
                    </DataTable>         
            </section>
        </main>










        <!-- add project modal ini -->
        <Dialog v-model:visible="projDis" header="Add Project" maximizable>
                <ProjectForm/>
        </Dialog>

        <div>
            <!-- amo ini an kanan pop up notif pag nag submit msg -->
            <Toast />
        </div>
    </AppLayout>

</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ProjectForm from '@/Pages/Admin/Forms/ProjectForms.vue'; 

   
    import { computed, ref, watchEffect , watch, onMounted     } from 'vue';
    import 'primeicons/primeicons.css'
    import IconField from 'primevue/iconfield';
    import Image from 'primevue/image';

    import Badge from 'primevue/badge';
    // amo ini an kanan table
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import ColumnGroup from 'primevue/columngroup';   // optional
    import Row from 'primevue/row';                   // optional
   import { router } from '@inertiajs/vue3'
    import RadioButton from 'primevue/radiobutton';

    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'
  import InputText from 'primevue/inputtext'
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import FileUpload from 'primevue/fileupload';

    import Dialog from 'primevue/dialog';
     import Card from 'primevue/card';

 




  
    const props = defineProps({
        data : Array,
    });

    const page = usePage()
    const toast = useToast()

    const src = ref(null);


    const projDis = ref(false);

    function projModal (data){
        projDis.value = true;
    }


</script>