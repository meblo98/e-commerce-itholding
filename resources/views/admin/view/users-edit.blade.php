@extends('admin.layouts.app')
@section('title', 'Edit User')
@section('content')

    @include('admin.partials.header')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Edit User</h3>
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
                            <a href="{{ route('admin.users.index') }}">
                                <div class="text-tiny">Users</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Edit User</div>
                        </li>
                    </ul>
                </div>
                <!-- edit-user -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-24">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mb-24">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-24">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="form-edit-user form-style-2" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="wg-box">
                        <div class="left">
                            <h5 class="mb-4">Account</h5>
                            <div class="body-text">Update the user information below</div>
                        </div>
                        <div class="right flex-grow">
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">First Name</div>
                                <input class="flex-grow" type="text" placeholder="First Name" name="name" tabindex="0"
                                    value="{{ old('name', $user->name) }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">Last Name</div>
                                <input class="flex-grow" type="text" placeholder="Last Name" name="lastname" tabindex="0"
                                    value="{{ old('lastname', $user->lastname) }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="email mb-24">
                                <div class="body-title mb-10">Email</div>
                                <input class="flex-grow" type="email" placeholder="Email" name="email" tabindex="0" 
                                    value="{{ old('email', $user->email) }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="email mb-24">
                                <div class="body-title mb-10">Phone</div>
                                <input class="flex-grow" type="tel" placeholder="Phone Number" name="phone" tabindex="0" 
                                    value="{{ old('phone', $user->phone) }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="email mb-24">
                                <div class="body-title mb-10">Role</div>
                                <select class="flex-grow" name="role" aria-required="true" required="">
                                    <option value="">-- Sélectionner un rôle --</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="bot">
                        <button class="tf-button w180" type="submit">Update</button>
                        <a href="{{ route('admin.users.index') }}" class="tf-button w180" style="background-color: #6c757d;">Cancel</a>
                    </div>

                </form>
                <!-- /edit-user -->
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
