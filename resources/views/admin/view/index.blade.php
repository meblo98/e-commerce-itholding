@extends('admin.layouts.app')

@section('title', 'Page d\'accueil')

@section('content')
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="tf-section-2 mb-30">
                    <div class="flex gap20 flex-wrap-mobile">
                        <div class="w-half">
                            <!-- chart-default -->
                            <div class="wg-chart-default mb-20">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap14">
                                        <div class="image">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                                viewBox="0 0 48 52" fill="none">
                                                <path opacity="0.08"
                                                    d="M19.1086 2.12943C22.2027 0.343099 26.0146 0.343099 29.1086 2.12943L42.4913 9.85592C45.5853 11.6423 47.4913 14.9435 47.4913 18.5162V33.9692C47.4913 37.5418 45.5853 40.8431 42.4913 42.6294L29.1086 50.3559C26.0146 52.1423 22.2027 52.1423 19.1086 50.3559L5.72596 42.6294C2.63194 40.8431 0.725956 37.5418 0.725956 33.9692V18.5162C0.725956 14.9435 2.63195 11.6423 5.72596 9.85592L19.1086 2.12943Z"
                                                    fill="url(#paint0_linear_53_110)" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_53_110" x1="-43.532" y1="-34.3465"
                                                        x2="37.6769" y2="43.9447" gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#92BCFF" />
                                                        <stop offset="1" stop-color="#2377FC" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <i class="icon-shopping-bag"></i>
                                        </div>
                                        <div>
                                            <div class="body-text mb-2">Total Produits</div>
                                            <h4>{{ number_format($totalProduits) }}</h4>
                                        </div>
                                    </div>
                                    <div class="box-icon-trending up">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">1.56%</div>
                                    </div>
                                </div>
                                <div class="wrap-chart">
                                    <div id="line-chart-1"></div>
                                </div>
                            </div>
                            <!-- /chart-default -->
                            <!-- chart-default -->
                            <div class="wg-chart-default mb-20">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap14">
                                        <div class="image">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                                viewBox="0 0 48 52" fill="none">
                                                <path opacity="0.08"
                                                    d="M19.1086 2.12943C22.2027 0.343099 26.0146 0.343099 29.1086 2.12943L42.4913 9.85592C45.5853 11.6423 47.4913 14.9435 47.4913 18.5162V33.9692C47.4913 37.5418 45.5853 40.8431 42.4913 42.6294L29.1086 50.3559C26.0146 52.1423 22.2027 52.1423 19.1086 50.3559L5.72596 42.6294C2.63194 40.8431 0.725956 37.5418 0.725956 33.9692V18.5162C0.725956 14.9435 2.63195 11.6423 5.72596 9.85592L19.1086 2.12943Z"
                                                    fill="url(#paint0_linear_53_110)" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_53_110" x1="-43.532" y1="-34.3465"
                                                        x2="37.6769" y2="43.9447" gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#92BCFF" />
                                                        <stop offset="1" stop-color="#2377FC" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <i class="icon-dollar-sign"></i>
                                        </div>
                                        <div>
                                            <div class="body-text mb-2">Total Catégories</div>
                                            <h4>{{ number_format($totalCategories) }}</h4>
                                        </div>
                                    </div>
                                    <div class="box-icon-trending down">
                                        <i class="icon-trending-down"></i>
                                        <div class="body-title number">1.56%</div>
                                    </div>
                                </div>
                                <div class="wrap-chart">
                                    <div id="line-chart-2"></div>
                                </div>
                            </div>
                            <!-- /chart-default -->
                            <!-- chart-default -->
                            <div class="wg-chart-default mb-20">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap14">
                                        <div class="image">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                                viewBox="0 0 48 52" fill="none">
                                                <path opacity="0.08"
                                                    d="M19.1086 2.12943C22.2027 0.343099 26.0146 0.343099 29.1086 2.12943L42.4913 9.85592C45.5853 11.6423 47.4913 14.9435 47.4913 18.5162V33.9692C47.4913 37.5418 45.5853 40.8431 42.4913 42.6294L29.1086 50.3559C26.0146 52.1423 22.2027 52.1423 19.1086 50.3559L5.72596 42.6294C2.63194 40.8431 0.725956 37.5418 0.725956 33.9692V18.5162C0.725956 14.9435 2.63195 11.6423 5.72596 9.85592L19.1086 2.12943Z"
                                                    fill="url(#paint0_linear_53_110)" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_53_110" x1="-43.532" y1="-34.3465"
                                                        x2="37.6769" y2="43.9447" gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#92BCFF" />
                                                        <stop offset="1" stop-color="#2377FC" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <i class="icon-file"></i>
                                        </div>
                                        <div>
                                            <div class="body-text mb-2">Total Marques</div>
                                            <h4>{{ number_format($totalMarques) }}</h4>
                                        </div>
                                    </div>
                                    <div class="box-icon-trending">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">0.00%</div>
                                    </div>
                                </div>
                                <div class="wrap-chart">
                                    <div id="line-chart-3"></div>
                                </div>
                            </div>
                            <!-- /chart-default -->
                            <!-- chart-default -->
                            <div class="wg-chart-default">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap14">
                                        <div class="image">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="52"
                                                viewBox="0 0 48 52" fill="none">
                                                <path opacity="0.08"
                                                    d="M19.1086 2.12943C22.2027 0.343099 26.0146 0.343099 29.1086 2.12943L42.4913 9.85592C45.5853 11.6423 47.4913 14.9435 47.4913 18.5162V33.9692C47.4913 37.5418 45.5853 40.8431 42.4913 42.6294L29.1086 50.3559C26.0146 52.1423 22.2027 52.1423 19.1086 50.3559L5.72596 42.6294C2.63194 40.8431 0.725956 37.5418 0.725956 33.9692V18.5162C0.725956 14.9435 2.63195 11.6423 5.72596 9.85592L19.1086 2.12943Z"
                                                    fill="url(#paint0_linear_53_110)" />
                                                <defs>
                                                    <linearGradient id="paint0_linear_53_110" x1="-43.532" y1="-34.3465"
                                                        x2="37.6769" y2="43.9447" gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#92BCFF" />
                                                        <stop offset="1" stop-color="#2377FC" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <i class="icon-users"></i>
                                        </div>
                                        <div>
                                            <div class="body-text mb-2">Total Utilisateurs</div>
                                            <h4>{{ number_format($totalUsers) }}</h4>
                                        </div>
                                    </div>
                                    <div class="box-icon-trending up">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">1.56%</div>
                                    </div>
                                </div>
                                <div class="wrap-chart">
                                    <div id="line-chart-4"></div>
                                </div>
                            </div>
                            <!-- /chart-default -->
                        </div>
                        <!-- category -->
                        <div class="wg-box w-half">
                            <div class="flex items-center justify-between">
                                <h5>Produits par catégorie</h5>
                                <div class="dropdown default">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="javascript:void(0);">Cette semaine</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Semaine dernière</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="flex gap10 justify-between flex-wrap">
                                <div>
                                    <div class="text-tiny mb-2">Total {{ date('d M, Y') }}</div>
                                    <div class="flex items-center gap10">
                                        <h4>{{ number_format($totalProduits) }}</h4>
                                        <div class="box-icon-trending up">
                                            <i class="icon-trending-up"></i>
                                            <div class="body-title number">{{ number_format($totalCategories) }} catégories</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $donutData = $categoriesWithCount->take(6)->map(function($c) {
                                    return ['label' => $c->titre, 'value' => (int)($c->produits_count ?? 0)];
                                })->values();
                            @endphp
                            <div id="morris-donut-1" class="text-center" data-donut='@json($donutData)'></div>
                            <div class="flex flex-column gap-3">
                                @foreach($categoriesWithCount->take(6) as $index => $categorie)
                                    @if($index % 3 == 0)
                                        <div class="flex gap20">
                                    @endif
                                    <div class="block-legend style-1 w-full">
                                        <div class="dot t{{ ($index % 6) + 1 }}"></div>
                                        <div class="text-tiny">{{ $categorie->titre }} ({{ $categorie->produits_count }})</div>
                                    </div>
                                    @if(($index + 1) % 3 == 0 || $loop->last)
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- /category -->
                    </div>
                    <!-- earnings -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Statistiques générales</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);">Cette semaine</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Semaine dernière</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="line-chart-8"></div>
                    </div>
                    <!-- /earnings -->
                </div>
                {{-- <div class="tf-section mb-30">
                    <!-- orders -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Recent orders</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="view-all">View all<i class="icon-chevron-down"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);">3 days</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">7 days</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="wg-table table-product-overview t2">
                            <ul class="table-title flex gap20 mb-14">
                                <li>
                                    <div class="body-title">Product</div>
                                </li>
                                <li>
                                    <div class="body-title">Customer</div>
                                </li>
                                <li>
                                    <div class="body-title">Product ID</div>
                                </li>
                                <li>
                                    <div class="body-title">Quantity</div>
                                </li>
                                <li>
                                    <div class="body-title">Price</div>
                                </li>
                                <li>
                                    <div class="body-title">Status</div>
                                </li>
                            </ul>
                            <div class="divider mb-14"></div>
                            <ul class="flex flex-column gap10">
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="images/products/31.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between flex-grow gap20">
                                        <div class="name">
                                            <a href="product-list.html" class="body-title-2">Taste of the Wild Formula
                                                Finder</a>
                                        </div>
                                        <div class="body-text">2,672</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div class="body-text">X1</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div>
                                            <div class="block-available">Delivered</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="images/products/32.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between flex-grow gap20">
                                        <div class="name">
                                            <a href="product-list.html" class="body-title-2">Proden Plaqueoff Dental Bites
                                                Dog, 150 G</a>
                                        </div>
                                        <div class="body-text">2,672</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div class="body-text">X2</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div>
                                            <div class="block-available">Delivered</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="images/products/33.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between flex-grow gap20">
                                        <div class="name">
                                            <a href="product-list.html" class="body-title-2">Zuke's Lil' Links Healthy
                                                Little Sausage Links for Dogs...</a>
                                        </div>
                                        <div class="body-text">2,672</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div class="body-text">X1</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div>
                                            <div class="block-available">Delivered</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="images/products/34.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between flex-grow gap20">
                                        <div class="name">
                                            <a href="product-list.html" class="body-title-2">Rachael Ray Nutrish Grain Free
                                                Chicken Drumstick...</a>
                                        </div>
                                        <div class="body-text">2,672</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div class="body-text">X3</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div>
                                            <div class="block-available">Delivered</div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="images/products/35.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between flex-grow gap20">
                                        <div class="name">
                                            <a href="product-list.html" class="body-title-2">Fruitables Dog Treats Sweet
                                                Potato & Pecan Flavor</a>
                                        </div>
                                        <div class="body-text">2,672</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div class="body-text">X2</div>
                                        <div class="body-text">$28,672.36</div>
                                        <div>
                                            <div class="block-available">Delivered</div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Showing 5 entries</div>
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
                    <!-- /orders -->
                </div> --}}
                <div class="tf-section-3">
                    <!-- top-product -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Meilleurs produits</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);">Cette semaine</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Semaine dernière</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="wg-table table-top-product-1">
                            <ul class="table-title flex gap10 mb-14">
                                <li>
                                    <div class="body-title">Produit</div>
                                </li>
                                <li>
                                    <div class="body-title">Marque</div>
                                </li>
                                <li>
                                    <div class="body-title">Catégorie</div>
                                </li>
                            </ul>
                            <ul class="flex flex-column gap18">
                                @forelse($recentProduits as $produit)
                                    <li class="product-item">
                                        <div class="image small no-bg">
                                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" loading="lazy">
                                        </div>
                                        <div class="flex items-center justify-between flex-grow">
                                            <div class="name">
                                                <a href="#" class="body-text">{{ Str::limit($produit->nom, 40) }}</a>
                                            </div>
                                            <div>
                                                <div class="body-text">{{ $produit->marque->nom ?? 'N/A' }}</div>
                                            </div>
                                            <div>
                                                <div class="body-text">{{ $produit->categorie->titre ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-center">Aucun produit disponible</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- top-product -->
                    <!-- earnings -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Utilisateurs récents</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="{{ route('admin.users.index') }}">Voir tous</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="wg-table">
                            <ul class="flex flex-column gap-3 mt-3">
                                @forelse($recentUsers as $recentUser)
                                    <li class="flex items-center justify-between p-3" style="border-bottom: 1px solid #eee;">
                                        <div>
                                            <div class="body-title-2">{{ $recentUser->name }} {{ $recentUser->lastname }}</div>
                                            <div class="text-tiny text-muted">{{ $recentUser->email }}</div>
                                        </div>
                                        <div>
                                            <span class="badge badge-{{ $recentUser->role === 'admin' ? 'primary' : 'secondary' }}">{{ ucfirst($recentUser->role) }}</span>
                                        </div>
                                    </li>
                                @empty
                                    <li class="text-center p-3">Aucun utilisateur</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- earnings -->
                    <!-- website-visitors -->
                    <div class="wg-box">
                        <div class="flex items-center justify-between">
                            <h5>Marques disponibles</h5>
                            <div class="dropdown default">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="{{ route('admin.marques.index') }}">Voir toutes</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center justify-center p-5">
                            <div class="text-center">
                                <h2>{{ number_format($totalMarques) }}</h2>
                                <p class="text-muted">Marques enregistrées</p>
                            </div>
                        </div>
                    </div>
                    <!-- website-visitors -->
                </div>
            </div>
            <!-- /main-content-wrap -->
        </div>
        <!-- /main-content-wrap -->
        <!-- bottom-page -->
        {{-- <div class="bottom-page">
            <div class="body-text">Copyright © {{ date('Y') }} {{ config('app.name') }}. Conçu avec</div>
            <i class="icon-heart"></i>
            <div class="body-text">Tous droits réservés.</div>
        </div> --}}
        <!-- /bottom-page -->
    </div>
@endsection
