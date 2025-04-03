<template>
    <AppLayout title="Codex">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               New Codex
            </h2>
        </template>
        <main class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-10 px-8">
                <header class="">
                    <h1 class="text-xl font-bold">Basic Information</h1>
                </header>
                <Divider />
                <form action="" class="mt-4">
 
                    <div class="">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Codex Name</label>
                            <InputText class="!w-full" type="text" v-model="form.sysName" placeholder="E.g., Insert Data into MySQL with Laravel" /> 
                    </div>
                    <section class=" mt-4  md:flex md:flex-row ">
                        <div class="xl:basis-1/2 md:basis-1/2 mr-8">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Category/Topic</label>
                            <MultiSelect v-model="selectedTopic" display="chip" :options="topic" optionLabel="name" filter placeholder="Select Cities"
                                :maxSelectedLabels="3" class="w-full " />
                        </div>                        
                        <div class="xl:basis-1/2 md:basis-1/2 ml-8">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Language/Framework</label>
                            <MultiSelect v-model="selectedLanguage" display="chip" :options="language" optionLabel="name" filter placeholder="Select Cities"
                                :maxSelectedLabels="3" class="w-full" />
                        </div>                        
                    </section>
                    <div class="mt-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Tags</label>
                            <InputText class="!w-full" type="text" v-model="form.sysName" placeholder="Type and press Enter to add tags" /> 
                            <label for="Web Name" class="block mt-2 text-sm font-medium text-gray-500 dark:text-white">Press Enter to add a tag</label>
                    </div>
                    <section class="mt-4">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">difficulty Level</label>
                        <div class="flex flex-wrap gap-4 mt-4">
                            <div class="flex items-center gap-2">
                                <RadioButton v-model="ingredient" inputId="ingredient1" name="pizza" value="Cheese" />
                                <label for="ingredient1">Basic</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton v-model="ingredient" inputId="ingredient2" name="pizza" value="Mushroom" />
                                <label for="ingredient2">Intermediate</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <RadioButton v-model="ingredient" inputId="ingredient3" name="pizza" value="Pepper" />
                                <label for="ingredient3">Advanced</label>
                            </div>
                        </div>
                    </section>

                    <section class=" mt-4  md:flex md:flex-row">
                        <div class="xl:basis-1/2 md:basis-1/2 mr-8">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Author (Optional)</label>
                            <InputText class="!w-full" type="text" v-model="form.sysName" placeholder="E.g., Insert Data into MySQL with Laravel" /> 
                        </div>
                        <div class="xl:basis-1/2 md:basis-1/2 ml-8">
                            <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Date Created</label>
                                <DatePicker v-model="icondisplay" showIcon fluid iconDisplay="input" inputId="icondisplay" class="!w-full" />
                            </div>
                        </div>
                    </section>

                    <header class="my-8">
                        <h1 class="text-xl font-bold">Content</h1>
                    </header>

                    <div class="mt-5">
                        <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Author (Optional)</label>
                        <Textarea name="" id="" class="!w-full" placeholder="A brief explanation of the snippet or concept..."/>
                    </div>

                    <nav class="">
                        <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-lg font-medium text-white mt-10  bg-blue-500 rounded-md px-5 py-3"><i class="pi pi-save"></i> Save Changes</button>                    
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
    import { useForm } from '@inertiajs/vue3'
    import Divider from 'primevue/divider';

    
    import RadioButton from 'primevue/radiobutton';

    import MultiSelect from 'primevue/multiselect';

    import DatePicker from 'primevue/datepicker';

    import Textarea from 'primevue/textarea';

    const form = useForm({
        //amo liwat ini an code para han system form
      sysName: null,
      slogan: null,
      sysLogo: null,
      sysFavicon: null,
      
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