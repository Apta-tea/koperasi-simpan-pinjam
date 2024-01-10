
<div wire:ignore.self id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="Nama Koperasi">Nama Koperasi</label>
                        <input type="text" id="nama_koperasi" class="form-control"  wire:model="nama_koperasi" />
                        @error('nama_koperasi')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Alamat">Alamat</label>
                        <input type="text" id="alamat" class="form-control" wire:model="alamat" />
                        @error('alamat')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Kota">Kota</label>
                        <input type="text" id="kota" class="form-control" wire:model="kota" />
                        @error('kota')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Provinsi">Provinsi</label>
                        <input type="text" id="provinsi" class="form-control" wire:model="provinsi" />
                        @error('provinsi')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Kode Pos">Kode Pos</label>
                        <input type="text" id="kode_pos" class="form-control" wire:model="kode_pos" />
                        @error('kode_pos')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Telepohone">Telephone</label>
                        <input type="text" id="telp" class="form-control" wire:model="telp" />
                        @error('telp')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="File Logo">File Logo</label>
                        <input type="file" id="file_logo" class="form-control" wire:model="file_logo" />
                        @error('file_logo')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Badan Hukum">Badan Hukum</label>
                        <input type="text" id="badan_hukum" class="form-control" wire:model="badan_hukum" />
                        @error('badan_hukum')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" id="status" wire:model="status">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                    <button wire:click.prevent="update()" class="btn btn-sm btn-success fas fa-save"> Update</button>
                    <button type="button" class="btn btn-secondary close-btn btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

