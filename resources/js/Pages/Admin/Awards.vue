<template>
    <AppLayout title="Achievements">
        <template #header>
              <section class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Achievements
                </h2>
                <div class="">
                    <button type="button" @click="TechModal()" class="md:mr-8 mr-0"  v-tooltip.top="'Add Achievement'"><i class="pi pi-plus" ></i></button> 
                </div>

            </section>
        </template>

        <main class="pt-10">
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg">
                <h1>Achievement</h1>   
                
            </section>


            <!-- amo ini an kanan Award form -->
            <Dialog  v-model:visible="sc"  maximizable :header="`Achievement `" :style="{ width: '500px' }" >
                    <AwardForm/>
            </Dialog>


            <div>
                <!-- amo ini an kanan pop up notif pag nag submit msg -->
                <Toast />
            </div>
        </main>
  
    </AppLayout>

</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import AwardForm from './Forms/AwardForm.vue';

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
    const page = usePage()
    const toast = useToast()


    const sc = ref(false);

    function TechModal(){
        sc.value = true;
    }
</script>