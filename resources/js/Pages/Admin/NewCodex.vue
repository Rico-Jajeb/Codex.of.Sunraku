<template>
    <AppLayout title="Codex">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               New Codex
            </h2>

            <!-- <div v-if="successMessage" class="bg-green-100 text-green-800 p-4 rounded mb-4">
    {{ successMessage }}
  </div> -->


  <!-- <div class="card flex justify-center">
        <h1>hahah</h1>
        <Toast />
        <button @click="show" type="button" class="bg-red-300">click me</button>
    </div> -->
    <!-- <div class="card flex justify-center">
    <h1>hahah</h1>
    <Toast />
    <button @click="show" type="button" class="bg-red-300">click me</button>
  </div> -->
    <div>
            <Toast />
    </div>
        </template>







        <main class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-10 px-8">
                <header class="">
                    <h1 class="text-xl font-bold">Codex Information</h1>
                </header>
                <Divider />
                <form  class="mt-4"  @submit.prevent="form.post('add.Project')">
 
                    <div class="">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Codex Name</label>
                            <InputText class="!w-full" type="text" v-model="form.CodexName" placeholder="E.g., Insert Data into MySQL with Laravel" />
                            <div v-if="form.errors.CodexName" class="text-red-500 text-sm mt-2">
                                {{ form.errors.CodexName }}
                            </div> 
                    </div>

                    <section class=" mt-4  md:flex md:flex-row ">
                        <div class="xl:basis-1/2 md:basis-1/2  md:mr-8">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Language</label>
                                <MultiSelect 
                                    v-model="form.language" 
                                    display="chip" 
                                    :options="topic" 
                                    optionLabel="name" 
                                    optionValue="code"
                                    filter 
                                    placeholder="Select Topics"
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
                                    :options="language" 
                                    optionLabel="name" 
                                    optionValue="code"
                                    filter 
                                    placeholder="Select Topics"
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
            </section>
        </main>
  
    </AppLayout>

</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import InputText from 'primevue/inputtext';
    import { ref } from "vue";
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import Divider from 'primevue/divider';

  
    import RadioButton from 'primevue/radiobutton';

    import MultiSelect from 'primevue/multiselect';

    import DatePicker from 'primevue/datepicker';

    import Textarea from 'primevue/textarea';


  
   


//     import Toast from 'primevue/toast';
// import { useToast } from 'primevue/usetoast';

// const toast = useToast();

// const show = () => {
//     toast.add({ severity: 'info', summary: 'Info', detail: 'Message Content', life: 3000 });
// };


// import Toast from 'primevue/toast';
// import { useToast } from 'primevue/usetoast';

// const toast = useToast();

// const show = () => {
//   toast.add({ 
//     severity: 'info', 
//     summary: 'Info', 
//     detail: 'Message Content', 
//     life: 3000 
//   });
// };



//     import { computed } from 'vue'
// import { usePage } from '@inertiajs/vue3'

// const page = usePage()

// const successMessage = computed(() => page.props.flash?.success)







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




    const form = useForm({
        //amo liwat ini an code para han system form
        CodexName: null,
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
    

    const selectedTopic = ref();
    const selectedLanguage = ref();
    const topic = ref([
        //amo ini an kanan framework na ginamit han select input
        { name: 'New York', code: 'NY' },
        { name: 'Rome', code: 'RM' },
        { name: 'London', code: 'LDN' },
        { name: 'Istanbul', code: 'IST' },
        { name: 'Paris', code: 'PRS' }
    ]);
    const language = ref([
        //amo ini an kanan langauge na ginamit han select input
        { name: 'PHP', code: 'NY' },
        { name: 'Laravel', code: 'RM' },
        { name: 'JavaScript', code: 'LDN' },
        { name: 'React', code: 'IST' },
        { name: 'Vue', code: 'PRS' },
        { name: 'Python', code: 'PRS' },
        { name: 'Django', code: 'PRS' }
    ]);

    //amo ini an difficulty level
    const ingredient = ref('');

    //amo ini an date picker
    const buttondisplay = ref();
    const icondisplay = ref();
    const templatedisplay = ref();
</script>