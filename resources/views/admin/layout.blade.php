<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') · CHF Publishing</title>
    <link rel="icon" type="image/png" href="{{ asset('images/chf-logo.png') }}?v={{ filemtime(public_path('images/chf-logo.png')) }}">
    <link rel="stylesheet" href="{{ asset('staff-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staff-assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staff-assets/css/ruang-admin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staff-assets/css/admin.css') }}?v={{ filemtime(public_path('staff-assets/css/admin.css')) }}">
    @stack('styles')
</head>
<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}"><span class="sidebar-brand__logo"><img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation logo" width="40" height="40"></span><span class="sidebar-brand-text mx-2">CHF <small>Publishing</small></span></a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <hr class="sidebar-divider"><div class="sidebar-heading">Publishing</div>
        <li class="nav-item {{ request()->routeIs('admin.content.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.content.index') }}"><i class="fas fa-fw fa-newspaper"></i><span>News &amp; content</span></a></li>
        <li class="nav-item {{ request()->routeIs('admin.heroes.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.heroes.edit') }}"><i class="fas fa-fw fa-images"></i><span>Page hero images</span></a></li>
        @if(auth()->user()->isAdmin())
            <li class="nav-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.team.index') }}"><i class="fas fa-fw fa-users"></i><span>Our Team</span></a></li>
            <hr class="sidebar-divider"><div class="sidebar-heading">Access</div>
            <li class="nav-item {{ request()->routeIs('admin.managers.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.managers.index') }}"><i class="fas fa-fw fa-user-shield"></i><span>Managers</span></a></li>
            <li class="nav-item {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.donations.index') }}"><i class="fas fa-fw fa-hand-holding-heart"></i><span>Donations</span></a></li>
            <li class="nav-item {{ request()->routeIs('admin.payment-settings.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.payment-settings.edit') }}"><i class="fas fa-fw fa-credit-card"></i><span>Payment settings</span></a></li>
        @endif
        <hr class="sidebar-divider"><li class="nav-item"><a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="fas fa-fw fa-external-link-alt"></i><span>View website</span></a></li>
        <div class="sidebar-card"><p class="mb-2">Hope, love and support for children with cancer.</p><strong>Children's Hope Foundation</strong></div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column"><div id="content">
        <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow-sm">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" type="button" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <span class="admin-topbar-brand"><img src="{{ asset('images/chf-logo.png') }}" alt="Children's Hope Foundation"></span><span class="admin-context">CHF content manager</span><ul class="navbar-nav ml-auto"><li class="nav-item dropdown no-arrow"><span class="nav-link"><span class="mr-2 d-none d-lg-inline text-gray-700">{{ auth()->user()->name }} <small class="admin-role">{{ ucfirst(auth()->user()->role) }}</small></span><span class="admin-avatar"><i class="fas fa-user"></i></span></span></li><li class="nav-item"><form method="post" action="{{ route('admin.logout') }}">@csrf<button class="btn btn-link nav-link admin-logout" type="submit">Sign out</button></form></li></ul>
        </nav>
        <div class="container-fluid admin-main">
            @if(session('status'))<div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('status') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>@endif
            @if($errors->any())<div class="alert alert-danger"><strong>Please check the form.</strong><ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </div>
    </div><footer class="sticky-footer bg-white"><div class="container my-auto"><div class="copyright text-center my-auto"><span>© {{ date('Y') }} Children's Hope Foundation</span></div></div></footer></div>
</div>
@stack('modals')
<script src="{{ asset('staff-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('staff-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('staff-assets/js/ruang-admin.min.js') }}"></script>
@stack('scripts')
</body>
</html>
