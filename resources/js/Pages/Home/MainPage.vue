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
   
               
 

            <section class="bg-gray-200 w-full  pb-4  rounded-t-lg h-[450px] overflow-y-auto relative">

                <header class=" flex justify-between px-4 py-8 max-w-7xl m-auto">
                    <h1 class="text-lg font-bold">Recent Codex</h1>
                 
                </header>
                <!-- amo ini an kanan card -->
                <section class="flex flex-row  flex-wrap justify-center gap-4 w-full mt-4  max-w-7xl m-auto">
                    <Card   class="!w-64 !md:w-80 !h-80 !shadow-lg  " v-for="item in filteredItems.slice().reverse().slice(0, 4)" :key="item.id">
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
                                    <button type="button" @click="openCategoryInfoModal(item)" class="mr-4" v-tooltip.top="'Click To View'">
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
                            
                            <p class="text-gray-700 text-md mt-4 whitespace-pre-line"><span class="text-md text-gray-900 font-bold">Content:</span> {{ selectedCodex.content }}</p>
                            <p class="text-gray-700 text-md mt-4 whitespace-pre-line"><span class="text-md text-gray-900 font-bold">Instructions:</span> {{ selectedCodex.instructions }}</p>
                            
                            
                            <div class="my-4">
                                <label for="" class="text-md text-gray-900 font-bold ">Code: </label>
                                <MonacoEditor  :key="selectedCodex.id"  language="javascript" class="h-86"  v-model="selectedCodeSnippet"  />                                  
                            </div>

                            <p class="text-gray-700 text-md mt-4 mb-3 whitespace-pre-line"><span class="text-md text-gray-900 font-bold">Output:</span> {{ selectedCodex.output }}</p>

                            <Image  alt="user header" loading="lazy"  preview imageClass="shadow-md rounded-xl w-full md:h-40 h-64 "  :src="`/storage/output/${selectedCodex.img}`" />

                        </section>
                    </Dialog>
            </section>

            </section>
        </article>


        <!-- kanan carousel in an mga skill -->
        <section class="bg-gray-200 py-32  rounded-b-lg relative ">

                <div class="overflow-hidden    relative h-[150px] max-w-7xl m-auto">

                    <div class="absolute -left-8 top-0 h-full w-32  bg-gray-200 blur-md z-50"></div>
                        <!-- Right Blur -->
                <div class="absolute -right-8 top-0 h-full w-32 bg-gray-200 blur-md z-50"></div>
                    <div
                    class="flex w-max animate-carousel"
                    ref="carouselRef"
                    >
                
                    <div v-for="(item, index) in loopedData" :key="index" class="min-w-[200px] max-w-[200px] mx-2 h-32 mt-4   p-4">
                        <h3 class="font-bold text-lg text-gray-800">
                            <Image  alt="user header" loading="lazy"   imageClass="  w-20 h-20 "  :src="`/storage/output/${item.img}`" />
                        </h3>
                    </div>
                    </div>
                </div>                
        </section>    


  

    </MainLayout>

</template>


<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { ref, computed, watch, onMounted, onBeforeUnmount  } from 'vue'
  
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

    import Carousel from 'primevue/carousel';
import { data } from 'autoprefixer';









    const props = defineProps({
        data: Array,
        category: Array,
        skill: Array,
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

 




// onMounted(() => {
//     data.getProductsSmall().then((data) => (products.value = data.slice(0, 9)));
// })


// const products = computed(() => props.data);

// const responsiveOptions = ref([
//     {
//         breakpoint: '1400px',
//         numVisible: 2,
//         numScroll: 1
//     },
//     {
//         breakpoint: '1199px',
//         numVisible: 3,
//         numScroll: 1
//     },
//     {
//         breakpoint: '767px',
//         numVisible: 2,
//         numScroll: 1
//     },
//     {
//         breakpoint: '575px',
//         numVisible: 1,
//         numScroll: 1
//     }
// ]);


const cardWidth = 200 + 16 // card width + margin (adjust if needed)
const carouselRef = ref(null)
const currentIndex = ref(0)
let interval = null


onMounted(() => {
  console.log("Data received:", props.skill); // 🔍 see if array is filled
  interval = setInterval(() => {
    if (props.skill.length > 0) {
      currentIndex.value = (currentIndex.value + 1) % props.data.length;
    }
  }, 1);
});


onBeforeUnmount(() => {
  clearInterval(interval)
})

const loopedData = computed(() => [...props.skill, ...props.skill])


</script>


<style scoped>
@keyframes carousel {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

.animate-carousel {
  animation: carousel 50s linear infinite;
}
</style>