@extends('admin.layouts.app')

@section('title', 'Liste des produits')

@section('content')

    @include('admin.partials.header')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Product List</h3>
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
                                <div class="text-tiny">Ecommerce</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Product List</div>
                        </li>
                    </ul>
                </div>
                <!-- product-list -->
                <div class="wg-box">
                    <div class="title-box">
                        <i class="icon-coffee"></i>
                        <div class="body-text">Tip search by Product ID: Each product is provided with a unique ID, which
                            you can rely on to find the exact product you need.</div>
                    </div>
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
                        <a class="tf-button style-1 w208" href="{{ route('admin.produits.create') }}"><i class="icon-plus"></i>Ajouter produit</a>
                    </div>
                    <div class="wg-table table-product-list">
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">image</div>
                            </li>
                            <li>
                                <div class="body-title">id</div>
                            </li>
                            <li>
                                <div class="body-title">nom</div>
                            </li>
                            <li>
                                <div class="body-title">description</div>
                            </li>
                            <li>
                                <div class="body-title">categorie_id</div>
                            </li>
                            <li>
                                <div class="body-title">marque</div>
                            </li>
                            <li>
                                <div class="body-title">stock</div>
                            </li>
                            <li>
                                <div class="body-title">active</div>
                            </li>
                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column">
                            @forelse($produits as $produit)
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        @php($img = $produit->image ? asset('storage/'.$produit->image) : asset('assets/img/placeholder.png'))
                                        <img src="{{ $img }}" alt="{{ $produit->nom }}">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="body-text">#{{ $produit->id }}</div>
                                        <div class="name">
                                            <span class="body-title-2">{{ $produit->nom }}</span>
                                        </div>
                                        <div class="body-text" style="max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $produit->description }}
                                        </div>
                                        <div class="body-text">{{ $produit->categorie_id }}</div>
                                        <div class="body-text">{{ $produit->marque->nom ?? '—' }}</div>
                                        <div class="body-text">{{ $produit->stock }}</div>
                                        <div>
                                            @if($produit->active)
                                                <div class="block-available">Actif</div>
                                            @else
                                                <div class="block-not-available">Inactif</div>
                                            @endif
                                        </div>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.produits.edit', $produit) }}" class="item edit"><i class="icon-edit-3"></i></a>
                                            <form method="POST" action="{{ route('admin.produits.destroy', $produit) }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="item trash js-delete-btn" style="border:none; background:none; cursor:pointer;"><i class="icon-trash-2"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="product-item gap14">
                                    <div class="flex items-center justify-center w-full py-20 body-text">Aucun produit trouvé</div>
                                </li>
                            @endforelse
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
                <!-- /product-list -->
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        {{-- <div class="bottom-page">
            <div class="body-text">Copyright © 2024 Remos. Design with</div>
            <i class="icon-heart"></i>
            <div class="body-text">by <a href="https://themeforest.net/user/themesflat/portfolio">Themesflat</a> All rights
                reserved.</div>
        </div> --}}
        <!-- /bottom-page -->

                <!-- Modal confirmation suppression -->
                <div id="deleteConfirmModal" style="position:fixed; inset:0; background:rgba(0,0,0,.4); display:none; align-items:center; justify-content:center; z-index:999;">
                    <div id="deleteModalBox" class="wg-box" style="max-width:420px; width:90%; background:#fff; color:#111827; border-radius:12px; padding:20px;">
                        <h4 id="deleteModalTitle" class="mb-10">Confirmer la suppression</h4>
                        <p id="deleteModalText" class="body-text mb-20">Cette action est irréversible. Supprimer ce produit ?</p>
                                <div class="flex items-center justify-end gap10">
                                        <button type="button" class="tf-button style-2" id="deleteCancelBtn">Annuler</button>
                                        <button type="button" class="tf-button danger" id="deleteConfirmBtn"><i class="icon-trash-2"></i> Supprimer</button>
                                </div>
                        </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function(){
                        var modal = document.getElementById('deleteConfirmModal');
                        var confirmBtn = document.getElementById('deleteConfirmBtn');
                        var cancelBtn = document.getElementById('deleteCancelBtn');
                        var box = document.getElementById('deleteModalBox');
                        var title = document.getElementById('deleteModalTitle');
                        var text = document.getElementById('deleteModalText');
                        var currentDeleteForm = null;

                        function isDark(){
                            var de = document.documentElement;
                            var body = document.body;
                            return (
                                de.classList.contains('dark') || body.classList.contains('dark') ||
                                (de.getAttribute('data-theme') === 'dark' || body.getAttribute('data-theme') === 'dark')
                            );
                        }

                        function applyModalTheme(){
                            if(isDark()){
                                box.style.background = '#111827';
                                box.style.color = '#F9FAFB';
                                title.style.color = '#F9FAFB';
                                text.style.color = '#D1D5DB';
                            } else {
                                box.style.background = '#FFFFFF';
                                box.style.color = '#111827';
                                title.style.color = '#111827';
                                text.style.color = '#4B5563';
                            }
                        }

                        function closeModal(){
                            modal.style.display = 'none';
                            currentDeleteForm = null;
                        }

                        // Attacher le listener à tous les boutons de suppression
                        document.querySelectorAll('.js-delete-btn').forEach(function(btn){
                            btn.addEventListener('click', function(e){
                                e.preventDefault();
                                e.stopPropagation();
                                currentDeleteForm = btn.closest('form');
                                applyModalTheme();
                                modal.style.display = 'flex';
                            });
                        });

                        // Bouton Annuler
                        cancelBtn.addEventListener('click', function(){
                            closeModal();
                        });

                        // Bouton Supprimer
                        confirmBtn.addEventListener('click', function(){
                            if(!currentDeleteForm) return;
                            
                            var csrfToken = currentDeleteForm.querySelector('[name="_token"]').value;
                            var url = currentDeleteForm.action;

                            // Créer FormData pour envoyer les données
                            var formData = new FormData();
                            formData.append('_token', csrfToken);
                            formData.append('_method', 'DELETE');

                            // Faire une requête POST avec _method=DELETE
                            fetch(url, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: formData,
                                redirect: 'follow'
                            })
                            .then(function(response){
                                if(response.status >= 200 && response.status < 400){
                                    window.location.href = '{{ route("admin.produits.index") }}';
                                } else {
                                    alert('Erreur lors de la suppression: ' + response.statusText);
                                    closeModal();
                                }
                            })
                            .catch(function(error){
                                alert('Une erreur est survenue: ' + error);
                                closeModal();
                            });
                        });

                        // Fermer au clic sur le fond
                        modal.addEventListener('click', function(e){
                            if(e.target === modal){
                                closeModal();
                            }
                        });
                    });
                </script>
        </div>
@endsection
