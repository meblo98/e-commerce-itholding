@extends('layouts.app')

@section('title', 'Page Non Trouvée')

@section('content')
    <!-- xc-breadcrumb area start -->
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span><a href="#">Accueil</a></span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span>Page Non Trouvée</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- xc-breadcrumb area end -->

    <div class="xc-error-one pb-80 pt-80">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-12">
                    <div class="xc-error-one__content text-center">
                        <div class="m-img">
                            <img src="{{ asset('assets/img/resourse/404-Inage.png') }}" alt="404 Error">
                        </div>
                        <h1 class="xc-error-one__title">Oops! Page Non Trouvée.</h1>
                        <p class="xc-error-one__info">La page que vous recherchez n'est pas disponible ou n'appartient pas à ce site web !</p>
                        <a href="{{ url('/') }}" class="swiftcart-btn">Retour à l'accueil<i class=""></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
