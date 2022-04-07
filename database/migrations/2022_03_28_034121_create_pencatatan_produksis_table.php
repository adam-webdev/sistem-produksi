<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencatatanProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencatatan_produksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_produksi_id')->constrained('jadwal_produksis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('finishgood_id')->constrained('finish_goods')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah');
            $table->string('keterangan');
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
        Schema::dropIfExists('pencatatan_produksis');
    }
}