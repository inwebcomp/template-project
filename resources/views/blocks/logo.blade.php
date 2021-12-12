<a class="logo {{ $class ?? '' }}" href="/{{ ($locale == 'ru' ? '' : $locale) }}">
    <img src="{{ asset('img/logo.svg') }}" width="150" height="50" alt="{{ config('app.name') }}" class="logo__img">
</a>
