@extends('layout.default')

@section('content')
    {{--        @include('blocks.text-block-example')--}}
    @include('blocks.text-block', ['text' => $page->text, 'formattedText' => $page->formattedText, 'resource' => 'page', 'resourceId' => $page->id])
@endsection
