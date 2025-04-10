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
                    <Card class="!w-80 !h-80 shadow-xl" >
                        <template #header>
                            <img alt="user header" src="https://primefaces.org/cdn/primevue/images/usercard.png" />
                           
                        </template>
                        <template #title>jaj</template>
                        <template #content>
                            <p class="m-0">
                                ajaj
                            </p>
                        </template>
                        <template #footer>
                            <nav class="flex gap-2 mt-4">
                                <button class="bg-blue-100 px-4 py-1 rounded-md">ha</button>
                                <button class="bg-blue-100 px-4 py-1 rounded-md">ha</button>                            
                            </nav>
                                <p>Updated Oct 15, 2023</p>
                            
                        </template>
                    </Card>
                    <Card class="!w-80 !h-80 shadow-xl"  v-for="item in data" :key="item.id">
                        <template #header>
                            <!-- <img alt="user header" src="https://primefaces.org/cdn/primevue/images/usercard.png" /> -->
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
                                <p class="bg-green-500 px-3 rounded-md">{{ item.status }}</p>                                
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

   


    import CategoryForm from '@/Pages/Admin/Forms/CategoryForms.vue';
    const visible = ref(false);

   // Amo ini an kanan for loop han item
    defineProps({
        data: Array
    });
</script>