@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
{!! Form::model($nasabah,array('url'=>'nasabah/'.$nasabah->id,'method'=>'patch')) !!}
    <table class='table table-bordered table-responsive-sm'>
        <tr><td>Nomor Rekening</td><td>{!! Form::text('no_rekening',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>Nama Lengkap</td><td>{!! Form::text('nama_lengkap',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>Telp/ HP</td><td>{!! Form::text('telp',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>Alamat</td><td>{!! Form::textarea('alamat',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td colspan=2>
            {!! Form::submit('Update Data',['class'=>'btn btn-danger btn-sm']) !!}
            {!! link_to('nasabah','Kembali',['class'=>'btn btn-danger btn-sm']) !!}
        </td></tr>
    </table>
{!! Form::close() !!}

@stop