<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Club Mobile Electronics</title>

    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/banner/6400254.jpg') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/banner/6400254.jpg') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/banner/6400254.jpg') }}" />
    <link rel="manifest" href="{{ asset('assets/img/favicons/site.webmanifest') }}" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <!-- Package Css link -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/nice-select/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/meanmenu/css/meanmenu.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/swiftcart-icons/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/glightbox/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/spacing/spacing.css') }}" />
    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiftcart.css') }}" />



</head>

<body>
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')

{{-- script side --}}
    <script src="{{ asset('assets/vendors/jquery/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nice-select/js/nice-select.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('assets/vendors/meanmenu/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tiny-slider/tiny-slider.js') }}"></script>
    <script src="{{ asset('assets/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/imagesloaded/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('assets/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circleType/jquery.circleType.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-lettering/jquery.lettering.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/ion.rangeSlider/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendors/glightbox/js/glightbox.min.js') }}"></script>
    <script src="https://unpkg.com/splitting/dist/splitting.min.js"></script>
    <script src="https://unpkg.com/scroll-out/dist/scroll-out.min.js"></script>

    <!-- template js -->
    <script src="{{ asset('assets/js/swiftcart.js') }}"></script>


    <script type="module" src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
