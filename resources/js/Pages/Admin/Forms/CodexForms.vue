<template>
   
          
                <form  class=""  @submit.prevent="form.post('add.Project')">
                 
                    <div class="">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Codex Name</label>
                            <InputText class="!w-full" type="text" v-model="form.CodexName" placeholder="E.g., Insert Data into MySQL with Laravel" />
                            <div v-if="form.errors.CodexName" class="text-red-500 text-sm mt-2">
                                {{ form.errors.CodexName }}
                            </div> 
                    </div>
                    <div class="">
                            <label for="Web Name" class="block mt-4 mb-2 text-lg font-medium text-gray-500 dark:text-white">Category2 Name</label>
                            <InputText class="!w-full" type="text" v-model="form.categoryName" placeholder="E.g., Insert Data into MySQL with Laravel" />
                            <div v-if="form.errors.categoryName" class="text-red-500 text-sm mt-2">
                                {{ form.errors.categoryName }}
                            </div> 
                    </div>
  
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
                    
                    <div class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Tags</label>
                            <InputText class="!w-full" type="text" v-model="form.tag" placeholder="Type and press Enter to add tags" /> 
                            <label for="Web Name" class="block mt-2 text-sm font-medium text-gray-500 dark:text-white">Press Enter to add a tag</label>
                            <div v-if="form.errors.tag" class="text-red-500 text-sm mt-2">
                                {{ form.errors.tag }}
                            </div> 
                    </div>
                    <section class="mt-4">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">difficulty Level</label>
                        <div class="md:flex md:flex-wrap gap-4 mt-4">
                            <div class="flex items-center gap-2">
                                <RadioButton v-model="form.level" inputId="level1" name="level" value="basic"  />
                                <label for="ingredient1">Basic</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton v-model="form.level" inputId="level2" name="level" value="intermediate"  />
                                <label for="ingredient2">Intermediate</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton v-model="form.level" inputId="level3" name="level" value="advanced"  />
                                <label for="ingredient3">Advanced</label>
                            </div>
                            
                        </div>
                        <div v-if="form.errors.level" class="text-red-500 text-sm mt-2">
                            {{ form.errors.level }}
                        </div> 
                    </section>
                    <header class="my-8">
                        <h1 class="text-xl font-bold">Content</h1>
                    </header>

                    <div class="mt-5">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description/Purpose</label>
                        <Textarea name="" id="" v-model="form.content" class="!w-full" placeholder="A brief explanation of the snippet or concept..."/>
                        <div v-if="form.errors.content" class="text-red-500 text-sm mt-2">
                            {{ form.errors.content }}
                        </div> 
                    </div>
                    <div class="mt-5">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Code Snippet/Commands</label>
                        <MonacoEditor v-model="form.code" language="javascript" class="h-80" />  
                        <div v-if="form.errors.code" class="text-red-500 text-sm mt-2">
                            {{ form.errors.code }}
                        </div>                       
                    </div>

                    <div class="mt-5">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Instructions/Steps</label>
                        <Textarea name="" id="" class="!w-full" v-model="form.instruction" placeholder="Step-by-step guidance if applicable..."/>
                        <div v-if="form.errors.instruction" class="text-red-500 text-sm mt-2">
                            {{ form.errors.instruction }}
                        </div>  
                    </div>
                    <div class="mt-5">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Expected Output</label>
                        <Textarea name="" id="" class="!w-full" v-model="form.output" placeholder="What the result should look like when executed..."/>
                        <div v-if="form.errors.output" class="text-red-500 text-sm mt-2">
                            {{ form.errors.output }}
                        </div> 
                        <div class="card flex flex-col items-center gap-6 mt-4">
                            <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                            <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        </div>
                    </div>
  
                    <nav class="">
                        <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-lg font-medium text-white mt-10  bg-blue-500 rounded-md px-5 py-3"><i class="pi pi-save"></i> Save Codex</button>                    
                    </nav>

                </form>              
         
  
</template>

<script setup>
    import InputText from 'primevue/inputtext';
    import { ref } from "vue";
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import Divider from 'primevue/divider';

  
    import RadioButton from 'primevue/radiobutton';

    import MultiSelect from 'primevue/multiselect';

    import DatePicker from 'primevue/datepicker';

    import Textarea from 'primevue/textarea';


  


    import { computed, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { useToast } from 'primevue/usetoast'

const page = usePage()
const toast = useToast()

const successMessage = computed(() => page.props.flash?.success)

// Automatically show toast when successMessage changes
watch(successMessage, (newValue) => {
  if (newValue) {
    toast.add({
      severity: 'success',
      summary: 'Success message',
      detail: newValue,
      life: 10000,
    })
  }
})


    //amo ini an knan monaco editor
    import MonacoEditor from '@/Pages/Admin/MonacoEditor/MonacoEditor.vue';
    const code = ref('// Start coding here...\n')

    //adi an knn img upload
    import FileUpload from 'primevue/fileupload';
    const src = ref(null);

    function onFileSelect(event) {
        const file = event.files[0];
        const reader = new FileReader();

        reader.onload = async (e) => {
            src.value = e.target.result;
        };

        reader.readAsDataURL(file);
    }



    const props = defineProps({
    category: {
        type: Object,
        required: true
    }
    });


    const form = useForm({
        //amo liwat ini an code para han system form
        CodexName: null,
        categoryName: null, 
        language: [],
        framework: [],
        tag: null,
        level: null,
        content: null,
        code: null,
        instruction: null,
        output: null,
        img: null,
     
      
    })


    // when category changes, update form.categoryName
    watch(
    () => props.category,
    (newCategory) => {
        if (newCategory && newCategory.category_name) {
        form.categoryName = newCategory.category_name;
        }
    },
    { immediate: true } // run immediately on first load
    );

    

    const selectedTopic = ref();
    const selectedLanguage = ref();
    const framework = ref([
        //amo ini an kanan framework na ginamit han select input
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

    //amo ini an difficulty level
    const ingredient = ref('');

    //amo ini an date picker
    const buttondisplay = ref();
    const icondisplay = ref();
    const templatedisplay = ref();
</script>