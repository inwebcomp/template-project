<section class="text-section">
    @section('scripts')
        @include ('layout.editable')
    @endsection

    @auth('admin')
        @isset($resource)
            <textblock-editor class="text-block" resource="{{ $resource }}" resource-id="{{ $resourceId }}">
                {!! $text !!}
            </textblock-editor>
        @else
            <div class="text-block fr-view">
                {!! $formattedText !!}
            </div>
        @endisset
    @else
        <div class="text-block fr-view">
            {!! $formattedText !!}
        </div>
    @endauth
</section>
