<template>
        

        <form @submit.prevent="submitForm" enctype="multipart/form-data">
              <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Test Name</label>
       
            <br>
            <InputText class="!w-full" type="text" v-model="form.project_id" :value="projectId" placeholder="Insert Skill name......" />
            <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Skill Logo</label>
            <div class="card flex flex-col items-center gap-6 mt-4">                
                    <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                    <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                  
            
            </div>
        
            <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-save mr-1"></i> Save </button>                    
            
        </form>

</template>
<script setup>
    import { ref } from "vue";
    import InputText from 'primevue/inputtext';
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form


    
    //kanan toast ini
    import { computed, watch } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'

    const page = usePage()
    const toast = useToast()

    const successMessage = computed(() => page.props.flash?.success)

    // bali ini na props is an kanan form la ini an id
    const props = defineProps({
        projectId: Number,
    })


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
        project_id: null,
        img: null,
        //tech_logo: null,
    })


const submitForm = () => {
    form.project_id = props.projectId // ensure correct id
    form.post(route('add.Test'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success message',
                detail: 'Category added successfully!',
                life: 10000,
            });
console.log("Submitting form with project ID:", form.project_id);

        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
            console.log("Submitting form with project ID:", form.project_id);

        },
    });
};
  

</script>