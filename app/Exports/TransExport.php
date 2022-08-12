<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class TransExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Transaksi::all();
        $transaksi=DB::table('transaksis')->join('users','users.id','=','transaksis.user_id')
        ->join('nasabahs','nasabahs.id','=','transaksis.nasabah_id')->select('transaksis.id','nasabahs.no_rekening','nasabahs.nama_lengkap','transaksis.created_at','transaksis.total','users.name')->get();
        return $transaksi;
    }

    public function headings(): array
    {

        return [
        'No',
        'No Rekening',
        'Nama',
        'Tanggal',
        'Jumlah',
        'Operator',
        ];
    }

}
