<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $table = 'pinjamans';
    protected $fillable = ['transaksi_id','no_rekening','nama_lengkap','total','angsuran','persen','skema','status','ket'];
}
