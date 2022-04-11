<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerDeleteStokfgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER delete_old_stokfg after DELETE ON penjualan_details
        FOR EACH ROW BEGIN
        UPDATE finish_goods
            SET jumlah_fg = jumlah_fg - OLD.jumlah
        WHERE
        id = OLD.finishgood_id;
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
        Schema::dropIfExists('trigger_delete_stokfg');
    }
}