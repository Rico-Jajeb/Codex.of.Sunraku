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
            <aside class="bg-yellow-500 sticky top-24 h-screen w-1/6">
                <nav>
                    <h1 v-for="cat in category" :key="cat.id">
                        {{ cat.category_name }} 
                    </h1>
                </nav>

            </aside>

            <!-- Scrollable Content -->
            <section class="bg-blue-500 w-5/6 overflow-y-auto">
                <!-- Simulated long content -->
                <div class="h-[2000px] p-4">Docu Content Here...</div>
            </section>
        </main>


    </MainLayout>
</template>

<script setup>
    import MainLayout from '@/Layouts/MainLayout.vue';

     
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