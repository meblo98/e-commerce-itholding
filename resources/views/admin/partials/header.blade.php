<div class="header-dashboard">
    <div class="wrap">
        <div class="header-left">
            <a href="index.html">
                <img class="" id="logo_header_mobile" alt=""
                    src="{{ asset('assets/img/banner/logo.jpeg') }}"
                    data-light="{{ asset('assets/img/banner/logo.jpeg') }}"
                    data-dark="{{ asset('assets/img/banner/logo.jpeg') }}" data-width="110px"
                    data-height="36px" data-retina="{{ asset('assets/img/banner/logo.jpeg') }}"
                    style="width:110px !important; max-height:40px !important; height:auto !important; object-fit:contain !important; background:transparent !important;">
            </a>
            <div class="button-show-hide">
                <i class="icon-menu-left"></i>
            </div>
            <form class="form-search flex-grow">
                <fieldset class="name">
                    <input type="text" placeholder="Search here... basse" class="show-search" name="name" tabindex="2"
                        value="" aria-required="true" required="">
                </fieldset>
                <div class="button-submit">
                    <button class="" type="submit"><i class="icon-search"></i></button>
                </div>
                <div class="box-content-search" id="box-content-search">
                    <ul class="mb-24">
                        <li class="mb-14">
                            <div class="body-title">Top selling product</div>
                        </li>
                        <li class="mb-14">
                            <div class="divider"></div>
                        </li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="images/products/17.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Dog Food Rachael Ray
                                                Nutrish®</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="images/products/18.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Natural Dog Food Healthy Dog
                                                Food</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="{{ asset('dashboard/assets/images/products/19.png') }}" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Freshpet Healthy Dog Food and
                                                Cat</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="">
                        <li class="mb-14">
                            <div class="body-title">Order product</div>
                        </li>
                        <li class="mb-14">
                            <div class="divider"></div>
                        </li>
                        <li>
                            <ul>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="images/products/20.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Sojos Crunchy Natural Grain
                                                Free...</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="images/products/21.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Kristin Watson</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14 mb-10">
                                    <div class="image no-bg">
                                        <img src="images/products/22.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Mega Pumpkin Bone</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-10">
                                    <div class="divider"></div>
                                </li>
                                <li class="product-item gap14">
                                    <div class="image no-bg">
                                        <img src="images/products/23.png" alt="">
                                    </div>
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="product-list.html" class="body-text">Mega Pumpkin Bone</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        <div class="header-grid">
            <div class="header-item button-dark-light">
                <i class="icon-moon"></i>
            </div>
            <div class="popup-wrap user type-header">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3"
                        data-bs-toggle="dropdown" aria-expanded="false"
                        data-redirect-url="{{ auth()->check() ? url('/admin') : route('login') }}">
                        <span class="header-user wg-user">
                            <span class="image">
                                <img src="images/avatar/user-1.png" alt="">
                            </span>
                            <span class="flex flex-column">
                                <span class="body-title mb-2" title="Ouvrir le tableau de bord">{{ auth()->user()->name }} {{ auth()->user()->lastname }}</span>
                                <span class="text-tiny">{{ ucfirst(auth()->user()->role) }}</span>
                            </span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end has-content" aria-labelledby="dropdownMenuButton3">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="user-item" style="border: none; background: none; cursor: pointer; width: 100%; text-align: left;">
                                    <div class="icon">
                                        <i class="icon-log-out"></i>
                                    </div>
                                    <div class="body-title-2">Déconnexion</div>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Clique sur le nom d'utilisateur: redirige vers dashboard si connecté, sinon login
    $(document).on('click', '#dropdownMenuButton3 .body-title', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var url = $('#dropdownMenuButton3').data('redirect-url');
        if (url) {
            window.location.href = url;
        }
    });
</script>
@endpush
