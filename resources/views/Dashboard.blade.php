@extends('Template-0')
@section('content')
@if (!empty($jnasabah && $kas && $credit && $month && $juser && $tot_pinjam))
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Nasabah</h4>
                  </div>
                  <div class="card-body">
                    {{ $jnasabah }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Kas Tersedia</h4>
                  </div>
                  <div class="card-body">
                  Rp. {{ number_format($kas->total) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-money-bill-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dana Dipinjam</h4>
                  </div>
                  <div class="card-body">
                  Rp. {{ number_format($tot_pinjam->total) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-id-card"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Operator</h4>
                  </div>
                  <div class="card-body">
                    {{ $juser }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Chart section -->
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-body">
                  <canvas id="myChart" height="150"></canvas>
                </div>
              </div>
            </div>
          </div>         
        </section>
      </div>
<script>
  const total = {!! json_encode($credit) !!};
  const month = {!! json_encode($month) !!};
</script>
@else
<div>
  <h6>Mohon Maaf, Data Tidak Ditemukan</h6> 
</div>
@endif
@stop
