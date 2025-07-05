<template>
       <header class="h-20 flex gap-4 justify-between  max-w-7xl m-auto fixed top-0 right-0 left-0 mt-0 md:mt-3  z-50">
        <!-- Logo or Site Name -->
        <div class=" flex items-center gap-4 pl-4 pt-1 md:pt-0 md:pl-0">
                <Image alt="Logo" loading="lazy" :src="`/storage/output/${setting.system_logo}`" imageClass="h-14 w-14 rounded-full " preview />  
                <Link href="/"  class="text-white  text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]  " > {{ setting.system_name }}</Link>    
        </div>
        <!-- Navigation  menu -->
        <nav class=" border-gray-200 dark:bg-gray-900 mt-3">
            <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-6 ">
                 
                  <Link href="Home"  v-if="(page.url.includes('document') || page.url.includes('projects'))" class="text-white text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]" >Home</Link>
                  <Link href="document" class="text-white text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]" >Codex</Link>
                  <Link href="projects" class="text-white text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]" >Projects</Link>
                </nav> 
             

                <!-- Hamburger Button (Mobile) -->
                <button  @click="isMenuOpen = !isMenuOpen" class="md:hidden p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                  <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                  </svg>
                </button>
            </div>
            <!-- Mobile Navigation Menu -->
            <div v-show="isMenuOpen" class="absolute top-0 left-0 w-full bg-white/30 backdrop-blur-md dark:bg-gray-900 shadow-lg md:hidden transition-transform duration-300 ease-in-out">
                <section class="flex justify-end">
                    <button class="pr-4 pt-4" type="button" @click="isMenuOpen = !isMenuOpen"><i class="pi pi-times" style="font-size: 1rem"></i></button>                    
                </section>

                <nav class="flex flex-col space-y-4 p-4">
                  <Link href="Home"  v-if="(page.url.includes('document') || page.url.includes('projects'))" class="text-white text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]" >Home</Link>
                  <Link href="document" class="text-white text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]" >Codex</Link>
                  <Link href="projects" class="text-white text-lg font-bold drop-shadow-[0_1px_1px_rgba(0,0,0,0.8)]" >Projects</Link>
               
              </nav>
            </div>

        </nav>
    </header>
  
</template>

<script setup>
  
    
    // This is for the hamburger nav
    import { ref } from 'vue';
 



    import { Head, Link, router } from '@inertiajs/vue3';
    import Image from 'primevue/image';

    import { usePage } from '@inertiajs/vue3'

const isMenuOpen = ref(false);
const page = usePage()

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },

    setting: {
        type: Object,
        required: true, // or true if you expect it always to be present
        default: () => ({}), // optional default value
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>