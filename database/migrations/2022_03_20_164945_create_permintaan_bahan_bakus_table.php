<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaanBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_bahan_bakus', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->foreignId('bahanbaku_id')->constrained('bahan_bakus')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_material');
            $table->string('status')->default('Belum dikonfirmasi');
            $table->date('tanggal');
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
        Schema::dropIfExists('permintaan_bahan_bakus');
    }
}