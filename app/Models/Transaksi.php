<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id','total','jenis_transaksi','user_id']; 

    public function NasabahSi()
    {
       return $this->belongTo(Nasabah::class);
    }

}


