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
                        <p class="mt-4 text-xl font-bold md:mt-6">{{ setting.system_name }} personal Knowledge base for ideas, notes, and projects.</p>
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
        <article class=" flex flex-row ">
            <aside class="bg-gray-800 basis-1.5/6 md:basis-1/6 rounded-r-lg pb-4 h-screen overflow-y-auto overflow-x-hidden ">
                <h1 class="text-center  text-sm md:text-xl font-bold text-white py-4"> 
                    <i class="pi pi-tags mr-0 md:mr-4" style="font-size: 1.1rem"></i>
                    Categories
                </h1>
                <Divider/>
                <nav class=" text-white text-sm md:text-lg font-normal pl-2 md:pl-14 ">
                    <!-- "All" button -->
                    <button @click="currentFilter = 'all'" :class="[ 'block mb-4 border-b-2', currentFilter === 'all' ? 'border-b-white ' : 'border-b-gray-800 '  ]" >
                        All
                    </button>
                    <!-- Category buttons -->
                    <!-- <div v-for="cat in category" :key="cat.id">
                        <button  @click="currentFilter = cat.category_name" :class="[ 'block mb-1 border-b-2', currentFilter === cat.category_name ? 'border-b-white font-bold' : 'border-b-gray-800'  ]" >
                            {{ cat.category_name }}
                        </button>
                    </div> -->
<!--           
<Accordion value="1" v-for="cat in category" :key="cat.id">
    <AccordionPanel value="0" >
        <AccordionHeader :class="['!bg-gray-800 !p-0 !text-white !text-lg !font-normal ' , currentFilter === cat.category_name ? '!border-b-red-600 font-bold' : 'border-b-gray-800'] " @click="currentFilter = cat.category_name"> {{ cat.category_name }}</AccordionHeader>
        <AccordionContent class="!bg-red-700" v-for="item in filteredItems.slice().reverse()" :key="item.id" >
            <button class="m-0 !bg-red-600 !p-0" @click="currentFilter = item.codex_name" >
                {{ item.codex_name }} 
            </button>
        </AccordionContent>
    </AccordionPanel>
</Accordion> -->
          
<Accordion value="1" v-for="cat in category" :key="cat.id">
    <AccordionPanel value="0" >
        <AccordionHeader :class="['!bg-gray-800 !p-0 !text-white !text-lg !font-normal ' , currentFilter === cat.category_name ? '!border-b-red-600 font-bold' : 'border-b-gray-800'] " @click="currentFilter = cat.category_name"> {{ cat.category_name }}</AccordionHeader>
        <AccordionContent class="!bg-red-700" v-for="item in filteredItems.slice().reverse()" :key="item.id" >
            <button type="button" class="m-0 !bg-red-600 !p-0" >
                {{ item.codex_name }} 
            </button>
        </AccordionContent>
    </AccordionPanel>
</Accordion>
          




                </nav>

    

            </aside>
               
            <section class="bg-gray-200 basis-5/6 md:basis-5/6  pb-4 rounded-lg h-screen overflow-y-auto">
                
                <header class=" flex justify-between px-4 pt-2">
                    <h1 class="text-lg font-bold">Recent Notes</h1>
                 
                </header>
                <!-- amo ini an kanan card -->
                <section class="flex flex-row  flex-wrap justify-center gap-4 w-full mt-4">
                    <Card   class="!w-64 !md:w-80 !h-80 !shadow-lg  " v-for="item in filteredItems.slice().reverse()" :key="item.id">
                        <template #title>
                            <header class="">
                                <h1 class="truncate text-lg font-bold">{{ item.codex_name }}</h1>
                            </header>
                        </template>
                        <template #content>
                            <section class="">
                                <label for=""></label>
                                <p class="m-0 text-gray-500 text-md h-20 w-full overflow-hidden text-ellipsis ">
                                   <span class="font-medium"> Content: </span>
                                {{ item.content }}
                                </p>
                            
                                <nav class=" gap-2 mt-4">
                                    <label for="" class="font-medium">Language:</label>
                                    <p class="truncate h-8 text-gray-400 font-bold">{{ item.language.join(', ') }}</p>

                                    <label class="font-medium" for="">framework: </label>
                                    <p class="  truncate h-8 text-gray-400 font-bold">{{ item.framework.join(', ') }}</p>                            
                                </nav>
                                <div class="flex justify-between mt-4">
                                    <p class=" text-sm text-gray-500">Date: {{ new Date(item.created_at).toISOString().split('T')[0] }}  </p>
                                       <!-- Eye BUTTON -->
                                    <button type="button" @click="openCategoryInfoModal(item)" class="mr-4">
                                        <i class="pi pi-eye" style="font-size: 1rem"></i>
                                    </button>
                                </div>
                               
                               

                            </section>

                        </template>
                    
                    </Card>
                </section>
          


            <section>
                    <Dialog  v-model:visible="categoryInfoDisp" maximizable   :header="`Codex: '${selectedCodex?.codex_name ?? ''}'`" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"  >
                        <section class="pt-1">
                         
                            <p class="text-gray-500 font-bold text-md"> <span class="text-md text-gray-900 font-bold">Category:</span>  {{ selectedCodex.category_name }}</p>
                            <p class="text-gray-500 font-bold text-md"> <span class="text-md text-gray-900 font-bold">Language:</span>  {{ selectedCodex.language.join(', ') }}</p>
                            <p class="text-gray-500 font-bold text-md"> <span class="text-md text-gray-900 font-bold">Framework:</span>  {{ selectedCodex.framework.join(', ') }}</p>
                            <p class="text-gray-500 font-bold text-md"> <span class="text-md text-gray-900 font-bold">Tags:</span>  {{ selectedCodex.tags }}</p>
                            <p class="text-gray-500 font-bold text-md"> <span class="text-md text-gray-900 font-bold">Level:</span>  {{ selectedCodex.diffuclt_level }}</p>
                            
                            <p class="text-gray-700 text-md mt-4"><span class="text-md text-gray-900 font-bold">Content:</span> {{ selectedCodex.content }}</p>
                            <p class="text-gray-700 text-md mt-4"><span class="text-md text-gray-900 font-bold">Instructions:</span> {{ selectedCodex.instructions }}</p>
                            
                            
                            <div class="my-4">
                                <label for="" class="text-md text-gray-900 font-bold ">Code: </label>
                                <MonacoEditor  :key="selectedCodex.id"  language="javascript" class="h-86"  v-model="selectedCodeSnippet"  />                                  
                            </div>

                            <p class="text-gray-700 text-md mt-4 mb-3"><span class="text-md text-gray-900 font-bold">Output:</span> {{ selectedCodex.output }}</p>

                            <Image  alt="user header" loading="lazy"  preview imageClass="shadow-md rounded-xl w-full md:h-40 h-64 "  :src="`/storage/output/${selectedCodex.img}`" />

                        </section>
                    </Dialog>
            </section>

            </section>
        </article>


    

    </MainLayout>

</template>


<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { ref, computed, watch } from 'vue'
  
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    import Divider from 'primevue/divider';

    import Card from 'primevue/card';

    import Dialog from 'primevue/dialog';
    import Image from 'primevue/image';
    //amo ini an knan monaco editor
    import MonacoEditor from '@/Pages/Admin/MonacoEditor/MonacoEditor.vue';
 


    import Accordion from 'primevue/accordion';
    import AccordionPanel from 'primevue/accordionpanel';
    import AccordionHeader from 'primevue/accordionheader';
    import AccordionContent from 'primevue/accordioncontent';









    const props = defineProps({
        data: Array,
        category: Array,
        setting: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
 


    // ini na code is para han button categories ha main page na ma display an codex based ha category na gin click
    const currentFilter = ref('all')

    // const currentCodex = ref('')

    const filteredItems = computed(() => {
        if (currentFilter.value === 'all') return props.data
        return props.data.filter(item => item.category_name === currentFilter.value)
    })

    // const filteredCodex = computed(() => {
    //     if (currentCodex.value === '') return props.data
    //     return props.data.filter(item => item.codex_name === currentCodex.value)
    // })


 
 











    // ini liwat is para han codex modal pag gin click an eye icon ha card ma display an mga info han card ha 
    const selectedCodex = ref({});  
    const categoryInfoDisp = ref(false);
    const selectedCodeSnippet = ref(''); // actual code string

    watch(selectedCodex, (newCodex) => {
        // ini liwat is an kanan code editor ini para mag display an iya value kay na display hiya pag gin click mo pero pag nag click kan iba
        // na codex  an value amo la gihap diri na bali in
    selectedCodeSnippet.value = newCodex.code_snippet || '';
    });

    function openCategoryInfoModal(category) {
        selectedCodex.value = category;
        selectedCodeSnippet.value = category.code_snippet || '';
        categoryInfoDisp.value = true;
    }

 




</script>