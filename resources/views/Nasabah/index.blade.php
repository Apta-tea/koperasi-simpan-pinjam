@extends('Template')
@section('content') 
{!! Html::ul($errors->all()) !!}
    <div class="row justify-content-end">
    <div class="col-4">
    {!! Form::open(array('url'=>'nasabah/search','class'=>'d-flex','role'=>'search')) !!}
    {!! Form::text('keyword',null,['class'=>'form-control me-2','placeholder'=>'Search']) !!}
    {!! Form::submit('Search',['class'=>'btn btn-outline-success']) !!}
    {!! Form::close() !!}
    </div></div>
<br>
{!! link_to('nasabah/create','+Tambah Data',['class'=>'btn btn-danger btn-sm']) !!}
<br><br>
<table class="table table-bordered table-responsive-sm" >
    <tr><th colspan="6" class="text-center">DATA NASABAH</th></tr>
    <tr><th>Nomor Rekening</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th colspan="2"></th></tr>
    @isset($nasabah)
    @foreach($nasabah as $n)
    <tr><td>{{ $n->no_rekening }}</td><td>{{ $n->nama_lengkap }}</td><td>{{ $n->telp }}</td><td>{{ $n->alamat }}</td>
    <td width="120" class="border-end-0">{!! link_to('nasabah/'.$n->id.'/edit','Edit',['class'=>'btn btn-primary btn-sm']) !!}
        {!! link_to('nasabah/'.$n->id,'Detail',['class'=>'btn btn-secondary btn-sm']) !!}
    <td width="40" class="border-start-0">
        {!! Form::open(array('url'=>'nasabah/'.$n->id,'method'=>'delete')) !!}
        {!! Form::submit('Delete',['class'=>'btn btn-warning btn-sm',"onclick"=>"return confirm('Anda yakin?')"]) !!}
        {!! Form::close() !!}
    </td>
    @endforeach
    </td></tr>
</table>
@if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
{!! $nasabah->render() !!}
@endisset
@stop