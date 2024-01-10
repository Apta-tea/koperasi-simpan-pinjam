<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nasabah;
use App\Models\Transaksi;
use Livewire\WithPagination;

class Transact extends Component
{
    use WithPagination;
    public $saldo_akhir, $nid;
    public $total, $jenis_transaksi;

    public function mount($id)
    {
        $nasaba = Nasabah::find($id);


            if($nasaba){
                $this->nasabah = $nasaba;
                $this->nid = $id;
                $this->saldo_akhir = $nasaba->saldo_akhir;
            }

    }

    public function render()
    {
        $transak = \DB::table('transaksis')
        ->join('users','users.id','=','transaksis.user_id')
        ->where('transaksis.nasabah_id','=',$this->nid)
        ->select('transaksis.*','users.name')
        ->orderBy('transaksis.id', 'desc')
        ->paginate(10);

        return view('livewire.transact.transact',['nasabah'=>$this->nasabah,'transaksi'=>$transak,]);
    }

    public function resetInputFields()
    {
        $this->total = '';
        $this->jenis_transaksi = '';
    }

    public function store()
    {
        $this->validate([
            'total'=>'required',
            'jenis_transaksi'=>'required']);
            $data = array(
                'jenis_transaksi'=>$this->jenis_transaksi,
                'total'=>$this->total,
                'nasabah_id'=>$this->nid,
            );
        $jenis = $this->jenis_transaksi;
        $id = $this->nid;
        $nasabah = Nasabah::find($id);
        $saldo = $nasabah->saldo_akhir;
        $status = $nasabah->status_pinjaman;
        $sisa_kas = \DB::table('sisa_kas')->first();
        if ($jenis=='debet')
        {
            if ($sisa_kas<$this->total){
                $pesan = 'Mohon maaf dana belum tersedia!!';
            }
            elseif ($saldo<$this->total){
                $pesan = 'Mohon maaf simpanan tidak cukup!!';
            }elseif ($status=='1'){
                $pesan = 'Mohon maaf tidak bisa melakukan penarikan, masih ada pinjaman!!';
            }else{
                $nsaldo =  ($saldo-$this->total);
                $nasabah->saldo_akhir=$nsaldo;
                $nasabah->save();
                $this->saldo_akhir = $nsaldo;
                $pesan = 'Simpanan sudah didebit';
                $transaksi = New Transaksi($data);
                \Auth::user()->opTrans()->save($transaksi);
            }
        }elseif($jenis=='denda'){
                if ($saldo<$this->total){
                $pesan = 'Mohon maaf simpanan tidak cukup!!';
                }else{
                $nsaldo =  ($saldo-$this->total);
                $nasabah->saldo_akhir=$nsaldo;
                $nasabah->save();
                $this->saldo_akhir = $nsaldo;
                $pesan = 'Denda sudah dikurangi dari simpanan';
                $transaksi = New Transaksi($data);
                \Auth::user()->opTrans()->save($transaksi);
                }
        }else{
                $nsaldo =  ($saldo+$this->total);
                $nasabah->saldo_akhir=$nsaldo;
                $nasabah->save();
                $this->saldo_akhir = $nsaldo;
                $pesan = 'Simpanan sudah ditambahkan';
                $transaksi = New Transaksi($data);
                \Auth::user()->opTrans()->save($transaksi); 
        }

        session()->flash('pesan', $pesan);
    	$this->resetInputFields();

    }
}
