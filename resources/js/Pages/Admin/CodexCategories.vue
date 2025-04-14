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


                            

                                <button type="button" @click="openModal(item.category_name)">
    <i class="pi pi-file-edit" style="font-size: 1rem"></i>
</button>

                                <!-- <button type="button"   @click="visible2 = true" ><i class="pi pi-file-edit" style="font-size: 1rem"></i></button> -->
                                <button class="mx-4"><i class="pi pi-trash" style="font-size: 1rem"></i></button>
                                
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
            <section>
    <Dialog v-model:visible="visible2" header="Update Category" :style="{ width: '25rem' }">
      <h1>This is the modal</h1>
      <p>Selected Category: {{ selectedCategory }}</p>
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

   




























    const selectedCategory = ref('')

    function openModal(categoryName) {
    selectedCategory.value = categoryName
    visible2.value = true
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

    const visible = ref(false);
    const visible2 = ref(false);

   // Amo ini an kanan for loop han item
    defineProps({
        data: Array
    });
</script>