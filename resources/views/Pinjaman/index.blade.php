@extends('Template')
@section('content') 
    <div class="row justify-content-end">
    <div class="col-4">
    {!! Form::open(array('url'=>'pinjaman/search','class'=>'d-flex','role'=>'search')) !!}
    {!! Form::text('keyword',null,['class'=>'form-control me-2','placeholder'=>'Search']) !!}
    {!! Form::submit('Search',['class'=>'btn btn-outline-success']) !!}
    {!! Form::close() !!}
    </div></div>
    <br><br>
<table class="table table-bordered table-responsive-sm">
    <tr><th colspan="2" class="text-center">PERINCIAN DANA</th></tr>
    @isset($kas,$tot_pinjam)
    <tr><td>DANA BERGULIR</td><td>{{ 'Rp.'. number_format($tot_pinjam->total) }}</td></tr>
    <tr><td>DANA TERSEDIA</td><td>{{ 'Rp.'. number_format($kas->total) }}</td></tr>
    @endisset
</table>
<br>
{!! link_to('pinjaman/create','+Tambah Data',['class'=>'btn btn-danger btn-sm']) !!}
<br><br>
<table class="table table-bordered" >
    <tr><th colspan="7" class="text-center">DATA PINJAMAN</th></tr>
    <tr><th>Tanggal Peminjaman</th><th>Nama</th><th>Jumlah Pinjaman</th><th>Jumlah Angsuran</th><th>Keterangan</th><th colspan="2"></th></tr>
    @isset($pinjaman)
    @foreach($pinjaman as $p)
    <tr><td>{{ tgl_id($p->created_at) }}</td><td>{{ $p->nama_lengkap }}</td><td>{{ number_format($p->total) }}</td><td>{{ $p->angsuran }}</td><td>{{ $p->ket }}</td>
    <td width="120" class="">
        {!! Form::open(array('url'=>'pinjaman/'.$p->id,'method'=>'delete')) !!}
        {!! Form::submit('Delete',['class'=>'btn btn-danger btn-sm',"onclick"=>"return confirm('Anda yakin?')"]) !!}
        {!! Form::close() !!}
    </td><td>
        @php
        $angsuran = \App\Models\Angsuran::where(['pinjaman_id' => $p->id,'status'=>'1'])->first();
        @endphp
        @if (isset($angsuran))
        {!! link_to('pinjaman/'.$p->id,'Angsuran',['class'=>'btn btn-warning btn-sm']) !!}
        @else
        {!! link_to('pinjaman/'.$p->id,'Angsuran',['class'=>'btn btn-warning btn-sm disabled']) !!}
        @endif
    @endforeach
    {!! $pinjaman->render() !!}
    @if (Session::has('pesan'))
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    {{ Session::get('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @endisset
    </td></tr>
</table>
@stop