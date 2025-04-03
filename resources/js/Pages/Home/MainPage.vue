<template>
    <MainLayout>
        <main class="bg-red-300 p-3 rounded-xl h-[97vh] m-3  pt-20  ">
                <section class="bg-yellow-300 max-w-7xl m-auto">
                    <header class="text-center pt-10 pb-4">
                        <h1 class="text-5xl font-extrabold mt-0 md:mt-40">Build Your Codex, Unlock Your Potential.</h1>
                        <p class="mt-4 text-xl font-bold md:mt-6">SunRaku's personal Knowledge base for ideas, notes, and information.</p>
                    </header>
                    <div class=" bg-green-400">
                        <IconField class="mx-auto md:!w-[640px] !w-80"  >
                            <InputIcon class="pi pi-search" />
                            <InputText v-model="value1" placeholder="Search codex by title, content, or tags..." class="!w-full" />
                        </IconField>
                    </div>           
                </section>
        </main>
        <article class="bg-blue-400 flex flex-row">
            <aside class="bg-green-300 basis-1/6">a</aside>
            <section class="bg-orange-300 basis-5/6">
                <Card class="!w-80 !h-80">
                    <template #title>
                        <header>
                            <h1>Getting Started with my Codex</h1>
                        </header>
                    </template>
                    <template #content>
                        <p class="m-0">
                        learn how to use My Codex effectively to organize your knowledge
                        </p>
                        <nav class="flex gap-2 mt-4">
                            <button class="bg-blue-100 px-4 py-1 rounded-md">Laravel</button>
                            <button class="bg-blue-100 px-4 py-1 rounded-md">Laravel</button>                            
                        </nav>
                        <p>Updated Oct 15, 2023</p>
                    </template>
                  
                </Card>
            </section>
        </article>
    </MainLayout>

</template>


<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { ref } from 'vue';
  
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';


    import Card from 'primevue/card';

    const value1 = ref(null);

</script>