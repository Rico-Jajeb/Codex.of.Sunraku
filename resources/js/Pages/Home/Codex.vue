<template>
  <MainLayout
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion"  >
        
        
        <main class="flex pt-36 max-w-7xl m-auto">
            <!-- Sticky Sidebar -->
            <aside class=" sticky top-24 h-screen overflow-y-auto overflow-x-hidden  w-1/6">
                <nav class="" v-for="cat in category" :key="cat.id">
                  
                    <button type="button"  @click="codeee(cat.category_name)" class=" font-medium">
                        {{ cat.category_name }} 
                    </button>

                     <div   v-if="selected === cat.category_name"  class="mt-1 space-y-2 transition-all duration-300" v-for="codex in data" :key="codex.id">
                        <div v-if="selected === codex.category_name" class="bg-white  p-3 ">
                            <button type="button"  @click="dispCodex(codex.id)" class=" w-full text-start text-gray-700">{{ codex.codex_name }}</button>
                        </div>    
                    </div>                   

                </nav>
  
            </aside>





            <!-- Scrollable Content -->
            <section class=" w-5/6 overflow-y-auto">
                <!-- Simulated long content -->
                <div class="h-[2000px] pl-32" >
                    <div  class=" " v-for="codex in data" :key="codex.id">
                        <div v-if="selectCodex === codex.id" class=" pl-8 ">
                            <header>
                                <h1 class="text-lg font-bold"> {{ codex.codex_name }}</h1>
                            </header>
                            <section class="mt-8">
                                <p class="text-gray-900 ">Category:  <span class="text-gray-500">{{ codex.category_name }}</span> </p>
                                <p class="text-gray-900 mt-2">Language:  <span class="text-gray-500">{{ codex.language.join(', ')  }}</span> </p>
                                <p class="text-gray-900 mt-2">Frameworks:  <span class="text-gray-500">{{ codex.framework.join(', ')  }}</span> </p>
                                <p class="text-gray-900 mt-2">Tags:  <span class="text-gray-500">{{ codex.tags  }}</span> </p>
                                <p class="text-gray-900 mt-2">Level:  <span class="text-gray-500">{{ codex.diffuclt_level  }}</span> </p>

                                <p class="text-gray-900 mt-6">Content</p>
                                <p class="text-gray-500 mt-4 whitespace-normal break-words overflow-hidden">{{ codex.content  }}</p>

                                <p class="text-gray-900 mt-6">Instructions</p>
                                <p class="text-gray-500 mt-4 whitespace-normal break-words overflow-hidden">{{ codex.instructions  }}</p>

                                <div class="my-4">
                                    <label for="" class="text-md text-gray-900 font-bold ">Code: </label>
                                    <MonacoEditor language="javascript" class="h-86"  v-model="codex.code_snippet"  />                                
                                </div>
                        
                                <p class="text-gray-900 mt-6">Output</p>
                                <p class="text-gray-500 mt-4 whitespace-normal break-words overflow-hidden">{{ codex.output  }}</p>

                                <div class="mt-6">
                                       <Image  alt="user header" loading="lazy"  preview imageClass="shadow-md rounded-xl w-full md:h-40 h-64 "  :src="`/storage/output/${codex.img}`" />
                                </div>
                            </section>
                        </div>    
                    </div>   
                </div>
            </section>
        </main>


    </MainLayout>
</template>

<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import Image from 'primevue/image';
    import { ref, watch } from 'vue'
      //amo ini an knan monaco editor
    import MonacoEditor from '@/Pages/Admin/MonacoEditor/MonacoEditor.vue';
 
    const props = defineProps({
        data: Array,
        category: Array,
        setting: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
 




    const show = ref(false)
const selected = ref(null)

    function codeee(item){
        //ini na code is an knn category button ini, bali pag gin click an category button ha documentation page, 
        // ma display an codex based ha category na gin click
        show.value = item 
        if (selected.value === item) {
            selected.value = null
        } else {
            selected.value = item
        }
    }


    const selectCodex = ref(null)


    function dispCodex(item){
        //ini liwat na code is para han codex, bali ngadto category button an codex ngadto pag gin click 
        // ma display an codex info na m gin click
        selectCodex.value = item
     
    }



</script>