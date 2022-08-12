<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Http\Requests\createNasabah;
use Illuminate\Support\Facades\Http;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\General_ledger;
use Session;
use Exception;

class NasabahController extends Controller
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
        $data['nasabah'] = Nasabah::paginate(5);
        return view('Nasabah.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Nasabah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createNasabah $request)
    {
        //

        if (!empty($request->file()))
        {
        $name = $request->file('foto')->getClientOriginalName();
        $path = $request->file('foto')->move(public_path().'/foto/',$name);
        $data = array(
            'no_rekening'=>$request->no_rekening,
            'nama_lengkap'=>$request->nama_lengkap,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp,
            'foto'=>$name
        );
        }else{
            $data = array(
                'no_rekening'=>$request->no_rekening,
                'nama_lengkap'=>$request->nama_lengkap,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp
            );
        }
    try
    {
        Nasabah::create($data);
        $pesan = 'Data sudah ditambahkan';
    }
    catch (Exception $exception)
    {
        $pesan = 'Database error!, ada duplikat nomor rekening' . $exception->getCode();
    }
    Session::flash('pesan',$pesan);
    return redirect('nasabah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        //
        $search = $request['keyword'];
        $data['nasabah'] = Nasabah::where('nama_lengkap','LIKE',"%{$search}%")->paginate(5);
        return view('Nasabah.index',$data);
    }

     public function show($id)
    {
        //
        $data['transaksi'] = \DB::table('transaksis')
                            ->join('users','users.id','=','transaksis.user_id')
                            ->where('transaksis.nasabah_id','=',$id)
                            ->select('transaksis.*','users.name')
                            ->paginate(10);
        $data['nasabah'] = Nasabah::find($id);
        return view('Nasabah.show',$data);
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
        $data['nasabah'] = Nasabah::find($id);
        return view('Nasabah.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(createNasabah $request, $id)
    {
        //
        $data = $request->all();
        $nasabah = Nasabah::find($id);
        $nasabah->update($data);
        return redirect('nasabah');
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
        $nasabah = Nasabah::find($id);
        $nasabah->delete($id);
        return redirect('nasabah');
    }

    public function transaksi(Request $request)
    {
        $this->validate($request,[
            'total'=>'required',
            'jenis_transaksi'=>'required']);
        $jenis = $request->jenis_transaksi;
        $id = $request->nasabah_id;
        $nasabah = Nasabah::find($id);
        $saldo = $nasabah->saldo_akhir;
        $status = $nasabah->status_pinjaman;
        $sisa_kas = \DB::table('sisa_kas')->first();
        if ($jenis=='debet')
        {
            if ($sisa_kas<$request->total){
                $pesan = 'Mohon maaf dana belum tersedia!!';
            }
            elseif ($saldo<$request->total){
                $pesan = 'Mohon maaf simpanan tidak cukup!!';
            }elseif ($status=='1'){
                $pesan = 'Mohon maaf tidak bisa melakukan penarikan, masih ada pinjaman!!';
            }else{
                $nsaldo =  ($saldo-$request->total);
                $nasabah->saldo_akhir=$nsaldo;
                $nasabah->save();
                $pesan = 'Simpanan sudah didebit';
                $transaksi = New Transaksi($request->all());
                \Auth::user()->opTrans()->save($transaksi);
            }
        }elseif($jenis=='denda'){
                if ($saldo<$request->total){
                $pesan = 'Mohon maaf simpanan tidak cukup!!';
                }else{
                $nsaldo =  ($saldo-$request->total);
                $nasabah->saldo_akhir=$nsaldo;
                $nasabah->save();
                $pesan = 'Denda sudah dikurangi dari simpanan';
                $transaksi = New Transaksi($request->all());
                \Auth::user()->opTrans()->save($transaksi);
                }
        }else{
                $nsaldo =  ($saldo+$request->total);
                $nasabah->saldo_akhir=$nsaldo;
                $nasabah->save();
                $pesan = 'Simpanan sudah ditambahkan';
                $transaksi = New Transaksi($request->all());
                \Auth::user()->opTrans()->save($transaksi);
        }
        Session::flash('pesan',$pesan);
        return redirect("nasabah/$request->nasabah_id");
        
    }
}
