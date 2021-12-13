export default {
    data() {
        return {
            menuOpened: false,
        }
    },

    methods: {
        showMenu() {
            if (! this.menuOpened) {
                this.menuOpened = true

                this.stopBodyScroll(true, 'sidebar')
            }
        },

        hideMenu() {
            if (this.menuOpened) {
                this.menuOpened = false
                this.stopBodyScroll(false, 'sidebar')
            }
        },
    },

    mounted() {
        document.addEventListener('touchstart', this.handleTouchStart.bind(this), false)
        document.addEventListener('touchmove', this.handleTouchMove.bind(this), false)
    },

    destroyed() {
        document.removeEventListener('touchstart', this.handleTouchStart.bind(this), false)
        document.removeEventListener('touchmove', this.handleTouchMove.bind(this), false)
    },
}
