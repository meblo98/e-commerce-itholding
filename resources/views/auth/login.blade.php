@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span>Connexion</span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span><a href="{{ url('/') }}">Accueil</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="xc-login-area pt-80 pb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="bg-white p-4 p-md-5 rounded-3 shadow-sm">
                        <h3 class="text-center mb-4">Bon retour !</h3>
                        <p class="text-center text-muted mb-4">Connectez-vous pour accéder à vos commandes.</p>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3 form-check d-flex justify-content-between">
                                <div>
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                                </div>
                                <a href="#" class="text-primary small">Mot de passe oublié ?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3 mb-4">Se connecter</button>
                            
                            <div class="text-center">
                                <span class="text-muted">Pas encore de compte ?</span>
                                <a href="{{ route('register') }}" class="fw-bold text-primary">S'inscrire</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
