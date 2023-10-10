<template>
  <div v-if="shouldShow && hasContent" class="break-normal">
      <div class="laravel-nova-chordpro-field">
        <Chordpro
            :chord="content"
            :chordpro-url="chordproUrl"
            fileName="aaa"
            chordproUrl="aaa"
        />
      </div>

  </div>
  <div v-else-if="hasContent" class="break-normal">
    <div
        v-if="expanded"
        class="max-w-none text-gray-500 dark:text-gray-400"
    >
      <div class="laravel-nova-chordpro-field">
        <Chordpro
            :chord="content"
            :chordpro-url="chordproUrl"
            fileName="aaa"
            chordproUrl="aaa"
            blockTitle="Teste"
        />
      </div>
    </div>

    <button
        type="button"
        v-if="!shouldShow"
        @click="toggle"
        class="link-default"
        :class="{ 'mt-6': expanded }"
        aria-role="button"
        tabindex="0"
    >
      {{ showHideLabel }}
    </button>
  </div>
  <div v-else>&mdash;</div>
</template>

<script>
import Chordpro from "./Chordpro.vue";

export default {
  components: {Chordpro},
  props: {
    plainText: {
      type: Boolean,
      default: false,
    },
    shouldShow: {
      type: Boolean,
      default: false,
    },
    content: {
      type: String,
    },
    chordproUrl: {
      type: String
    }
  },

  data: () => ({expanded: false}),

  methods: {
    toggle() {
      this.expanded = !this.expanded
    },
  },

  computed: {
    hasContent() {
      return this.content !== '' && this.content !== null
    },

    showHideLabel() {
      return !this.expanded ? this.__('Show Content') : this.__('Hide Content')
    },
  },
}
</script>
<style>
.prose {
  max-width: none;
}
</style>
