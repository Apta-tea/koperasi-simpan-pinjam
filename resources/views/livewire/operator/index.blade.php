<div>
    @include('livewire.operator.create')
<br><br>
<table class="table table-striped" >
    <tr><th>Tanggal Input</th><th>Nama</th><th>E-mail</th><th colspan="2"></th></tr>
    @isset($user)
    @foreach($user as $data)
    <tr><td>{{ tgl_id($data->created_at) }}</td><td>{{ $data->name }}</td><td>{{ $data->email }}</td>
    <td class="text-center" colspan="2" width="50">
    <button wire:click="delete({{ $data->id }})" class="btn btn-sm btn-danger fas fa-trash-alt" onclick="confirm('Anda yakin?') || event.stopImmediatePropagation()"> Delete</button>
    </td>
    @endforeach
    @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">{{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif
    @endisset
    </tr>
</table>
</div>
