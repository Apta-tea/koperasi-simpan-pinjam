@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>DATA OPERATOR</h1>
          </div>
{!! Html::ul($errors->all()) !!}
<br>
{!! Form::button('+Tambah Data',['class'=>'btn btn-danger btn-sm','data-toggle'=>'modal', 'data-target'=>'#user']) !!}
<br><br>
<table class="table table-bordered" >
    <tr><th>Tanggal Input</th><th>Nama</th><th>E-mail</th><th colspan="2"></th></tr>
    @isset($user)
    @foreach($user as $u)
    <tr><td>{{ tgl_id($u->created_at) }}</td><td>{{ $u->name }}</td><td>{{ $u->email }}</td>
    <td class="text-center" colspan="2" width="50">
        {!! Form::open(array('url'=>'delete_user/'.$u->id,'method'=>'delete')) !!}
        {!! Form::button('<i class="fas fa-trash-alt" style="white"></i> Delete',['type'=>'submit','class'=>'btn btn-danger btn-sm',"onclick"=>"return confirm('Anda yakin?')"]) !!}
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
</section>
</div>
<div class="modal fade" id="user" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        {!! Form::button('Close',['class'=>'btn btn-secondary btn-sm','data-dismiss'=>'modal']) !!}
        {!! Form::submit('Simpan Data',['class'=>'btn btn-danger btn-sm']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@stop