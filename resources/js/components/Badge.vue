<template>
<span
    :class="additionalClasses"
    class="text-xs font-normal px-1.5 py-0.5 m-1 inline-block rounded border"
>
        {{ name }}
      </span>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
  name: {
    type: String,
    required: true
  },
  color: String,
  border: {
    type: Boolean,
    default: false
  }
})

const additionalClasses = computed(() => {
  const classes = [];

  classes.push(props.border ? 'border-slate-200 dark:border-slate-800' : 'border-slate-100 dark:dark:border-slate-800')
  classes.push(props.color ? props.color : 'text-slate-500 bg-slate-100 hover:bg-slate-200 dark:text-slate-300 dark:bg-gray-800 dark:hover:bg-gray-700 ')

  return classes.join(' ')
})

</script>

<style>

</style>
