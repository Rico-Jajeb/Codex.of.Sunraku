<template>
                <form  class=""  @submit.prevent="form.post('add.Setting')" >
                        <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">add Category name</label>
                                <InputText class="!w-full" type="text" v-model="form.system_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                <div v-if="form.errors.system_name" class="text-red-500 text-sm mt-2">
                                    {{ form.errors.setting_name }}
                                </div> 
                        </div>

                            
                        <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Category Image Cover</label>
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
    import { computed, watch } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'


    
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
    system_name: null,
    img: null,

})


</script>