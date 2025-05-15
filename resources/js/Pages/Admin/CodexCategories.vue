<template>
    <AppLayout title="Codex">
        <template #header>
            <section class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Codex Category
                </h2>
                <div class="">
                   
                        <button  @click="visible = true"  class="bg-blue-600  pl-4 pr-4 py-2 rounded-md text-md font-bold text-white" type="submit"> <i class="pi pi-plus mr-2"></i> New Category</button>                
                </div>

            </section>

        </template>
        <main class="py-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="flex justify-center w-full py-8 gap-2">     
                <button  type="button"  @click="openCategoryCard()">
                    <i class="pi pi-table mr-2"></i>
                </button>
                <button type="button"  @click="openCategoryTable()">
                    <i class="pi pi-align-justify mr-2"></i>
                </button>
            </section>
            <section class=" overflow-hidden  sm:rounded-lg  px-8">
                    <div class="">
                        <IconField class="mx-auto md:!w-full !w-80"  >
                            <InputIcon class="pi pi-search" />
                            <InputText v-model="value1" placeholder="Search codex categories..." class="!w-full" />
                        </IconField>
                    </div> 
                <!-- amo ini an kanan cards category  -->
                <section v-if="categoryCard" class="flex flex-row  basis-5/6 flex-wrap justify-center gap-4 mt-4">
                    <!-- Amo ini an card  -->
                    <!-- <Card class="!w-80 !h-80 shadow-xl"  v-for="item in data" :key="item.id"> -->
                    <Card  class="!w-80 !h-80 shadow-xl"  v-for="item in data" :key="item.id">
                        <template #header>
                            <img alt="user header" loading="lazy"  class="h-36 w-full object-cover rounded-t-lg"  :src="`/storage/output/${item.img}`" />
                        </template>
                        <template  #title>
                            <div class="truncate">
                                {{ item.category_name }}                                
                            </div>

                        </template>
                        <template #content>
                            <div class="  h-20 overflow-hidden">
                                <p class="text-md text-gray-600 font-medium">
                                    {{ item.description }}
                                </p>                                
                            </div>

                        </template>
                        <template #footer>
                            <div class="flex justify-end">

                                <!-- Eye BUTTON -->
                                <button type="button" @click="openCategoryInfoModal(item)" class="mr-4">
                                    <i class="pi pi-eye" style="font-size: 1rem"></i>
                                </button>
                                <!-- UPDATE BUTTON -->
                                <button type="button" @click="openModal(item)">
                                    <i class="pi pi-file-edit" style="font-size: 1rem"></i>
                                </button>
                                <!-- DELETE BUTTON -->
                                <button type="button" @click="deleteModal(item)" class="mx-4">
                                    <i class="pi pi-trash" style="font-size: 1rem"></i>
                                </button>   
                                <!-- Amo ini an kann category status -->
                                <div class="">
                                      <Badge v-if="item.status === 'Active'" value="" severity="success"></Badge>
                                      <Badge v-else="item.status === 'Oflline'" value="" severity="danger"></Badge>
                                </div>                       
                            </div>
                        </template>
                    </Card>
                </section> 
                <!-- amo liwat adi an knn table han category     -->
                 <section v-if="categoryTable"  class="bg-white rounded-lg mt-4 pt-8 pb-4">
                 
  
                        <DataTable v-model:selection="selectedCateg" dataKey="id" :value="data"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">
                      
                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column field="category_name" header="category_name" sortable />
                        <Column field="description" header="description" sortable />
                        <!-- <Column field="img" header="Image" sortable /> -->
                            <Column field="img" header="Image" sortable>
                                <template #body="{ data }">
                                <Image 
                                    alt="user header"
                                    loading="lazy"
                                 
                                    :src="`/storage/output/${data.img}`"
                               preview  imageClass="h-16 object-cover rounded-md"  />
                                </template>
                            </Column>

                        <Column class="!text-end" header="Actions">
                            <template #body="{ data }">
                                <nav class="flex gap-1">
                                <!-- Eye BUTTON -->
                                    <button type="button" @click="openCategoryInfoModal(data)" class="mr-4">
                                        <i class="pi pi-eye" style="font-size: 1rem"></i>
                                    </button>
                                    <!-- UPDATE BUTTON -->
                                    <button type="button" @click="openModal(data)">
                                        <i class="pi pi-file-edit" style="font-size: 1rem"></i>
                                    </button>
                                    <!-- DELETE BUTTON -->
                                    <button type="button" @click="deleteModal(data)" class="mx-4">
                                        <i class="pi pi-trash" style="font-size: 1rem"></i>
                                    </button>                               
                                </nav>

                            </template>
                        </Column>
                    </DataTable>
                 </section>
            </section>
        </main>

        <!--ADD amo ini an kanan modal han category form -->
        <section>
            <div class="card flex justify-center bg-red-500">
                <Button label="Show" @click="visible = true" />
                <Dialog v-model:visible="visible" maximizable header="Add Category" :style="{ width: '25rem' }"  >
                    <CategoryForm/>
                </Dialog>
            </div>
        </section>

        <!--ADD amo ini an kanan modal han codex  form -->
        <section>
            <div class="card flex justify-center bg-red-500">
                <Button label="Show" @click="codexModal = true" />
                <Dialog v-model:visible="codexModal" maximizable header="Codex Information" class=" max-w-7xl mx-auto sm:px-6 lg:px-1 "  >
                    
                    <CodexForm :category="selectedCategory" />
                </Dialog>
            </div>
        </section>



        <!-- Adi an modal han update category form -->
        <!-- <section>
            <div class="card flex justify-center bg-red-500">
                <Button label="Show" @click="visible2 = true" />
                <Dialog v-model:visible="visible2" header="Update Category" :style="{ width: '25rem' }"  >
                    <UpdateCategoryForm/>
                </Dialog>
            </div>
        </section> -->-

            <!--UPDATE adi an knn category  modal -->
            <section>    
                <Dialog v-model:visible="visible2" maximizable
                        :header="`Update '${selectedCategory.category_name}' Category`"
                        :style="{ width: '25rem' }" >
  
                        <!-- <form @submit.prevent="form.put(route('categories.update', selectedCategory.id))" enctype="multipart/form-data"> -->
                          
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">


                            <div class="">
                                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">UPDATE Category name</label>
                                    <InputText class="!w-full" type="text" v-model="form.category_name" name="category_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                    <div v-if="form.errors.category_name" class="text-red-500 text-sm mt-2">
                                        {{ form.errors.category_name }}
                                    </div> 
                            </div>
                            <div class="mt-4">
                                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description</label>
                                    <InputText class="!w-full" type="text" v-model="form.description" name="description" placeholder="A brief explanation of the category" />
                                    <div v-if="form.errors.description" class="text-red-500 text-sm mt-2">
                                        {{ form.errors.description }}
                                    </div> 
                            </div>
                                
                            <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Category Image Cover</label>
                            <div class="card flex flex-col items-center gap-6 mt-4">                
                                    
                                <!-- <img  :src="`/storage/output/${selectedCategory.img}`" alt="Image" class="shadow-md object-cover rounded-xl w-full  max-h-44 " style="filter: grayscale(0%)" /> -->

                                <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />

                                <!-- <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto /> -->

                                <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                  
  


                            </div>
                            <nav class="">   
                                <button type="submit">Update Category</button>

                                <!-- <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-save mr-1"></i> Save </button>                    
           -->
                            </nav>
                    </form>

                </Dialog>
            </section>



            <!--DELETE amo ini an delete modal kanan category -->
            <section>
                <Dialog v-model:visible="visible3" :header="`Delete '${selectedCategory.category_name}' Category`" :style="{ width: '25rem' }">
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

            <!-- Category display info -->
            <section>
                <!-- <Dialog v-model:visible="categoryInfoDisp" maximizable :header="`Codex Category: '${selectedCategory.category_name}'`" :style="{ width: '90vw' }">
                    -->
                    <Dialog 
                            v-model:visible="categoryInfoDisp"
                            maximizable
                            :header="`Codex Category: '${selectedCategory?.category_name ?? ''}'`"
                            :style="{ width: '90vw' }"
                        >
                        <section class="overflow-hidden h-full ">

  
                    <nav class="flex justify-end w-full  gap-4">
                    <!-- amo ini an button kann codex modal para han form -->
                        <button  @click="openCodexModal(selectedCategory)"  class="bg-blue-600 pl-4 pr-4 py-2 rounded-md text-md font-bold text-white" type="button" >
                            <i class="pi pi-plus mr-2"></i> Add Codex
                        </button>
                        <button  @click="exportCSV($event)" type="button"  class="bg-green-600 pl-4 pr-4 py-2 rounded-md text-md font-bold text-white">
                            Export CSV
                        </button>
                   </nav>
               
                    <DataTable v-model:selection="selectedProducts" dataKey="id" :value="products"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">
                      
                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>

                        <Column field="codex_name" header="codex_name" sortable />
                        <Column field="category_name" header="category_name" sortable />
                        <Column field="language" header="language" sortable />
                        <Column field="framework" header="framework" sortable />
                        <Column field="tags" header="tags" sortable />
                        <Column field="diffuclt_level" header="difficult level" sortable />
                        <Column field="content" header="content" sortable />
                        <Column field="instructions" header="instruction" sortable />
                        <Column field="code_snippet" header="code snippet" sortable />
                        <Column field="output" header="output" sortable />
                        <!-- <Column field="img" header="Image" sortable /> -->
                           <Column field="img" header="Image" sortable>
                                <template #body="{ data }">
                                <Image 
                                    alt="user header"
                                    loading="lazy"
                                 
                                    :src="`/storage/output/${data.img}`"
                               preview  imageClass="h-16 object-cover rounded-md"  />
                                </template>
                            </Column>

                        <Column class="!text-end">
                            <template #body="{ data }">
                                <nav class="flex gap-1">
                                    <button @click="editCodexModal(data)" class=" py-2 px-4"><i class="pi pi-pencil" ></i></button>
                                    <button @click="editCodexModal(data)" class=" py-2 px-4"><i class="pi pi-trash" ></i></button>                                    
                                </nav>

                            </template>
                        </Column>
                    </DataTable>
       

                </section>
                </Dialog>
            </section>

            <!--UPDATE amo ini an kanan edit codex modal -->
            <section>
                <Dialog v-model:visible="codexInfoDisp"  :header="`Codex Category: '${selectedCodex?.codex_name ?? ''}'`" maximizable class=" max-w-7xl  mx-auto sm:px-6 lg:px-1 bg-red-600">
                
                        
                            <h2>{{ selectedCodex.id }}</h2>
                        <!-- <form  class=""  @submit.prevent="form.post('')"> -->
                        <!-- <form @submit.prevent="form.put(route('codex.update', selectedCodex.id))"> -->
                        <form @submit.prevent="submitCodexForm" enctype="multipart/form-data">

                        <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">update Codex Name</label>
                                <InputText class="!w-full" type="text" v-model="codexform.codex_name" placeholder="E.g., Insert Data into MySQL with Laravel" />
                                <div v-if="codexform.errors.codex_name" class="text-red-500 text-sm mt-2">
                                    {{ codexform.errors.codex_name }}
                                </div> 
                        </div>
                        <div class="">
                                <label for="Web Name" class="block mt-4 mb-2 text-lg font-medium text-gray-500 dark:text-white">Category Name</label>
                                <InputText class="!w-full" type="text" v-model="codexform.category_name" placeholder="E.g., Insert Data into MySQL with Laravel" />
                                <div v-if="codexform.errors.category_name" class="text-red-500 text-sm mt-2">
                                    {{ codexform.errors.category_name }}
                                </div> 
                        </div>

                        <section class=" mt-4  md:flex md:flex-row ">
                            <div class="xl:basis-1/2 md:basis-1/2  md:mr-8">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Language</label>
                                    <MultiSelect 
                                        v-model="codexform.language" 
                                        display="chip" 
                                        :options="language" 
                                        optionLabel="name" 
                                        optionValue="code"
                                        filter 
                                        placeholder="Select a language"
                                        :maxSelectedLabels="3" 
                                        class="w-full" />
                                        <div v-if="codexform.errors.language" class="text-red-500 text-sm mt-2">
                                            {{ codexform.errors.language }}
                                        </div> 
                            </div>                        
                            <div class="xl:basis-1/2 md:basis-1/2 md:ml-8 mt-4 md:mt-0">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Framework</label>
                                    <MultiSelect 
                                        v-model="codexform.framework" 
                                        display="chip" 
                                        :options="framework" 
                                        optionLabel="name" 
                                        optionValue="code"
                                        filter 
                                        placeholder="Select a framework"
                                        :maxSelectedLabels="3" 
                                        class="w-full" />
                                        <div v-if="codexform.errors.framework" class="text-red-500 text-sm mt-2">
                                            {{ codexform.errors.framework }}
                                        </div> 
                            </div>                        
                        </section>
                        
                        <div class="mt-4">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Tags</label>
                                <InputText class="!w-full" type="text" v-model="codexform.tags" placeholder="Type and press Enter to add tags" /> 
                                <label for="Web Name" class="block mt-2 text-sm font-medium text-gray-500 dark:text-white">Press Enter to add a tag</label>
                                <div v-if="codexform.errors.tags" class="text-red-500 text-sm mt-2">
                                    {{ codexform.errors.tags }}
                                </div> 
                        </div>
                        <section class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">difficulty Level</label>
                            <div class="md:flex md:flex-wrap gap-4 mt-4">
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="codexform.diffuclt_level" inputId="level1" name="level" value="basic"  />
                                    <label for="ingredient1">Basic</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="codexform.diffuclt_level" inputId="level2" name="level" value="intermediate"  />
                                    <label for="ingredient2">Intermediate</label>
                                </div>
                                <div class="flex items-center gap-2">
                                    <RadioButton v-model="codexform.diffuclt_level" inputId="level3" name="level" value="advanced"  />
                                    <label for="ingredient3">Advanced</label>
                                </div>
                                
                            </div>
                            <div v-if="codexform.errors.diffuclt_level" class="text-red-500 text-sm mt-2">
                                {{ codexform.errors.diffuclt_level }}
                            </div> 
                        </section>
                        <header class="my-8">
                            <h1 class="text-xl font-bold">Content</h1>
                        </header>

                        <div class="mt-5">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description/Purpose</label>
                            <Textarea name="" id="" v-model="codexform.content" class="!w-full" placeholder="A brief explanation of the snippet or concept..."/>
                            <div v-if="codexform.errors.content" class="text-red-500 text-sm mt-2">
                                {{ codexform.errors.content }}
                            </div> 
                        </div>
                        <div class="mt-5">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Code Snippet/Commands</label>
                            <MonacoEditor v-model="codexform.code_snippet" language="javascript" class="h-80" />  
                            <div v-if="codexform.errors.code_snippet" class="text-red-500 text-sm mt-2">
                                {{ codexform.errors.code_snippet }}
                            </div>                       
                        </div>

                        <div class="mt-5">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Instructions/Steps</label>
                            <Textarea name="" id="" class="!w-full" v-model="codexform.instructions" placeholder="Step-by-step guidance if applicable..."/>
                            <div v-if="codexform.errors.instructions" class="text-red-500 text-sm mt-2">
                                {{ codexform.errors.instructions }}
                            </div>  
                        </div>
                        <div class="mt-5">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Expected Output</label>
                            <Textarea name="" id="" class="!w-full" v-model="codexform.output" placeholder="What the result should look like when executed..."/>
                            <div v-if="codexform.errors.output" class="text-red-500 text-sm mt-2">
                                {{ codexform.errors.output }}
                            </div> 
                            <div class="card flex flex-col items-center gap-6 mt-4">
                                <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                                <FileUpload mode="basic" @input="codexform.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                            </div>
                        </div>

                        <nav class="">
                            <!-- <button type="submit" :disabled="codexform.processing"  severity="secondary" label="Submit" class="text-lg font-medium text-white mt-10  bg-blue-500 rounded-md px-5 py-3"><i class="pi pi-save"></i> Save Codex</button>                     -->
                                  <button type="submit">Update Category</button>
                        </nav>

                    </form>      
                </Dialog>
            </section>

            <!-- new shit -->
            <!-- new shit -->
            <div>
                <!-- amo ini an kanan pop up notif pag nag submit msg -->
                <Toast />
            </div>

    </AppLayout>
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';

    import 'primeicons/primeicons.css'
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    
    import Card from 'primevue/card';

  
    import Dialog from 'primevue/dialog';

    import { computed, ref, watchEffect , watch, onMounted     } from 'vue';
    import { router } from '@inertiajs/vue3'
    import RadioButton from 'primevue/radiobutton';

    import MultiSelect from 'primevue/multiselect';
   import Textarea from 'primevue/textarea';


    import InputText from 'primevue/inputtext'
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import FileUpload from 'primevue/fileupload';

   
 
import Image from 'primevue/image';

    import Badge from 'primevue/badge';


    // amo ini an kanan update category Form
    import UpdateCategoryForm from '@/Pages/Admin/Forms/Update/CategoryUpdateForms.vue';


    // amo ini an kann category form
    import CategoryForm from '@/Pages/Admin/Forms/CategoryForms.vue';
    import CodexForm from '@/Pages/Admin/Forms/CodexForms.vue';

    

    //amo ini an kanan category info modal table
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import ColumnGroup from 'primevue/columngroup';   // optional
    import Row from 'primevue/row';                   // optional


    
  



    //kanan toast ini
    
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'




const selectedProducts = ref();
const dt = ref();


    const page = usePage()
    const toast = useToast()

    const successMessage = computed(() => page.props.flash?.success)




    const props = defineProps({
        data: Array,
        codex: Array
    });

    
  








    function openCategoryInfoModal(category) {
    selectedCategory.value = category;
    form.category_name = category.category_name;
    form.description = category.description; // or whatever the property is
    form.img = null; // reset image, or preload if needed

    categoryInfoDisp.value = true;
    }




 const products = computed(() => {
    if (!selectedCategory.value || !selectedCategory.value.category_name) {
            return [];
    }
        return props.codex.filter(item => item.category_name === selectedCategory.value.category_name);
    });


const selectedCategory = ref({}); // ← whole object now  



    
   


//kanan edit codex ha datatable


    //amo ini an knan monaco editor
    import MonacoEditor from '@/Pages/Admin/MonacoEditor/MonacoEditor.vue';
    const code = ref('// Start coding here...\n')
 

//-------------------------------------------- codex ---------------------------

    const codexInfoDisp = ref(false);
    const selectedCodex = ref({}); // ← whole object now  


    const codexform = useForm({
        //amo liwat ini an code para han system form
        codex_name: null,
        category_name: null, 
        language: [],
        framework: [],
        tags: null,
        diffuclt_level: null,
        content: null,
        code_snippet: null,
        instructions: null,
        output: null,
        img: null,
    })




    function editCodexModal(category) {
        selectedCodex.value = category;
        codexform.codex_name = category.codex_name; //bali ini na code amo ini an para ma display an codex_name ngadto han sakob han input
        codexform.category_name = category.category_name;
        codexform.tags = category.tags;
        codexform.content = category.content;
        codexform.code_snippet = category.code_snippet;
        codexform.instructions = category.instructions;
        codexform.output = category.output;
        codexform.diffuclt_level = category.diffuclt_level;
        codexform.framework = category.framework;
        codexform.language = category.language;
        codexInfoDisp.value = true;
    }





const submitCodexForm = () => {
    // Log current input values for debugging
    console.log("codex_name Name:", codexform.CodexName);
    console.log("category_name Name:", codexform.categoryName);
    console.log("tags Name:", codexform.tag);
    console.log("content :", codexform.content);
    console.log("code_snippet :", codexform.code);
    console.log("instructions :", codexform.instruction);
    console.log("output :", codexform.output);
    console.log("diffuclt_level :", codexform.level);
    console.log("framework :", codexform.framework);
    console.log("language :", codexform.language);
    console.log("Image:", codexform.img);
    // Spoof the PUT method by transforming the form data
    codexform.transform(data => ({
        ...data,
        _method: 'PUT',
    }));

    codexform.post(route('codex.update', selectedCodex.value.id), {
        preserveScroll: true,
        forceFormData: true, // Required for sending FormData including files
        onSuccess: () => {
            console.log("Form submitted successfully.");
            // Reset modal and form
            src.value = null;
            form.reset();
            visible2.value = false;
        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};












    const selectedTopic = ref();
    const selectedLanguage = ref();
    //amo ini an kanan framework na ginamit han select input
    const framework = ref([
        { name: 'Vue', code: 'Vue' },
        { name: 'React', code: 'React' },
        { name: 'Angular', code: 'Angular' },
        { name: 'Svelte', code: 'Svelte' },
        { name: 'Next.js', code: 'Next.js' },
        { name: 'Nuxt.js', code: 'Nuxt.js' },
        { name: 'Laravel', code: 'Laravel' },
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

     //amo ini an kanan langauge na ginamit han select input
    const language = ref([
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



  

// ----------------------------------------------------------------- kanan table han codex ---------------------------









// Export to CSV
const exportCSV = () => {
  // This will export the table's data to CSV
  dt.value.exportCSV();
};





//--------------------------------------------- Kanan Category ONLY -----------------------------------------------------

const selectedCateg = ref();





function openModal(category) {
    selectedCategory.value = category;
    form.category_name = category.category_name;
    form.description = category.description; // or whatever the property is
    form.img = null; // reset image, or preload if needed

    visible2.value = true;
    }




    const form = useForm({
    category_name: null,
    description: null,
    img: null,
    });




const src = ref(null);




    function onFileSelect(event) {
        const file = event.files[0];
        const reader = new FileReader();

        reader.onload = async (e) => {
            src.value = e.target.result;
        };

        reader.readAsDataURL(file);
    }





const submitForm = () => {
 
    form.transform(data => ({
        ...data,
        _method: 'PUT',
    }));

    form.post(route('categories.update', selectedCategory.value.id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Update message',
                detail: 'Category Updated Successfully!', // Can hardcode or pull from props if needed
                life: 10000,
            });
            src.value = null;
            form.reset();
            visible2.value = false;
        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};



//Bali ini an kanan button han card tas table han category

const categoryTable = ref(false);
const categoryCard = ref(true);


function openCategoryTable() {
        categoryTable.value = true;
        categoryCard.value = false;
    }
    
function openCategoryCard() {
        categoryCard.value = true;
        categoryTable.value = false;
    }





//--------------------------------------------- END  Test area -----------------------------------------------------


    








    
    function openCodexModal(category) {
    selectedCategory.value = category;
 
        codexModal.value = true;
    }




  

    // amo ini an mga knn modal
    const visible = ref(false);
    const visible2 = ref(false);
    const visible3 = ref(false);
    const categoryInfoDisp = ref(false);
    const codexModal = ref(false);


//------------------------------------------------------------- DELETE ------------------------------------------------

    const deletePost = (id) => {
        //amo ini an kanna delete
        // bali amo ini an nkadto han button knan delete
        router.delete(`/posts/${id}`, {
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


    const item = ref({ id: null })

    function deleteModal(category) {
    selectedCategory.value = category
    item.value.id = category.id
    visible3.value = true
    }

    function closeDelete(){
        visible3.value = false
    }


</script>