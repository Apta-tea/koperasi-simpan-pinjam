@extends('Template-0')
@section('content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile Koperasi</h1>
          </div> 
{!! Html::ul($errors->all()) !!}
{!! link_to('profile','List',['class'=>'fas fa-long-arrow-alt-left']) !!}
<table class="table table-striped table-bordered">
	<tr>
		<td>Nama Koperasi</td>
		<td>{{ $profile->nama_koperasi }}</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>{{ $profile->alamat }}</td>
	</tr>
	<tr>
		<td>Kota</td>
		<td>{{ $profile->kota }}</td>
	</tr>
	<tr>
		<td>Provinsi</td>
		<td>{{ $profile->provinsi }}</td>
	</tr>
    <tr>
		<td>Kode Pos</td>
		<td>{{ $profile->kode_pos }}</td>
	</tr>
    <tr>
		<td>Telephone</td>
		<td>{{ $profile->telp }}</td>
	</tr>
    <tr>
		<td>File Logo</td>
		<td>
                @if (!empty($profile->file_logo) && File::exists(public_path().'/storage/foto/'.$profile->file_logo))
                <img src="{{ asset('/storage/foto/'.$profile->file_logo) }}" class="picture_50x50">
                @else 
                <img src="{{ asset('/foto/no_image.jpg') }}" class="picture_50x50">
                @endif
        </td>
	</tr>
	<tr>
		<td>Badan Hukum</td>
		<td>{{ $profile->badan_hukum }}</td>
	</tr>
    <tr>
		<td>Status</td>
		<td>{{ $profile->status }}</td>
	</tr>
	<tr>
		<td>Created At</td>
		<td>{{ $profile->created_at }}</td>
	</tr>
	<tr>
		<td>Updated At</td>
		<td>{{ $profile->updated_at }}</td>
	</tr>
</table>
</section>
</div>
@stop
