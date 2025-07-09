<script setup>

    import Header from '@/Pages/Header/Header.vue';
    import Footer from '@/Pages/Footer/Footer.vue';
import { Head, Link, router } from '@inertiajs/vue3';
const props = defineProps({
    data: Array,
    category: Array,
    setting: Object,
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    title: String,
});





</script>

<template >
      <Head :title="title" > 
            <link rel="apple-touch-icon" :href="`/storage/output/${setting.system_logo}`" />

      </Head>

    <Header
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion"

    />
        <main class="  min-h-screen ">
            <slot></slot>
        </main>
    <Footer
        :data="data"
        :category="category"
        :setting="setting"
        :can-login="canLogin"
        :can-register="canRegister"
        :laravel-version="laravelVersion"
        :php-version="phpVersion"
    />
</template>

