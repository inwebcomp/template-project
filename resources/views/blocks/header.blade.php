<header class="header">
    <div class="container">
        <button class="menu__toggler" @click="showMenu">
            <i class="icon icon--menu"></i>
        </button>

        @include('blocks.logo')
        @include('blocks.menu')
        @include('blocks.language')
        @include('blocks.phone')
    </div>
</header>