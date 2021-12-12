@if (isset($breadcrumbs) and is_iterable($breadcrumbs))
    <nav class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
        <ul>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ rtrim(\InWeb\Base\Support\Route::localized(''), '/') ?: '/' }}" itemprop="item"
                   class="breadcrumbs__item">
                    <i class="icon icon--home"></i>
                </a>
                <meta itemprop="name" content="{{ config('app.name') }}"/>
                <meta itemprop="position" content="1"/>
            </li>
            @foreach($breadcrumbs as $index => $item)
                <li>
                    <span class="breadcrumbs__separator"><i class="icon icon--chevron-right"></i></span>
                </li>

                <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    @isset($item['link'])
                        <a itemprop="item" href="{{ $item['link'] }}" class="breadcrumbs__item">
                            <span class="breadcrumbs__text" itemprop="name">{{ $item['title'] }}</span>
                        </a>
                        <meta itemprop="position" content="{{ $index + 2 }}"/>
                    @else
                        <span class="breadcrumbs__item" itemprop="item">
                        <span class="breadcrumbs__text" itemprop="name">{{ $item['title'] }}</span>
                    </span>
                        <meta itemprop="position" content="{{ $index + 2 }}"/>
                    @endisset
                </li>
            @endforeach
        </ul>
    </nav>
@endif