<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUpdateStokBahanBakuKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stok_bahanbakukeluar after INSERT ON bahan_baku_keluars
        FOR EACH ROW BEGIN
        UPDATE stok_bahan_bakus
            SET jumlah_material = jumlah_material - NEW.jumlah
        WHERE
        id = NEW.stok_id;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_stok_bahanbakukeluar');
    }
}