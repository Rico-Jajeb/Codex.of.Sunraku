<template >
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
    <Footer/>
</template>

<script setup>

    import Header from '@/Pages/Header/Header.vue';
    import Footer from '@/Pages/Footer/Footer.vue';

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