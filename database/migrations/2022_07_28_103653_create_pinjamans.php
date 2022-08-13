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
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->id();
            $table->integer('transaksi_id')->nullable();
            $table->string('no_rekening',8);
            $table->string('nama_lengkap',30);
            $table->integer('total');
            $table->integer('angsuran');
            $table->float('persen',5);
            $table->enum('skema',['flat','nflat']);
            $table->enum('status',['0','1'])->default('1');
            $table->string('ket',30);
            $table->enum('aktif',['0','1'])->default('1');
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
        Schema::dropIfExists('pinjamans');
    }
};
