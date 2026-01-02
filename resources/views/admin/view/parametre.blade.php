@extends('admin.layouts.app')

@section('title', 'Parameter Settings')

@section('content')
    @include('admin.partials.header')
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Setting</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="index.html">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Paramètre</div>
                        </li>
                    </ul>
                </div>
                <!-- Change Password -->
                <div class="wg-box mt-30">
                    <div class="left">
                        <h5 class="mb-4">Modifier le mot de passe</h5>
                        <div class="body-text">Mettez à jour votre mot de passe de compte.</div>
                    </div>
                    <div class="right flex-grow">
                        @if(session('status'))
                            <div class="block-available mb-20">{{ session('status') }}</div>
                        @endif

                        <form method="POST" action="{{ route('settings.password.update') }}" class="form-style-2">
                            @csrf
                            <fieldset class="mb-20">
                                <div class="body-title mb-10">Adresse email du compte</div>
                                <input class="w-full" type="email" name="email" placeholder="Email" value="{{ auth()->user()->email }}" required>
                                @error('email')
                                    <div class="text-tiny tf-color-1 mt-6">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="mb-20">
                                <div class="body-title mb-10">Nouveau mot de passe</div>
                                <div class="password flex items-center w-full">
                                    <input class="password-input w-full flex-grow" type="password" name="password" placeholder="Nouveau mot de passe" required>
                                    <span class="show-pass"><i class="icon-eye-off hide"></i><i class="icon-eye view"></i></span>
                                </div>
                                @error('password')
                                    <div class="text-tiny tf-color-1 mt-6">{{ $message }}</div>
                                @enderror
                            </fieldset>
                            <fieldset class="mb-24">
                                <div class="body-title mb-10">Confirmer le mot de passe</div>
                                <div class="password flex items-center w-full">
                                    <input class="password-input w-full flex-grow" type="password" name="password_confirmation" placeholder="Confirmer" required>
                                    <span class="show-pass"><i class="icon-eye-off hide"></i><i class="icon-eye view"></i></span>
                                </div>
                            </fieldset>
                            <button type="submit" class="tf-button w180">Mettre à jour</button>
                        </form>
                    </div>
                </div>
                <!-- /Change Password -->
                <!-- /setting -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        <!-- /bottom-page -->
    </div>
@endsection
