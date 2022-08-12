<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use Session;

class ShuController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('check');
    }

    public function index()
    {
        //
        $nasabah = Nasabah::all();
        $data['jnasabah'] = count($nasabah); 
        $data['kas'] = \DB::table('sisa_kas')->first();
        $data['tot_pinjam'] = \DB::table('tot_pinjam')->first();
        $data['saldo'] = \DB::table('nasabahs')->select(\DB::raw('sum(saldo_akhir) as saldo'))->first();
        $data['laba'] = \DB::table('laba')->first();
        return view('Shu.index',$data);
    }

    public function proc(Request $request)
    {
        $laba = $request->laba;
        $shu = $request->shu;
        $operasional = $request->operasional;
        $nlaba = $laba-$operasional;
        $janggota = $request->jnasabah;
        $simpanan = $request->simpanan;
        $simpanp = $simpanan/100;
        $user_id = \Auth::user()->id;
        $nasabah = Nasabah::all();
        $max_nasabah = Nasabah::max('saldo_akhir');
        if ($laba<$operasional)
        {
            $pesan = "Input dana operasional anda lebih besar dari laba";
        }else{
                if ($request->shu===null)
                {
                    \DB::table('general_ledgers')->insert([
                        'total' => $operasional,
                        'jenis_transaksi' => 'operasional',
                        'user_id' => $user_id,
                        'status_pembukuan' => '1',
                        'created_at' => now()
                        ]);
                    foreach($nasabah as $n){
                        $saldo_shu = (($n->saldo_akhir/$simpanp)/100)*$nlaba;
                        $saldo_n = $n->saldo_akhir+$saldo_shu;
                        \DB::table('transaksis')->insert([
                            'nasabah_id' => $n->id,
                            'total' => $saldo_shu,
                            'jenis_transaksi' => 'shu',
                            'user_id' => $user_id,
                            'created_at' => now()
                            ]);
                        \DB::table('nasabahs')->where('id',$n->id)->update(['saldo_akhir'=>$saldo_n]);
                    }
                    \DB::table('pengembalians')->where('aktif','=','1')->update(['aktif'=>'0']);
                    $pesan = "Sisa hasil usaha sudah dibagikan pada semua anggota!";
                }else{
                    if ((($max_nasabah*(($shu/100)/12))*$janggota)<$nlaba)
                    {
                        $pesan = "Nilai bagi hasil yang anda input terlalu besar, laba tidak mencukupi!";
                    }else{
                    \DB::table('general_ledgers')->insert([
                        'total' => $operasional,
                        'jenis_transaksi' => 'operasional',
                        'user_id' => $user_id,
                        'status_pembukuan' => '1',
                        'created_at' => now()
                        ]);
                    foreach($nasabah as $n){
                        $saldo_shu = (($shu/100)/12)*$n->saldo_akhir;
                        $saldo_n = $n->saldo_akhir+$saldo_shu;
                        \DB::table('transaksis')->insert([
                            'nasabah_id' => $n->id,
                            'total' => $saldo_shu,
                            'jenis_transaksi' => 'shu',
                            'user_id' => $user_id,
                            'created_at' => now()
                            ]);
                        \DB::table('nasabahs')->where('id',$n->id)->update(['saldo_akhir'=>$saldo_n]);
                    }
                    \DB::table('pengembalians')->where('aktif','=','1')->update(['aktif'=>'0']);
                    $pesan = "Sisa hasil usaha sudah dibagikan pada semua anggota!";
                }
                }
    }
        Session::flash('pesan',$pesan);
        return redirect('shu');
    }

}
