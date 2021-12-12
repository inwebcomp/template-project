<title>{{ isset($meta) ? $meta['title'] : config('app.name') }}</title>

@if(isset($meta))
    @if (isset($meta['description']) and $meta['description'])
        <meta name="description" content="{{ $meta['description'] }}" />
    @endif

    @if (isset($meta['keywords']) and $meta['keywords'])
        <meta name="keywords" content="{{ $meta['keywords'] }}" />
    @endif

    @if (isset($meta['canonical']) and $meta['canonical'])
        <link rel="canonical" href="{{ $meta['canonical'] }}"/>
    @endif
@endif

<meta itemprop="name" content="{{ config('app.name') }}" />
