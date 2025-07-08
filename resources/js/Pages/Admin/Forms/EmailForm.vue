<template>
        

        <form @submit.prevent="submitForm" enctype="multipart/form-data">

            <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Your Name</label>
            <InputText class="!w-full" type="text" v-model="form.name" placeholder="Enter your name......" />
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-2">
                        {{ form.errors.name }}
                    </div>
        
            <div class="mt-4">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Your Email</label>
                <InputText class="!w-full" type="email" v-model="form.email" placeholder="Enter your email......" />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-2">
                    {{ form.errors.email }}
                </div>
            </div>
            <div class="mt-4">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Subject</label>
                <InputText class="!w-full" type="text" v-model="form.subject" placeholder="Enter Subject......" />
                <div v-if="form.errors.subject" class="text-red-500 text-sm mt-2">
                    {{ form.errors.subject }}
                </div>
            </div>
            <div class="mt-4">
                <label for="Web Name" class="block mt-4 mb-2 text-md font-bold text-gray-700 dark:text-white">Message</label>
                <Textarea  class="!w-full h-32"  type="email" v-model="form.message" placeholder="Enter message......" />
                <div v-if="form.errors.message" class="text-red-500 text-sm mt-2">
                    {{ form.errors.message }}
                </div>
            </div>

 
      
        
        <button type="submit" :disabled="form.processing"  severity="secondary" label="Submit" class="text-md font-bold text-black mt-6  bg-green-500 rounded-md px-5 py-3"><i class="pi pi-send mr-1"></i> Send </button>                    
            
        </form>

</template>
<script setup>
    import { ref } from "vue";
    import InputText from 'primevue/inputtext';
    import { useForm } from '@inertiajs/vue3' // amo ini an knan system form


    
    //kanan toast ini
    import { computed, watch } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useToast } from 'primevue/usetoast'

    import Textarea from 'primevue/textarea';

    const page = usePage()
    const toast = useToast()

    const successMessage = computed(() => page.props.flash?.success)

    const categoryInfoDisp = ref(true);


 


    const form = useForm({
        name: '',
        email: '',
        subject: '',
        message: '',
    })


const submitForm = () => {
    form.post(route('send-mail'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Message sent!',
                detail: 'Thank you for reaching out. Your message has been successfully sent!',
                life: 10000,
            });
            categoryInfoDisp.value = false;
            form.reset();
        },
        onError: (errors) => {
            console.error("Form submission failed.", errors);
        },
    });
};
  

</script>