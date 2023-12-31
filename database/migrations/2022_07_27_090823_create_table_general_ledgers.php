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
        Schema::create('general_ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('transaksi_id');
            $table->integer('jumlah');
            $table->enum('jenis_transaksi',['debet','wajib','sukarela','operasional','pinjaman','pengembalian','shu','denda']);
            $table->integer('user_id');
            $table->enum('status_pembukuan',['0','1'])->default('1');
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
        Schema::dropIfExists('general_ledgers');
    }
};
