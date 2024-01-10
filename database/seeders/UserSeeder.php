<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
             //delete table content
             \DB::table('users')->delete();
             //insert dummy record
             \DB::table('users')->insert(array(
                 array('name'=>'kwan loong','email'=>'k@l.id','password'=>Hash::make('123456')),                 
             ));
    }
}
