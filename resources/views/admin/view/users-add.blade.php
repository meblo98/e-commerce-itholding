@extends('admin.layouts.app')
@section('title', 'Add User')
@section('content')

    @include('admin.partials.header')
    <!-- main-content -->
    <div class="main-content">
        <!-- main-content-wrap -->
        <div class="main-content-inner">
            <!-- main-content-wrap -->
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Add New User</h3>
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
                            <div class="text-tiny">Add New User</div>
                        </li>
                    </ul>
                </div>
                <!-- add-new-user -->
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

                <form class="form-add-new-user form-style-2" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="wg-box">
                        <div class="left">
                            <h5 class="mb-4">Account</h5>
                            <div class="body-text">Fill in the information below to add a new account</div>
                        </div>
                        <div class="right flex-grow">
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">First Name</div>
                                <input class="flex-grow" type="text" placeholder="First Name" name="name" tabindex="0"
                                    value="{{ old('name') }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="name mb-24">
                                <div class="body-title mb-10">Last Name</div>
                                <input class="flex-grow" type="text" placeholder="Last Name" name="lastname" tabindex="0"
                                    value="{{ old('lastname') }}" aria-required="true" required="">
                            </fieldset>
                            <fieldset class="email mb-24">
                                <div class="body-title mb-10">Email</div>
                                <input class="flex-grow" type="email" placeholder="Email" name="email" tabindex="0" value="{{ old('email') }}"
                                    aria-required="true" required="">
                            </fieldset>
                            <fieldset class="email mb-24">
                                <div class="body-title mb-10">Phone</div>
                                <input class="flex-grow" type="tel" placeholder="Phone Number" name="phone" tabindex="0" value="{{ old('phone') }}"
                                    aria-required="true" required="">
                            </fieldset>
                            <fieldset class="email mb-24">
                                <div class="body-title mb-10">Role</div>
                                <select class="flex-grow" name="role" aria-required="true" required="">
                                    <option value="">-- Sélectionner un rôle --</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </fieldset>
                            <fieldset class="password mb-24">
                                <div class="body-title mb-10">Password</div>
                                <input class="password-input" type="password" placeholder="Enter password" name="password"
                                    tabindex="0" aria-required="true" required="">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                            </fieldset>
                            <fieldset class="password">
                                <div class="body-title mb-10">Confirm password</div>
                                <input class="password-input" type="password" placeholder="Confirm password" name="password_confirmation"
                                    tabindex="0" aria-required="true" required="">
                                <span class="show-pass">
                                    <i class="icon-eye view"></i>
                                    <i class="icon-eye-off hide"></i>
                                </span>
                            </fieldset>
                        </div>
                    </div>
                    
                    <div class="bot">
                        <button class="tf-button w180" type="submit">Save</button>
                    </div>

                </form>
                <!-- /add-new-user -->
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
