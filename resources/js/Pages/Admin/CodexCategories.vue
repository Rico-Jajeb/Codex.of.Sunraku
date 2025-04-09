<template>
    <AppLayout title="Codex">
        <template #header>
            <section class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Codex Category
                </h2>
                <button class="bg-blue-600  pl-4 pr-4 py-2 rounded-md text-md font-bold text-white" type="submit"> <i class="pi pi-plus mr-2"></i> Add Category</button>                
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
                <main class="flex flex-row  basis-5/6 flex-wrap justify-center gap-4 mt-4">
                    <Card class="!w-80 !h-80 shadow-xl">
                    <template #title>
                        <header>
                            <h1>hahah</h1>
                        </header>
                    </template>
                    <template #content>
                        <p class="m-0">
                        learn how to use My Codex effectively to organize your knowledge
                        </p>
                        <nav class="flex gap-2 mt-4">
                            <button class="bg-blue-100 px-4 py-1 rounded-md">ha</button>
                            <button class="bg-blue-100 px-4 py-1 rounded-md">ha</button>                            
                        </nav>
                        <p>Updated Oct 15, 2023</p>
                    </template>
                  
                </Card>
                </main>                  
            </section>
        </main>
 
    </AppLayout>
</template>
<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';

    import 'primeicons/primeicons.css'
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    
    import Card from 'primevue/card';
</script>