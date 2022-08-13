@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
<div class="row">
<div class="col-sm-12">
    <table class='table table-bordered table-responsive-sm'>
        <tr><th colspan="2" class="text-center">KALKULASI SISA HASIL USAHA</th></tr>
        <tr><td width="200">Total Dana</td><td>Rp. {{ number_format($kas->total+$tot_pinjam->total) }}</td></tr>
        <tr><td>Jumlah Anggota</td><td>{{ $jnasabah }}</td></tr>
        <tr><td>Dana Bergulir</td><td>Rp. {{ number_format($tot_pinjam->total) }}</td></tr>
        <tr><td>Dana Tersedia</td><td>Rp. {{ number_format($kas->total) }}</td></tr>
        <tr><td>Dana Anggota</td><td>Rp. {{ number_format($saldo->saldo) }}</td></tr>
        <tr><td>Total Keuntungan Berjalan</td><td>Rp. {{ max(number_format($laba->laba),0) }}</td></tr>
    </table>
</div>
</div>
@if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
        <tr><td>Biaya Operasional</td><td>
        {!! Form::open(array('url'=>'shu/proc')) !!}
        {!! Form::text('operasional','',['class'=>'form-control','placeholder'=>'0','required']) !!}
        <tr><td>Persentase SHU (%)</td><td>
        {!! Form::text('shu','',['class'=>'form-control','placeholder'=>'Masukan presentase bagi hasil yang diinginkan, atau kosongkan untuk otomatis kalkulasi']) !!}
        {!! Form::hidden('laba',max($laba->laba,0)) !!}
        {!! Form::hidden('jnasabah',$jnasabah) !!}
        {!! Form::hidden('simpanan',$saldo->saldo) !!}
        </td></tr><tr><td colspan="2">
        {!! Form::submit('Proses',['class'=>'btn btn-success btn-sm float-end',"onclick"=>"return confirm('Anda yakin?')"]) !!}
        {!! Form::close() !!}
        </td></tr>
    </table>
</div>
</div>
<div class="navbar navbar-inverse navbar-fixed-bottom">
      <div class="container">
        <ul>
        <li>Total SHU yang dibagikan pada semua anggota merupakan total laba setelah dikurangi biaya operasional.</li>
        <li>Kalkulasi otomatis, membagikan secara proporsional total laba bersih berdasarkan jumlah simpanan.</li>
        <li>Input manual presentase merupakan APR dari simpanan.</li>
        </ul>
      </div>
</div>
@stop