@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
{!! Form::open(array('url'=>'nasabah', 'files'=>'true')) !!}
    <table class='table table-bordered table-responsive-sm'>
        <tr><td>Nomor Rekening</td><td>{!! Form::text('no_rekening','',['class'=>'form-control','maxlength'=>'8','required']) !!}</td></tr>
        <tr><td>Nama Lengkap</td><td>{!! Form::text('nama_lengkap','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Telp/ HP</td><td>{!! Form::text('telp','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Alamat</td><td>{!! Form::textarea('alamat','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Foto</td><td>{!! Form::file('foto',null,['class'=>'form-control']) !!} </td></tr>
        <tr><td colspan=2>
            {!! Form::submit('Simpan Data',['class'=>'btn btn-danger btn-sm']) !!}
            {!! link_to('nasabah','Kembali',['class'=>'btn btn-danger btn-sm']) !!}
        </td></tr>
    </table>
{!! Form::close() !!}

@stop