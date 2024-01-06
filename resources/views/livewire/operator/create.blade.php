
<div align="left">
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createModal">+Tambah Data</button>
</div>

<div wire:ignore.self id="createModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" id="name" class="form-control"  wire:model="name" />
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" id="email" class="form-control" wire:model="email" autofocus />
                        @error('email')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" id="password" class="form-control" name="password" wire:model="password" />
                        @error('password')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Password-confirm">Confirm Password</label>
                        <input type="password" id="password" class="form-control" name="password_confirmation" wire:model="password_confirmation" />
                        @error('password')<span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click.prevent="create()" class="btn btn-sm btn-success fas fa-save"> Save</button>
                    <button type="button" class="btn btn-sm btn-secondary close-btn" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

