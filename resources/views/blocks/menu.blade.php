@if(is_iterable($menu))
    <nav class="menu {{ $class ?? '' }}">
        @foreach($menu as $item)
            <a href="{{ $item->link }}" @click="scrollToBlock" class="menu__link">{{ $item->title }}</a>
        @endforeach
    </nav>
@endif
