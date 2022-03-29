<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDeleteOldStokFinishGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER delete_old_stok_finish_good after DELETE ON pencatatan_produksis
        FOR EACH ROW BEGIN
        UPDATE stok_finish_goods
            SET jumlah = jumlah - OLD.jumlah
        WHERE
        id = OLD.stokfinishgood_id;
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
        Schema::dropIfExists('delete_old_stok_finish_good');
    }
}