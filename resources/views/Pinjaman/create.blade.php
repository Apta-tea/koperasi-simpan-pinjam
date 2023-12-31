@extends('Template')
@section('content')
{!! Html::ul($errors->all()) !!}
{!! Form::open(array('url'=>'pinjaman')) !!}
    <table class='table table-bordered table-responsive-sm'>
        <tr><td>Nomor Rekening</td><td>{!! Form::text('no_rekening','',['class'=>'form-control','required','id'=>'norek']) !!}</td></tr>
        <tr><td>Nama Lengkap</td><td>{!! Form::text('nama_lengkap','',['class'=>'form-control','required','readonly','id'=>'nama']) !!}</td></tr>
        <tr><td>Jumlah Pinjaman</td><td>{!! Form::text('total','',['class'=>'form-control','required','id'=>'total']) !!}</td></tr>
        <tr><td>Jumlah Angsuran</td><td>{!! Form::text('angsuran','',['class'=>'form-control','placeholder'=>'Banyaknya kali (x) angsuran','maxlength'=>'2','required']) !!}</td></tr>
        <tr><td>Keperluan</td><td>{!! Form::text('ket','',['class'=>'form-control']) !!}</td></tr>
        <tr><td>Presentase Bagi Hasil (%)</td><td>{!! Form::text('persen','',['class'=>'form-control','placeholder'=>'2.5','maxlength'=>'3','required']) !!}</td></tr>
        <tr><td>Skema Angsuran</td><td>{!! Form::select('skema',array('flat'=>'Flat','nflat'=>'Non Flat'),['class'=>'form-control']) !!}</td></tr>
        <tr><td colspan=2>
            {!! Form::submit('Simpan Data',['class'=>'btn btn-danger btn-sm']) !!}
            {!! link_to('pinjaman','Kembali',['class'=>'btn btn-danger btn-sm']) !!}
        </td></tr>
    </table>
{!! Form::close() !!}

<script type="text/javascript">
 $(document).ready(function() {
            
$("#norek").change(function(){
    var no = $(this).val();
    var _token = $('input[name="_token"]').val();
        $.ajax({
            method: "POST",
            url: "{{ url('pinjaman/get_name') }}",
            data: { nor:no, _token:_token },
            success:function(data){
                $("#nama").val(data);
        }
    });
})
}); 
</script>
@stop

