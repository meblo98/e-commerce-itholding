@extends('admin.layouts.app')

@section('title', 'Liste des marques')

@section('content')
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Toutes les marques</h3>
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
                            <div class="text-tiny">Marques</div>
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

                @if (session('success'))
                    <div class="alert alert-success mb-20">
                        {{ session('success') }}
                    </div>
                @endif

                <style>
                    /* Contraste clair pour les cartes marques, adapté au thème */
                    .marque-card {
                        border: 1px solid var(--card-border, rgba(17, 24, 39, 0.08));
                        background: var(--card-bg, #fff);
                        transition: border-color .2s ease, box-shadow .2s ease, transform .12s ease;
                    }
                    .marque-card:hover {
                        box-shadow: 0 6px 18px rgba(0,0,0,.08);
                        transform: translateY(-1px);
                        border-color: var(--card-border-hover, rgba(17,24,39,.18));
                    }
                    .marque-card .logo-wrap {
                        border: 1px solid var(--logo-border, rgba(17, 24, 39, 0.06));
                        background: var(--logo-bg, #f7f7f9);
                    }
                    /* Light theme variables */
                    body:not(.dark-theme) .marque-card {
                        --card-border: rgba(17, 24, 39, 0.10);
                        --card-border-hover: rgba(17, 24, 39, 0.18);
                        --card-bg: #ffffff;
                        --logo-border: rgba(17, 24, 39, 0.06);
                        --logo-bg: #f7f7f9;
                    }
                    /* Dark theme variables */
                    body.dark-theme .marque-card {
                        --card-border: rgba(255, 255, 255, 0.16);
                        --card-border-hover: rgba(255, 255, 255, 0.24);
                        --card-bg: rgba(255, 255, 255, 0.02);
                        --logo-border: rgba(255, 255, 255, 0.12);
                        --logo-bg: rgba(255, 255, 255, 0.04);
                    }
                </style>

                <!-- all-marque -->
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <div class="show">
                                <div class="text-tiny">{{ $marques->count() }} marques</div>
                            </div>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.marques.create') }}">
                            <i class="icon-plus"></i>Ajouter
                        </a>
                    </div>
                    <div class="grid-marques" style="display:grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px;">
                        @forelse ($marques as $marque)
                            <div class="marque-card wg-box" style="display:flex; flex-direction:column; align-items:center; gap:12px; padding:16px;">
                                <div class="logo-wrap" style="width:120px; height:120px; display:flex; align-items:center; justify-content:center; border-radius:8px;">
                                    @if($marque->logo)
                                        <img class="brand-logo" src="{{ asset('storage/' . $marque->logo) }}"
                                             data-light="{{ asset('storage/' . $marque->logo) }}"
                                             data-dark="{{ asset('storage/' . $marque->logo) }}"
                                             alt="{{ $marque->nom }}" style="max-width:100%; max-height:100%; object-fit:contain;">
                                    @else
                                        <i class="icon-image" style="font-size: 32px; opacity: 0.6;"></i>
                                    @endif
                                </div>
                                <div class="body-title" style="text-align:center;">{{ $marque->nom }}</div>
                                <div class="list-icon-function" style="display:flex; gap:10px; justify-content:center;">
                                    <a href="{{ route('admin.marques.edit', $marque) }}" class="item edit" title="Éditer">
                                        <i class="icon-edit-3"></i>
                                    </a>
                                    <form action="{{ route('admin.marques.destroy', $marque) }}" method="POST"
                                        class="js-delete-form" data-name="{{ $marque->nom }}"
                                        style="display: inline-block; margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item trash" title="Supprimer">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20" style="grid-column: 1 / -1;">
                                <p class="body-text">Aucune marque trouvée</p>
                                <a href="{{ route('admin.marques.create') }}" class="tf-button style-1 mt-10">
                                    <i class="icon-plus"></i>Créer votre première marque
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- /all-marque -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <div id="delete-confirm-modal" class="delete-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:9999;">
        <div style="background:#fff; padding:24px; border-radius:12px; max-width:420px; width:90%; box-shadow:0 10px 40px rgba(0,0,0,0.2);">
            <h4 class="body-title" style="margin-bottom:12px; color:#111;">Confirmer la suppression</h4>
            <p class="body-text" style="margin-bottom:16px; color:#111;">Supprimer <span data-role="cat-name" style="font-weight:600; color:#111;">cette marque</span> ? Cette action est définitive.</p>
            <div style="display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" data-role="cancel" class="tf-button" style="background:#e5e7eb; color:#111;">Annuler</button>
                <button type="button" data-role="confirm" class="tf-button style-1">Supprimer</button>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('delete-confirm-modal');
            const nameSpan = modal.querySelector('[data-role="cat-name"]');
            const cancelBtn = modal.querySelector('[data-role="cancel"]');
            const confirmBtn = modal.querySelector('[data-role="confirm"]');
            let pendingForm = null;

            document.querySelectorAll('.js-delete-form').forEach((form) => {
                form.addEventListener('submit', (event) => {
                    event.preventDefault();
                    pendingForm = form;
                    nameSpan.textContent = form.dataset.name || 'cette marque';
                    modal.style.display = 'flex';
                });
            });

            const closeModal = () => {
                modal.style.display = 'none';
                pendingForm = null;
            };

            cancelBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (event) => {
                if (event.target === modal) closeModal();
            });
            confirmBtn.addEventListener('click', () => {
                if (pendingForm) pendingForm.submit();
            });
        });
    </script>
@endpush
    {{-- <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>All Attributes</h3>
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
                                <div class="text-tiny">Attributes</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">All attributes</div>
                        </li>
                    </ul>
                </div>
                <!-- all-attribute -->
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <div class="show">
                                <div class="text-tiny">Showing</div>
                                <div class="select">
                                    <select class="">
                                        <option>10</option>
                                        <option>20</option>
                                        <option>30</option>
                                    </select>
                                </div>
                                <div class="text-tiny">entries</div>
                            </div>
                            <form class="form-search">
                                <fieldset class="name">
                                    <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                                        value="" aria-required="true" required="">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href="add-attributes.html"><i class="icon-plus"></i>Add new</a>
                    </div>
                    <div class="wg-table table-all-attribute">
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">Category</div>
                            </li>
                            <li>
                                <div class="body-title">Value</div>
                            </li>
                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column">
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Color</a>
                                </div>
                                <div class="body-text">Blue, green, white</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Size</a>
                                </div>
                                <div class="body-text">S, M, L, XL</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Material</a>
                                </div>
                                <div class="body-text">Cotton, Polyster</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Style</a>
                                </div>
                                <div class="body-text">Classic, mordern, ethnic, western</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Meat Type</a>
                                </div>
                                <div class="body-text">Fresh, Frozen, Marinated</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Weight</a>
                                </div>
                                <div class="body-text">1kg, 2kg, 3kg, over 5kg</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Packaging</a>
                                </div>
                                <div class="body-text">Plastic box, paper, nylon, tin cans</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Kind of food</a>
                                </div>
                                <div class="body-text">Dried food, wet food, supplementary food</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Milk</a>
                                </div>
                                <div class="body-text">Formula milk, fresh milk</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="attribute-item flex items-center justify-between gap20">
                                <div class="name">
                                    <a href="add-attributes.html" class="body-title-2">Combo</a>
                                </div>
                                <div class="body-text">Cat food, dog food</div>
                                <div class="list-icon-function">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="item edit">
                                        <i class="icon-edit-3"></i>
                                    </div>
                                    <div class="item trash">
                                        <i class="icon-trash-2"></i>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Showing 10 entries</div>
                        <ul class="wg-pagination">
                            <li>
                                <a href="#"><i class="icon-chevron-left"></i></a>
                            </li>
                            <li>
                                <a href="#">1</a>
                            </li>
                            <li class="active">
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /all-attribute -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        <div class="bottom-page">
            <div class="body-text">Copyright © 2024 Remos. Design with</div>
            <i class="icon-heart"></i>
            <div class="body-text">by <a href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All rights
                reserved.</div>
        </div>
        <!-- /bottom-page -->
    </div> --}}
@endsection
