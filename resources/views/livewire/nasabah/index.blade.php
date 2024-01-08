<div>
<div class="row justify-content-end">
    <div class="col-4">
        {{ Form::text('search','',['class'=>'form-control me-2', 'wire:model'=>'search', 'placeholder'=>'&#128269;']) }}
    </div></div>

{!! link_to('nasabah/create','+Tambah Data',['class'=>'btn btn-danger btn-sm']) !!}
<br><br>
<table class="table table-bordered table-responsive-sm" >
    <tr><th>Nomor Rekening</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th colspan="2"></th></tr>
    @isset($nasaba)
    @foreach($nasaba as $n)
    <tr><td>{{ $n->no_rekening }}</td><td>{{ $n->nama_lengkap }}</td><td>{{ $n->telp }}</td><td>{{ $n->alamat }}</td>
    <td width="120" class="border-end-0">
        {!! link_to('nasabah/'.$n->id,'',['class'=>'fas fa-eye']) !!}
        {!! link_to('nasabah/'.$n->id.'/edit','',['class'=>'fas fa-edit']) !!}
        {!! Form::open(array('url'=>'nasabah/'.$n->id,'method'=>'delete')) !!}
        {{ Form::button('<i class="fas fa-trash-alt" style="color:#6777ef"></i>',['class'=>'btn btn-flat','type'=>'submit','role'=>'button',"onclick"=>"return confirm('Anda yakin?')"]) }}
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
{{ $nasaba->links() }}
@endisset
</div>
</div>

