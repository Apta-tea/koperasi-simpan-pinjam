<div>
{!! link_to('nasabah','List',['class'=>'fas fa-long-arrow-alt-left']) !!}
<br\>
<div class="row">
<div class="col-sm-6">
    <table class='table table-striped table-responsive-sm'>
        <!-- <tr><th colspan="3" class="text-center">NASABAH</th></tr> -->
        <tr><td width="200">Nama</td><td>{{ $nasabah->nama_lengkap }}</td><td rowspan="3"><img src="{{ asset('storage/foto').'/'.$nasabah->foto }}" width="100"></td></tr>
        <tr><td>Nomor Rekening</td><td>{{ $nasabah->no_rekening }}</td></tr>
        <tr><td>Telepon</td><td>{{ $nasabah->telp }}</td></tr>
        <tr><td>Total Saldo</td><td>{{ number_format($saldo_akhir) }}</td><td class="text-center">
        {!! Form::open(array('url'=>'laporan/transNas')) !!}
        {!! Form::hidden('nasabah_id',$nasabah->id) !!}
        {!! Form::button('<i class="fas fa-print"></i> Laporan',['type'=>'submit','class'=>'btn btn-success btn-sm','formtarget'=>'_blank']) !!}
        {!! Form::close() !!}
        </td></tr>
    </table>
</div>
<div class="col-sm-6">
    {!! Form::hidden('nasabah_id',$nasabah->id,['wire:model'=>'nid']) !!}
    @error('nid')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <table class='table table-bordered table-responsive-sm'>
        <tr><th colspan="2" class="text-center">FORM TRANSAKSI</th></tr>
        <tr><td width="200">Jumlah</td><td>{!! Form::text('total',null,['class'=>'form-control', 'wire:model'=>'total']) !!}</td></tr>
        @error('total')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        <tr><td>Jenis Transaksi</td><td>
        <select name="jenis_transaksi" wire:model="jenis_transaksi" class="form-control"><option selected="selected">--select--</option><option value="debet">DEBET</option><option value="wajib">SIMPANAN WAJIB</option><option value="sukarela">SIMPANAN SUKARELA</option><option value="denda">DENDA</option></select>
        @error('jenis_transaksi')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </td></tr>
        <tr><td colspan="2" class="text-right">{!! Form::button('<i class="fas fa-cash-register"></i> Proses',['class'=>'btn btn-danger btn-sm float-end', 'wire:click.prevent'=>'store()']) !!}</td></tr>
    </table>
</div>
</div>
@if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@isset($transaksi)
<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
        <tr><td>Tanggal</td><td>Jenis Transaksi</td><td>Jumlah</td><td>Operator</td></tr>
        @foreach($transaksi as $t)
        <tr><td>{{ tgl_id($t->created_at) }}</td><td>{{ $t->jenis_transaksi }}</td><td>{{ number_format($t->total) }}</td><td>{{ $t->name }}</td></tr>
        @endforeach
    </table>
</div>
</div>
{!! $transaksi->links() !!}
@endisset
</div>

