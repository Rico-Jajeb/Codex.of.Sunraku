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
                    <button type="button" @click="projModal()" class="md:mr-8 mr-0"  v-tooltip.top="'Add New Project'"><i class="pi pi-plus" style="font-size: 1.1rem"></i></button>                   
                </nav>

    
                <DataTable  dataKey="id" :value="data"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">
                        
                            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                            <Column field="content" header="Project Name" sortable   >
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.proj_name, 'Project name')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                        {{ slotProps.data.proj_name }}
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
                            <Column field="content" header="Description" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.proj_description, 'Project Description')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                        {{ slotProps.data.proj_description }}
                                        </div>                                    
                                    </button>
                                </template>
                            </Column>
                            <Column field="content" header="Gallery" sortable>
                                <template #body="slotProps">
                                    <nav class="flex gap-0 w-36">
                                        <button type="button"   @click="openGalleryModal(slotProps.data.id, 'Gallery')" v-tooltip.top="'Click to View'">
                                            <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] ">
                                            <i class="pi pi-eye" ></i>
                                            </div>                                    
                                        </button>
                                        <button type="button" @click="screeshotModal(slotProps.data.id)" class=" py-2 px-4" v-tooltip.top="'Add Image'"><i class="pi pi-plus" ></i></button>       
                                    </nav>
                                </template>
                            </Column>
                            <Column field="content" header="Language" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.language, 'Language')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                            {{ slotProps.data.language }}
                                        </div>                                    
                                    </button>
                                </template>
                            </Column>
                            <Column field="content" header="Framework" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.framework, 'Framework')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                            {{ slotProps.data.framework }}
                                        </div>                                    
                                    </button>
                                </template>
                            </Column>
                            <Column field="content" header="Github Link" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.github_url, 'Github Link')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                            {{ slotProps.data.github_url }}
                                        </div>                                    
                                    </button>
                                </template>
                            </Column>
                            <Column field="content" header="Live Link" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.live_url, 'Live Link')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                            {{ slotProps.data.live_url }}
                                        </div>                                    
                                    </button>
                                </template>
                            </Column>
                            <Column field="content" header="Status" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.status, 'Status')" v-tooltip.top="'Click to View'">
                                        <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36">
                                            {{ slotProps.data.status }}
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
        </main>





       <Dialog v-model:visible="SCModal" header="Screen Shot"  maximizable>
            <!-- <TestForm  :project-id="SelectedProjId" /> -->
            <ScreenshotForms :project-id="SelectedProjId"/>
        </Dialog>

        <!-- add project modal ini -->
        <Dialog v-model:visible="projDis" header="Add Project" maximizable>
                <ProjectForm/>
        </Dialog>
 
        <!-- Bali amo ini an modal para han view content,instructions, output han kanan codex -->
        <Dialog v-model:visible="contentMod" maximizable  modal  :header="selectedType" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
                <h1 class=" text-ellipsis">   {{ selectedContent }}</h1>
        </Dialog>
        
        <!-- bali kanan gallery han screenshot liwat ini -->
        <Dialog v-model:visible="galleryMod" maximizable  modal  :header="selectedGalleryType" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <section class=" flex gap-4 flex-wrap ">
                <section class="" v-for="SC in props.ScreenShots" key="SC.id" >
                    <div v-if="selectedGallery == SC.project_id" class="w-36">       
                        <Image  alt="user header" loading="lazy" :src="`/storage/screenshot/${SC.img}`" preview  imageClass="h-16  object-cover rounded-md"  />
                    </div>
                </section>                
            </section>

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
    import ScreenshotForms from './Forms/ScreenshotForms.vue';
    import TestForm from './Forms/TestForm.vue';
   
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
import TechSkill from './TechSkill.vue';

 




  
    const props = defineProps({
        data : Array,
        ScreenShots : Array,
    });

    const page = usePage()
    const toast = useToast()

    const src = ref(null);


    const projDis = ref(false);

    function projModal (data){
        projDis.value = true;
    }

//---------------------- CONTENT MODAL ----------------------

    const contentMod = ref(false);
    const selectedContent = ref('');
    const selectedType = ref('');

    // amo ini an kanan modal  han content han codex pag ginclick ma vview an info
    function openContentModal(content, type) {
        selectedContent.value = content
        selectedType.value = type
        contentMod.value = true
    }



//------------------ Screen Shot ------------------------

    const SCModal = ref(false);
  
    const SelectedProjId = ref(null);

    function screeshotModal(id){
        SelectedProjId.value = id;
        SCModal.value = true;
    }

   const galleryMod = ref(false);
    const selectedGallery = ref('');
    const selectedGalleryType = ref('');

    // amo ini an kanan modal  han content han codex pag ginclick ma vview an info
    function openGalleryModal(content, type) {
        selectedGallery.value = content
        selectedGalleryType.value = type
        galleryMod.value = true
    }





</script>