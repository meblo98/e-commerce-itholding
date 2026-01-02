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
    <link rel="shortcut icon" href="{{ asset('assets/img/banner/6400254.jpg') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/banner/6400254.jpg') }}">
</head>

<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <div class="wrap-login-page">
                <div class="flex-grow flex flex-column justify-center gap30">
                    <a href="#" id="site-logo-inner">

                    </a>
                    <div class="login-box" style="border: 2px solid #d1d5db; border-radius: 8px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); background: #f3f4f6;">
                        <div>
                            <h3>Connexion au compte</h3>
                            <div class="body-text">Entrez votre email et mot de passe pour vous connecter</div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mb-24">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-login flex flex-column gap24" method="POST" action="/login">
                            @csrf
                            <fieldset class="email">
                                <div class="body-title mb-10">Adresse email <span class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="email" placeholder="Entrez votre adresse email"
                                    name="email" tabindex="0" value="{{ old('email') }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10">Mot de passe <span class="tf-color-1">*</span></div>
                                <input class="password-input" type="password" placeholder="Entrez votre mot de passe"
                                    name="password" tabindex="0" value="" aria-required="true" required="">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                            </fieldset>
                            <div class="flex justify-between items-center">
                                <div class="flex gap10">
                                    <input class="" type="checkbox" id="signed" name="remember">
                                    <label class="body-text" for="signed">Rester connecté</label>
                                </div>
                                <a href="#" class="body-text tf-color">Mot de passe oublié ?</a>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <a href="{{ url('/') }}" class="body-text tf-color">← Retour à l'accueil</a>
                            </div>
                            <button type="submit" class="tf-button w-full">Connexion</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascript -->
    <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/main.js') }}"></script>

</body>

</html>
