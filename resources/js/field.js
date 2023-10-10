import DetailField from './fields/DetailField.vue'
import FormField from './fields/FormField.vue'

Nova.booting((app, store) => {
  app.component('detail-laravel-nova-chordpro-field', DetailField)
  app.component('form-laravel-nova-chordpro-field', FormField)
})
