<div class="xc-banner-one pt-20 pb-40">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-xl-3 col-xxl-2 d-none d-xl-flex flex-column h-100">
                {{-- lister les categories ici --}}
                <div class="xc-banner-one__cat flex-grow-1" style="height: 100%; max-height: 100%; overflow-y: auto;">
                    <ul>
                        @if(isset($categories))
                            @foreach ($categories->take(9) as $categorie)
                                <li><a href="#">{{ $categorie->titre }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-12 col-xl-9 col-xxl-10">
                <div class="xc-main-slider">
                    <div class="xc-main-slider__carousel swiftcart-owl__carousel owl-carousel" data-owl-options='{
                        "loop": true,
                        "animateOut": "fadeOut",
                        "animateIn": "fadeIn",
                        "items": 1,
                        "autoplay": true,
                        "autoplayTimeout": 7000,
                        "smartSpeed": 1000,
                        "nav": false,
                        "navText": ["<span class=\"fa-solid fa-chevron-left\"></span>","<span class=\"fa-solid fa-chevron-right\"></span>"],
                        "dots": false,
                        "margin": 0
                        }'>
                        <!-- Les images du banniere -->
                        <div class="xc-main-slider__item has-banner-image">
                            <div class="xc-main-slider__left">
                                <div class="xc-main-slider__content">
                                    <span class="xc-main-slider__subtitle">
                                        Votre Satisfaction, Notre Priorité
                                    </span>
                                    <h3 class="xc-main-slider__title">CLUB MOBILE <br> ELECTRONICS</h3>
                                    <p class="xc-main-slider__info">
                                        La qualité et l’innovation au cœur de votre maison
                                    </p>
                                    <!-- Bouton retiré : le bouton est géré ailleurs -->
                                </div>
                            </div>
                        </div>
                        <!-- Styles déplacés vers `public/assets/css/swiftcart.css` pour maintenance -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner one end -->
