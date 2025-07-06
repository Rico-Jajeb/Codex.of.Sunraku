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
                            <Column class="!text-end" header="Actions">
                                <template #body="{ data }">
                                    <nav class="flex gap-0 w-36">
                                     
                                         
                                        <button type="button" @click="openModal(data)" class=" py-2 px-4" v-tooltip.top="'Click to Edit'"><i class="pi pi-pencil" ></i></button>     
                                        <button type="button" @click="deleteModal(data)" class="py-2 px-4" v-tooltip.top="'Click to Delete'">
                                            <i class="pi pi-trash" style="font-size: 1rem"></i>
                                        </button>                                  
                                    </nav>
                                </template>
                            </Column>
                            <Column field="content" header="Highlight" sortable>
                                <template #body="slotProps">
                                   
                                        <div class="" v-if="slotProps.data.highlight == 'Yes'">
                                            <div class="overflow-hidden text-ellipsis    rounded-lg">
                                               
                                                <Badge value="" severity="success" v-tooltip.top="'Project is highlighted'"></Badge>
                                            </div>
                                        </div>                                    
                                        <div class="" v-if="slotProps.data.highlight !== 'Yes' ">
                                            <div class="overflow-hidden text-ellipsis      rounded-lg">
                                               <Badge value="" severity="danger" v-tooltip.top="'Project is NOT highlighted'"></Badge>
                                            </div>
                                        </div>                                    
                                                                      
                                   
                                </template>
                            </Column>
                            <Column field="content" header="Status" sortable>
                                <template #body="slotProps">
                                    <button type="button"   @click="openContentModal(slotProps.data.status, 'Status')" v-tooltip.top="'Click to View'">
                                        <div class="" v-if="slotProps.data.status == 'OnHold'">
                                            <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36 bg-gray-400 rounded-lg">
                                                {{ slotProps.data.status }}
                                            </div>
                                        </div>                                    
                                        <div class="" v-if="slotProps.data.status == 'Completed'">
                                            <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36 bg-green-400 rounded-lg">
                                                {{ slotProps.data.status }}
                                            </div>
                                        </div>                                    
                                        <div class="" v-if="slotProps.data.status == 'Ongoing'">
                                            <div class="overflow-hidden text-ellipsis  whitespace-nowrap max-w-[200px] w-36 bg-blue-400 rounded-lg">
                                                {{ slotProps.data.status }}
                                            </div>
                                        </div>                                    
                                    </button>
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
    

                    </DataTable>         
            </section>     
        </main>



            <!-- Kanan Update -->
            <Dialog 
                v-model:visible="categoryInfoDisp"
                maximizable
                :header="` Skill:'${selectedCategory?.tech_name ?? ''}'`"
                >
                    <form @submit.prevent="submitForm" enctype="multipart/form-data">
                        <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Update Skill</label>
                                <InputText class="!w-full" type="text" v-model="form.tech_name" name="category_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                <div v-if="form.errors.tech_name" class="text-red-500 text-sm mt-2">
                                    {{ form.errors.tech_name }}
                                </div> 
                        </div>
                        <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Skill Logo</label>
                        <div class="card flex flex-col items-center gap-6 mt-4">                
                            <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                            <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        </div>
                        <nav class="">   
                            <button type="submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3">Update Skill</button>
                        </nav>
                    </form>
                        
            </Dialog>



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
            <section class=" grid md:grid-cols-4 grid-cols-1 gap-4 flex-wrap ">
                <section class="" v-for="SC in props.ScreenShots" key="SC.id" >
                    <div v-if="selectedGallery == SC.project_id" class=" flex  justify-center">       
                        <Image  alt="user header" loading="lazy" :src="`/storage/screenshot/${SC.img}`" preview  imageClass="h-36 w-full  object-cover rounded-md"  />
                        <button type="button" @click="deleteModalScreenshot(SC)" class="py-2 px-4" v-tooltip.top="'Click to Delete'">
                            <i class="pi pi-trash" style="font-size: 1rem"></i>
                        </button>   
                    </div>
                </section>                
            </section>

        </Dialog>  

        <!-- Kanan update ini -->
        <Dialog 
                v-model:visible="categoryInfoDisp"
                maximizable
                :header="` Project:${selectedCategory?.proj_name ?? ''}`"
                >
                    <form @submit.prevent="submitForm" enctype="multipart/form-data">
                 
                        <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Project name</label>
                                <InputText class="!w-full" type="text" v-model="form.proj_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                <div v-if="form.errors.proj_name" class="text-red-500 text-sm mt-2">
                                    {{ form.errors.proj_name }}
                                </div> 
                        </div>
                        <div class="mt-4">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description</label>
                                <InputText class="!w-full" type="text" v-model="form.proj_description" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                <div v-if="form.errors.proj_description" class="text-red-500 text-sm mt-2">
                                    {{ form.errors.proj_description }}
                                </div> 
                        </div>
                        <section class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Status Level</label>
                            <div class="md:flex md:flex-wrap gap-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="form.status" inputId="level1" name="level" value="Ongoing"  />
                                    <label for="ingredient1">Ongoing</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="form.status" inputId="level2" name="level" value="Completed"  />
                                    <label for="ingredient2">Completed</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="form.status" inputId="level3" name="level" value="OnHold"  />
                                    <label for="ingredient3">On Hold</label>
                                </div>
                                
                            </div>
                            <div v-if="form.errors.status" class="text-red-500 text-sm mt-2">
                                {{ form.errors.status }}
                            </div> 
                        </section>
                        <section class=" mt-4  md:flex md:flex-row ">
                            <div class="xl:basis-1/2 md:basis-1/2  md:mr-8">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Language</label>
                                    <MultiSelect 
                                        v-model="form.language" 
                                        display="chip" 
                                        :options="language" 
                                        optionLabel="name" 
                                        optionValue="code"
                                        filter 
                                        placeholder="Select a language"
                                        :maxSelectedLabels="3" 
                                        class="w-full" />
                                        <div v-if="form.errors.language" class="text-red-500 text-sm mt-2">
                                            {{ form.errors.language }}
                                        </div> 
                            </div>                        
                            <div class="xl:basis-1/2 md:basis-1/2 md:ml-8 mt-4 md:mt-0">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Framework</label>
                                    <MultiSelect 
                                        v-model="form.framework" 
                                        display="chip" 
                                        :options="framework" 
                                        optionLabel="name" 
                                        optionValue="code"
                                        filter 
                                        placeholder="Select a framework"
                                        :maxSelectedLabels="3" 
                                        class="w-full" />
                                        <div v-if="form.errors.framework" class="text-red-500 text-sm mt-2">
                                            {{ form.errors.framework }}
                                        </div> 
                            </div>                        
                        </section>
                             <section class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Highlight</label>
                            <div class="md:flex md:flex-wrap gap-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="form.highlight" inputId="level1" name="level" value="Yes"  />
                                    <label for="ingredient1">Yes</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="form.highlight" inputId="level2" name="level" value="No"  />
                                    <label for="ingredient2">No</label>
                                </div>
                              
                                
                            </div>
                            <div v-if="form.errors.highlight" class="text-red-500 text-sm mt-2">
                                {{ form.errors.highlight }}
                            </div> 
                        </section>
                        <div class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Github URL</label>
                            <InputText class="!w-full" type="text" v-model="form.github_url" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                            <div v-if="form.errors.github_url" class="text-red-500 text-sm mt-2">
                                {{ form.errors.github_url }}
                            </div> 
                        </div>
                        <div class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Live URL</label>
                            <InputText class="!w-full" type="text" v-model="form.live_url" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                            <div v-if="form.errors.live_url" class="text-red-500 text-sm mt-2">
                                {{ form.errors.live_url }}
                            </div> 
                        </div>
                        <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Skill Logo</label>
                        <div class="card flex flex-col items-center gap-6 mt-4">                
                            <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                            <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        </div>
                        <nav class="">   
                            <button type="submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3">Update Project</button>
                        </nav>
                    </form>
                        
        </Dialog>

            <!--DELETE amo ini an delete modal kanan category -->
            <section>
                <Dialog v-model:visible="visible3" :header="`Delete '${selectedCategory.proj_name}' Project`" :style="{ width: '25rem' }">
                    <nav class="flex justify-center gap-6">
                        <button @click="deletePost(item.id)" class=" bg-red-600 text-white px-3 py-1 rounded">
                            <i class="pi pi-trash mr-2"></i> Delete 
                        </button>
                        <button @click="closeDelete()" class=" bg-green-600 text-white px-3 py-1 rounded">
                            <i class="pi pi-times mr-2"></i> Cancel
                        </button>                        
                    </nav>

                </Dialog>
            </section>
            <!--DELETE amo ini an delete modal kanan Screenshots -->
            <section>
                <Dialog v-model:visible="visible4" :header="`Delete Screenshot`" :style="{ width: '25rem' }">
                    <nav class="flex justify-center gap-6">
                        <button @click="deletescreenshoot(item1.id)" class=" bg-red-600 text-white px-3 py-1 rounded">
                            <i class="pi pi-trash mr-2"></i> Delete 
                        </button>
                        <button @click="closeDelete2()" class=" bg-green-600 text-white px-3 py-1 rounded">
                            <i class="pi pi-times mr-2"></i> Cancel
                        </button>                        
                    </nav>

                </Dialog>
            </section>

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



    import MultiSelect from 'primevue/multiselect';


    import ToggleSwitch from 'primevue/toggleswitch';





  
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


//------------------------ Edit Project ----------------------------------
   function onFileSelect(event) {
        const file = event.files[0];
        const reader = new FileReader();

        reader.onload = async (e) => {
            src.value = e.target.result;
        };

        reader.readAsDataURL(file);
    }


    const categoryInfoDisp = ref(false);
    const selectedCategory = ref(false);

    const form = useForm({
        //amo liwat ini an code para han system form
     

        proj_name: null,
        proj_description: null,
        language: [],
        framework: [],
        status: null,
        img: null,
        github_url: null,
        live_url: null,
        highlight: null,
    })

    function openModal(data) {
         selectedCategory.value = data;
         form.proj_name = data.proj_name;
         form.proj_description = data.proj_description;
         form.language = data.language;
         form.framework = data.framework;
         form.status = data.status;
         form.github_url = data.github_url;
         form.live_url = data.live_url;
         form.img = null; // reset image, or preload if needed
        categoryInfoDisp.value = true;
    }


    


const submitForm = () => {
 
    form.transform(data => ({
        ...data,
        _method: 'PUT',
    }));

    form.post(route('project.update', selectedCategory.value.id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Update message',
                detail: 'Project Updated Successfully!', // Can hardcode or pull from props if needed
                life: 10000,
            });
            src.value = null;
            form.reset();
            categoryInfoDisp.value = false;
        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};



    const framework = ref([
        //amo ini an kanan framework na ginamit han select input
        { name: 'Vue', code: 'Vue' },
        { name: 'React', code: 'React' },
        { name: 'Angular', code: 'Angular' },
        { name: 'Svelte', code: 'Svelte' },
        { name: 'Next.js', code: 'Next.js' },
        { name: 'Nuxt.js', code: 'Nuxt.js' },
        { name: 'Laravel', code: 'Laravel' },
         { name: 'Codeigniter', code: 'Codeigniter' },
        { name: 'Symfony', code: 'Symfony' },
        { name: 'Django', code: 'Django' },
        { name: 'Flask', code: 'Flask' },
        { name: 'Express', code: 'Express' },
        { name: 'NestJS', code: 'NestJS' },
        { name: 'Ruby on Rails', code: 'Ruby on Rails' },
        { name: 'Spring Boot', code: 'Spring Boot' },
        { name: 'ASP.NET Core', code: 'ASP.NET Core' },
        { name: 'Inertia.js', code: 'Inertia.js' },
        { name: 'Remix', code: 'Remix' },
        { name: 'Blitz.js', code: 'Blitz.js' },
        { name: 'RedwoodJS', code: 'RedwoodJS' },
        { name: 'React Native', code: 'React Native' },
        { name: 'Flutter', code: 'Flutter' },
        { name: 'Ionic', code: 'Ionic' },
        { name: 'Slim', code: 'Slim' },
        { name: 'FastAPI', code: 'FastAPI' },
        { name: 'Lumen', code: 'Lumen' },
        { name: 'Koa', code: 'Koa' },
        { name: 'Qwik', code: 'Qwik' },
        { name: 'SolidJS', code: 'SolidJS' },
        { name: 'T3 Stack', code: 'T3 Stack' }

    ]);
    
    const language = ref([
        //amo ini an kanan langauge na ginamit han select input
        { name: 'PHP', code: 'PHP' },
        { name: 'JavaScript', code: 'JavaScript' },
        { name: 'TypeScript', code: 'TypeScript' },
        { name: 'Python', code: 'Python' },
        { name: 'Ruby', code: 'Ruby' },
        { name: 'Java', code: 'Java' },
        { name: 'C#', code: 'C#' },
        { name: 'C++', code: 'C++' },
        { name: 'Go', code: 'Go' },
        { name: 'Dart', code: 'Dart' },
        { name: 'Swift', code: 'Swift' },
        { name: 'Kotlin', code: 'Kotlin' },
        { name: 'Rust', code: 'Rust' },
        { name: 'Scala', code: 'Scala' },
        { name: 'Perl', code: 'Perl' },
        { name: 'Elixir', code: 'Elixir' }
    ]);




    
//----------------------- delete -------------------------

    const visible3 = ref(false);
    const item = ref({ id: null })
        
    function deleteModal(data) {
            selectedCategory.value = data
            item.value.id = data.id
            visible3.value = true
    }

    function closeDelete(){
            visible3.value = false
    }


    const deletePost = (id) => {
        //amo ini an kanna delete
        // bali amo ini an nkadto han button knan delete
        router.delete(`/deletProject/${id}`, {
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Delete message',
                detail: 'Deleted Successfully!', // Can hardcode or pull from props if needed
                life: 10000,
            });

        }
        })
        // tapos ini liwat an code para pag na delete na matik ma close an modal
        visible3.value = false
    }

    //screenshot delete
    const selectedscreenshot = ref(false);
    const visible4 = ref(false);
    const item1 = ref({ id: null })
        
    function deleteModalScreenshot(ScreenShots) {
            selectedscreenshot.value = ScreenShots
            item1.value.id = ScreenShots.id
            visible4.value = true
    }

    function closeDelete2(){
            visible4.value = false
    }



    const deletescreenshoot = (id) => {
        //amo ini an kanna delete
        // bali amo ini an nkadto han button knan delete
        router.delete(`/deletScreenshot/${id}`, {
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Delete message',
                detail: 'Deleted Successfully!', // Can hardcode or pull from props if needed
                life: 10000,
            });

        }
        })
        // tapos ini liwat an code para pag na delete na matik ma close an modal
        visible4.value = false
    }





</script>