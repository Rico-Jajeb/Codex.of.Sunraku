<template>
    <AppLayout title="System Settings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                General Settings
            </h2>
        </template>


        <main class="pt-10">
          
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg">

                <header class="px-4 pt-4 mt-8 mb-8">
                    <h1 class="text-2xl font-bold text-gray-900  dark:text-white mb-2" >General settings</h1>
                    <p class="m-0">Configure the basic information about your tourism website</p>
                    <Divider />                    
                </header>
                

                 <form @submit.prevent="submitForm" enctype="multipart/form-data">
                    <div class="px-4">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">System name</label>
                            <InputText class="!w-full" type="text" v-model="form.system_name" placeholder="Insert System Name" />
                            <div v-if="form.errors.system_name" class="text-red-500 text-sm mt-2">
                                {{ form.errors.system_name }}
                            </div> 
                    </div>
                    <div class="px-4  mt-8 mb-8">
                            <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Slogan/Tagline</label>
                            <InputText class="!w-full" type="text" v-model="form.system_slogan" placeholder="Insert Slogan/Tagline" />
                            <div v-if="form.errors.system_slogan" class="text-red-500 text-sm mt-2">
                                {{ form.errors.system_slogan }}
                            </div> 
                    </div>
                  

                          <section class=" mt-4 px-4  md:flex md:flex-row ">
                    <div class="  xl:basis-1/2 md:basis-1/2 ">
                        <label for="email" class="block mb-2 text-lg font-medium  text-gray-900 dark:text-white">Logo</label>
                        <div class=" block sm:flex ">
                            <Image v-if="!srcLogo" alt="user header" loading="lazy"  preview imageClass="shadow-md rounded-xl w-full md:w-40 md:h-40 h-64"  :src="`/storage/output/${props.data.system_logo}`" />
                    
                            <Image v-if="srcLogo" :src="srcLogo" alt="Image" preview imageClass="shadow-md rounded-xl w-full md:w-40 md:h-40 h-64 "  />
                            <FileUpload mode="basic" @input="form.system_logo = $event.target.files[0]" @select="onFileSelectLogo" customUpload auto severity="secondary" class="md:mt-0 mt-4 p-button-outlined ml-2 sm:ml-8 md:ml-2" />
                        </div>
                    </div>
                    <div class="  xl:basis-1/2 md:basis-2/2 md:mt-0 mt-10">
                        <label for="email" class="block mb-2 text-lg font-medium  text-gray-900 dark:text-white">Background</label>
                        <div class=" block sm:flex ">
                            <Image v-if="!src" alt="user header" loading="lazy"  preview imageClass="shadow-md rounded-xl w-full md:w-40 md:h-40 h-64"  :src="`/storage/output/${props.data.system_favicon}`" />
                    
                            <Image v-if="src" :src="src" alt="Image" preview imageClass="shadow-md rounded-xl w-full md:w-40 md:h-40 h-64 "  />
                 
                            <FileUpload mode="basic" @input="form.system_favicon = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="md:mt-0 mt-4 p-button-outlined ml-2 sm:ml-8 md:ml-2" />
                       
                        </div>
                    </div>

                    
                </section>

                <div class="px-4">
                    <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-lg font-medium text-white mt-10  bg-blue-500 rounded-md px-5 py-3"><i class="pi pi-save"></i> Save Changes</button>                    
               
                </div>

                </form>

            </section>




         
        </main>

            <div>
                <!-- amo ini an kanan pop up notif pag nag submit msg -->
                <Toast />
            </div>   
    </AppLayout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import FileUpload from 'primevue/fileupload';
    import InputText from 'primevue/inputtext';
    import { ref } from "vue";
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import Divider from 'primevue/divider';
    import { computed, watch } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'
    import Card from 'primevue/card';
    import SystemForm from '@/Pages/Admin/Forms/SystemForm.vue';
import Image from 'primevue/image';


    const page = usePage()
    const toast = useToast()


    const props = defineProps({
        data: Object
    })


      
    const srcLogo = ref(null);
    const src = ref(null);

    function onFileSelectLogo(event) {
        const file = event.files[0];
        const reader = new FileReader();

        reader.onload = async (e) => {
            srcLogo.value = e.target.result;
        };

        reader.readAsDataURL(file);
    }

    function onFileSelect(event) {
        const file = event.files[0];
        const reader = new FileReader();

        reader.onload = async (e) => {
            src.value = e.target.result;
        };

        reader.readAsDataURL(file);
    }



    const form = useForm({
        system_name: props.data?.system_name ?? '',
        system_slogan: props.data?.system_slogan ?? '',
        system_logo:    null,
        
        system_favicon: null,
    })







const submitForm = () => {
 
    form.transform(data => ({
        ...data,
        _method: 'PUT',
    }));

    form.post(route('system.update',  props.data.id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Update Setting',
                detail: 'Setting Updated Successfully!', // Can hardcode or pull from props if needed
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








</script>