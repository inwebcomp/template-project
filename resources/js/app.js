require('./bootstrap');

const Vue = require('vue')
import ScrollIntoView from 'scroll-into-view'

import Translator from './services/Translator'

// components
import ContactForm from './forms/ContactForm'
import TextblockEditor from './components/TextblockEditor'

// Mixins
import StopBodyScroll from './mixins/StopBodyScroll'
import HandlesSidebars from './mixins/HandlesSidebars'
import HandlesSwipe from './mixins/HandlesSwipe'

const app = Vue.createApp({
    components: [
        ContactForm,

        TextblockEditor,
    ],

    mixins: [
        StopBodyScroll,
        HandlesSidebars,
        HandlesSwipe,
    ],

    data: {
        //
    },

    methods: {
        initExcludeFromSwipe() {
            this.excludeFromSwipe = Array.from(document.getElementsByClassName('owl-carousel'))
            this.excludeFromSwipe.push(...Array.from(document.getElementsByClassName('responsive-table')))
        },

        handleLeftSwipe() {
            this.hideMenu()
        },

        handleRightSwipe() {
            this.showMenu()
        },

        scrollTop(e) {
            window.history.pushState({}, e.target.innerText, e.target.href)

            ScrollIntoView(document.getElementById('app'), {
                time: 350,
            })

            e.preventDefault()
        },

        scrollToBlock(e) {
            if (!e.target.hash)
                return

            let el = document.querySelector(e.target.hash)

            if (e.target.pathname === window.location.pathname && el) {
                window.history.pushState({}, e.target.innerText, e.target.href)

                ScrollIntoView(el, {
                    time: 350,
                    align: {
                        topOffset: 35
                    }
                })

                e.preventDefault()
                this.hideMenu()
            }
        },
    },

    mounted() {
        require('./page')

        this.initExcludeFromSwipe()
    },
})

// Global Mixins
const Lang = new Translator({})

app.mixin({
    methods: {
        __: function (...args) {
            return Lang.get(...args)
        },
    },
})

// Global Components
import Checkbox from './components/Checkbox'
import Radio from './components/Radio'

app.component('checkbox', Checkbox)
app.component('radio', Radio)

app.mount('#app')
