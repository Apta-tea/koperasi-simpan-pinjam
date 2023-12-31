<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_ledger extends Model
{
    use HasFactory;
    protected $fillable = ['transaksi_id','total','jenis_transaksi','user_id','status_pembukuan']; 


}
