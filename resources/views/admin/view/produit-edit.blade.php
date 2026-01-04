@extends('admin.layouts.app')

@section('title', 'Éditer Produit')

@section('content')

    @include('admin.partials.header')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Modifier le produit</h3>
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
                            <div class="text-tiny">Modifier produit</div>
                        </li>
                    </ul>
                </div>

                <!-- form-edit-product -->
                <form action="{{ route('admin.produits.update', $produit) }}" method="POST" enctype="multipart/form-data" class="tf-section-2 form-edit-product" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                    @csrf
                    @method('PUT')

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
                                value="{{ old('nom', $produit->nom) }}" aria-required="true" required="">
                            <div class="text-tiny">Entrez un nom explicite pour le produit</div>
                        </fieldset>
                        <div class="gap22 cols">
                            <fieldset class="category">
                                <div class="body-title mb-10">Catégorie <span class="tf-color-1">*</span></div>
                                <div class="select">
                                    <select name="categorie_id" required>
                                        <option value="">Choisir catégorie</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('categorie_id', $produit->categorie_id) == $cat->id ? 'selected' : '' }}>{{ $cat->titre }}</option>
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
                                            <option value="{{ $marque->id }}" {{ old('marque_id', $produit->marque_id) == $marque->id ? 'selected' : '' }}>{{ $marque->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        <div class="gap22 cols">
                            <fieldset class="stock">
                                <div class="body-title mb-10">Stock <span class="tf-color-1">*</span></div>
                                <input class="flex-grow mb-10" type="number" placeholder="Quantité en stock" name="stock" tabindex="0"
                                    value="{{ old('stock', $produit->stock) }}" aria-required="true" required="" min="0">
                            </fieldset>
                            <fieldset class="price">
                                <div class="body-title mb-10">Prix (FCFA) <span class="tf-color-1">*</span></div>
                                <input class="flex-grow mb-10" type="number" placeholder="Prix du produit" name="prix" tabindex="0"
                                    value="{{ old('prix', $produit->prix) }}" aria-required="true" required="" min="0">
                            </fieldset>
                        </div>
                        <fieldset class="description">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea class="mb-10" name="description" placeholder="Description complète du produit" tabindex="0"
                                aria-required="true" required="">{{ old('description', $produit->description) }}</textarea>
                            <div class="text-tiny">Décrivez les détails et caractéristiques du produit</div>
                        </fieldset>
                        <fieldset class="active">
                            <div class="body-title mb-10">Actif</div>
                            <label class="checkbox">
                                <input type="checkbox" name="active" value="1" {{ old('active', $produit->active) ? 'checked' : '' }}>
                                <span>Produit actif dans la boutique</span>
                            </label>
                        </fieldset>
                    </div>

                    <div class="wg-box">
                        <fieldset class="upload">
                            <div class="body-title mb-10">Images du produit</div>

                            @if($produit->images->count() > 0)
                                <div class="mb-20">
                                    <div class="body-title mb-10">Images actuelles</div>
                                    <div class="upload-image mb-16" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px;">
                                        @foreach($produit->images as $image)
                                            <div class="item" style="position: relative;">
                                                <img src="{{ asset('storage/' . $image->chemin) }}" alt="Image" style="width: 120px; height: 120px; object-fit: cover; border-radius: 4px;">
                                                <form method="POST" action="{{ route('admin.produits.image.delete', $image) }}" style="position: absolute; top: 0; right: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-delete" style="background: rgba(255,0,0,0.7); border: none; padding: 4px 8px; cursor: pointer; color: white; border-radius: 0 0 0 4px;" title="Supprimer">
                                                        <i class="icon-trash-2" style="font-size: 12px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="body-title mb-10">Ajouter des images</div>
                            <div class="upload-image mb-16" id="preview-images" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 12px;"></div>
                            <div class="upload-image mb-16" style="width: 100%;">
                                <div class="item up-load" style="width: 100%;">
                                    <label class="uploadfile" for="product-images" style="width: 100%;">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">Déposez vos images ici ou sélectionnez <span class="tf-color">cliquez pour parcourir</span></span>
                                        <input type="file" id="product-images" name="images[]" accept="image/*" multiple>
                                    </label>
                                </div>
                            </div>
                            <div class="body-text">Les images doivent être en format JPEG, PNG ou GIF (max 2MB)</div>
                        </fieldset>
                        <div class="cols gap10">
                            <button class="tf-button w-full" type="submit">Enregistrer modifications</button>
                            <a href="{{ route('admin.produits.index') }}" class="tf-button style-2 w-full">Annuler</a>
                        </div>
                    </div>
                </form>
                <!-- /form-edit-product -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->

        <!-- /bottom-page -->
    </div>

    <script>
        document.getElementById('product-images').addEventListener('change', function(e) {
            const preview = document.getElementById('preview-images');
            preview.innerHTML = '';

            Array.from(e.target.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const div = document.createElement('div');
                    div.className = 'item';
                    div.innerHTML = '<img src="' + event.target.result + '" alt="Aperçu" style="max-width: 120px; max-height: 120px; object-fit: cover; border-radius: 4px;">';
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

@endsection
