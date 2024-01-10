<div align="left">
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">+Tambah Data</button>
</div>
<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="Nomor Rekening">Nomor Rekening</label>
                        <input type="text" id="no_rekening" class="form-control"  wire:model="no_rekening" />
                        @error('no_rekening')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Nama Lengkap">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" class="form-control" wire:model="nama_lengkap" />
                        @error('nama_lengkap')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Telp/ HP">Telp/ HP</label>
                        <input type="text" id="telp" class="form-control" wire:model="telp" />
                        @error('telp')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <input type="text" id="alamat" class="form-control" wire:model="alamat" />
                        @error('alamat')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="No KTP">No KTP</label>
                        <input type="text" id="no_ktp" class="form-control" wire:model="no_ktp" />
                        @error('no_ktp')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <input type="file" id="foto" class="form-control" wire:model="foto" />
                        @error('foto')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                    <button wire:click.prevent="store()" class="btn btn-sm btn-success fas fa-save"> Save</button>
                    <button type="button" class="btn btn-sm btn-secondary close-btn" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

