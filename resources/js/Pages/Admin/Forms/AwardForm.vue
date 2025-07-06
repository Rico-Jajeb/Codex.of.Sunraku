<template>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Achievement Title</label>
                <InputText class="!w-full" type="text" v-model="form.award_title" placeholder="Insert Title...." />
                <div v-if="form.errors.award_title" class="text-red-500 text-sm mt-2">
                    {{ form.errors.award_title }}
                </div>                 
            </div>
            <div class="">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Achievement Description</label>
                <InputText class="!w-full" type="text" v-model="form.award_description" placeholder="Insert description...." />
                <div v-if="form.errors.award_description" class="text-red-500 text-sm mt-2">
                    {{ form.errors.award_description }}
                </div>                 
            </div>
            <div class="">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Issuer</label>
                <InputText class="!w-full" type="text" v-model="form.issuer" placeholder="Insert description...." />
                <div v-if="form.errors.issuer" class="text-red-500 text-sm mt-2">
                    {{ form.errors.issuer }}
                </div>                 
            </div>
            <div class="">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Date</label>
                <InputText class="!w-full" type="text" v-model="form.Date" placeholder="Insert description...." />
                <div v-if="form.errors.Date" class="text-red-500 text-sm mt-2">
                    {{ form.errors.Date }}
                </div>                 
            </div>
            <div class="">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Award Links</label>
                <InputText class="!w-full" type="text" v-model="form.award_url" placeholder="Insert description...." />
                <div v-if="form.errors.award_url" class="text-red-500 text-sm mt-2">
                    {{ form.errors.award_url }}
                </div>                 
            </div>
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

            <br>
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

   import RadioButton from 'primevue/radiobutton';
    
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
        award_title: null,
        award_description: null,
        issuer: null,
        Date: null,
        award_url: null,
        highlight: null,
        img: null,
    })


const submitForm = () => {
    form.post(route('add.Award'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Success message',
                detail: 'Achievement added successfully!',
                life: 10000,
            });

        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};
  
</script>