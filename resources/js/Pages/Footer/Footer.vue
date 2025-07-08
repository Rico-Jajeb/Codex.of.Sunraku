<template>
       <footer class="bg-black m-3 text-white rounded-lg h-96">
   
            <section class="md:flex  md:justify-between h-64 px-24">
                <header class="flex  pt-4 md:pt-24 ">
                    <h1 class="text-lg md:text-3xl font-bold">{{ setting.system_slogan }}</h1>                   
                </header>


                <section class="h-32 pt-4 md:pt-24 ">
                    <label for="" class="text-sm md:text-lg font-bold">Social:</label>
                    <nav class="flex gap-4  mt-4 mb-4 ">  
                        <a :href="setting.facebook" target="_blank" rel="noopener noreferrer" ><i class="pi pi-facebook" style="font-size: 1.5rem"></i></a>
                        <a :href="setting.linked" target="_blank" rel="noopener noreferrer" ><i class="pi pi-linkedin" style="font-size: 1.5rem"></i></a>
                        <a :href="setting.github" target="_blank" rel="noopener noreferrer" ><i class="pi pi-github" style="font-size: 1.5rem"></i></a>
                   </nav> 
                   <div class="">
                    <button @click="categoryInfoDisp = true"><i class="pi pi-envelope" style="font-size: 1.3rem">:  </i></button>            <span class="text-sm md:text-lg">{{ setting.email }}</span>        
                   </div>

                   

                </section>
               
            </section>


            <Divider/>
            <section class="flex justify-between px-2 md:px-24">
                <h1 class="text-sm md:text-md">© 2025 {{ setting.system_name }}. <br> Built with Laravel & Vue.js. <br> All rights reserved.</h1>
                <h1 class="text-sm md:text-md">Design and developed by: RJC </h1>
            </section>
          <Dialog  v-model:visible="categoryInfoDisp" maximizable   :header="`Contact  `" :style="{ width: '600px' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"  >
        <EmailForm/>
    </Dialog>
    </footer> 
</template>

<script setup>
import { ref } from 'vue';
 import Divider from 'primevue/divider';
import { Head, Link, router } from '@inertiajs/vue3';
   import Dialog from 'primevue/dialog';

    import EmailForm from '../Admin/Forms/EmailForm.vue';

    const props = defineProps({
        data: Array,
        category: Array,
        setting: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
 
const categoryInfoDisp = ref(false);
</script>
