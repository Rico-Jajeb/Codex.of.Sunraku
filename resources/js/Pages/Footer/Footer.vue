<template>
       <footer class="bg-black m-3 text-white rounded-lg h-96">
        <section >
             
            <h1>{{ setting.system_name }}</h1>

            <nav></nav>

        </section>
    </footer> 
</template>

<script setup>


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
