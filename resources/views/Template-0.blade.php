<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &mdash; KSP</title>

  <!-- General CSS Files -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> 


  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/node_modules/jqvmap/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/node_modules/weathericons/css/weather-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/node_modules/weathericons/css/weather-icons-wind.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/node_modules/summernote/summernote-bs4.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <script src="{{ asset('/assets/dist/js/jquery-3.6.0.min.js') }}"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">

      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>        
          <ul class="navbar-nav ml-auto">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
            <!--   <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a> -->
              <a href="{{ route('operator') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout 
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="text-center">
          @php
				  $profile = \App\Models\Profile::where('status','active')->first(); 
				  @endphp
          @if (!empty($profile->file_logo) && File::exists(public_path().'/assets/'.$profile->file_logo))
          <img class="logo" src="{{ asset('/foto/'.$profile->file_logo) }}" alt="Desktop Logo">
          @else
          <img class="logo" src="{{ asset('/foto/no_image.jpg') }}" alt="Desktop Logo">
          @endif
          </div>
          <div class="sidebar-brand">
            <a href="{{ url('dashboard') }}">Koperasi Simpan Pinjam</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('dashboard') }}">KSP</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Administrator</li>
              @php
                $menu_open = '';
                if (str_contains(Request::url(),'operator') || str_contains(Request::url(),'profile')) 
                {$menu_open = 'dropdown active';}
		          @endphp
              <li class="nav-item {{ $menu_open }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-cog"></i><span>Admin</span></a>
                <ul class="dropdown-menu">
                  <li class="@if(str_contains(Request::url(),'profile'))active @endif"><a class="nav-link" href="{{ route('profile') }}">Profil</a></li>
                  <li class="@if(str_contains(Request::url(),'operator'))active @endif"><a class="nav-link" href="{{ route('operator') }}">Operator</a></li>
                </ul>
              </li>
              <li class="menu-header">Nasabah</li>
              <li class="@if(str_contains(Request::url(),'nasabah'))active @endif"><a class="nav-link" href="{{ url('nasabah') }}"><i class="fas fa-user-friends"></i> <span>Nasabah</span></a></li>
              <li class="menu-header">Pinjaman</li>
              <li class="@if(str_contains(Request::url(),'pinjaman'))active @endif"><a class="nav-link" href="{{ url('pinjaman') }}"><i class="fas fa-dollar-sign"></i> <span>Pinjaman</span></a></li>
              <li class="menu-header">Administrasi</li>
              @php
                $menu_open = '';
                if (str_contains(Request::url(),'shu') || str_contains(Request::url(),'ttp_buku') || str_contains(Request::url(),'lapxls')) 
                {$menu_open = 'dropdown active';}
		          @endphp
              <li class="nav-item {{ $menu_open }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-id-card"></i> <span>Pengurus</span></a>
                <ul class="dropdown-menu">
                  <li class="@if(str_contains(Request::url(),'shu'))active @endif"><a class="nav-link" href="{{ url('shu') }}">Sisa Hasil Usaha</a></li>
                  <li class="@if(str_contains(Request::url(),'ttp_buku'))active @endif"><a class="nav-link" href="{{ url('shu/ttp_buku') }}">Tutup Buku</a></li>
                  <li class="@if(str_contains(Request::url(),'lapxls'))active @endif"><a class="nav-link" href="{{ url('laporan/lapxls') }}">Laporan Transaksi</a></li>
                </ul>
              </li>             
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://github.com/Apta-tea/koperasi-simpan-pinjam" class="btn btn-primary btn-lg btn-block btn-icon-split" target=_blank>
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div>
        </aside>
      </div>

      <!-- Main Content -->
      @yield('content')
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{ now()->year }} <div class="bullet"></div>  <a href="#">Koperasi Simpan Pinjam</a>
        </div>
        <div class="footer-right">
          2.0.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('/assets/node_modules/simpleweather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('/assets/node_modules/chart/Chart.min.js') }}"></script>
  <script src="{{ asset('/assets/node_modules/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('/assets/node_modules/jqvmap/jquery.vmap.world.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('/assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('/assets/js/page/index-0.js') }}"></script>
</body>
</html>
