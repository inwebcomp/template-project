export default {
    data() {
        return {
            excludeFromSwipe: [],
            xDown: null,
            yDown: null,
        }
    },

    methods: {
        getTouches(evt) {
            return evt.touches ||
                evt.originalEvent.touches
        },

        handleTouchStart(evt) {
            for (let container of this.excludeFromSwipe) {
                if (container.isEqualNode(evt.target) || container.contains(evt.target)) {
                    return
                }
            }

            const firstTouch = this.getTouches(evt)[0]
            this.xDown = firstTouch.clientX
            this.yDown = firstTouch.clientY
        },

        handleTouchMove(evt) {
            if (!this.xDown || !this.yDown) {
                return
            }

            let xUp = evt.touches[0].clientX
            let yUp = evt.touches[0].clientY

            let xDiff = this.xDown - xUp
            let yDiff = this.yDown - yUp

            if (Math.abs(xDiff) < 20 && Math.abs(yDiff) < 20) {
                return
            }

            if (Math.abs(xDiff) > Math.abs(yDiff)) {
                if (xDiff > 0) {
                    this.handleLeftSwipe()
                } else {
                    this.handleRightSwipe()
                }
            }

            /* reset values */
            this.xDown = null
            this.yDown = null
        },

        handleLeftSwipe() {
            //
        },

        handleRightSwipe() {
            //
        },
    },
}
