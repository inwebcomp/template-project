<template>
    <div class="radio" :class="{ 'radio--success': success }">
        <input type="radio" :id="_uid" class="radio__input" @input="$emit('input', val)" :checked="checked" :value="val" :name="name">
        <label :for="_uid" class="radio__label">
            <div class="radio__checker"></div>
        </label>
    </div>
</template>

<script>
    export default {
        name: "radio",

        props: {
            val: {},
            value: {},
            success: {
                type: Boolean,
                default: false
            },
            name: {
                type: String,
                required: true
            }
        },

        computed: {
            checked() {
                return this.val == this.value;
            }
        },
    }
</script>
