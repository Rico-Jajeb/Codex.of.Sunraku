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
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg pt-8">

                <DataTable v-model:selection="TechSkill" dataKey="id" :value="data"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">  
                    <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                    <Column field="award_title" header="Title" sortable />
                    <Column field="content" header="Description" sortable>
                        <template #body="slotProps">
                            <button type="button"   @click="openContentModal(slotProps.data.award_description, 'Description')" v-tooltip.top="'Click to View'">
                                <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                {{ slotProps.data.award_description }}
                                </div>                                    
                            </button>
                        </template>
                    </Column>
                    <Column field="img" header="Image" sortable>
                        <template #body="{ data }">
                        <Image 
                            alt="user header"
                            loading="lazy"
                            
                            :src="`/storage/output/${data.img}`"
                        preview  imageClass="h-16 object-cover rounded-md"  />
                        </template>
                    </Column>
                    <Column field="content" header="Issuer" sortable>
                        <template #body="slotProps">
                            <button type="button"   @click="openContentModal(slotProps.data.issuer, 'Issuer')" v-tooltip.top="'Click to View'">
                                <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                {{ slotProps.data.issuer }}
                                </div>                                    
                            </button>
                        </template>
                    </Column>
                    <Column field="content" header="Highlight" sortable>
                        <template #body="slotProps">
                            
                                <div class=" flex justify-center" v-if="slotProps.data.highlight == 'Yes'">
                                    <div class="overflow-hidden text-ellipsis    rounded-lg">
                                        
                                        <Badge value="" severity="success" v-tooltip.top="'Project is highlighted'"></Badge>
                                    </div>
                                </div>                                    
                                <div class="flex justify-center" v-if="slotProps.data.highlight !== 'Yes' ">
                                    <div class="overflow-hidden text-ellipsis      rounded-lg">
                                        <Badge value="" severity="danger" v-tooltip.top="'Project is NOT highlighted'"></Badge>
                                    </div>
                                </div>                                    
                                                                
                            
                        </template>
                    </Column>
                      <Column field="Date" header="Date" sortable />
                    <Column field="content" header="Achievement Links" sortable>
                        <template #body="slotProps">
                            <button type="button"   @click="openContentModal(slotProps.data.award_url, 'Achievement Links')" v-tooltip.top="'Click to View'">
                                <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                {{ slotProps.data.award_url }}
                                </div>                                    
                            </button>
                        </template>
                    </Column>
                    <Column class="!text-end" header="Actions">
                        <template #body="{ data }">
                            <nav class="flex gap-1">
                                <button type="button" @click="openModal(data)" class=" py-2 px-4" v-tooltip.top="'Click to Edit'"><i class="pi pi-pencil" ></i></button>     
                                <button type="button" @click="deleteModal(data)" class="mx-4" v-tooltip.top="'Click to Delete'">
                                    <i class="pi pi-trash" style="font-size: 1rem"></i>
                                </button>                                  
                            </nav>
                        </template>
                    </Column>
                </DataTable>
            </section>








        <!-- Bali amo ini an modal para han view content,instructions, output han kanan codex -->
        <Dialog v-model:visible="contentMod" maximizable  modal  :header="selectedType" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
                <h1 class=" text-ellipsis">   {{ selectedContent }}</h1>
        </Dialog>





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



    const prop = defineProps({
        data: Array,
    });


    const page = usePage()
    const toast = useToast()


    const sc = ref(false);

    function TechModal(){
        sc.value = true;
    }


//---------------- content ---------
   const contentMod = ref(false);
    const selectedContent = ref('');
    const selectedType = ref('');

    // amo ini an kanan modal  han content han codex pag ginclick ma vview an info
    function openContentModal(content, type) {
        selectedContent.value = content
        selectedType.value = type
        contentMod.value = true
    }


</script>