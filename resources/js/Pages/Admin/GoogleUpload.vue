<template>
  <form @submit.prevent="submit">
    <input type="file" @change="handleFile" />
    <button type="submit">Upload</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const file = ref(null)

function handleFile(e) {
  file.value = e.target.files[0]
}

function submit() {
  const formData = new FormData()
  formData.append('file', file.value)

  router.post('/upload-drive', formData, {
    forceFormData: true,
    onSuccess: () => alert('Upload successful!'),
  })
}
</script>
