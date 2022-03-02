<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  @auth
  <meta name="idKantor" content="{{ auth()->user()->kantor_id }}" />
  @endauth
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

  <title>{{ config('app.name', 'Laravel') }}</title>
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css"> --}}
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css"> --}}
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">


   <!-- navbar -->
   @include('layouts.nav-header')

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/dashboard" class="brand-link">
      <img src="{{ asset('/images/logo.png') }}" alt="The Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        {{-- <router-link to="/profile">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="{{ auth()->user()->photo }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">

                  {{ Auth::user()->name }}
                  <span class="d-block text-muted">
                    {{ Ucfirst(Auth::user()->type) }}
                  </span>
              </div>
          </div>
        </router-link> --}}
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>
      <!-- Sidebar Menu -->
      @include('layouts.sidebar-menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  {{-- Content Wrapper. Contains page content --}}
  <div class="content-wrapper">
    {{-- Main content --}}

    <!-- Content Header (Page header) -->
    {{-- <div class="content-header"> --}}
      {{-- <div class="container-fluid"> --}}
        {{-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> --}}
      {{-- </div><!-- /.container-fluid --> --}}
    {{-- </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->
    <router-view></router-view>

    <vue-progress-bar></vue-progress-bar>

    {{-- /.content --}}
  </div>
  {{-- /.content-wrapper --}}

  {{-- Main Footer --}}
  <footer class="main-footer">
    {{-- To the right --}}
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0.2
    </div>
    {{-- Default to the left --}}
    <strong>Copyright &copy; 2022 <a href="https://bprku.com">BPRKU</a>.</strong>
    CODE BY SUGA
  </footer>
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user());
    //console.log(window.userlogin);
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> --}}
</body>
</html>
