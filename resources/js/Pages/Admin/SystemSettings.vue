<template>
    <AppLayout title="System Settings">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                System Settings
            </h2>
        </template>


        <main>hello world
            <section class="w-96 bg-blue-300">
                <SystemForm/>
            </section>
            <section>
                <section class="flex flex-row  basis-5/6 flex-wrap justify-center gap-4 mt-4">
                    <!-- Amo ini an card  -->
                    <Card class="!w-80 !h-80 shadow-xl"  v-for="item in data" :key="item.id">
                        <template #header>
                            <img alt="user header" class="h-36 w-full object-cover rounded-t-lg"  :src="`/storage/output/${item.img}`" />
                        </template>
                        <template  #title>
                            <div class="truncate">
                                {{ item.system_name }}                                
                            </div>

                        </template>
                        <template #content>
                            <div class="  h-20 overflow-hidden">
                                <p class="text-md text-gray-600 font-medium">
                                  
                                </p>                                
                            </div>

                        </template>
                        <template #footer>
                            <div class="flex justify-end">

                                                  <!-- UPDATE BUTTON -->
                                <button type="button" @click="openModal(item)">
                                    <i class="pi pi-file-edit" style="font-size: 1rem"></i>
                                </button> 
                            </div>
                        </template>

                       
                    </Card>
                </section> 
            </section>






            <section>
                           <!--UPDATE adi an knn category  modal -->
            <section>    
                <Dialog v-model:visible="visible2" maximizable
                        :header="`Update '${selectedCategory.system_name}' Category`"
                        :style="{ width: '25rem' }" >
  
                 
                        <form @submit.prevent="submitForm" enctype="multipart/form-data">

                            <div class="">
                                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">UPDATE Category name</label>
                                    <InputText class="!w-full" type="text" v-model="form2.system_name" name="category_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                    <div v-if="form2.errors.system_name" class="text-red-500 text-sm mt-2">
                                        {{ form2.errors.system_name }}
                                    </div> 
                            </div>
          
                                
                            <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Category Image Cover</label>
                            <div class="card flex flex-col items-center gap-6 mt-4">                
                                    
                                <img  :src="`/storage/output/${selectedCategory.img}`" alt="Image" class="shadow-md object-cover rounded-xl w-full  max-h-44 " style="filter: grayscale(0%)" />

                                <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />

                                <!-- <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto /> -->

                                <FileUpload mode="basic" @input="form2.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                  
  


                            </div>
                            <nav class="">   
                                <button type="submit">Update Category</button>

                          
          
                            </nav>
                    </form>

                </Dialog>
            </section>

            </section>
        </main>
            
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

    import Dialog from 'primevue/dialog';

    const props = defineProps({
        data: Array,
    });



    const selectedCategory = ref({}); // ← whole object now  
    const src = ref(null);

    const visible2 = ref(false);


    function openModal(category) {
    selectedCategory.value = category;
    form2.system_name = category.system_name;
    form2.img = null; // reset image, or preload if needed

    visible2.value = true;
    }

    function onFileSelect(event) {
    const file = event.files[0];
    const reader = new FileReader();

    reader.onload = async (e) => {
        src.value = e.target.result;
    };

    reader.readAsDataURL(file);
}



   




    const form2 = useForm({
        //amo liwat ini an code para han system form
        system_name: null,
        img: null,

    })


// const submitForm = () => {
//     const formData = new FormData();

//     // Check if data exists and log it
//     console.log("system Name:", form.system_name);
//     console.log("Image:", form.img);

//     // Always append fields, even if they're empty
//     formData.append('system_name', form.system_name || '');
    
//     // Only append image if it exists
//     if (form.img) {
//         formData.append('img', form.img);
//     }

//     // Log FormData before sending
//     console.log('FormData before sending:', formData);

//     form.put(route('system.update', selectedCategory.value.id), {
//         preserveScroll: true,
//         forceFormData: true, // Ensures the data is sent as FormData
//         onSuccess: () => {
//             console.log("Form submitted successfully.");
//         },
//         onError: (errors) => {
//             console.error("Form submission failed.", errors);
//         }
//     });
// };



const submitForm = () => {
    // Log current input values for debugging
    console.log("system Name:", form2.system_name);
    console.log("Image:", form2.img);

    // Spoof the PUT method by transforming the form data
    form2.transform(data => ({
        ...data,
        _method: 'PUT',
    }));

    form2.post(route('system.update', selectedCategory.value.id), {
        preserveScroll: true,
        forceFormData: true, // Required for sending FormData including files
        onSuccess: () => {
            console.log("Form submitted successfully.");
            // Reset modal and form
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