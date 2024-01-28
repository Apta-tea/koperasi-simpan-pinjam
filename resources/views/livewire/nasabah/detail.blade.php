
<div wire:ignore.self id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Detail Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
             <table class="table table-striped">               
                <tr><td>Nomor Rekening</td><td>{{ $no_rekening }}</td></tr> 
                <tr><td>Nama Lengkap</td><td>{{ $nama_lengkap }}</td></tr>
                <tr><td>Alamat</td><td>{{ $alamat }}</td></tr>
                <tr><td>Tlp/ HP</td><td>{{ $telp }}</td></tr>
                <tr><td>No KTP</td><td>{{ $no_ktp }}</td></tr>
                <tr><td>Saldo</td><td>{{ $saldo_akhir }}</td></tr>
                <tr><td>Status</td><td>{{ $status }}</td></tr>
            </table>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
</div>

