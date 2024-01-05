<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profile;
use Livewire\WithFileUploads;

class Profil extends Component
{
    public $profile, $nama_koperasi, $alamat, $kota, $provinsi, $kode_pos, $telp, $file_logo, $badan_hukum, $status;
    use WithFileUploads;

    public function render()
    {
        $this->profile = Profile::all();
        return view('livewire.profil.index');
    }

    public function resetInputFields()
    {
    	$this->nama_koperasi = '';
    	$this->alamat = '';
    	$this->kota = '';
        $this->provinsi = '';
        $this->kode_pos = '';
        $this->telp = '';
        $this->file_logo = '';
        $this->badan_hukum = '';
        $this->status = '';
    }

    public function store()
    {
    	$validation = $this->validate([
    		'nama_koperasi' => 'required',
            // 'file_logo' => 'image|max:1024',
    	]);
        if (!empty($this->file_logo)){
        $name = md5($this->file_logo . microtime()).'.'.$this->file_logo->extension();          
        $this->file_logo->storeAs('foto', $name, 'public');
    	Profile::create([
            'nama_koperasi'=> $this->nama_koperasi,
            'alamat'=> $this->alamat,
            'kota'=> $this->kota,
            'provinsi'=> $this->provinsi,
            'kode_pos'=> $this->kode_pos,
            'telp'=> $this->telp,
            'file_logo'=> $name,
            'badan_hukum'=> $this->badan_hukum,
            'status'=> $this->status
        ]);
    }else{
        Profile::create([
            'nama_koperasi'=> $this->nama_koperasi,
            'alamat'=> $this->alamat,
            'kota'=> $this->kota,
            'provinsi'=> $this->provinsi,
            'kode_pos'=> $this->kode_pos,
            'telp'=> $this->telp,
            'file_logo'=> '',
            'badan_hukum'=> $this->badan_hukum,
            'status'=> $this->status
        ]);
    }
    	session()->flash('message', 'Data telah ditambahkan.');
    	$this->resetInputFields();
    	$this->emit('profilStore');
    }

    public function edit($id)
    {
        $data = Profile::findOrFail($id);
        $this->data_id = $id;
        $this->nama_koperasi = $data->nama_koperasi;
        $this->alamat = $data->alamat;
        $this->kota = $data->kota;
        $this->provinsi = $data->provinsi;
        $this->kode_pos = $data->kode_pos;
        $this->telp = $data->telp;
        $this->badan_hukum = $data->badan_hukum;
        $this->status = $data->status;
    }

    public function update()
    {
        $validate = $this->validate([
    		'nama_koperasi' => 'required',
        ]);
        if (!empty($this->file_logo)){
        $name = md5($this->file_logo . microtime()).'.'.$this->file_logo->extension();          
        $this->file_logo->storeAs('foto', $name, 'public');
        $data = Profile::find($this->data_id);
        $data->update([
            'nama_koperasi'=> $this->nama_koperasi,
            'alamat'=> $this->alamat,
            'kota'=> $this->kota,
            'provinsi'=> $this->provinsi,
            'kode_pos'=> $this->kode_pos,
            'telp'=> $this->telp,
            'file_logo'=> $name,
            'badan_hukum'=> $this->badan_hukum,
            'status'=> $this->status
        ]);
    }else{
        $data = Profile::find($this->data_id);
        $data->update([
            'nama_koperasi'=> $this->nama_koperasi,
            'alamat'=> $this->alamat,
            'kota'=> $this->kota,
            'provinsi'=> $this->provinsi,
            'kode_pos'=> $this->kode_pos,
            'telp'=> $this->telp,
            'badan_hukum'=> $this->badan_hukum,
            'status'=> $this->status
        ]);
    }

        session()->flash('message', 'Data telah diupdate.');
        $this->resetInputFields();
        $this->emit('profilStore');
    }

    public function delete($id)
    {
        Profile::find($id)->delete();
        session()->flash('message', 'Data telah dihapus.');
    }

}
