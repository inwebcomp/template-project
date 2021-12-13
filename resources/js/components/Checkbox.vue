<template>
    <div class="checkbox" :class="{ 'checkbox--success': success, 'checkbox--disabled': disabled, }">
        <input :disabled="disabled" type="checkbox" :id="_uid" class="checkbox__input" :checked="value" @click.stop="emitEvent">
        <label :for="_uid" class="checkbox__label">
            <i class="fas fa-check checkbox__checker"></i>
        </label>
    </div>
</template>

<script>
    export default {
        name: "checkbox",

        props: {
            value: {
                type: Boolean,
                default: false
            },
            success: {
                type: Boolean,
                default: false
            },
            disabled: {
                type: Boolean,
                default: false
            }
        },

        methods: {
            emitEvent() {
                if (!this.disabled) this.$emit('input', ! this.value)
            }
        }
    }
</script>
