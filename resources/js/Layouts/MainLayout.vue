<template>
    <Header/>
        <main class="  min-h-screen">
            <slot></slot>
        </main>
    <Footer/>
</template>

<script setup>

    import Header from '@/Pages/Header/Header.vue';
    import Footer from '@/Pages/Footer/Footer.vue';
</script>