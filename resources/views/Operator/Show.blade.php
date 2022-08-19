@extends('Template')
@section('content') 
{!! Html::ul($errors->all()) !!}
<br>
{!! Form::button('+Tambah Data',['class'=>'btn btn-danger btn-sm','data-bs-toggle'=>'modal', 'data-bs-target'=>'#user']) !!}
<br><br>
<table class="table table-bordered" >
    <tr><th colspan="7" class="text-center">DATA OPERATOR</th></tr>
    <tr><th>Tanggal Input</th><th>Nama</th><th>E-mail</th><th colspan="2"></th></tr>
    @isset($user)
    @foreach($user as $u)
    <tr><td>{{ tgl_id($u->created_at) }}</td><td>{{ $u->name }}</td><td>{{ $u->email }}</td>
    <td class="text-center" colspan="2" width="50">
        {!! Form::open(array('url'=>'delete_user/'.$u->id,'method'=>'delete')) !!}
        {!! Form::submit('Delete',['class'=>'btn btn-danger btn-sm',"onclick"=>"return confirm('Anda yakin?')"]) !!}
        {!! Form::close() !!}
    </td>
    @endforeach
    @if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @endisset
    </tr>
</table>
<div class="modal fade" id="user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Operator</h5>
      </div>
      <div class="modal-body">
        {!! Form::open(array('url'=>'adduser')) !!}
        <table class='table table-borderless table-responsive-sm'>
        <tr><td>Nama</td><td>{!! Form::text('name','',['class'=>'form-control','required']) !!}</td></tr>
        <tr><td>E-mail</td><td>{!! Form::text('email','',['class'=>'form-control','onfocus'=>'this.value=""','required']) !!}</td></tr>
        <tr><td>Password</td><td>{!! Form::password('password',['class'=>'form-control','id'=>'password','onfocus'=>'this.value=""','required']) !!}</td></tr>
        <tr><td>Confirm Password</td><td>{!! Form::password('password_confirmation',['class'=>'form-control','id'=>'password-confirm','required']) !!}</td></tr>
        </table>        
      </div>
      <div class="modal-footer">
        {!! Form::button('Close',['class'=>'btn btn-secondary btn-sm','data-bs-dismiss'=>'modal']) !!}
        {!! Form::submit('Simpan Data',['class'=>'btn btn-danger btn-sm']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop