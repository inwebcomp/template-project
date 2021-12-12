<picture>
    @foreach($formats as $item)
        <source srcset="{{ $image->getUrl($thumbnail, $item['format']) }}" type="image/{{ $item['format'] }}">
    @endforeach
    <img src="{{ $image->getUrl($thumbnail) }}" width="{{ $width ?? 'auto' }}" height="{{ $height ?? 'auto' }}" class="{{ $class ?? '' }}" alt="{{ $alt }}">
</picture>
