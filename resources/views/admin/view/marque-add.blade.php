@extends('admin.layouts.app')

@section('title', 'Ajouter une marque')

@section('content')
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Ajouter une marque</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ url('/admin') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('admin.marques.index') }}">
                                <div class="text-tiny">Marques</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Nouvelle marque</div>
                        </li>
                    </ul>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-20">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- new-marque -->
                <div class="wg-box">
                    <form action="{{ route('admin.marques.store') }}" method="POST" enctype="multipart/form-data" class="form-new-product form-style-1" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                        @csrf
                        <fieldset class="name">
                            <div class="body-title">Nom de la marque <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" placeholder="Nom de la marque" name="nom" tabindex="0"
                                value="{{ old('nom') }}" aria-required="true" required>
                        </fieldset>
                        <fieldset class="upload">
                            <div class="body-title mb-10">Logo de la marque <span class="tf-color-1">*</span></div>
                            <div class="upload-image mb-16" style="width: 100%;">
                                <div class="item up-load" style="width: 100%;">
                                    <label class="uploadfile" for="upload-logo" style="width: 100%;">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">Déposez votre image ici ou sélectionnez <span class="tf-color">cliquez pour parcourir</span></span>
                                        <input type="file" id="upload-logo" name="logo" accept="image/*" required>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="bot">
                            <div></div>
                            <button class="tf-button w208" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <!-- /new-marque -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
    </div>

@endsection
