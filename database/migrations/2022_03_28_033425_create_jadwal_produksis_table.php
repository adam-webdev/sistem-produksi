<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_produksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwalproduksi');
            $table->foreignId('stokfinishgood_id')->constrained('stok_finish_goods')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tanggal');
            $table->integer('jumlah_barang');
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
        Schema::dropIfExists('jadwal_produksis');
    }
}