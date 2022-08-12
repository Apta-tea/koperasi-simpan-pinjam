<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateNasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete table content
        \DB::table('nasabahs')->delete();
        //insert dummy record
        \DB::table('nasabahs')->insert(array(
            array('nama_lengkap'=>'Babe Cabita','alamat'=>'Leuwigajah','no_rekening'=>'12345678','foto'=>'','saldo_akhir'=>'0','telp'=>'','status_pinjaman'=>'0'),
            array('nama_lengkap'=>'Charlie van houten','alamat'=>'Bandung','no_rekening'=>'13245678','foto'=>'','saldo_akhir'=>'0','telp'=>'','status_pinjaman'=>'0'),
            array('nama_lengkap'=>'B. Pamungkas','alamat'=>'Cisarua','no_rekening'=>'13425678','foto'=>'','saldo_akhir'=>'0','telp'=>'','status_pinjaman'=>'0'),
        ));

    }
}
