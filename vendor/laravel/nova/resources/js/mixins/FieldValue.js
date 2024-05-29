import filled from '../util/filled'

export default {
  props: ['field'],

  methods: {
    isEqualsToValue(value) {
      return Boolean(
        this.field.value === value ||
          this.field.value?.toString() === value ||
          this.field.value === value?.toString() ||
          this.field.value?.toString() === value?.toString()
      )
    },
  },

  computed: {
    fieldAttribute() {
      return this.field.attribute
    },

    fieldHasValue() {
      return filled(this.field.value)
    },

    usesCustomizedDisplay() {
      return this.field.usesCustomizedDisplay && filled(this.field.displayedAs)
    },

    fieldValue() {
      if (!this.usesCustomizedDisplay && !this.fieldHasValue) {
        return null
      }

      return String(this.field.displayedAs ?? this.field.value)
    },

    shouldDisplayAsHtml() {
      return this.field.asHtml
    },
  },
}
