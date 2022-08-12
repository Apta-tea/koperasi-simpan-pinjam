@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
<div class="row">
<div class="col-sm-12">
    <table class='table table-bordered table-responsive-sm'>
        <tr><th colspan="2" class="text-center">NASABAH</th></tr>
        <tr><td width="200">Nama</td><td>{{ $angsuran[0]->nama_lengkap }}</td></tr>
        <tr><td>Nomor Rekening</td><td>{{ $angsuran[0]->no_rekening }}</td></tr>
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
        <table class="table table-bordered table-responsive-sm">
        <tr><td>Tanggal</td><td>Jumlah Cicilan</td><td>Skema</td><td>Operasi</td></tr>
        @foreach($angsuran as $a)
        <tr><td>{{ tgl_id($a->created_at) }}</td><td>{{ number_format($a->jumlah_cicilan) }}</td><td>{{ $a->skema }}</td><td>
        {!! Form::open(array('url'=>'pinjaman/'.$a->id,'method'=>'patch')) !!}
        {!! Form::hidden('nama_lengkap',$a->nama_lengkap) !!}
        {!! Form::hidden('no_rekening',$a->no_rekening) !!}
        {!! Form::hidden('jumlah_cicilan',$a->jumlah_cicilan) !!}
        {!! Form::hidden('pinjaman_id',$a->pinjaman_id) !!}
        {!! Form::hidden('angsuran_id',$a->id) !!}
        {!! Form::submit('Angsur',['class'=>'btn btn-success btn-sm',"onclick"=>"return confirm('Anda yakin?')"]) !!}
        {!! Form::close() !!}
        </td></tr>
        @endforeach
    </table>
</div>
</div>
@stop