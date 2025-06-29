<template>
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <InputText class="!w-full" type="hidden" v-model="form.project_id" :value="projectId" placeholder="Insert Skill name......" />
            <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload project Screenshot </label>
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

    

   const props = defineProps({
        projectId: Number,
    })


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
        project_id: null,
        img: null,  
    })


const submitForm = () => {
    form.project_id = props.projectId // ensure correct id
    form.post(route('add.ScreenShot'), {
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