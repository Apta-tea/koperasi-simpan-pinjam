<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use App\Models\Nasabah;
use App\Models\General_ledger;
use App\Models\Transaksi;
use Session;
use Illuminate\Support\Carbon;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('check');
    }

    public function index()
    {
        //
        $data['pinjaman'] = Pinjaman::where('status','1')->paginate(20);
        $data['kas'] = \DB::table('sisa_kas')->first();
        $data['tot_pinjam'] = \DB::table('tot_pinjam')->first();
        return view('Pinjaman.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Pinjaman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $skema=$request->skema;
        $angsuran=$request->angsuran;
        $total=$request->total;
        $persen=$request->persen;
        $no_rekening=$request->no_rekening;
        $nasabah = \DB::table('nasabahs')->where('no_rekening','=',$no_rekening)->first();
        $nasabah_stat = $nasabah->status_pinjaman;
        $nasabah_id = $nasabah->id;
        $user_id = \Auth::user()->id;
        $sisa_kas = \DB::table('sisa_kas')->first();
        if ($nasabah_stat=='0'){
            $data = array(
                'no_rekening'=>$no_rekening,
                'nama_lengkap'=>$request->nama_lengkap,
                'total'=>$total,
                'angsuran'=>$angsuran,
                'persen'=>$persen,
                'skema'=>$skema,
                'ket'=>$request->ket
            );
           $loan = Pinjaman::create($data);
           $pinjaman_id = $loan->id;
           if ($sisa_kas<$total)
           {
            $pesan = "Maaf Kas masih belum memiliki dana!!";
           }
           elseif ($skema=='flat')
           {
               $j_cicil=((($persen/100)*$total)+$total)/$angsuran;
               $angsur=array(
                    'pinjaman_id'=>$pinjaman_id,
                    'jumlah_cicilan'=>$j_cicil
               );
               for($i=1;$i<=$angsuran;$i++){
                   Angsuran::create($angsur);
               }
               $trans = \DB::table('transaksis')->insertGetId([
                        'nasabah_id' => $nasabah_id,
                        'total' => $total,
                        'jenis_transaksi' => 'pinjaman',
                        'user_id' => $user_id,
                        'created_at' => now()
                        ]);
               \DB::table('nasabahs')->where('no_rekening',$no_rekening)->update(['status_pinjaman'=>'1']);
               \DB::table('pinjamans')->where('id',$pinjaman_id)->update(['transaksi_id'=>$trans]);
           }else{      
               $termin=$angsuran;
               $tot_trans=$total;      
               for($i=1;$i<=$termin;$i++){
                   $j_cicil=((($persen/100)*$total)+$total)/$angsuran;
                   $angsur=array(
                    'pinjaman_id'=>$loan->id,
                    'jumlah_cicilan'=>$j_cicil
                   );
                   Angsuran::create($angsur);
                   $total=$total-$j_cicil;
                   $angsuran--;
               }
               $trans = \DB::table('transaksis')->insertGetId([
                'nasabah_id' => $nasabah_id,
                'total' => $tot_trans,
                'jenis_transaksi' => 'pinjaman',
                'user_id' => $user_id,
                'created_at' => now()
                ]);
               \DB::table('nasabahs')->where('no_rekening',$no_rekening)->update(['status_pinjaman'=>'1']);
               \DB::table('pinjamans')->where('id',$pinjaman_id)->update(['transaksi_id'=>$trans]);
           }
        }else{
            $pesan = "Maaf Nasabah masih memiliki pinjaman!!";
        }
        if (isset($pesan)){
            Session::flash('pesan',$pesan);
        }
        return redirect('pinjaman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
         $data['angsuran'] = \DB::table('angsurans')
         ->join('pinjamans','pinjamans.id','=','angsurans.pinjaman_id')
         ->where('angsurans.pinjaman_id','=',$id)
         ->where('angsurans.status','=','1')
         ->select('angsurans.id','angsurans.pinjaman_id','angsurans.jumlah_cicilan','pinjamans.nama_lengkap','pinjamans.no_rekening','angsurans.created_at','pinjamans.skema')
         ->get();
         if ($data['angsuran']->isEmpty()){
            return redirect('pinjaman');
         }else{    
            return view('Pinjaman.show',$data);
         }
    }

    public function search(Request $request)
    {
        //
        $search = $request['keyword'];
        $data['pinjaman'] = Pinjaman::where('nama_lengkap','LIKE',"%{$search}%")->paginate(5);
        $data['kas'] = \DB::table('sisa_kas')->first();
        $data['tot_pinjam'] = \DB::table('tot_pinjam')->first();
        return view('Pinjaman.index',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        \DB::table('angsurans')->where('id',$request->angsuran_id)->update(['status'=>'0']);
        $nasabah = \DB::table('nasabahs')
                    ->where('nama_lengkap','=',$request->nama_lengkap)
                    ->where('no_rekening','=',$request->no_rekening)
                    ->first();
        $user_id = \Auth::user()->id;
        \DB::table('transaksis')->insert([
            'nasabah_id' => $nasabah->id,
            'total' => $request->jumlah_cicilan,
            'jenis_transaksi' => 'pengembalian',
            'user_id' => $user_id,
            'created_at' => now()
            ]);
        \DB::table('pengembalians')->insert([
            'pinjaman_id' => $request->pinjaman_id,
            'jumlah_cicilan' => $request->jumlah_cicilan,
            'created_at' => now()
            ]);
        return redirect("pinjaman/$request->pinjaman_id");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $status_angsuran = \DB::table('angsurans')->where('pinjaman_id','=',$id)->orderBy('id','asc')->limit(1)->value('status');
        if ($status_angsuran=='1'){
            $pinjaman = Pinjaman::find($id);
            $no_rekening = $pinjaman->no_rekening;
            $transaksi_id = $pinjaman->transaksi_id;
            \DB::table('nasabahs')->where('no_rekening',$no_rekening)->update(['status_pinjaman'=>'0']);           
            \DB::table('angsurans')->where('pinjaman_id','=', $id)->delete();
            \DB::table('transaksis')->where('id','=', $transaksi_id)->delete();
            \DB::table('general_ledgers')->where('transaksi_id','=', $transaksi_id)->delete();
            \DB::table('pinjamans')->where('id','=',$id)->delete();
        }else{
            $pinjaman = Pinjaman::find($id);
            $no_rekening = $pinjaman->no_rekening;
            \DB::table('nasabahs')->where('no_rekening',$no_rekening)->update(['status_pinjaman'=>'0']);
            \DB::table('pinjamans')->where('id','=',$id)->update(['status'=>'0']);
            \DB::table('angsurans')->where('pinjaman_id', '=', $id)->delete();
            \DB::table('pengembalians')->where('pinjaman_id','=',$id)->update(['status_pinjam'=>'0']);
        }

        return redirect('pinjaman');
        
    }

    public function get_name(Request $request)
    {
        $data = \DB::table('nasabahs')->where('no_rekening','=',$request->nor)->value('nama_lengkap');
        echo $data;
    }
}
