<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDeleteOldStokBahanbakumasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER delete_old_stok_bahanbakumasuk after DELETE ON bahan_baku_masuks
        FOR EACH ROW BEGIN
        UPDATE stoks
            SET jumlah_material = jumlah_material - OLD.jumlah
        WHERE
        id = OLD.stok_id;
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
        Schema::dropIfExists('delete_old_stok_bahanbakumasuk');
    }
}