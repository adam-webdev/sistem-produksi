<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDeleteOldStokBahanbakeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER delete_old_stok_bahanbakeluar after DELETE ON bahan_baku_keluars
        FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET jumlah_material = jumlah_material - OLD.jumlah
        WHERE
        id = OLD.bahanbaku_id;
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
        Schema::dropIfExists('delete_old_stok_bahanbakeluar');
    }
}