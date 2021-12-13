import { disableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock';

export default {
    methods: {
        stopBodyScroll(val, elemClass) {
            if (val) {
                this.$nextTick(() => {
                    disableBodyScroll(document.getElementsByClassName(elemClass)[0])
                })
            } else {
                this.$nextTick(() => {
                    clearAllBodyScrollLocks()
                })
            }
        }
    }
}

