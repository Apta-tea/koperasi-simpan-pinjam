<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $fillable=['nama_lengkap','no_rekening','alamat','telp','foto','no_ktp','saldo_akhir','status_pinjaman'];

    public function trans()
    {
        return $this->hasMany(Transaksi::class);
    }
}
