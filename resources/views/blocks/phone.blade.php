<div class="header__phone">
    <a href="tel:{{ config('contacts.phone_link') }}" class="header__phone__link">
        <div class="header__phone__icon">
            <i class="icon icon--phone"></i>
        </div>
        <div>
            <div class="header__phone__text">@lang('Свяжитесь с нами')</div>
            <div class="header__phone__value">{{ \App\Models\Textblock::text('phone') }}</div>
        </div>
    </a>
</div>
