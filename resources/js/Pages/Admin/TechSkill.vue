<template>
      <AppLayout title="Tech Skills">
        <template #header>
            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tech Skills
            </h2> -->
        
            <section class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tech Skills
                </h2>
                <div class="">
                    <button type="button" @click="TechModal()" class="md:mr-8 mr-0"  v-tooltip.top="'Add New Skill'"><i class="pi pi-plus" ></i></button> 
                                       

                        
                </div>

            </section>
        </template>

        <main class="pt-10">
            <section class="max-w-7xl  mx-auto  sm:px-6 lg:px-8 pb-8 bg-white overflow-hidden shadow-xl rounded-lg">
                
                <nav class=" mt-8 mb-4 flex justify-center ">
                    <div class=""></div>
                    <header>
                        <h1 class="text-lg font-medium">List of Skills</h1>
                    </header>
                                      
                </nav>

               
              
                <DataTable v-model:selection="TechSkill" dataKey="id" :value="data"  ref="dt" scrollable scrollHeight="600px"  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" removableSort tableStyle="min-width: 50rem">  
                    <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                    <Column field="tech_name" header="Skill" sortable />
                    <Column field="img" header="Image" sortable>
                        <template #body="{ data }">
                        <Image 
                            alt="user header"
                            loading="lazy"
                            
                            :src="`/storage/output/${data.img}`"
                        preview  imageClass="h-16 object-cover rounded-md"  />
                        </template>
                    </Column>
                    <Column class="!text-end" header="Actions">
                        <template #body="{ data }">
                            <nav class="flex gap-1">
                                <button type="button" @click="openModal(data)" class=" py-2 px-4" v-tooltip.top="'Click to Edit'"><i class="pi pi-pencil" ></i></button>     
                                <button type="button" @click="deleteModal(data)" class="mx-4" v-tooltip.top="'Click to Delete'">
                                    <i class="pi pi-trash" style="font-size: 1rem"></i>
                                </button>                                  
                            </nav>
                        </template>
                    </Column>
                </DataTable>
            </section>


           

           <Dialog 
                v-model:visible="categoryInfoDisp"
                maximizable
                :header="` Skill:'${selectedCategory?.tech_name ?? ''}'`"
                >
                    <form @submit.prevent="submitForm" enctype="multipart/form-data">
                        <div class="">
                                <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Update Skill</label>
                                <InputText class="!w-full" type="text" v-model="form.tech_name" name="category_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                <div v-if="form.errors.tech_name" class="text-red-500 text-sm mt-2">
                                    {{ form.errors.tech_name }}
                                </div> 
                        </div>
                        <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Skill Logo</label>
                        <div class="card flex flex-col items-center gap-6 mt-4">                
                            <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                            <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                        </div>
                        <nav class="">   
                            <button type="submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3">Update Skill</button>
                        </nav>
                    </form>
                        
           </Dialog>
       
           <!-- amo ini an kanan skill form -->
           <Dialog  v-model:visible="sc"  maximizable :header="`Skill `" :style="{ width: '300px' }" >
                <TechSkillForm/>
           </Dialog>



            <!--DELETE amo ini an delete modal kanan category -->
            <section>
                <Dialog v-model:visible="visible3" :header="`Delete '${selectedCategory.tech_name}' Category`" :style="{ width: '25rem' }">
                    <nav class="flex justify-center gap-6">
                        <button @click="deletePost(item.id)" class=" bg-red-600 text-white px-3 py-1 rounded">
                            <i class="pi pi-trash mr-2"></i> Delete
                        </button>
                        <button @click="closeDelete()" class=" bg-green-600 text-white px-3 py-1 rounded">
                            <i class="pi pi-times mr-2"></i> Cancel
                        </button>                        
                    </nav>

                </Dialog>
            </section>



            <div>
                <!-- amo ini an kanan pop up notif pag nag submit msg -->
                <Toast />
            </div>
        </main>
    </AppLayout>
   
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    
    import TechSkillForm from './Forms/TechSkillForm.vue';
   

    import { computed, ref, watchEffect , watch, onMounted     } from 'vue';
    import 'primeicons/primeicons.css'
    import IconField from 'primevue/iconfield';
    import Image from 'primevue/image';

    import Badge from 'primevue/badge';
    // amo ini an kanan table
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import ColumnGroup from 'primevue/columngroup';   // optional
    import Row from 'primevue/row';                   // optional
   import { router } from '@inertiajs/vue3'
    import RadioButton from 'primevue/radiobutton';

    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'
  import InputText from 'primevue/inputtext'
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import FileUpload from 'primevue/fileupload';

    import Dialog from 'primevue/dialog';
     import Card from 'primevue/card';
    const prop = defineProps({
        data: Array,
    });

    const page = usePage()
    const toast = useToast()

    const src = ref(null);

   function onFileSelect(event) {
        const file = event.files[0];
        const reader = new FileReader();

        reader.onload = async (e) => {
            src.value = e.target.result;
        };

        reader.readAsDataURL(file);
    }



    const categoryInfoDisp = ref(false);
    const selectedCategory = ref(false);

    const form = useForm({
        //amo liwat ini an code para han system form
        tech_name: null,
        img: null,
    })

    function openModal(data) {
         selectedCategory.value = data;
         form.tech_name = data.tech_name;
         form.img = null; // reset image, or preload if needed
        categoryInfoDisp.value = true;
    }


    const sc = ref(false);

    function TechModal(){
        sc.value = true;
    }
  





const submitForm = () => {
 
    form.transform(data => ({
        ...data,
        _method: 'PUT',
    }));

    form.post(route('skill.update', selectedCategory.value.id), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Update message',
                detail: 'Category Updated Successfully!', // Can hardcode or pull from props if needed
                life: 10000,
            });
            src.value = null;
            form.reset();
            categoryInfoDisp.value = false;
        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};


//----------------------- delete -------------------------

 const visible3 = ref(false);
const item = ref({ id: null })
    function deleteModal(data) {
        selectedCategory.value = data
        item.value.id = data.id
        visible3.value = true
    }

 function closeDelete(){
        visible3.value = false
    }


     const deletePost = (id) => {
        //amo ini an kanna delete
        // bali amo ini an nkadto han button knan delete
        router.delete(`/skill/${id}`, {
        onSuccess: () => {
              toast.add({
                severity: 'success',
                summary: 'Delete message',
                detail: 'Deleted Successfully!', // Can hardcode or pull from props if needed
                life: 10000,
            });

        }
        })
        // tapos ini liwat an code para pag na delete na matik ma close an modal
        visible3.value = false
    }

</script>