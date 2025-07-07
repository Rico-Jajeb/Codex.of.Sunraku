<template >
    <MainLayout
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion"  title="Main Page" >
      
        <main class="relative  p-3 rounded-xl h-[60vh] md:h-[97vh] m-3 pt-20 overflow-hidden ">
            <!-- Background Image -->
            <img alt="System Background" loading="lazy" :src="`/storage/output/${setting.system_favicon}`" class="absolute inset-0 w-full h-full object-cover -z-10" />
                <section class=" max-w-7xl m-auto flex justify-center items-center">
                    <header class="text-center pt-10 pb-4">
                        <h1 class="text-4xl md:text-7xl font-extrabold mt-0 md:mt-40 cursor-pointer" style="-webkit-text-stroke: 0.5px black;">
                            <span
                            v-for="(char, index) in setting.system_slogan.split('')"
                            :key="index"
                            class="hover:text-white transition-colors duration-300"
                            >
                            {{ char }}
                            </span>
                        </h1>
            
                        <p class="mt-4 text-xl md:text-2xl font-bold md:mt-6 cursor-pointer" style="-webkit-text-stroke: 0.5px black;" >
                                <span
                                v-for="(char, index) in (setting.system_name + ' personal Knowledge base for ideas, notes, and projects.').split('')"
                                :key="index"
                                class="hover:text-white transition-colors duration-300">
                                {{ char }}
                                </span>
                        </p>

                    </header>
                    <!-- <div class=" ">
                        <IconField class="mx-auto md:!w-[640px] !w-80"  >
                            <InputIcon class="pi pi-search" />
                            <InputText v-model="value1" placeholder="Search codex by title, content, or tags..." class="!w-full" />
                        </IconField>
                    </div>       
                    <div class="">
                     
                    </div>  -->
                </section>
        </main>
       
        <article class=" flex flex-row  " >
            <section class="bg-gray-300 w-full  pb-4  rounded-t-lg  relative">

                <header class=" flex justify-between px-4 py-8 max-w-7xl m-auto">
                    <div class="">
                        <h1 class="text-3xl font-bold cursor-pointer">Recent Codex</h1>
                        <p class="text-lg font-medium text-gray-800 mt-1 cursor-pointer">Latest documentation and code snippets from my knowledge base.</p>                        
    
                    </div>
                </header>
                <!-- amo ini an kanan card -->
                <section class="grid md:grid-cols-4 grid-cols-1    flex-wrap justify-center gap-4 w-full mt-4  max-w-7xl m-auto px-8 md:px-0">
                    <Card   class=" !w-sm !md:w-sm !h-md !shadow-lg transition transform hover:-translate-y-2" v-for="item in filteredItems.slice().reverse().slice(0, 4)" :key="item.id" >
                        <template #title>
                            <header class="">
                                <h1 class="truncate text-xl text-gray-950 font-bold">{{ item.codex_name }}</h1>
                            </header>
                        </template>
                        <template #content>
                            <section class="">
                                <label for=""></label>
                                <p class="m-0 text-gray-500 text-md font-medium h-20 w-full overflow-hidden text-ellipsis ">{{ item.content }}</p>
                            
                                <nav class=" gap-2 mt-4">
                                    <div class="flex flex-wrap gap-2 truncate ">
                                        <p
                                        v-for="lang in item.language.slice(0,4)"
                                        :key="lang.id"
                                        :class="['px-2 py-1 rounded truncate text-xs font-bold', languageColors[lang]?.bg || 'bg-gray-200', languageColors[lang]?.text || 'text-black'] "
                                        >
                                        {{ lang }}
                                        </p>
                                    </div>
                                                                    
                                    <div class="flex flex-wrap gap-2 truncate mt-3">
                                        <div
                                        v-for="fw in item.framework.slice(0,4)"
                                        :key="fw.id"
                                        :class="['px-2 py-1 rounded truncate overflow-x-hidden text-xs font-bold', frameworkColors[fw]?.bg || 'bg-gray-200', frameworkColors[fw]?.text || 'text-black']"
                                        >
                                        {{ fw }}
                                        </div>
                                    </div>
                                </nav>
                                <div class="flex justify-between mt-4">
                                    <p class=" text-sm text-gray-500">{{ new Date(item.created_at).toISOString().split('T')[0] }}  </p>
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
        <section class="bg-gray-300  md:pt-32 md:pb-32 pt-16 pb-4 rounded-b-lg relative ">
           <header class=" flex justify-center items-center">
                <!-- <h1 class="text-3xl font-bold font-mono"> <i class="pi pi-slack mr-2" style="font-size: 1.5rem"></i>Technology Stack</h1> -->
   <h1 class="text-3xl font-bold font-mono flex items-center cursor-pointer ">
    <i class="pi pi-slack mr-2" style="font-size: 1.5rem"></i>
    <span
      v-for="(char, index) in techText.split('')"
      :key="index"
      :class="['text-gray-800', charHoverClasses[index], 'transition-colors duration-300']"
    >
     {{ char === ' ' ? '\u00A0' : char }}
    </span>
  </h1>
            </header>

                <div class="overflow-hidden    relative h-[150px] max-w-7xl m-auto">

                    <div class="absolute -left-8 top-0 h-full w-32  bg-gray-300 blur-md z-20"></div>
                        <!-- Right Blur -->
                <div class="absolute -right-8 top-0 h-full w-32 bg-gray-300 blur-md z-20"></div>
                    <div
                    class="flex w-max animate-carousel"
                    ref="carouselRef"
                    >
                
                    <div v-for="(item, index) in loopedData" :key="index" class="min-w-[200px] max-w-[200px] mx-2 h-32 mt-4   p-4">
                        <h3 class="font-bold text-lg text-gray-800">
                            <Image  alt="user header" loading="lazy"   imageClass=" grayscale hover:grayscale-0 transition w-20 h-20 "  :src="`/storage/output/${item.img}`" />
                        </h3>
                    </div>
                    </div>
                </div>                
        </section>    

        <section class="w-full bg-gray-300 pb-36 pt-8">
            <div class="max-w-7xl m-auto px-4">
                <header class="mb-12 ">
                    <h1 class="text-lg text-gray-800">HIGHLIGHTS</h1>
                    <h1 class="text-4xl text-gray-800 font-bold">Exclusive Project</h1>
                </header>       
                
                <article class="grid  lg:grid-cols-3 grid-cols-1  gap-12 px-3 md:px-0">
                   
                    <Card style="width: 25rem; overflow: hidden" v-for="proj in  project.filter(p => p.highlight === 'Yes')" key="proj.id" class="!w-80 md:!w-full" >
                        <template #header>
                            <Image image-class="h-64" alt="project Image" loading="lazy" preview :src="`/storage/output/${proj.img}`"   />
                        </template>
                        <template #title>
                            <h1 class="font-bold truncate">
                                {{ proj.proj_name }}
                            </h1>
                        </template>
                     
                        <template #content>
                            <p class="m-0 h-24 w-full overflow-hidden text-ellipsis">
                               {{ proj.proj_description }}
                            </p>
                        </template>
                        <template #footer>
                            <div class="flex gap-4 mt-1">
                                    <div
                                        v-for="fw in proj.framework.slice(0,4)"
                                        :key="fw.id"
                                        :class="['px-2 py-1 rounded truncate overflow-x-hidden text-xs font-bold', frameworkColors[fw]?.bg || 'bg-gray-200', frameworkColors[fw]?.text || 'text-black']"
                                        >
                                        {{ fw }}
                                    </div>
                                   
                            </div>
                            <div class="mt-2 flex justify-between ">
                                <div class="flex gap-2">
                                    <a :href="proj.github_url" target="_blank" rel="noopener noreferrer" v-tooltip.top="'Go to Github'"><i class="pi pi-github" style="font-size: 1.5rem"></i></a>
                                    <a :href="proj.live_url" target="_blank" rel="noopener noreferrer" v-tooltip.top="'Go to live server'"><i class="pi pi-globe" style="font-size: 1.5rem"></i></a>
                                </div>
                                <div class="">
                                  
                                      <Badge :severity="getSeverity(proj.status)" ></Badge>
                                </div>
                            </div>
                        </template>
                    </Card>
                </article>
            </div>

       
            <!-- kann timeline -->
            <section class="card max-w-7xl m-auto px-4">
                <header class="mt-24 md:mt-32 mb-10 flex justify-center">
                    <h1 class="text-3xl font-bold font-mono"><i class="pi pi-trophy mr-2" style="font-size: 1.5rem"></i>Achievements</h1>  
                </header>
                    <Timeline :value="events" :align="timelineAlign" class="customized-timeline">
                        <template #marker="slotProps">
                            <span class="flex w-6 h-6 items-center justify-center text-white rounded-full z-10 shadow-sm" :style="{ backgroundColor: slotProps.item.color }">
                                <i :class="slotProps.item.icon"></i>
                            </span>
                        </template>
                        <template #content="slotProps">
                            <Card class="mt-4 !bg-gray-300 !shadow-none">
                                <template #content>
                                
                                    <Image v-if="slotProps.item.image" :src="`/storage/output/${slotProps.item.image}`" :alt="slotProps.item.name"  image-class="w-96 shadow-sm rounded-md" preview />
                                    <h1 class="text-lg font-bold">  {{ slotProps.item.proj_name }}</h1>
                                    <p>
                                        {{ slotProps.item.proj_description }}
                                    </p>              
                                </template>
                                <template #footer>
                                {{ slotProps.item.date }}
                                </template>

                            </Card>
                        </template>
                    </Timeline>
            </section>

 

        </section>

       
        

    </MainLayout>

</template>


<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import { ref, computed, watch, onMounted, onBeforeUnmount, onUnmounted  } from 'vue'
    import IconField from 'primevue/iconfield';
    import InputIcon from 'primevue/inputicon';
    import Card from 'primevue/card';
    import Dialog from 'primevue/dialog';
    import Image from 'primevue/image';
    //amo ini an knan monaco editor
    import MonacoEditor from '@/Pages/Admin/MonacoEditor/MonacoEditor.vue';
    import { data } from 'autoprefixer';
    import Badge from 'primevue/badge';
    import Timeline from 'primevue/timeline';









    const props = defineProps({
        data: Array,
        category: Array,
        skill: Array,
        project: Array,
        screenshotimg: Array,
        award: Array,

        setting: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
 


    // ini na code is para han button categories ha main page na ma display an codex based ha category na gin click
    const currentFilter = ref('all')



    const filteredItems = computed(() => {
        if (currentFilter.value === 'all') return props.data
        return props.data.filter(item => item.category_name === currentFilter.value)
    })




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

const carouselRef = ref(null)
const currentIndex = ref(0)
let interval = null


onMounted(() => {
 
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



//---------------kanan hover colorful ----------------
const techText = ref('Technology Stack')

// List of Tailwind color classes for hover — choose your favorite!
const hoverColorClasses = [
  'hover:text-red-500',
  'hover:text-orange-500',
  'hover:text-amber-500',
  'hover:text-yellow-500',
  'hover:text-lime-500',
  'hover:text-green-500',
  'hover:text-emerald-500',
  'hover:text-cyan-500',
  'hover:text-sky-500',
  'hover:text-blue-500',
  'hover:text-indigo-500',
  'hover:text-violet-500',
  'hover:text-purple-500',
  'hover:text-fuchsia-500',
  'hover:text-pink-500',
  'hover:text-rose-500'
]

// Function to assign a random hover color to each character
const charHoverClasses = techText.value.split('').map(() => {
  return hoverColorClasses[Math.floor(Math.random() * hoverColorClasses.length)]
})


//--------------------------- PROJECT -----------------------------
const images = ref();

const activeIndex = ref(0);

const responsiveOptions = ref([
    {
        breakpoint: '1300px',
        numVisible: 4
    },
    {
        breakpoint: '575px',
        numVisible: 1
    }
]);

onMounted(() => {
    images.value = props.screenshotimg.map(proj => ({
        itemImageSrc: `/storage/screenshot/${proj.img}`,
        thumbnailImageSrc: `/storage/screenshot/${proj.img}`, // Use same img if no separate thumbnail
        alt: proj.img // Or proj.name/title if available
    }));
});




const getSeverity = (status) => {
  const statusSeverityMap = {
    Ongoing: 'info',
    Completed: 'success',
    OnHold: 'warn',
  }
  return statusSeverityMap[status] || 'secondary'
}


//------------------------ kanan timeline -------------------
const events = computed(() => {
    return props.award.map((proj) => ({
        date: proj.Date ?? 'N/A',
        proj_name: proj.award_title ?? 'Unknown',
        proj_description: proj.award_description ?? 'Unknown',
      
        icon: proj.icon ?? 'pi pi-check-circle', // You can customize default icon
        color: proj.color ?? '#000000',
        image: proj.img ?? null,
       
    }));
});


const screenWidth = ref(window.innerWidth)

const updateWidth = () => {
  screenWidth.value = window.innerWidth
}

onMounted(() => {
  window.addEventListener('resize', updateWidth)
})

onUnmounted(() => {
  window.removeEventListener('resize', updateWidth)
})

const timelineAlign = computed(() => {
  if (screenWidth.value >= 768) {
    return 'alternate' // For md and up
  }
  return 'center' // Default or mobile
})




//---------------------------- CODEX CARDS -------------------------
const languageColors = {
  PHP:         { bg: 'bg-purple-300', text: 'text-purple-800' },
  JavaScript:  { bg: 'bg-yellow-300', text: 'text-yellow-800' },
  TypeScript:  { bg: 'bg-blue-300', text: 'text-blue-800' },
  Python:      { bg: 'bg-green-300', text: 'text-green-800' },
  Ruby:        { bg: 'bg-red-300', text: 'text-red-800' },
  Java:        { bg: 'bg-orange-300', text: 'text-orange-800' },
  'C#':        { bg: 'bg-indigo-300', text: 'text-indigo-800' },
  'C++':       { bg: 'bg-gray-300', text: 'text-gray-800' },
  Go:          { bg: 'bg-cyan-300', text: 'text-cyan-800' },
  Dart:        { bg: 'bg-teal-300', text: 'text-teal-800' },
  Swift:       { bg: 'bg-orange-200', text: 'text-orange-800' },
  Kotlin:      { bg: 'bg-purple-200', text: 'text-purple-800' },
  Rust:        { bg: 'bg-orange-400', text: 'text-orange-900' },
  Scala:       { bg: 'bg-red-400', text: 'text-red-900' },
  Perl:        { bg: 'bg-pink-300', text: 'text-pink-800' },
  Elixir:      { bg: 'bg-violet-300', text: 'text-violet-800' },
};


const frameworkColors = {
  Vue:            { bg: 'bg-green-300', text: 'text-green-800' },
  React:          { bg: 'bg-blue-300', text: 'text-blue-800' },
  Angular:        { bg: 'bg-red-300', text: 'text-red-800' },
  Svelte:         { bg: 'bg-orange-300', text: 'text-orange-800' },
  'Next.js':      { bg: 'bg-gray-300', text: 'text-gray-800' },
  'Nuxt.js':      { bg: 'bg-emerald-300', text: 'text-emerald-800' },
  Codeigniter:    { bg: 'bg-orange-200', text: 'text-orange-800' },
  Laravel:        { bg: 'bg-rose-300', text: 'text-rose-800' },
  Symfony:        { bg: 'bg-gray-300', text: 'text-gray-800' },
  Django:         { bg: 'bg-green-300', text: 'text-green-800' },
  Flask:          { bg: 'bg-gray-200', text: 'text-gray-800' },
  Express:        { bg: 'bg-gray-400', text: 'text-gray-800' },
  NestJS:         { bg: 'bg-red-300', text: 'text-red-800' },
  'Ruby on Rails':{ bg: 'bg-pink-300', text: 'text-pink-800' },
  'Spring Boot':  { bg: 'bg-green-200', text: 'text-green-800' },
  'ASP.NET Core': { bg: 'bg-blue-200', text: 'text-blue-800' },
  'Inertia.js':   { bg: 'bg-purple-300', text: 'text-purple-800' },
  Remix:          { bg: 'bg-indigo-300', text: 'text-indigo-800' },
  'Blitz.js':     { bg: 'bg-yellow-300', text: 'text-yellow-800' },
  RedwoodJS:      { bg: 'bg-red-400', text: 'text-red-900' },
  'React Native': { bg: 'bg-cyan-300', text: 'text-cyan-800' },
  Flutter:        { bg: 'bg-sky-300', text: 'text-sky-800' },
  Ionic:          { bg: 'bg-blue-300', text: 'text-blue-800' },
  Slim:           { bg: 'bg-gray-300', text: 'text-gray-800' },
  FastAPI:        { bg: 'bg-teal-300', text: 'text-teal-800' },
  Lumen:          { bg: 'bg-yellow-200', text: 'text-yellow-800' },
  Koa:            { bg: 'bg-green-200', text: 'text-green-800' },
  Qwik:           { bg: 'bg-purple-200', text: 'text-purple-800' },
  SolidJS:        { bg: 'bg-blue-200', text: 'text-blue-800' },
  'T3 Stack':     { bg: 'bg-violet-300', text: 'text-violet-800' },
};



</script>


<style lang="scss" scoped>
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



@media screen and (max-width: 960px) {
    ::v-deep(.customized-timeline) {
        .p-timeline-event:nth-child(even) {
            flex-direction: row;

            .p-timeline-event-content {
                text-align: left;
            }
        }

        .p-timeline-event-opposite {
            flex: 0;
        }
    }
}


</style>