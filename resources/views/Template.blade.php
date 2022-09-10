<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.98.0">
    <title>MINI-KSP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbar-static/">

    

    

<link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet">
<script src="{{ asset('/assets/dist/js/jquery-3.6.0.min.js') }}"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/navbar-top.css') }}" rel="stylesheet">
  </head>
  <body>
    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('dashboard') }}">MINI-KSP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ url('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('nasabah') }}">Nasabah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('pinjaman') }}">Pinjaman</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Pengurus</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
              <li><a class="dropdown-item" href="{{ url('shu') }}">Sisa Hasil Usaha</a></li>
              <li><a class="dropdown-item" href="{{ url('shu/ttp_buku') }}">Tutup Buku</a></li>
              <!-- <li><a class="dropdown-item" target="_blank" href="{{ url('laporan/lappdf') }}">Laporan Transaksi</a></li> -->
              <li><a class="dropdown-item" href="{{ url('laporan/lapxls') }}">Laporan Transaksi</a></li>
            </ul>
          </li>
      </ul>
      <div class="navbar-nav"> 
          <div class="nav-item text-nowrap">
          <a class="fa-regular fa-user nav-link px-0"></a>
          </div>                              
          <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="#">{{ Auth::user()->name }}</a>
          </div>
          <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="{{ route('operator') }}">{{ __('Operator') }}</a>
          </div> 
          <div class="nav-item text-nowrap">
          {!! Form::open(array('url'=>'logout')) !!}
          <!-- <a class="nav-link px-3" href="#">Sign out</a> -->
          {!! Form::submit('Logout',['class'=>'btn btn-link nav-link px-3']) !!}
          {!! Form::close() !!}
          </div>
  </div>
    </div>
  </div>
</nav>

<main class="container">
    @yield('content')
</main>

    <script src="{{ asset('/assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/fontawesome/js/all.min.js') }}"></script>
    
      
  </body>
</html>
