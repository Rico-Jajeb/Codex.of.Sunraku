<template>
       <footer class="bg-black m-3 text-white rounded-lg h-96">
   
            <section class="md:flex  md:justify-between h-64 px-24">
                <header class="flex  pt-24 ">
                    <h1 class="text-lg md:text-3xl font-bold">{{ setting.system_slogan }}</h1>                   
                </header>


                <section class="h-32 pt-24 ">
                    <label for="" class="text-lg font-bold">Social:</label>
                    <nav class="flex gap-4  mt-4 mb-4 ">  
                        <a :href="setting.facebook" target="_blank" rel="noopener noreferrer" ><i class="pi pi-facebook" style="font-size: 1.5rem"></i></a>
                        <a :href="setting.linked" target="_blank" rel="noopener noreferrer" ><i class="pi pi-linkedin" style="font-size: 1.5rem"></i></a>
                        <a :href="setting.github" target="_blank" rel="noopener noreferrer" ><i class="pi pi-github" style="font-size: 1.5rem"></i></a>
                   </nav> 
                          <button><i class="pi pi-envelope" style="font-size: 1.3rem">: <span class="text-lg">{{ setting.email }}</span> </i></button>
                   

                </section>
               
            </section>


            <Divider/>
            <section class="flex justify-between px-24">
                <h1>© 2025 {{ setting.system_name }}. Built with Laravel & Vue.js. All rights reserved.</h1>
                <h1>Design and developed by: RJC </h1>
            </section>
        
    </footer> 
</template>

<script setup>
import { ref } from 'vue';
 import Divider from 'primevue/divider';
import { Head, Link, router } from '@inertiajs/vue3';


    const props = defineProps({
        data: Array,
        category: Array,
        setting: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
 

</script>
