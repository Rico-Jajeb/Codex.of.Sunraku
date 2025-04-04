<template>
    <div ref="editorContainer" class="w-full h-96 rounded-lg" />
  </template>
  
  <script setup>
  import * as monaco from 'monaco-editor'
  import { onMounted, ref, onBeforeUnmount } from 'vue'
  
  const props = defineProps({
    modelValue: String,
    language: {
      type: String,
      default: 'javascript'
    },
  })
  
  const emit = defineEmits(['update:modelValue'])
  
  const editorContainer = ref(null)
  let editorInstance = null
  
  onMounted(() => {
    editorInstance = monaco.editor.create(editorContainer.value, {
      value: props.modelValue,
      language: props.language,
      automaticLayout: true,
      theme: 'vs-dark'
    })
  
    editorInstance.onDidChangeModelContent(() => {
      const value = editorInstance.getValue()
      emit('update:modelValue', value)
    })
  })
  
  onBeforeUnmount(() => {
    if (editorInstance) {
      editorInstance.dispose()
    }
  })
  </script>
  
  <style scoped>
  /* Optional: you can use Tailwind to set the height or CSS */
  </style>
  