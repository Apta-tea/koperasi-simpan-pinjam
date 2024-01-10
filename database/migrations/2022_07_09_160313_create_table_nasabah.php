<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap',30);
            $table->string('no_rekening',8)->unique();
            $table->text('alamat');
            $table->string('telp',20)->nullable();
            $table->string('foto',30)->nullable();
            $table->string('no_ktp')->nullable();
            $table->integer('saldo_akhir',20)->default('0');
            $table->enum('status_pinjaman',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nasabahs');
    }
};
