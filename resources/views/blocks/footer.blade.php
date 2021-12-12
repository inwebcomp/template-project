<footer class="footer">
    <div class="container">
        <div class="footer__top">
            @include('blocks.logo')
            @include('blocks.menu')

            <a href="#" @click="scrollTop" class="footer__to-top">
                <i class="icon icon--arrow-top"></i>@lang('Наверх')
            </a>
        </div>

        <div class="footer__bottom">
            <span class="footer__copyrights">{!! \App\Models\Textblock::html('copyrights', true) !!}</span>
            <p class="footer__text ">Powered by <a href="//inweb.md" target="_blank"
                                                   class="footer__text__link"><b>InWeb.md</b></a></p>
        </div>
    </div>
</footer>
