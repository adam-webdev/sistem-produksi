<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUpdateStokFinishGoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER update_stok_finish_good after INSERT ON pencatatan_produksis
        FOR EACH ROW BEGIN
        UPDATE finish_goods
            SET jumlah = jumlah + NEW.jumlah
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
        Schema::dropIfExists('update_stok_finish_good');
    }
}