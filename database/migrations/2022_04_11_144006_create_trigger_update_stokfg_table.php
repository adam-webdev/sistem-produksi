<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerUpdateStokfgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stokfg after INSERT ON penjualan_details
        FOR EACH ROW BEGIN
        UPDATE finish_goods
            SET jumlah_fg = jumlah_fg + NEW.jumlah
        WHERE
        id = NEW.finishgood_id;
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
        Schema::dropIfExists('trigger_update_stokfg');
    }
}