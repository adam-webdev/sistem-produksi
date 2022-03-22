<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUpdateOldStokBahanbakumasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_old_stok_bahanbakumasuk before UPDATE ON bahan_baku_masuks
        FOR EACH ROW BEGIN
        UPDATE stoks
            SET jumlah_material = NEW.jumlah
        WHERE
        OLD.id = NEW.stok_id;
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
        Schema::dropIfExists('update_old_stok_bahanbakumasuk');
    }
}