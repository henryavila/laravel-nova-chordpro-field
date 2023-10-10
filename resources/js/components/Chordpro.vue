<script setup>
import html2pdf from "html2pdf.js";
import {ChordProParser, FormatterSettings, HtmlFormatter,} from "chordproject-parser";
import {computed, ref} from "vue";
import Badge from "./Badge.vue";
import {useLocalization} from 'laravel-nova'

const props = defineProps({
  chord: String,
  showTabs: {
    type: Boolean,
    default: true
  },
  useSimpleChord: {
    type: Boolean,
    default: false
  },
  showChords: {
    type: Boolean,
    default: true
  }
})

const report = ref()
const printing = ref(false)
const {__} = useLocalization()


const parser = new ChordProParser();
const parsedContent = parser.parse(props.chord);
const settings = new FormatterSettings();
settings.showMetadata = false;
settings.showTabs = props.showTabs;
settings.useSimpleChord = props.useSimpleChord;
settings.showChords = props.showChords;
const formatter = new HtmlFormatter(settings);
const formattedContent = formatter.format(parsedContent);


const savePdf = () => {
  printing.value = true
  html2pdf()
      .set({
        margin: 5,
        filename: `cifra-${kebabCase(parsedContent.title)}.pdf`,
        image: {type: 'jpeg', quality: 0.97},
        pagebreak: {
          mode: 'avoid-all'
        },
        html2canvas: {
          scale: 2,
          dpi: 192,
          letterRendering: true,
          allowTaint: true,
        },
        jsPDF: {
          format: 'a4',
          orientation: 'portrait',
          compress: true,
        }
      })
      .from(report.value)
      .save()
      .then(() => printing.value = false)
      .catch(() => printing.value = false)
}

const toMinutesSeconds = (duration) => {
  const minutes = Math.floor(duration / 60);
  const seconds = duration - minutes * 60;

  const formattedMinutes = minutes.toLocaleString("en-US", {
    minimumIntegerDigits: 2,
    useGrouping: false,
  });

  const formattedSeconds = seconds.toLocaleString("en-US", {
    minimumIntegerDigits: 2,
    useGrouping: false,
  });
  return `${formattedMinutes}:${formattedSeconds}`;
}

const kebabCase = str => str
    .match(/[A-Z]{2,}(?=[A-Z][a-z]+[0-9]*|\b)|[A-Z]?[a-z]+[0-9]*|[A-Z]|[0-9]+/g)
    .join('-')
    .toLowerCase();

</script>

<template>

  <div class="prose dark:prose-invert">
    <div class="max-w-fit ml-auto mr-0">
      <Badge v-if="!printing" :name="__('save pdf')" class="cursor-pointer" @click="savePdf"/>
      <div v-else class="mr-8" :class="{printing: 'hidden'}">
        {{ __('wait...') }}
      </div>
    </div>


    <div ref="report" class="font-mono" :class="{printing: 'text-gray-900'}">

      <div class="flex justify-between items-start leading-4">

        <div>
          <div v-if="parsedContent.title" class="text-3xl font-bold">{{ parsedContent.title }}</div>
          <div v-if="parsedContent.subtitle" class="text-xl font-light opacity-80">{{ parsedContent.subtitle }}</div>
        </div>

        <div class="text-right opacity-75">
          <div v-if="parsedContent.key">{{ __('Key in') }} {{ parsedContent.key }}</div>
          <div v-if="parsedContent.tempo || parsedContent.time">
            <span v-if="parsedContent.tempo">{{ parsedContent.tempo }} BPM </span>
            <span v-if="parsedContent.time"> {{ __('in') + ' ' + parsedContent.time }}</span>
          </div>
          <div v-if="parsedContent.duration">{{ __('Duration') }} {{ toMinutesSeconds(parsedContent.duration) }}</div>
        </div>

      </div>


      <div v-html="formattedContent.join('\n')"></div>
    </div>
  </div>
</template>

<style>
.lyrics-line {
  display: flex;
  align-items: flex-end;
  flex-wrap: wrap;
  margin-top: 0.3rem;
}

.chord-lyrics {
  display: flex;
  flex-direction: column;
  align-items: left;
}

.above-lyrics {
  padding-right: 0.3em;
  margin-bottom: -0.3rem !important
}

.tab-section {
  color: #008702;
}

.chord {
  font-weight: bold;
  color: #db3e00;
}

.chord-lyrics:last-child .chord {
  padding-right: 0;
}

.word {
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  margin-right: 0.9em;
}

.empty-line {
  margin-top: 1.5em;
}

.song-content {
  margin-top: 1.2em;
  font-size: 1.1rem;
}

.chorus-section {
  font-weight: bold;
  border-left: 2px black solid;
  padding-left: 1em;
}

.comment-line {
  color: #717178;
}

</style>
