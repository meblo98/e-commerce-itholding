<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->

<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>Remos eCommerce Admin Dashboard HTML Template</title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/style.css') }}">



    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/font/fonts.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/icon/style.css') }}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{asset('assets/img/banner/logo.jpeg')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/banner/logo.jpeg') }}">

</head>

<body>
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">
                <!-- preload -->
                {{-- <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div> --}}
                <!-- /preload -->
                <!-- section-menu-left -->
                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ url('/admin') }}" id="site-logo-inner">
                            <img class="" id="logo_header" alt="euro logo"
                                src="{{ asset('assets/img/banner/logo.jpeg')}}"
                                data-light="{{ asset('assets/img/banner/logo.jpeg') }}"
                                data-dark="{{ asset('assets/img/banner/logo.jpeg') }}"
                                style="width:130px !important; max-height:48px !important; height:auto !important; object-fit:contain !important; background:transparent !important;">
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Tableau de bord</div>
                            <ul class="menu-list">
                                <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
                                    <a href="{{ url('/admin') }}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                            <div class="center-heading">Gestion</div>
                            <ul class="menu-list">
                                <li class="menu-item has-children {{ request()->is('produit-*') ? 'active' : '' }}">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                                        <div class="text">Produits</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item {{ request()->is('produit-add') ? 'active' : '' }}">
                                            <a href="{{url('/produit-add')}}" class="">
                                                <div class="text">Ajouter un produit</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item {{ request()->is('produit-list') ? 'active' : '' }}">
                                            <a href="{{ url('produit-list') }}" class="">
                                                <div class="text">Liste des produits</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children {{ request()->is('category-*') ? 'active' : '' }}">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Catégories</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item {{ request()->is('category-list') ? 'active' : '' }}">
                                            <a href="{{url('/category-list')}}" class="">
                                                <div class="text">Liste des catégories</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item {{ request()->is('category-add') ? 'active' : '' }}">
                                            <a href="{{ url('/category-add') }}" class="">
                                                <div class="text">Nouvelle catégorie</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children {{ request()->is('marque-*') ? 'active' : '' }}">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-box"></i></div>
                                        <div class="text">Marques</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item {{ request()->is('marque-list') ? 'active' : '' }}">
                                            <a href="{{ url('/marque-list') }}" class="">
                                                <div class="text">Liste des marques</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item {{ request()->is('marque-add') ? 'active' : '' }}">
                                            <a href="{{ url('/marque-add') }}" class="">
                                                <div class="text">Ajouter une marque</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item {{ request()->is('commande-*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.commandes.index') }}" class="">
                                        <div class="icon"><i class="icon-file-text"></i></div>
                                        <div class="text">Commandes</div>
                                    </a>
                                </li>
                                <li class="menu-item has-children {{ request()->is('user-*') ? 'active' : '' }}">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Utilisateurs</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item {{ request()->is('user-list') ? 'active' : '' }}">
                                            <a href="{{ url('/user-list') }}" class="">
                                                <div class="text">Tous les utilisateurs</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item {{ request()->is('user-add') ? 'active' : '' }}">
                                            <a href="{{ url('/user-add') }}" class="">
                                                <div class="text">Nouvel utilisateur</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="menu-item {{ request()->is('rapport') ? 'active' : '' }}">
                                    <a href="{{ url('/rapport') }}" class="">
                                        <div class="icon"><i class="icon-pie-chart"></i></div>
                                        <div class="text">Rapports</div>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="center-item">
                            <div class="center-heading">Paramètres</div>
                            <ul class="menu-list">
                                <li class="menu-item {{ request()->is('settings') ? 'active' : '' }}">
                                    <a href="{{ url('/settings') }}" class="">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Paramètres du compte</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="">
                                        <div class="icon"><i class="icon-log-out"></i></div>
                                        <div class="text">Déconnexion</div>
                                    </a>
                                    <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="section-content-right">
                    @include('admin.partials.header')
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    {{-- les scripts --}}
    <!-- Javascript -->
    <script src="{{asset('dashboard/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{asset('dashboard/assets/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/zoom.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-1.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-3.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-4.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-5.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-6.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/theme-settings.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>
    <!-- Additional vendor charts/libs (needed by some admin pages) -->
    <script src="{{ asset('dashboard/assets/js/jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jvectormap-us-lcc.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/jvectormap.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/raphael.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/morris.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/morris.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-8.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-9.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/apexcharts/line-chart-10.js') }}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/line-chart-11.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/line-chart-12.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/line-chart-13.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/line-chart-14.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/line-chart-15.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/apexcharts/line-chart-16.js')}}"></script>
    <script>
        // Fix logo override issue - force correct logo after page load
        $(document).ready(function() {
            var logoSrc = "{{ asset('assets/img/banner/6400254.jpg') }}";
            $('#logo_header').attr('src', logoSrc);
            $('#logo_header_mobile').attr('src', logoSrc);

            // Override retina logo function to use our logo
            setTimeout(function() {
                $('#logo_header').attr('src', logoSrc);
                $('#logo_header_mobile').attr('src', logoSrc);
            }, 100);
        });
    </script>
    @stack('scripts')
</body>

</html>
