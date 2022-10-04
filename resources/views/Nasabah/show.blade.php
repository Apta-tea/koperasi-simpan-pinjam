@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
<div class="row">
<div class="col-sm-6">
    <table class='table table-bordered table-responsive-sm'>
        <tr><th colspan="3" class="text-center">NASABAH</th></tr>
        <tr><td width="200">Nama</td><td>{{ $nasabah->nama_lengkap }}</td><td rowspan="3"><img src="{{ asset('foto').'/'.$nasabah->foto }}" width="100"></td></tr>
        <tr><td>Nomor Rekening</td><td>{{ $nasabah->no_rekening }}</td></tr>
        <tr><td>Telepon</td><td>{{ $nasabah->telp }}</td></tr>
        <tr><td>Total Saldo</td><td>{{ number_format($nasabah->saldo_akhir) }}</td><td class="text-center">
        {!! Form::open(array('url'=>'laporan/transNas')) !!}
        {!! Form::hidden('nasabah_id',$nasabah->id) !!}
        {!! Form::submit('Laporan',['class'=>'btn btn-success btn-sm','formtarget'=>'_blank']) !!}
        {!! Form::close() !!}
        </td></tr>
    </table>
</div>
<div class="col-sm-6">
    {!! Form::open(array('url'=>'nasabah/transaksi')) !!}
    {!! Form::hidden('nasabah_id',$nasabah->id) !!}
    <table class='table table-bordered table-responsive-sm'>
        <tr><th colspan="2" class="text-center">FORM TRANSAKSI</th></tr>
        <tr><td width="200">Jumlah</td><td>{!! Form::text('total',null,['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Jenis Transaksi</td><td>{!! Form::select('jenis_transaksi',array('debet'=>'DEBET','wajib'=>'SIMPANAN WAJIB','sukarela'=>'SIMPANAN SUKARELA','denda'=>'DENDA'),['class'=>'form-control']) !!}</td></tr>
        <tr><td colspan="2">{!! Form::submit('Proses',['class'=>'btn btn-danger btn-sm float-end']) !!}</td></tr>
    </table>
    {!! Form::close() !!}
</div>
</div>
@if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@isset($transaksi)
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
        <tr><td>Tanggal</td><td>Jenis Transaksi</td><td>Jumlah</td><td>Operator</td></tr>
        @foreach($transaksi as $t)
        <tr><td>{{ tgl_id($t->created_at) }}</td><td>{{ $t->jenis_transaksi }}</td><td>{{ number_format($t->total) }}</td><td>{{ $t->name }}</td></tr>
        @endforeach
    </table>
</div>
</div>
{!! $transaksi->render() !!}
@endisset
@stop