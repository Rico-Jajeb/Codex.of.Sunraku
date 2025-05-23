<template>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">

            <div class="">
                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">add Category name</label>
                    <InputText class="!w-full" type="text" v-model="form.CategoryName" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                    <div v-if="form.errors.CategoryName" class="text-red-500 text-sm mt-2">
                        {{ form.errors.CategoryName }}
                    </div> 
            </div>
            <div class="mt-4">
                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description</label>
                    <InputText class="!w-full" type="text" v-model="form.CategoryDesc" placeholder="A brief explanation of the category" />
                    <div v-if="form.errors.CategoryDesc" class="text-red-500 text-sm mt-2">
                        {{ form.errors.CategoryDesc }}
                    </div> 
            </div>
                 
            <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Category Image Cover</label>
            <div class="card flex flex-col items-center gap-6 mt-4">                
                    <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                    <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                  
            
                </div>
            <nav class="">
                    <!-- <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-save mr-1"></i> Save </button>                    
             -->
                <button type="submit">Update Category</button>
            </nav>
    </form>
    <div>
        <!-- amo ini an kanan pop up notif pag nag submit msg -->
            <Toast />
    </div>
</template>

<script setup>
    import InputText from 'primevue/inputtext';
    import { ref } from "vue";
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import Divider from 'primevue/divider';

    
    //kanan toast ini
    import { computed, watch } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'

    const page = usePage()
    const toast = useToast()

    const successMessage = computed(() => page.props.flash?.success)

  


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
        CategoryName: null,
        CategoryDesc: null,
        img: null,
   
    })


const submitForm = () => {
    form.post(route('add.Category'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success message',
                detail: 'Category added successfully!',
                life: 10000,
            });

        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};
</script>