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
                    <div class="">
                        <!-- <li v-for="(item, index) in msgg" :key="index">{{ item }}</li> -->
                        <!-- <li v-for="(item, index) in data" :key="index">{{ item }}</li> -->
                        <!-- <li v-for="item in data" :key="item.id">{{ item.codex_name }}</li> -->
                        <!-- <li v-for="item in data" :key="item.id">
        <strong>{{ item.codex_name }}</strong> - 
        Language: {{ item.language }} | 
        Framework: {{ item.framework }}
      </li> -->
                    </div> 
                </section>
        </main>
        <article class="bg-blue-400 flex flex-row">
            <aside class="bg-green-300 basis-1/6">
                <h1 class="text-center text-xl font-bold  py-4">Category</h1>
                <nav class="pl-3 ">
                        <button @click="currentFilter = 'all'" class="block">All</button>
                        <!-- amo adi an button para han category -->
                        <div v-for="cat in category" :key="cat.id">
                            <button @click="currentFilter = cat.category_name" class="block">
                            {{ cat.category_name }}
                            </button>
                        </div>        
                </nav>

    

            </aside>
            <section class="bg-orange-300  flex flex-row  basis-5/6 flex-wrap justify-center gap-4">

                <!-- <Card class="!w-80 !h-80 " v-for="item in data" :key="item.id">
                    <template #title>
                        <header>
                            <h1>{{ item.codex_name }}</h1>
                        </header>
                    </template>
                    <template #content>
                        <p class="m-0">
                        learn how to use My Codex effectively to organize your knowledge
                        </p>
                        <nav class="flex gap-2 mt-4">
                            <button class="bg-blue-100 px-4 py-1 rounded-md">{{ item.language }}</button>
                            <button class="bg-blue-100 px-4 py-1 rounded-md">{{ item.framework }}</button>                            
                        </nav>
                        <p>Updated Oct 15, 2023</p>
                    </template>
                  
                </Card> -->


                <Card class="!w-80 !h-80 " v-for="item in filteredItems" :key="item.id">
                    <template #title>
                        <header>
                            <h1>{{ item.codex_name }}</h1>
                        </header>
                    </template>
                    <template #content>
                        <p class="m-0">
                        learn how to use My Codex effectively to organize your knowledge
                        </p>
                        <nav class="flex gap-2 mt-4">
                            <button class="bg-blue-100 px-4 py-1 rounded-md">{{ item.language }}</button>
                            <button class="bg-blue-100 px-4 py-1 rounded-md">{{ item.framework }}</button>                            
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
   import { ref, computed } from 'vue'
  
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';


    import Card from 'primevue/card';

 

    const { data, category } = defineProps({
        data: Array,
        category: Array
    })

    const currentFilter = ref('all')

  

    const filteredItems = computed(() => {
    if (currentFilter.value === 'all') return data
    return data.filter(item => item.category_name === currentFilter.value)
    })

</script>