@extends('admin.layouts.app')

@section('title', 'categorie ')

@section('content')

    @include('admin.partials.header')

    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Modification de la catégorie</h3>
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
                            <a href="#">
                                <div class="text-tiny">Category</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">New category</div>
                        </li>
                    </ul>
                </div>
                <!-- new-category -->
                <div class="wg-box">
                    <form action="{{ route('admin.categories.update', $categorie) }}" method="POST" class="form-new-product form-style-1" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
                        @csrf
                        @method('PUT')
                        <fieldset class="name">
                            <div class="body-title">Nom de la catégorie <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" placeholder="Nom de la catégorie" name="titre" tabindex="0"
                                value="{{ old('titre', $categorie->titre) }}" aria-required="true" required>
                        </fieldset>
                        <fieldset class="description">
                            <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                            <textarea class="mb-10" name="description" placeholder="Description" tabindex="0"
                                aria-required="true" required="">{{ old('description', $categorie->description) }}</textarea>
                        </fieldset>
                        <div class="bot">
                            <div></div>
                            <button class="tf-button w208" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <!-- /new-category -->
            </div>
            <!-- /main-content-wrap -->
        </div>
    </div>
@endsection
