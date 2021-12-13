<template>
    <slot></slot>
</template>

<script>
    export default {
        name: 'ContactForm',

        data: () => ({
            form: {
                contact: '',
                message: '',
            },
            errors: {
                contact: false,
                message: false,
            },
        }),

        methods: {
            validate() {
                if (this.form.contact)
                    this.errors.contact = false

                if (this.form.message)
                    this.errors.message = false
            },

            validateHard() {
                this.errors.contact = !this.form.contact
                this.errors.message = !this.form.message
            },

            hasErrors() {
                return this.errors.contact || this.errors.message
            },

            submitHandler() {
                this.validateHard()

                if (this.hasErrors() || this.loading) {
                    return false
                }

                this.loading = true

                axios.post('/api/contact', this.form)
                    .then(({data: {message}}) => {
                        this.loading = false
                        this.error = false
                        this.message = message
                        this.reset()

                        this.doneButton()
                    })
                    .catch(() => {
                        this.loading = false
                        this.error = true
                        this.message = this.__('Произошла ошибка :( Пожалуйста, позвоните нам')
                    })
            },
        },
    }
</script>

