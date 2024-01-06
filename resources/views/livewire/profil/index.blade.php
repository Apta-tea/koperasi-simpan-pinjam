<div>
    @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">{{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif
    @include('livewire.profil.create')
    @include('livewire.profil.update')
    <br />
@if(!empty($profile))
    <table class="table table-striped ">
        <thead>
            <tr>
            <th>Nama Koperasi</th><th>Alamat</th><th>Telephone</th><th>File Logo</th><th>Status</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($profile as $data)
        	<tr>	
        		<td>{{ $data->nama_koperasi }}</td>
        		<td>{{ $data->alamat }}</td>
        		<td>{{ $data->telp }}</td>
                <td>
                @if (!empty($data->file_logo) && \File::exists(public_path().'/storage/foto/'.$data->file_logo))
                <img src="{{ asset('/storage/foto/'.$data->file_logo) }}" class="picture_50x50">
                @else 
                <img src="{{ asset('/foto/no_image.jpg') }}" class="picture_50x50">
                @endif
                </td>
                <td>{{ $data->status }}</td>
        		<td>
                    {!! link_to('profile/'.$data->id,' Detail',['class'=>'btn btn-primary btn-sm fas fa-eye']) !!}
                    <button data-toggle="modal" data-target="#updateModal" class="btn btn-primary btn-sm fas fa-edit" wire:click="edit({{ $data->id }})"> Edit</button>
                    <button wire:click="delete({{ $data->id }})" class="btn btn-danger btn-sm fas fa-trash-alt" onclick="confirm('Anda yakin?') || event.stopImmediatePropagation()"> Delete</button>
                </td>
        	</tr>
        	@endforeach
        </tbody>
    </table>
@else
    <div>
        <h6>Data tidak ditemukan.</h6>
    </div>
@endif
</div>
