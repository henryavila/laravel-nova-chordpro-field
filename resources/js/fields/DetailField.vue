<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <ChordproExpert
          :content="field.value"
          :plain-text="true"
          :should-show="field.shouldShow"
          :show-chords="field.showChords"
          :show-tabs="field.showTabs"
          :use-simple-chord="field.useSimpleChord"
      />
    </template>
  </PanelItem>
</template>

<script>
import ChordproExpert from "../components/ChordproExpert.vue";
import Chordpro from "../components/Chordpro.vue";

export default {
  components: {Chordpro, ChordproExpert},
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
