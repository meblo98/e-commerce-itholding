@extends('admin.layouts.app')

@section('title', 'Users List')

@section('content')

    @include('admin.partials.header')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>All User</h3>
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
                                <div class="text-tiny">User</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">All User</div>
                        </li>
                    </ul>
                </div>
                <!-- all-user -->
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <form class="form-search" onsubmit="return false;">
                                <fieldset class="name">
                                    <input type="text" id="user-search-input" placeholder="Search here..." class="" name="name" tabindex="2"
                                        value="" aria-required="true">
                                </fieldset>
                                <div class="button-submit">
                                    <button class="" type="button"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.users.create') }}"><i class="icon-plus"></i>Add new</a>
                    </div>
                    <div class="wg-table table-all-user">
                        <ul class="table-title flex gap20 mb-14">
                            <li>
                                <div class="body-title">User</div>
                            </li>
                            <li>
                                <div class="body-title">Phone</div>
                            </li>
                            <li>
                                <div class="body-title">Email</div>
                            </li>
                            <li>
                                <div class="body-title">Role</div>
                            </li>
                            <li>
                                <div class="body-title">Action</div>
                            </li>
                        </ul>
                        <ul class="flex flex-column">
                            @forelse($users as $user)
                                <li class="user-item gap14">
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="#" class="body-title-2">{{ $user->name }} {{ $user->lastname }}</a>
                                            <div class="text-tiny mt-3">{{ $user->email }}</div>
                                        </div>
                                        <div class="body-text">{{ $user->phone }}</div>
                                        <div class="body-text">{{ $user->email }}</div>
                                        <div class="body-text">
                                            <span class="badge" style="background: {{ $user->role === 'admin' ? '#dc3545' : '#28a745' }}; padding: 0.25rem 0.5rem; border-radius: 0.25rem; color: white;">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </div>
                                        <div class="list-icon-function">
                                            <div class="item edit">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"><i class="icon-edit-3"></i></a>
                                            </div>
                                            <div class="item trash">
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="user-item gap14">
                                    <div class="flex items-center justify-center gap20 flex-grow">
                                        <p class="text-center">Aucun utilisateur trouvé</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Total: {{ $users->count() }} utilisateurs</div>
                    </div>
                </div>
                <!-- /all-user -->
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
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('user-search-input');
            var headerSearchInput = document.getElementById('header-search-input');
            var userItems = document.querySelectorAll('.user-item');

            function filterUsers(filter) {
                filter = filter.toLowerCase().trim();
                userItems.forEach(function(item) {
                    // Ignorer le message "Aucun résultat"
                    if (item.querySelector('p')?.textContent.includes('Aucun utilisateur trouvé')) return;

                    var nameEl = item.querySelector('.name');
                    var name = nameEl ? nameEl.textContent.toLowerCase() : '';
                    
                    var phoneEl = item.querySelector('.body-text:nth-child(2)'); // Phone
                    var phone = phoneEl ? phoneEl.textContent.toLowerCase() : '';

                    var emailEl = item.querySelector('.body-text:nth-child(3)'); // Email
                    var email = emailEl ? emailEl.textContent.toLowerCase() : '';
                    
                    if (name.includes(filter) || phone.includes(filter) || email.includes(filter)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    filterUsers(this.value);
                });
            }

            if (headerSearchInput) {
                headerSearchInput.addEventListener('input', function() {
                    filterUsers(this.value);
                });
            }
        });
    </script>
@endpush
