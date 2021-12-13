export default {
    methods: {
        hasErrors() {
            return Object.keys(this.errors).find(i => this.errors[i])
        },
        reset() {
            for (let field in this.form) {
              this.form[field] = ''
            }
        },
        doneButton() {
            this.buttonForceText = this.__('Отправлено')
            this.icon = 'icon--done'

            setTimeout(() => {
                this.buttonForceText = null
                this.icon = 'icon--arrow-right'
            }, 4000)
        }
    },

    computed: {
        buttonText() {
            return this.loading ? this.__('Отправка...') : (this.buttonForceText || this.__('Отправить'))
        },
    }
}
