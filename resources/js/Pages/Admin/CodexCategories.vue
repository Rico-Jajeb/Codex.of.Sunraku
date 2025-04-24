<template>
    <AppLayout title="Codex">
        <template #header>
            <section class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Codex Category
                </h2>
                <button  @click="visible = true"  class="bg-blue-600  pl-4 pr-4 py-2 rounded-md text-md font-bold text-white" type="submit"> <i class="pi pi-plus mr-2"></i> Add Category</button>                
            </section>

        </template>
        <main class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class=" overflow-hidden  sm:rounded-lg py-10 px-8">
                    <div class="">
                        <IconField class="mx-auto md:!w-full !w-80"  >
                            <InputIcon class="pi pi-search" />
                            <InputText v-model="value1" placeholder="Search codex categories..." class="!w-full" />
                        </IconField>
                    </div>  
                <section class="flex flex-row  basis-5/6 flex-wrap justify-center gap-4 mt-4">
                    <!-- Amo ini an card  -->
                    <!-- <Card class="!w-80 !h-80 shadow-xl"  v-for="item in data" :key="item.id"> -->
                    <Card class="!w-80 !h-80 shadow-xl"  v-for="item in data" :key="item.id">
                        <template #header>
                            <img alt="user header" class="h-36 w-full object-cover rounded-t-lg"  :src="`/storage/output/${item.img}`" />
                        </template>
                        <template  #title>
                            <div class="truncate">
                                {{ item.category_name }}                                
                            </div>

                        </template>
                        <template #content>
                            <div class="  h-20 overflow-hidden">
                                <p class="text-md text-gray-600 font-medium">
                                    {{ item.description }}
                                </p>                                
                            </div>

                        </template>
                        <template #footer>
                            <div class="flex justify-end">

                                <!-- Eye BUTTON -->
                                <button type="button" @click="openCategoryInfoModal(item)" class="mr-4">
                                    <i class="pi pi-eye" style="font-size: 1rem"></i>
                                </button>
                                <!-- UPDATE BUTTON -->
                                <button type="button" @click="openModal(item)">
                                    <i class="pi pi-file-edit" style="font-size: 1rem"></i>
                                </button>
                                <!-- DELETE BUTTON -->
                                <button type="button" @click="deleteModal(item)" class="mx-4">
                                    <i class="pi pi-trash" style="font-size: 1rem"></i>
                                </button>   
                                <!-- Amo ini an kann category status -->
                                <div class="">
                                      <Badge v-if="item.status === 'Active'" value="" severity="success"></Badge>
                                      <Badge v-else="item.status === 'Oflline'" value="" severity="danger"></Badge>
                                </div>                       
                            </div>
                        </template>

                       
                    </Card>
                </section>     
            </section>
        </main>


        <!-- amo ini an kanan modal han category form -->
        <section>
            <div class="card flex justify-center bg-red-500">
                <Button label="Show" @click="visible = true" />
                <Dialog v-model:visible="visible" header="Add Category" :style="{ width: '25rem' }"  >
                    <CategoryForm/>
                </Dialog>
            </div>
        </section>





        <!-- Adi an modal han update category form -->
        <!-- <section>
            <div class="card flex justify-center bg-red-500">
                <Button label="Show" @click="visible2 = true" />
                <Dialog v-model:visible="visible2" header="Update Category" :style="{ width: '25rem' }"  >
                    <UpdateCategoryForm/>
                </Dialog>
            </div>
        </section> -->

            <!-- adi an knn modal -->
            <!-- <section>
                <Dialog v-model:visible="visible2" :header="`Update '${selectedCategory}' Category`" :style="{ width: '25rem' }"> -->
                    <section>    
                <Dialog v-model:visible="visible2"
  :header="`Update '${selectedCategory.category_name}' Category`"
  :style="{ width: '25rem' }">
  
                        <form @submit.prevent="form.put(route('categories.update', selectedCategory.id))" enctype="multipart/form-data">
                   
              

               <!-- <form  class=""  @submit.prevent="form.put('/categories/{id}')" > -->
                <!-- <form @submit.prevent="form.put(`/categories/${form.id}`)"> -->


                            <div class="">
                                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Category name</label>
                                    <InputText class="!w-full" type="text" v-model="form.category_name" name="category_name" placeholder="Insert Category Name, e.g (laravel, django, codeigniter..)" />
                                    <div v-if="form.errors.category_name" class="text-red-500 text-sm mt-2">
                                        {{ form.errors.category_name }}
                                    </div> 
                            </div>
                            <div class="mt-4">
                                    <label for="Web Name" class="block mb-2 text-lg font-medium text-gray-500 dark:text-white">Description</label>
                                    <InputText class="!w-full" type="text" v-model="form.description" name="description" placeholder="A brief explanation of the category" />
                                    <div v-if="form.errors.description" class="text-red-500 text-sm mt-2">
                                        {{ form.errors.description }}
                                    </div> 
                            </div>
                                
                            <label for="Web Name" class="block mt-4 text-sm font-bold text-gray-700 dark:text-white">Upload Category Image Cover</label>
                            <div class="card flex flex-col items-center gap-6 mt-4">                
                                    
                                <img  :src="`/storage/output/${selectedCategory.img}`" alt="Image" class="shadow-md object-cover rounded-xl w-full  max-h-44 " style="filter: grayscale(0%)" />


                                    <img v-if="src" :src="src" alt="Image" class="shadow-md rounded-xl w-full sm:w-64" style="filter: grayscale(0%)" />
                                    <!-- <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
                             -->
                             <!-- <FileUpload name="img" accept="image/*" customUpload @select="onFileSelect" /> -->
                            
                             <!-- <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto severity="secondary" class="p-button-outlined" />
             -->
                            

             <input type="file" @change="e => form.img = e.target.files[0]" />

             <!-- yawa makuri ampotik  -->
                    <!-- day 4 na ada ini puttik man -->
                    <!-- another day shitt hahah -->
                     <!-- hahah lets try commit 3 -->
                      <!-- i am endded an idiot haha -->
                      <!-- i am doing another shit -->
                      <!-- fuck you -->
                            
                            </div>
                            <nav class="">
                                    <!-- <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-save mr-1"></i> Save </button>                    
                             -->
                             <button @click="submitForm">Update Category</button>

                           
                             <!-- <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-save mr-1"></i> Save </button>                    
            -->

                             </nav>
                    </form>

                </Dialog>
            </section>


            <section>
                <Dialog v-model:visible="visible3" :header="`Delete '${selectedCategory.category_name}' Category`" :style="{ width: '25rem' }">
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

            <!-- Category display info -->
            <section>
                <Dialog v-model:visible="categoryInfoDisp" :header="`Codex Category: '${selectedCategory.category_name}'`" :style="{ width: '90vw' }">
                    <nav class="flex justify-center gap-6">
                   <h1>This is the category info</h1>
                    </nav>

                </Dialog>
            </section>

    </AppLayout>
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';

    import 'primeicons/primeicons.css'
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    
    import Card from 'primevue/card';


    import Dialog from 'primevue/dialog';

    import { ref } from 'vue';
    import { router } from '@inertiajs/vue3'

   


    import InputText from 'primevue/inputtext'
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form
    import FileUpload from 'primevue/fileupload';


//     const form = useForm({
//         //amo liwat ini an code para han system form
//         CategoryName: null,
//         CategoryDesc: null,
//         img: null,
   
//     })


//    //adi an knn img upload

//     const src = ref(null);

//     function onFileSelect(event) {
//         const file = event.files[0];
//         const reader = new FileReader();

//         reader.onload = async (e) => {
//             src.value = e.target.result;
//         };

//         reader.readAsDataURL(file);
//     }



//----------------------------------- original  -------------------------

// const form = useForm({
//     category_name: null,
//     description: null,
//     img: null,
// });

// const src = ref(null);

// function onFileSelect(event) {
//     const file = event.files[0];
//     if (!file) return;

//     form.img = file;

//     const reader = new FileReader();
//     reader.onload = (e) => {
//         src.value = e.target.result;
//     };
//     reader.readAsDataURL(file);
// }


    // function submitForm() {
    //     form.submit('put', `/codex/category/${category.id}`, {
    //     forceFormData: true
    // });

    // }


//     function submitForm() {
//     form.submit('put', route('categories.update', selectedCategory.id), {
//         forceFormData: true,
//     });
// }



//--------------------------------------------- Test area -----------------------------------------------------






const form = useForm({
  category_name: null,
  description: null,
  img: null,
  _method: 'PUT',
});


const src = ref(null);






function onFileSelect(event) {
  const file = event.target.files[0];
  if (file) {
    form.img = file;
  }
}




function submitForm() {
  form.post(`/codex/category/${category.id}`, {
    forceFormData: true,
  });
}











//--------------------------------------------- END  Test area -----------------------------------------------------




    //adi an knn img upload
    // const src = ref(null);

    // function onFileSelect(event) {
    //     const file = event.files[0];
    //     const reader = new FileReader();

    //     reader.onload = async (e) => {
    //         src.value = e.target.result;
    //     };

    //     reader.readAsDataURL(file);
    // }



    // const form = useForm({
    //     //amo liwat ini an code para han system form
    //     CategoryName: null,
    //     CategoryDesc: null,
    //     img: null,
   
    // })































    // amo adi an code para han pag select edit category 
    // const selectedCategory = ref('')

    // function openModal(categoryName) {
    //     selectedCategory.value = categoryName
    //     visible2.value = true
    // }





    const selectedCategory = ref({}); // ← whole object now

    function openModal(category) {
    selectedCategory.value = category;
    form.category_name = category.category_name;
    form.description = category.description; // or whatever the property is
    form.img = null; // reset image, or preload if needed

    visible2.value = true;
    }


    function openCategoryInfoModal(category) {
    selectedCategory.value = category;
    form.category_name = category.category_name;
    form.description = category.description; // or whatever the property is
    form.img = null; // reset image, or preload if needed

    categoryInfoDisp.value = true;
    }




  








































//kanan category update
// const selectedCategory = ref(null)

// function openEditModal(item) {
//   selectedCategory.value = {
//     id: item.id,
//     CategoryName: item.category_name,
//     CategoryDesc: item.description,
//     CategoryImageUrl: `/storage/output/${item.img}`
//   }
//   visible2.value = true
// }











    import Badge from 'primevue/badge';


    // amo ini an kanan update category Form
    import UpdateCategoryForm from '@/Pages/Admin/Forms/Update/CategoryUpdateForms.vue';


    // amo ini an kann category form
    import CategoryForm from '@/Pages/Admin/Forms/CategoryForms.vue';

    // amo ini an mga knn modal
    const visible = ref(false);
    const visible2 = ref(false);
    const visible3 = ref(false);
    const categoryInfoDisp = ref(false);




    const deletePost = (id) => {
        //amo ini an kanna delete
        // bali amo ini an nkadto han button knan delete
    router.delete(`/posts/${id}`, {
      onSuccess: () => {
      }
    })
        // tapos ini liwat an code para pag na delete na matik ma close an modal
        visible3.value = false
    }


    const item = ref({ id: null })

    function deleteModal(category) {
    selectedCategory.value = category
    item.value.id = category.id
    visible3.value = true
    }

    function closeDelete(){
        visible3.value = false
    }

   // Amo ini an kanan for loop han item
    defineProps({
        data: Array
    });
</script>