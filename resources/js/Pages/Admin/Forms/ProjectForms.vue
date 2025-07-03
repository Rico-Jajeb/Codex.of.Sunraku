<template>
                   <form @submit.prevent="submitForm" enctype="multipart/form-data">
                        <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Project name</label>
                                <InputText class="!w-full" type="text" v-model="form.proj_name" placeholder="Insert Project name...." />
                                <div v-if="form.errors.proj_name" class="text-red-500 text-sm mt-2">
                                    {{ form.errors.proj_name }}
                                </div> 
                        </div>
                        <div class="mt-4">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description</label>
                                <InputText class="!w-full" type="text" v-model="form.proj_description" placeholder="Insert Project Description...." />
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
                       <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Project Cover</label>
                        <div class="card flex flex-col items-center gap-6 mt-4">                
                                <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                                <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                            
                        </div>
                 
                        <nav class="">
                                <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-save mr-1"></i> Save </button>                    
                        </nav>
                </form>
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FileUpload from 'primevue/fileupload';
    import InputText from 'primevue/inputtext';
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import { computed, watch, ref } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'
  
    import RadioButton from 'primevue/radiobutton';

    import MultiSelect from 'primevue/multiselect';
   import Textarea from 'primevue/textarea';
    



    
    const page = usePage()
    const toast = useToast()

    const successMessage = computed(() => page.props.flash?.success)

    




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
        proj_name: null,
        proj_description: null,
        language: [],
        framework: [],
        status: null,
        img: null,
        github_url: null,
        live_url: null,
    })


    const framework = ref([
        //amo ini an kanan framework na ginamit han select input
        { name: 'Vue', code: 'Vue' },
        { name: 'React', code: 'React' },
        { name: 'Angular', code: 'Angular' },
        { name: 'Svelte', code: 'Svelte' },
        { name: 'Next.js', code: 'Next.js' },
        { name: 'Nuxt.js', code: 'Nuxt.js' },
        { name: 'Codeigniter', code: 'Codeigniter' },
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


const submitForm = () => {
    form.post(route('add.Projects'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success message',
                detail: 'Project added successfully!',
                life: 10000,
            });

        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};
</script>