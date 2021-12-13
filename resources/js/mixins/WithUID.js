export default {
    data() {
        return {
            uid: false,
        }
    },

    created() {
        console.log(this)
        this.uid = this.$el
    },
}
