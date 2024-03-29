@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>TAMBAH NASABAH</h1>
          </div> 
{!! Html::ul($errors->all()) !!}
{!! Form::open(array('url'=>'nasabah', 'files'=>'true')) !!}
    <table class='table table-bordered table-responsive-sm'>
        <tr><td>Nomor Rekening</td><td>{!! Form::text('no_rekening','',['class'=>'form-control','maxlength'=>'8','required']) !!}</td></tr>
        <tr><td>Nama Lengkap</td><td>{!! Form::text('nama_lengkap','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Telp/ HP</td><td>{!! Form::text('telp','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Alamat</td><td>{!! Form::textarea('alamat','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>No KTP</td><td>{!! Form::text('no_ktp','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>Foto</td><td>{!! Form::file('foto',null,['class'=>'form-control']) !!} </td></tr>
        <tr><td colspan=2>
            {!! Form::button('<i class="fas fa-save"></i> Simpan Data',['type'=>'submit','class'=>'btn btn-danger btn-sm']) !!}
            {!! link_to('nasabah',' Kembali',['class'=>'btn btn-warning btn-sm fas fa-undo']) !!}
        </td></tr>
    </table>
{!! Form::close() !!}
</section>
</div>
@stop