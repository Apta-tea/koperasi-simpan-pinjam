@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
<div class="row">
<div class="col-sm-12">
    <table class='table table-bordered table-responsive-sm'>
        <tr><th colspan="2" class="text-center">REKAPITULASI PERIODE</th></tr>
        <tr><td width="200">Total Dana</td><td>Rp. {{ number_format($kas->total+$tot_pinjam->total) }}</td></tr>
        <tr><td>Jumlah Anggota</td><td>{{ $jnasabah }}</td></tr>
        <tr><td>Dana Bergulir</td><td>Rp. {{ number_format($tot_pinjam->total) }}</td></tr>
        <tr><td>Dana Tersedia</td><td>Rp. {{ number_format($kas->total) }}</td></tr>
        <tr><td>Dana Anggota</td><td>Rp. {{ number_format($saldo->saldo) }}</td></tr>
        <tr><td>Total Keuntungan Berjalan</td><td>Rp. {{ max(number_format($laba->laba),0) }}</td></tr>
        <tr><td colspan="2">
        {!! Form::open(array('url'=>'shu/ttp')) !!}
        {!! Form::hidden('kas',max($kas->total,0)) !!}
        {!! Form::hidden('tot_pinjam',max($tot_pinjam->total,0)) !!}
        {!! Form::hidden('laba',max($laba->laba,0)) !!}
        {!! Form::submit('Tutup buku',['class'=>'btn btn-danger btn-sm float-end',"onclick"=>"return confirm('Tutup periode ini?')"]) !!}
        {!! Form::close() !!}
        </td></tr>
    </table>
</div>
</div>
@if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@stop