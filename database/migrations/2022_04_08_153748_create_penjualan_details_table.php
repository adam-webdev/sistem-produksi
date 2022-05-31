<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjualan_id')->constrained('penjualans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('finishgood_id')->constrained('finish_goods')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jumlah');
            $table->string('jenis_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->date('tanggal_penjualan');
            $table->string('total_pembayaran');
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
        Schema::dropIfExists('penjualan_details');
    }
}