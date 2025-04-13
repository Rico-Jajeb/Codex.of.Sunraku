<template>
    <form @submit.prevent="submit">
      <!-- Display the category name -->
      <h1 class="text-2xl font-bold text-center mb-6 text-gray-700">
        {{ form.CategoryName || 'Edit Category' }}
      </h1>
  
      <div>
        <label class="block mb-2 text-lg font-medium">Category Name</label>
        <InputText class="!w-full" v-model="form.CategoryName" />
        <div v-if="form.errors.CategoryName" class="text-red-500 text-sm mt-2">
          {{ form.errors.CategoryName }}
        </div>
      </div>
  
      <div class="mt-4">
        <label class="block mb-2 text-lg font-medium">Description</label>
        <InputText class="!w-full" v-model="form.CategoryDesc" />
        <div v-if="form.errors.CategoryDesc" class="text-red-500 text-sm mt-2">
          {{ form.errors.CategoryDesc }}
        </div>
      </div>
  
      <label class="block mt-4 text-sm font-bold">Upload Category Image Cover</label>
      <div class="card flex flex-col items-center gap-6 mt-4">
        <img v-if="src" :src="src" class="shadow-md rounded-xl w-full sm:w-64" />
        <FileUpload mode="basic" @input="form.img = $event.target.files[0]" @select="onFileSelect" customUpload auto />
      </div>
  
      <button type="submit" :disabled="form.processing" class="mt-6 bg-green-500 text-white px-5 py-3 rounded-md">
        <i class="pi pi-save mr-1"></i> Save
      </button>
  
      <Toast />
    </form>
  </template>
  
  
  <script setup>
  import InputText from 'primevue/inputtext'
  import FileUpload from 'primevue/fileupload'
  import { ref, watch, computed } from 'vue'
  import { useForm, usePage } from '@inertiajs/vue3'
  import { useToast } from 'primevue/usetoast'
  
  const props = defineProps({
    category: Object
  })
  
  const emit = defineEmits(['close'])
  
  const src = ref(null)
  const toast = useToast()
  const page = usePage()
  
  const successMessage = computed(() => page.props.flash?.success)
  
  watch(successMessage, (newValue) => {
    if (newValue) {
      toast.add({
        severity: 'success',
        summary: 'Success',
        detail: newValue,
        life: 5000
      })
      emit('close') // close modal after success
    }
  })
  
  const form = useForm({
    CategoryName: '',
    CategoryDesc: '',
    img: null
  })
  
  watch(() => props.category, (newVal) => {
    if (newVal) {
      form.CategoryName = newVal.CategoryName || ''
      form.CategoryDesc = newVal.CategoryDesc || ''
      src.value = newVal.CategoryImageUrl || null // optional preview
    }
  }, { immediate: true })
  
  function onFileSelect(event) {
    const file = event.files[0]
    const reader = new FileReader()
  
    reader.onload = (e) => {
      src.value = e.target.result
    }
  
    reader.readAsDataURL(file)
  }
  
  function submit() {
    form.post(route('categories.update', props.category.id), {
      forceFormData: true,
      onSuccess: () => {
        emit('close')
      }
    })
  }
  </script>
  