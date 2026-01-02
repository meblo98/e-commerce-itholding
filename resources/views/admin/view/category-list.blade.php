@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Toutes les catégories</h3>
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
                            <div class="text-tiny">Catégories</div>
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

                <!-- all-category -->
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <div class="show">
                                <div class="text-tiny">{{ $categories->count() }} catégories</div>
                            </div>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.categories.create') }}">
                            <i class="icon-plus"></i>Ajouter
                        </a>
                    </div>
                    <div class="wg-table table-all-category">
                        <ul class="table-title mb-14"
                            style="display:grid; grid-template-columns: 80px 1fr 1.5fr 120px; column-gap: 20px; align-items: center;">
                            <li>
                                <div class="body-title">ID</div>
                            </li>
                            <li>
                                <div class="body-title">Titre</div>
                            </li>
                            <li>
                                <div class="body-text">Description</div>
                            </li>
                            <li style="text-align: center;">
                                <div class="body-title">Actions</div>
                            </li>
                        </ul>
                        <div class="divider mb-14"></div>

                        @forelse ($categories as $categorie)
                            <ul class="mb-14"
                                style="display:grid; grid-template-columns: 80px 1fr 1.5fr 120px; column-gap: 20px; align-items: center;">
                                <li>
                                    <div class="body-title-2">#{{ $categorie->id }}</div>
                                </li>
                                <li>
                                    <div class="body-title">{{ $categorie->titre }}</div>
                                </li>
                                <li>
                                    <div class="body-text">{{ Str::limit($categorie->description ?? '-', 100) }}</div>
                                </li>
                                <li>
                                    <div class="list-icon-function" style="justify-content: center; gap: 10px;">
                                        <a href="{{ route('admin.categories.edit', $categorie) }}" class="item edit" title="Éditer">
                                            <i class="icon-edit-3"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $categorie) }}" method="POST"
                                            class="js-delete-form" data-name="{{ $categorie->titre }}"
                                            style="display: inline-block; margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item trash" title="Supprimer">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                            <div class="divider"></div>
                        @empty
                            <div class="text-center py-20">
                                <p class="body-text">Aucune catégorie trouvée</p>
                                <a href="{{ route('admin.categories.create') }}" class="tf-button style-1 mt-10">
                                    <i class="icon-plus"></i>Créer votre première catégorie
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- /all-category -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        <!-- /bottom-page -->
    </div>
    <div id="delete-confirm-modal" class="delete-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.45); align-items:center; justify-content:center; z-index:9999;">
        <div style="background:#fff; padding:24px; border-radius:12px; max-width:420px; width:90%; box-shadow:0 10px 40px rgba(0,0,0,0.2);">
            <h4 class="body-title" style="margin-bottom:12px;">Confirmer la suppression</h4>
            <p class="body-text" style="margin-bottom:16px;">Supprimer <span data-role="cat-name" style="font-weight:600;">cette catégorie</span> ? Cette action est définitive.</p>
            <div style="display:flex; justify-content:flex-end; gap:12px;">
                <button type="button" data-role="cancel" class="tf-button" style="background:#e5e7eb; color:#111;">Annuler</button>
                <button type="button" data-role="confirm" class="tf-button style-1">Supprimer</button>
            </div>
        </div>
    </div>
@endsection

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
                    nameSpan.textContent = form.dataset.name || 'cette catégorie';
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
