@extends('admin.layouts.app')

@section('title', 'Produit')

@section('content')

    @include('admin.partials.header')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Ajouter un produit</h3>
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
                            <a href="{{ route('admin.produits.index') }}">
                                <div class="text-tiny">Produits</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Ajouter produit</div>
                        </li>
                    </ul>
                </div>
                <!-- form-add-product -->
                <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data" class="tf-section-2 form-add-product" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                    @csrf

                    @if($errors->any())
                        <div class="wg-box alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="wg-box">
                        <fieldset class="name">
                            <div class="body-title mb-10">Nom du produit <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Nom du produit" name="nom" tabindex="0"
                                value="{{ old('nom') }}" aria-required="true" required="">
                            <div class="text-tiny">Entrez un nom explicite pour le produit</div>
                        </fieldset>
                        <div class="gap22 cols">
                            <fieldset class="category">
                                <div class="body-title mb-10">Catégorie <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select name="categorie_id" required>
                                        <option value="">Choisir catégorie</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>{{ $cat->titre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="brand">
                                <div class="body-title mb-10">Marque (optionnel)</div>
                                <div class="select">
                                    <select name="marque_id">
                                        <option value="">Sans marque</option>
                                        @foreach($marques as $marque)
                                            <option value="{{ $marque->id }}" {{ old('marque_id') == $marque->id ? 'selected' : '' }}>{{ $marque->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="gap22 cols">
                            <fieldset class="stock">
                                <div class="body-title mb-10">Stock <span class="tf-color-1">*</span></div>
                                <input class="flex-grow mb-10" type="number" placeholder="Quantité en stock" name="stock" tabindex="0"
                                    value="{{ old('stock', 0) }}" aria-required="true" required="" min="0">
                            </fieldset>
                            <fieldset class="price">
                                <div class="body-title mb-10">Prix (FCFA) <span class="tf-color-1">*</span></div>
                                <input class="flex-grow mb-10" type="number" placeholder="Prix du produit" name="prix" tabindex="0"
                                    value="{{ old('prix', 0) }}" aria-required="true" required="" min="0">
                            </fieldset>
                        </div>
                        <fieldset class="description">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea class="mb-10" name="description" placeholder="Description complète du produit" tabindex="0"
                                aria-required="true" required="">{{ old('description') }}</textarea>
                            <div class="text-tiny">Décrivez les détails et caractéristiques du produit</div>
                        </fieldset>
                        <fieldset class="active">
                            <div class="body-title mb-10">Actif</div>
                            <label class="checkbox">
                                <input type="checkbox" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }}>
                                <span>Produit actif dans la boutique</span>
                            </label>
                        </fieldset>
                    </div>
                    <div class="wg-box">
                        <fieldset class="upload">
                            <div class="body-title mb-10">Images du produit <span class="tf-color-1">*</span></div>
                            <div class="upload-image mb-16" id="preview-images" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px;"></div>
                            <div class="upload-image mb-16" style="width: 100%;">
                                <div class="item up-load" style="width: 100%;">
                                    <label class="uploadfile" for="product-images" style="width: 100%;">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">Déposez vos images ici ou sélectionnez <span class="tf-color">cliquez pour parcourir</span></span>
                                        <input type="file" id="product-images" name="images[]" accept="image/*" multiple required>
                                    </label>
                                </div>
                            </div>
                            <div class="body-text">Vous devez ajouter au moins 1 image. Les images doivent être en format JPEG, PNG ou GIF (max 2MB)</div>
                        </fieldset>
                        <div class="cols gap10">
                            <button class="tf-button w-full" type="submit">Créer produit</button>
                            <a href="{{ route('admin.produits.index') }}" class="tf-button style-2 w-full">Annuler</a>
                        </div>
                    </div>
                </form>
                <!-- /form-add-product -->

                <script>
                    document.getElementById('product-images').addEventListener('change', function(e) {
                        const preview = document.getElementById('preview-images');
                        preview.innerHTML = '';

                        Array.from(e.target.files).forEach((file, index) => {
                            const reader = new FileReader();
                            reader.onload = function(event) {
                                const div = document.createElement('div');
                                div.className = 'item';
                                div.innerHTML = '<img src="' + event.target.result + '" alt="Aperçu" style="max-width: 120px; max-height: 120px; object-fit: cover;">';
                                preview.appendChild(div);
                            };
                            reader.readAsDataURL(file);
                        });
                    });
                </script>
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->

        <!-- /bottom-page -->
    </div>

@endsection
