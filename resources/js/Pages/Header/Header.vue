<template>
       <header class="h-20 flex gap-4 justify-between bg-blue-300 max-w-7xl m-auto fixed top-0 right-0 left-0 mt-0 md:mt-3">
        <!-- Logo or Site Name -->
        <div class="text-lg font-bold text-gray-800 dark:text-white">
          <Link href="/" >SunRaku's Codex</Link>   
        </div>
        <!-- Navigation  menu -->
        <nav class=" border-gray-200 dark:bg-gray-900">
            <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-6 ">
                  <Link href="about" >Search</Link>
                
                  <Link href="about" >Categories</Link>
                  <Link href="about" >Recent Notes</Link>
                </nav> 
                <!-- This is the navigation button for login and register            -->
                <nav class="ml-20">
                    <Link :href="route('login')" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </Link>
                    <Link :href="route('register')" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Register
                    </Link>
                    <!-- TEMPORARY LA INI PARA MADAGMIT PAG KADTO DASHBOARD  -->
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                    </Link>
                </nav>

                <!-- Hamburger Button (Mobile) -->
                <button  @click="isMenuOpen = !isMenuOpen" class="md:hidden p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                  <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                  </svg>
                </button>
            </div>
            <!-- Mobile Navigation Menu -->
            <div v-show="isMenuOpen" class="absolute top-16 left-0 w-full bg-white dark:bg-gray-900 shadow-lg md:hidden transition-transform duration-300 ease-in-out">
              <nav class="flex flex-col space-y-4 p-4">
                <Link href="about" >About</Link>
                  <Link href="about" >Services</Link>
                  <Link href="about" >Tourist Spot</Link>
                  <Link href="about" >Blogs</Link>
                  <Link href="about" >Contact</Link> 
              </nav>
            </div>

        </nav>
    </header>
  
</template>

<script setup>
  
    
    // This is for the hamburger nav
    import { ref } from 'vue';
    const isMenuOpen = ref(false);



    import { Head, Link } from '@inertiajs/vue3';

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
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>