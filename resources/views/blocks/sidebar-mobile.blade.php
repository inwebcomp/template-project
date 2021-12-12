<transition name="slide">
    <header v-show="menuOpened" class="header sidebar sidebar--menu">
        <div class="container">
            <button class="sidebar__close" @click="hideMenu">
                <i class="icon icon--close"></i>
            </button>

            @include('blocks.language')
            @include('blocks.logo')
            @include('blocks.menu')
            @include('blocks.phone')
        </div>
    </header>
</transition>

<transition>
    <div class="sidebar__overlay" @click="hideMenu" v-show="menuOpened"></div>
</transition>