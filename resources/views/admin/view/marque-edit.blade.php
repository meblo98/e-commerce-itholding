@extends('admin.layouts.app')

@section('title', 'Ajouter une marque')

@section('content')
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Modifier la marque</h3>
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
                            <div class="text-tiny">Modifier marque</div>
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

                <!-- edit-marque -->
                <div class="wg-box">
                    <form action="{{ route('admin.marques.update', $marque) }}" method="POST" enctype="multipart/form-data" class="form-new-product form-style-1" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                        @csrf
                        @method('PUT')
                        <fieldset class="name">
                            <div class="body-title">Nom de la marque <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" placeholder="Nom de la marque" name="nom" tabindex="0"
                                value="{{ old('nom', $marque->nom) }}" aria-required="true" required>
                        </fieldset>
                        <fieldset class="upload">
                            <div class="body-title mb-10">Logo de la marque</div>
                            @if($marque->logo)
                                <div class="mb-10" style="display:flex; align-items:center; gap:12px;">
                                    <img class="brand-logo" src="{{ asset('storage/' . $marque->logo) }}"
                                         data-light="{{ asset('storage/' . $marque->logo) }}"
                                         data-dark="{{ asset('storage/' . $marque->logo) }}"
                                         alt="{{ $marque->nom }}" style="max-width: 120px; max-height: 120px; object-fit: contain; border: 1px solid rgba(17,24,39,0.08); border-radius: 4px; padding: 8px;">
                                </div>
                            @endif
                            <div class="upload-image mb-16" style="width: 100%;">
                                <div class="item up-load" style="width: 100%;">
                                    <label class="uploadfile" for="upload-logo" style="width: 100%;">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">Déposez votre image ici ou sélectionnez <span class="tf-color">cliquez pour parcourir</span></span>
                                        <input type="file" id="upload-logo" name="logo" accept="image/*">
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
                <!-- /edit-marque -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
    </div>

@endsection
