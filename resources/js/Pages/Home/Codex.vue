<template>
  <MainLayout
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion" title="Codex" >
        
   <section class="" :class="testClass">   
        <main class=" pt-24 max-w-7xl m-auto px-0 md:px-8 ">

            <section class=" flex items-center mb-4 px-4 md:px-0">
    
                <button class="ml-4 md:hidden" @click="visible2 = true"> <i class="pi pi-bars" style="font-size: 1.1rem"></i></button>
                <button type="button" label="Show" @click="visible = true" class="z-10 mx-auto text-gray-500 border-gray-400 border-2 rounded-md px-4 py-1"><i class="pi pi-search mr-4" style="font-size: 1rem"></i> Search codex by title...</button>
                <button @click="toggleA"  class=" mt-2 px-4 py-2 text-white rounded flex items-center space-x-2">
                    <i :class="isAActive ? 'pi pi-moon' : 'pi pi-sun text-gray-600'"></i>
                </button>
            </section> 


            <section class="flex">
                <!-- Sticky Sidebar -->

                <aside class="hidden md:block sticky top-24 h-screen overflow-y-auto overflow-x-hidden   md:w-1/6 border-r-2 border-gray-700">
                    <header class="mb-4">
                        <h1 class=" md:text-lg font-bold text-gray-500">Codex Category</h1>                    
                    </header>
                    <nav class="  overflow-x-hidden overflow-y-auto  hover:text-gray-400" v-for="cat in category" :key="cat.id">
                    
                        <button type="button"  @click="codeee(cat.category_name)" class=" font-medium w-full md:text-left">
                            {{ cat.category_name }} 
                        </button>     
                       <!-- Outer scrollable container -->
                        <div
                        v-if="selected === cat.category_name"
                        class="overflow-x-hidden overflow-y-auto mt-1 space-y-2 transition-all duration-300"
                        style="max-height: 300px;"  
                        >
                        <!-- Only show codex items matching selected category -->
                        <div
                            v-for="codex in data.filter(c => c.category_name === selected)"
                            :key="codex.id"
                            class="h-20 overflow-hidden hover:text-gray-400 p-3"
                        >
                            <button
                            type="button"
                            @click="dispCodex(codex.id)"
                            class="w-full text-start text-gray-700 hover:text-gray-400"
                            >
                            {{ codex.codex_name }}
                            </button>
                        </div>
                        </div>

                  

                    </nav>
    
                </aside>
            

                <section class="w-6/6 md:w-5/6 overflow-y-auto">
                    <div class="md:h-[2000px] pl-0 pr-2 md:pl-32 mt-8">
                        <div v-if="selectCodex">
                        <div v-for="codex in data" :key="codex.id">
                            <div v-if="selectCodex === codex.id" class="pl-8">
                                <header>
                                    <h1 class="text-lg font-bold"> <span class="text-gray-500">Codex:</span> {{ codex.codex_name }}</h1>
                                </header>
                                <section class="mt-8">
                                    <p :class="testClass" class="text-gray-900 ">Category:  <span class="text-gray-500">{{ codex.category_name }}</span> </p>
                                    <p :class="testClass" class="text-gray-900 mt-2">Language:  <span class="text-gray-500">{{ codex.language.join(', ')  }}</span> </p>
                                    <p :class="testClass" class="text-gray-900 mt-2">Frameworks: 
                                         <span class="text-gray-500">{{ codex.framework.join(', ')  }}</span> 
                                    </p>
                                 
                                    
                                    <p :class="testClass" class="text-gray-900 mt-2">Tags:  <span class="text-gray-500">{{ codex.tags  }}</span> </p>
                                    <p :class="testClass" class="text-gray-900 mt-2">Level:  <span class="text-gray-500">{{ codex.diffuclt_level  }}</span> </p>

                                    <p :class="testClass" class="text-gray-900 mt-6">Content</p>
                                    <p class="text-gray-500 mt-4 whitespace-pre-line break-words overflow-hidden">{{ codex.content  }}</p>

                                    <p :class="testClass" class="text-gray-900 mt-6">Instructions</p>
                                    <p class="text-gray-500 mt-4  break-words overflow-hidden whitespace-pre-line">{{ codex.instructions  }}</p>

                                    <div class="my-4">
                                        <label for="" :class="testClass" class="text-md text-gray-900 font-bold ">Code: </label>
                                        <MonacoEditor language="javascript" class="h-86"  v-model="codex.code_snippet"  />                                
                                    </div>
                            
                                    <p :class="testClass" class="text-gray-900 mt-6">Output</p>
                                    <p class="text-gray-500 mt-4 whitespace-pre-line break-words overflow-hidden">{{ codex.output  }}</p>

                                    <div class="mt-6">
                                        <Image  alt="user header" loading="lazy"  preview imageClass="shadow-md rounded-xl w-full md:h-40 h-64 "  :src="`/storage/output/${codex.img}`" />
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                            <div v-else class="pl-8 text-gray-600">
                                    <h1 class="text-2xl font-bold mb-4">Welcome to {{setting.system_name }} Codex Documentation 🎉</h1>
                                    <p class="mb-2">Select a codex on the left to explore detailed information including code snippets, frameworks, and outputs.</p>
                                    <p class="mb-2">This codex system is designed to help you document, manage, and quickly reference your important code and technical notes.</p>
                                    <p>Use the sidebar to browse categories or try the search feature to jump right in.</p>
                                    </div>
                            </div>
                    </section>
                </section>
        </main>
 </section>
        <!-- kanan search modal ini -->
        <Dialog  v-model:visible="visible" maximizable  modal header="Search Codex" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <IconField class="mx-auto md:!w-[640px] !w-80"  >
                <InputIcon class="pi pi-search" />
                <InputText v-model="search" placeholder="Search codex by title..." class="!w-[280px] md:!w-[640px]" />
            </IconField>

            <section class=" h-64 overflow-y-auto overflow-x-hidden mt-4 ">
                <div class="mt-1 space-y-2 transition-all duration-300 " v-for="codex in filteredProducts" :key="codex.id">
                    <button type="button"  @click="dispCodex(codex.id)" class=" w-full text-start text-gray-700 hover:bg-gray-200">{{ codex.codex_name }}</button> 
                </div>                  
            </section>
        </Dialog>

        <Drawer v-model:visible="visible2" header="Codex Category">
            <nav class=" overflow-y-auto  hover:text-gray-400" v-for="cat in category" :key="cat.id">
            
                <button type="button"  @click="codeee(cat.category_name)" class="text-gray-900 font-medium w-full text-left ">
                    {{ cat.category_name }} 
                </button>

                <div   v-if="selected === cat.category_name"  class="mt-1 space-y-2 transition-all duration-300  overflow-y-auto  " v-for="codex in data" :key="codex.id">
                    <div v-if="selected === codex.category_name" class="bg-white h-20 overflow-hidden hover:text-gray-400  p-3 ">
                        <button type="button"  @click="dispCodex(codex.id)" class=" w-full text-start text-gray-700 hover:text-gray-400">{{ codex.codex_name }}</button>
                    </div>    
                </div>                   

            </nav>
        </Drawer>

             <div>
                <!-- amo ini an kanan pop up notif pag nag submit msg -->
                <Toast />
            </div>
        
    </MainLayout>
    
</template>

<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';
    import Image from 'primevue/image';
    import { ref, watch, computed  } from 'vue'
    import InputIcon from 'primevue/inputicon';
    import IconField from 'primevue/iconfield';
    import Dialog from 'primevue/dialog';
    import 'primeicons/primeicons.css'
    //amo ini an knan monaco editor
    import MonacoEditor from '@/Pages/Admin/MonacoEditor/MonacoEditor.vue';
    
    import Drawer from 'primevue/drawer';
       import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'

import ToggleSwitch from 'primevue/toggleswitch';

import VirtualScroller from 'primevue/virtualscroller';

    const page = usePage()
    const toast = useToast()

 
    const props = defineProps({
        data: Array,
        category: Array,
        setting: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    });
 


    const visible2 = ref(false);

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
        
        visible.value = false;
        visible2.value = false;
    }


//----- search ----
    const search = ref('')

    const visible = ref(false);
   
    // amo ini an kanan codes para han search
    const filteredProducts = computed(() =>
    props.data.filter(p =>
        p.codex_name.toLowerCase().includes(search.value.toLowerCase())
    )
    )




//----------- dark mode -----------

const testClass = ref('') // Start with no additional class

function a() {
  // Return the class string
  return 'bg-gray-900 text-white'
}

const isAActive = ref(false)
function toggleA() {
  if (testClass.value === '') {
    testClass.value = a()
  } else {
    testClass.value = ''
  }

    isAActive.value = !isAActive.value
}


</script>