<div class="language">
    <a href="@if(isset($localizedPathRu)){{ $localizedPathRu }} @else / @endif" class="language__button language__button--ru @if($locale == 'ru') language__button--active @endif">Ру</a>
    <a href="@if(isset($localizedPathRo)){{ $localizedPathRo }} @else /ro @endif" class="language__button language__button--ro @if($locale == 'ro') language__button--active @endif">Ro</a>
</div>
