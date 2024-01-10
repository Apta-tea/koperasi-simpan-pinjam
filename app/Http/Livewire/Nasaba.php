<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Nasabah;

class Nasaba extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $no_rekening, $nama_lengkap, $alamat, $telp, $no_ktp, $saldo_akhir, $status, $foto;

    public function render()
    {
        //$this->nasaba = Nasabah::all();
        //return view('livewire.nasabah.index',['nasaba'=>Nasabah::where('nama_lengkap', 'like', '%'.$this->search.'%')->paginate(3)]);
       $nasaba = Nasabah::orderby('id','desc')->select('*');
        if (!empty($this->search)){
            $nasaba->orWhere('nama_lengkap','like',"%".$this->search."%");
            $nasaba->orWhere('no_rekening','like',"%".$this->search."%");
        }
        $nasaba = $nasaba->paginate(10);
        return view ('livewire.nasabah.index',['nasaba'=>$nasaba,]); 
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit($id)
    {
        $data = Nasabah::findOrFail($id);
        $this->data_id = $id;
        $this->no_rekening = $data->no_rekening;
        $this->nama_lengkap = $data->nama_lengkap;
        $this->telp = $data->telp;
        $this->alamat = $data->alamat;
        $this->no_ktp = $data->no_ktp;
        $this->saldo_akhir = $data->saldo_akhir;
        if ($data->status_pinjaman == '0'){
            $this->status = "Tidak ada pinjaman";
        }else{
            $this->status = "Ada pinjaman";
        }
    }

    public function resetInputFields()
    {
        $this->no_rekening = '';
        $this->nama_lengkap = '';
        $this->telp = '';
        $this->alamat = '';
        $this->no_ktp = '';
    }

    public function store()
    {
    	$validation = $this->validate([
    		'no_rekening' => 'required',
            'nama_lengkap'=> 'required',
            // 'foto' => 'image|max:1024',
    	]);
        if (!empty($this->foto)){
        $name = md5($this->foto . microtime()).'.'.$this->foto->extension();          
        $this->foto->storeAs('foto', $name, 'public');
    	Nasabah::create([
            'no_rekening'=> $this->no_rekening,
            'nama_lengkap'=> $this->nama_lengkap,
            'telp'=> $this->telp,
            'alamat'=> $this->alamat,
            'no_ktp'=> $this->no_ktp,
            'foto'=> $name
        ]);
    }else{
        Nasabah::create([
            'no_rekening'=> $this->no_rekening,
            'nama_lengkap'=> $this->nama_lengkap,
            'telp'=> $this->telp,
            'alamat'=> $this->alamat,
            'no_ktp'=> $this->no_ktp,
        ]);
    }
    	session()->flash('pesan', 'Data telah ditambahkan.');
    	$this->resetInputFields();
    	$this->emit('nasabahStore');
    }

    public function update()
    {
        $validate = $this->validate([
    		'no_rekening' => 'required',
            'nama_lengkap' => 'required',
        ]);
        $data = Nasabah::find($this->data_id);
        $data->update([
            'no_rekening'=> $this->no_rekening,
            'nama_lengkap'=> $this->nama_lengkap,
            'telp'=> $this->telp,
            'alamat'=> $this->alamat,
            'no_ktp'=> $this->no_ktp
        ]);
        session()->flash('pesan', 'Data telah diupdate.');
        $this->resetInputFields();
        $this->emit('nasabahStore');
    }

    public function delete($id)
    {
        Nasabah::find($id)->delete();
        session()->flash('pesan', 'Data telah dihapus.');
    }
}
