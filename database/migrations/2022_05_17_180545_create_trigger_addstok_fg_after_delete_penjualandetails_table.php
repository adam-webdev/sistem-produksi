<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerAddstokFgAfterDeletePenjualandetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_addstok_fg_after_delete_penjualandetails after DELETE ON penjualan_details
        FOR EACH ROW BEGIN
        UPDATE finish_goods
            SET jumlah_fg = jumlah_fg + OLD.jumlah
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
        Schema::dropIfExists('trigger_addstok_fg_after_delete_penjualandetails');
    }
}