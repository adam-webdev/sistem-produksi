<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUpdateStokBahanBakuMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stok_bahanbakumasuk after INSERT ON bahan_baku_masuks
        FOR EACH ROW BEGIN
        UPDATE bahan_bakus
            SET jumlah_material = jumlah_material + NEW.jumlah
        WHERE
        id = NEW.bahanbaku_id;
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
        Schema::dropIfExists('update_stok_bahanbakumasuk');
    }
}