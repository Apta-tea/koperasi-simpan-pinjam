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
}
