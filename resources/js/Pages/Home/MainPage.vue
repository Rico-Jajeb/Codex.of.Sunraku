<template>
    <MainLayout
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion"  >
      
        <main class="relative  p-3 rounded-xl h-[97vh] m-3 pt-20 overflow-hidden ">
            <!-- Background Image -->
            <img alt="System Background" loading="lazy" :src="`/storage/output/${setting.system_favicon}`" class="absolute inset-0 w-full h-full object-cover -z-10" />
                <section class=" max-w-7xl m-auto">
                    <header class="text-center pt-10 pb-4">
                        <h1 class="text-5xl font-extrabold mt-0 md:mt-40">{{ setting.system_slogan }}</h1>
                        <p class="mt-4 text-xl font-bold md:mt-6">SunRaku's personal Knowledge base for ideas, notes, and projects.</p>
                    </header>
                    <div class=" ">
                        <IconField class="mx-auto md:!w-[640px] !w-80"  >
                            <InputIcon class="pi pi-search" />
                            <InputText v-model="value1" placeholder="Search codex by title, content, or tags..." class="!w-full" />
                        </IconField>
                    </div>       
                    <div class="">
                     
                    </div> 
                </section>
        </main>
        <article class=" flex flex-row">
            <aside class="bg-gray-800 basis-1/6 rounded-r-lg">
                <h1 class="text-center text-xl font-bold text-white py-4"> 
                    <i class="pi pi-tags mr-4" style="font-size: 1.1rem"></i>
                    Categories
                </h1>
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
               
            <section class="bg-gray-200 basis-5/6  pb-4 rounded-lg">
                
                <header class=" flex justify-between px-4 pt-2">
                    <h1 class="text-lg font-bold">Recent Notes</h1>
                 
                </header>
                <!-- amo ini an kanan card -->
                <section class="flex flex-row  flex-wrap justify-center gap-4 w-full mt-4">
                    <Card class="!w-80 !h-80 !shadow-lg  " v-for="item in filteredItems.slice().reverse()" :key="item.id">
                        <template #title>
                            <header class="">
                                <h1 class="truncate text-lg font-bold">{{ item.codex_name }}</h1>
                            </header>
                        </template>
                        <template #content>
                            <section class="">
                                <p class="m-0 text-gray-500 text-md h-20 w-full overflow-hidden text-ellipsis ">
                                {{ item.content }}
                                </p>
                            
                                <nav class=" gap-2 mt-4">
                                    <label for="" class="font-medium">Language:</label>
                                    <p class="truncate h-8 text-gray-400 font-bold">{{ item.language.join(', ') }}</p>

                                    <label class="font-medium" for="">framework: </label>
                                    <p class="  truncate h-8 text-gray-400 font-bold">{{ item.framework.join(', ') }}</p>                            
                                </nav>
                                <p class="mt-4 text-sm text-gray-500">Date: {{ new Date(item.created_at).toISOString().split('T')[0] }}</p>

                            </section>

                        </template>
                    
                    </Card>
                </section>
          

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

 

  const props = defineProps({
    data: Array,
    category: Array,
    setting: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
 


    // const props = defineProps({
    //     data: Array,
    //     category: Array,
    //     setting: Object,
    // })

    const currentFilter = ref('all')

  

    // const filteredItems = computed(() => {
    // if (currentFilter.value === 'all') return data
    // return data.filter(item => item.category_name === currentFilter.value)
    // })
    const filteredItems = computed(() => {
    if (currentFilter.value === 'all') return props.data
    return props.data.filter(item => item.category_name === currentFilter.value)
})









</script>