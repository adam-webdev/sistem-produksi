<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStokFinishGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stok_finish_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finishgood_id')->constrained('finish_goods')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->string('satuan');
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
        Schema::dropIfExists('stok_finish_goods');
    }
}