@if($contact)
    <b>@lang('Контактные данные'):</b> {{ $contact }}<br>
@endif
@if($messageText)
    <b>@lang('Текст сообщения'):</b><br>
    {!! $messageText !!}
@endif