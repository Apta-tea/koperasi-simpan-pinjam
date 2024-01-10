<div>
@include('livewire.nasabah.update')
@include('livewire.nasabah.detail')
<!-- @include('livewire.nasabah.create') -->
<div class="row justify-content-end">
    <div class="col-4">
        {{ Form::text('search','',['class'=>'form-control me-2', 'wire:model'=>'search', 'placeholder'=>'&#128269;']) }}
    </div></div>
{!! link_to('nasabah/create','+Tambah Data',['class'=>'btn btn-danger btn-sm']) !!} 
<br><br>
<table class="table table-striped table-responsive-sm" >
    <tr><th>Nomor Rekening</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th colspan="2"></th></tr>
    @isset($nasaba)
    @foreach($nasaba as $n)
    <tr><td>{{ $n->no_rekening }}</td><td>{{ $n->nama_lengkap }}</td><td>{{ $n->telp }}</td><td>{{ $n->alamat }}</td>
    <td width="200" class="border-end-0">
        {!! link_to('nasabah/'.$n->id,' Transaksi ',['class'=>'fas fa-coins']) !!}
        <a href="#" data-toggle="modal" data-target="#updateModal" class="fas fa-edit" wire:click="edit({{ $n->id }})" style="color:#47c363"> Edit</a>
        <a href="#" wire:click.prevent="delete({{ $n->id }})" class="fas fa-trash-alt" style="color:#fc544b" onclick="confirm('Anda yakin?') || event.stopImmediatePropagation()"> Delete </a>
        <a href="#" data-toggle="modal" data-target="#detailModal" class="fas fa-eye" wire:click="edit({{ $n->id }})"> Detail</a>
    </td>
    @endforeach
    </td></tr>
</table>
@if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
    </div>
@endif
{{ $nasaba->links() }}
@endisset
</div>
</div>

