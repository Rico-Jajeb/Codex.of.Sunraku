<template>
    <MainLayout
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion"  >

        <section class="bg-gray-800 rounded-b-lg">

       
        <main class="pt-24 max-w-7xl m-auto ">
            <section class="flex justify-center mt-8 md:mt-32 ">
                <header class="text-center">
                    <h1 class="text-4xl text-white font-bold">My Projects</h1>
                    <h1 class="text-lg font-bold text-gray-300">A collection of my recent work and personal projects.</h1>
                </header>                
            </section>
         

               
                <article class="grid lg:grid-cols-2 grid-cols-1 gap-12 px-4 md:px-0 mt-14 pb-24">
                    <div class="mb-8" v-for="proj in project" :key="proj.id">
                        <Galleria :value="getImages(proj)" :numVisible="5"  containerStyle="max-width: 640px" :showThumbnails="false" :showIndicators="true" :changeItemOnIndicatorHover="true" >
                            <template #item="slotProps">
                            <!-- <Image
                                :src="slotProps.item.itemImageSrc"
                                :alt="slotProps.item.alt"
                                image-class="h-96 w-[100vw] object-cover "
                                preview
                            /> -->
                            <Image
                                :src="slotProps.item.itemImageSrc"
                                :alt="slotProps.item.alt"
                                image-class="h-96 w-[100vw] object-cover "
                                preview
                            />
                            </template>
                        </Galleria>

                        <header class="md:mb-0 mb-12">
                            <h1 class="text-2xl font-bold text-white mt-4">{{ proj.proj_name }}</h1>
                            <p class="h-32 text-gray-400 text-lg font-medium">{{ proj.proj_description }}</p>  
                            <p class="mt-10 md:mt-0 text-gray-200 text-lg font-medium">Key Features</p>  
                            <div class="" v-for="SC in screenshotimg" key="SC.id">
                                <div v-if="proj.id == SC.project_id" class=" ">
                                      <div class="flex flex-wrap" v-if="SC.features && SC.features !== 'NULL'">
                                              <li class="ml-4 text-white">{{ SC.features }}</li>  
                                      </div>
                                </div>
                            </div>
                        </header>

                
                        <section class="mt-4 flex items-start gap-2 flex-wrap">
                            <div class="flex gap-2">
                                <div
                                v-for="lang in proj.language.slice(0,4)"
                                :key="lang.id"
                                :class="['px-2 py-1 rounded truncate overflow-x-hidden text-xs font-bold', languageColors[lang]?.bg || 'bg-gray-200', languageColors[lang]?.text || 'text-black']"
                                >
                                {{ lang }}
                                </div>
                            </div>

                            <div class="flex gap-2 ">
                                <div
                                v-for="fw in proj.framework"
                                :key="fw.id"
                                :class="['px-2 py-1 rounded truncate overflow-x-hidden text-xs font-bold', frameworkColors[fw]?.bg || 'bg-gray-200', frameworkColors[fw]?.text || 'text-black']"
                                >
                                {{ fw }}
                                </div>
                            </div>
                        </section>



                        <div class="mt-2 flex justify-between">
                            <div class="flex gap-2">
                                <a :href="proj.github_url" target="_blank" rel="noopener noreferrer" v-tooltip.top="'Go to Github'"><i class="text-blue-400 pi pi-github" style="font-size: 1.5rem"></i></a>
                                <a :href="proj.live_url" target="_blank" rel="noopener noreferrer" v-tooltip.top="'Go to live server'"><i class="text-blue-400  pi pi-globe" style="font-size: 1.5rem"></i></a>
                            </div>
                            <div class="">
                                
                                <Badge :severity="getSeverity(proj.status)" ></Badge>
                            </div>
                        </div>
                    </div>

                </article>


        </main>

        </section>
    </MainLayout>
</template>
<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import Image from 'primevue/image';
    import { ref, watch, computed, onMounted, onBeforeUnmount  } from 'vue'
    import InputIcon from 'primevue/inputicon';
    import IconField from 'primevue/iconfield';
    import Dialog from 'primevue/dialog';
    import 'primeicons/primeicons.css'
    import Badge from 'primevue/badge';
    import Card from 'primevue/card';
  import Galleria from 'primevue/galleria';

    const props = defineProps({
        data: Array,
        category: Array,
        setting: Object,
        project: Array,
        screenshotimg: Array,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });


const getSeverity = (status) => {
  const statusSeverityMap = {
    Ongoing: 'info',
    Completed: 'success',
    OnHold: 'warn',
  }
  return statusSeverityMap[status] || 'secondary'
}

//----- kanan screenshot
// const images = ref();

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



function getImages(proj) {
  const firstImage = {
    itemImageSrc: proj.img ? `/storage/output/${proj.img}` : '/fallback-image.jpg',
    thumbnailImageSrc: proj.img ? `/storage/output/${proj.img}` : '/fallback-image.jpg',
    alt: proj.img || 'Main image'
  };

  const screenshots = (props.screenshotimg ?? [])
    .filter(ss => ss.project_id === proj.id)
    .filter(ss => ss.img && ss.img !== 'NULL'); // ✅ filter only screenshots with valid images

  const screenshotImages = screenshots.map(ss => ({
    itemImageSrc: `/storage/screenshot/${ss.img}`,
    thumbnailImageSrc: `/storage/screenshot/${ss.img}`,
    alt: ss.img
  }));

  return [firstImage, ...screenshotImages];
}



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





