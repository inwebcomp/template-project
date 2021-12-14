<a class="logo {{ $class ?? '' }}" href="/{{ ($locale == 'ru' ? '' : $locale) }}">
    <img src="{{ asset('img/logo.png') }}" height="40" alt="{{ config('app.name') }}" class="logo__img">
</a>
