<footer style="background-image: url('img/footer-interior-image.jpg')" class="footer-interior footer">
    <div class="container">
        <div class="row">
            <div class="footer-interior__column col-6 col-xl-4">
                <div class="footer-interior__group-title">Kurumsal</div>
                <ul class="footer-interior__list">
                    <li class="footer-interior__list-item"><a href="{{ \App\Helper::pageSlug(4) }}" class="footer-interior__list-link">Hakkımızda</a>
                    </li>
                    <li class="footer-interior__list-item"><a href="{{ route('user.contact') }}"
                                                              class="footer-interior__list-link">İletişim</a></li>
                    <li class="footer-interior__list-item"><a href="{{ \App\Helper::pageSlug(5) }}" class="footer-interior__list-link">Kişisel Verileri Aydınlatma Metni</a>
                    </li>
                </ul>
            </div>
            <div class="footer-interior__column col-12 col-sm-6 col-xl-4">
                <div class="footer-interior__group-title">İletişim</div>
                <p>Cemalpaşa Mah. 63005 Sok. No.27 Aydınoğlu İşmerkezi Kat.9 No.18 Seyhan - Adana</p>
                <p>
                    <a href="mailto:info@aydinoglu-insaat.com.tr"><span>info@aydinoglu-insaat.com.tr</span></a>
                </p>
                <p><a href="tel:+90 322 233 0933"><span>+90 322 233 0933</span></a></p>
            </div>
            <div class="footer-interior__column col-12 col-sm-6 col-xl-4">
                <div class="footer-interior__group-title">Mail Aboneliği</div>
                <p>Projeler hakkında bilgilendirme mailleri alın!</p>
                <form action="#" class="footer-interior__form" id="subscribeForm">
                    <input placeholder="Mail adresiniz" name="email" class="footer-interior__input" type="email" required/>
                    <button class="footer-interior__submit">Abone Ol
                        <span class="footer-interior__submit-icon icon-chevron-right"></span>
                    </button>
                </form>

                @push('footer')
                    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

                    <script>
                        $(function () {
                            $('#subscribeForm').submit(function (e) {
                                e.preventDefault()
                                axios.post('{{ route('subscribeForm') }}', $(this).serialize()).then((res) => {
                                    $.each(res.data.message, function (index, value) {
                                        toastr[res.data.status](value)
                                    })
                                    if (res.data.status === 'success') {
                                        $('#subscribeForm')[0].reset()
                                    }
                                })
                            })
                        })
                    </script>
                @endpush
            </div>
        </div>
        <div class="footer-interior__bottom">
            <div class="row">
                <div class="footer-interior__column col-12 col-sm-6">
                    <div class="footer-interior__copyright">© {{ date('Y') }} <strong>{{ config('app.name') }}.</strong> All Rights Reserved.
                        <br>
                        Designed by <a href="//bilgibahcesi.com" target="_blank">bilgibahcesi.com</a></div>
                </div>
                <div class="footer-interior__column col-12 col-sm-6 col-lg-3 offset-lg-3">
                    {{--<div class="footer-interior__socials"><a href="#"
                                                             class="footer-interior__social icofont-twitter">
                            <div class="visually-hidden">twitter</div>
                        </a><a href="#" class="footer-interior__social icofont-facebook">
                            <div class="visually-hidden">facebook</div>
                        </a><a href="#" class="footer-interior__social icofont-behance">
                            <div class="visually-hidden">behance</div>
                        </a><a href="#" class="footer-interior__social icofont-google-plus">
                            <div class="visually-hidden">google plus</div>
                        </a><a href="#" class="footer-interior__social icofont-linkedin">
                            <div class="visually-hidden">linkedin</div>
                        </a></div>--}}
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<script src="/front/assets/js/polyfill.min.js"></script>
{{--<script src="/front/assets/js/jquery.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/front/assets/js/jquery.viewport.min.js"></script>
<script src="/front/assets/js/jQuerySimpleCounter.min.js"></script>
<script src="/front/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/front/assets/js/isotope.pkgd.min.js"></script>
{{--<script src="/front/assets/js/animsition.min.js"></script>--}}
<script src="/front/assets/js/bootstrap.bundle.min.js"></script>
<script src="/front/assets/js/rellax.min.js"></script>
<script src="/front/assets/js/swiper.min.js"></script>
<script src="/front/assets/js/smoothscroll.js"></script>
<script src="/front/assets/js/svg4everybody.legacy.min.js"></script>
<script src="/front/assets/js/TweenMax.min.js"></script>
<script src="/front/assets/js/TimelineLite.min.js"></script>
<script src="/front/assets/js/typed.min.js"></script>
<script src="/front/assets/js/vivus.min.js"></script>

<script src="/front/assets/js/revolution/jquery.themepunch.tools.min.js"></script>
<script src="/front/assets/js/revolution/jquery.themepunch.revolution.min.js"></script>

<script src="/front/assets/js/revolution-addons/panorama/three.min.js"></script>
<script src="/front/assets/js/revolution-addons/panorama/revolution.addon.panorama.min.js"></script>

<script src="/front/assets/js/revolution/extensions/revolution.extension.actions.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.carousel.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.kenburn.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.migration.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.navigation.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.parallax.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.slideanims.min.js"></script>
<script src="/front/assets/js/revolution/extensions/revolution.extension.video.min.js"></script>

<script src="/front/assets/js/theme.js"></script>
@stack('footer')

<script src="/front/fslightbox.js"></script>


<!--
KT
-->
</body>

</html>
