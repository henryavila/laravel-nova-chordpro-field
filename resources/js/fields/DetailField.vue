<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <ChordproExpert
          :content="field.value"
          :plain-text="true"
          :should-show="field.shouldShow"
          :chordpro-url="field.chordproUrl"
      />
    </template>
  </PanelItem>
</template>

<script>
import ChordproExpert from "../components/ChordproExpert.vue";

export default {
  components: {ChordproExpert},
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
