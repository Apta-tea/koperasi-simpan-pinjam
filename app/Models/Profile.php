<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['nama_koperasi','alamat','kota','provinsi','kode_pos','telp','file_logo','badan_hukum','status'];
}
