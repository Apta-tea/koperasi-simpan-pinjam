@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>UPDATE NASABAH</h1>
          </div> 
{!! Html::ul($errors->all()) !!}
{!! Form::model($nasabah,array('url'=>'nasabah/'.$nasabah->id,'method'=>'patch')) !!}
    <table class='table table-bordered table-responsive-sm'>
        <tr><td>Nomor Rekening</td><td>{!! Form::text('no_rekening',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>Nama Lengkap</td><td>{!! Form::text('nama_lengkap',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>Telp/ HP</td><td>{!! Form::text('telp',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>Alamat</td><td>{!! Form::textarea('alamat',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td>No KTP</td><td>{!! Form::text('no_ktp',null,['class'=>'form-control']) !!}</td></tr>
        <tr><td colspan=2>
            {!! Form::button('<i class="fas fa-pen"></i> Update Data',['type'=>'submit','class'=>'btn btn-danger btn-sm']) !!}
            {!! link_to('nasabah',' Kembali',['class'=>'btn btn-warning btn-sm fas fa-undo']) !!}
        </td></tr>
    </table>
{!! Form::close() !!}
</section>
</div>
@stop