<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\fpdf\FPDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransExport;
use App\Models\Nasabah;

class LaporanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('check');
    }

    public function lapPdf()
    {
        $fpdf = New pdf('P','mm','A4');
        $fpdf->AliasNbPages();
        $fpdf->AddPage();
        $fpdf->SetFont('Times','B',12);
        $fpdf->SetLeftMargin(20);
        $fpdf->Cell(8,8,'No',1,0,'C');
        $fpdf->Cell(30,8,'Tanggal',1,0,'C');
        $fpdf->Cell(30,8,'No. Rekening',1,0,'C');
        $fpdf->Cell(40,8,'Nama',1,0,'C');
        $fpdf->Cell(30,8,'Jumlah',1,0,'C');
        $fpdf->Cell(30,8,'Operator',1,1,'C');
        $transaksi = \DB::table('transaksis')->join('users','users.id','=','transaksis.user_id')
        ->join('nasabahs','nasabahs.id','=','transaksis.nasabah_id')->select('nasabahs.no_rekening',
        'nasabahs.nama_lengkap','transaksis.created_at','transaksis.total','users.name')->get();
        $no=1;
        foreach ($transaksi as $t)
        {
            $fpdf->SetFont('Times','',12);
            $fpdf->SetLeftMargin(20);
            $fpdf->Cell(8,8,$no,1,0,'C');
            $fpdf->Cell(30,8,tgl_id($t->created_at),1,0,'C');
            $fpdf->Cell(30,8,$t->no_rekening,1,0,'C');
            $fpdf->Cell(40,8,$t->nama_lengkap,1,0,'C');
            $fpdf->Cell(30,8,$t->total,1,0,'C');
            $fpdf->Cell(30,8,$t->name,1,1,'C');
            $no++;
        }
        $fpdf->Output();
        die;
    }

    public function transNas(Request $request)
    {
        $nasabah = Nasabah::find($request->nasabah_id);
        $fpdf = New pdf('P','mm','A4');
        $fpdf->AliasNbPages();
        $fpdf->AddPage();
        $fpdf->SetFont('Times','B',12);
        $fpdf->SetLeftMargin(25);
        $fpdf->Cell(10,8,'Nama: '.$nasabah->nama_lengkap,0,1,'L');
        $fpdf->Cell(10,8,'No. Rekening: '.$nasabah->no_rekening,0,1,'L');
        $fpdf->Cell(10,8,'',0,1,'C');
        $fpdf->Cell(10,8,'No',1,0,'C');
        $fpdf->Cell(30,8,'Tanggal',1,0,'C');
        $fpdf->Cell(40,8,'Kode Operator',1,0,'C');
        $fpdf->Cell(40,8,'Jenis Transaksi',1,0,'C');
        $fpdf->Cell(40,8,'Jumlah',1,1,'C');
        $transaksi = \DB::table('transaksis')
                    ->where('transaksis.nasabah_id','=',$request->nasabah_id)
                    ->select('transaksis.*')
                    ->orderBy('created_at','asc')
                    ->limit(25)
                    ->get();
        $no=1;
        foreach ($transaksi as $t)
        {
            $fpdf->SetFont('Times','',12);
            $fpdf->SetLeftMargin(25);
            $fpdf->Cell(10,8,$no,1,0,'C');
            $fpdf->Cell(30,8,tgl_id($t->created_at),1,0,'C');
            $fpdf->Cell(40,8,$t->user_id,1,0,'C');
            $fpdf->Cell(40,8,$t->jenis_transaksi,1,0,'C');
            $fpdf->Cell(40,8,number_format($t->total),1,1,'C');
            $no++;
        }
        $fpdf->Cell(120,8,'Total Saldo: ',1,0,'L');
        $fpdf->Cell(40,8,number_format($nasabah->saldo_akhir),1,1,'C');
        $fpdf->Output();
        die;
    }

    public function pinjNas(Request $request)
    {
        $pinjaman = \DB::table('angsurans')
                    ->join('pinjamans','pinjamans.id','=','angsurans.pinjaman_id')
                    ->where('angsurans.pinjaman_id','=',$request->pinjaman_id)
                    ->where('angsurans.status','=','1')
                    ->select('angsurans.id','angsurans.pinjaman_id','angsurans.jumlah_cicilan','pinjamans.nama_lengkap','pinjamans.no_rekening','angsurans.created_at','pinjamans.skema')
                    ->get();
        $fpdf = New pdf('P','mm','A4');
        $fpdf->AliasNbPages();
        $fpdf->AddPage();
        $fpdf->SetFont('Times','B',12);
        $fpdf->SetLeftMargin(25);
        $fpdf->Cell(10,8,'Nama: '.$pinjaman[0]->nama_lengkap,0,1,'L');
        $fpdf->Cell(10,8,'No. Rekening: '.$pinjaman[0]->no_rekening,0,1,'L');
        $fpdf->Cell(10,8,'',0,1,'C');
        $fpdf->Cell(10,8,'No',1,0,'C');
        $fpdf->Cell(30,8,'Tanggal',1,0,'C');
        $fpdf->Cell(40,8,'Skema',1,0,'C');
        $fpdf->Cell(80,8,'Jumlah Cicilan',1,1,'C');
        //$fpdf->Cell(40,8,'Sisa Pinjaman',1,1,'C');
        $no=1;
        foreach ($pinjaman as $p)
        {
            $fpdf->SetFont('Times','',12);
            $fpdf->SetLeftMargin(25);
            $fpdf->Cell(10,8,$no,1,0,'C');
            $fpdf->Cell(30,8,tgl_id(tglAdd($p->created_at,$no)),1,0,'C');
            $fpdf->Cell(40,8,$p->skema,1,0,'C');
            $fpdf->Cell(80,8,number_format($p->jumlah_cicilan),1,1,'C');
            $no++;
        }
        $tot_pinjam = \DB::table('angsurans')
                    ->where('pinjaman_id','=',$request->pinjaman_id)
                    ->where('angsurans.status','=','1')
                    ->sum('jumlah_cicilan');
        $fpdf->Cell(80,8,'Total Pinjaman: ',1,0,'L');
        $fpdf->Cell(80,8,number_format($tot_pinjam),1,1,'C');
        $fpdf->Output();
        die;
    }



    public function lapXls()
    {
        return Excel::download(new TransExport, 'data transaksi.xlsx');
               
        
    }


}
 
class pdf extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image(asset('foto').'/'.'member.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Times','B',16);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(40,10,'KOPERASI MINI-KSP',0,0,'C');
        // Line break
        $this->Ln(25);
        $this->Cell(190,0,'',1,0,'C');
        $this->Ln(10);
    }

    // Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Times','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
}
    
}