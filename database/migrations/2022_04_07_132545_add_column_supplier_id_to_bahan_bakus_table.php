<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSupplierIdToBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bahan_bakus', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bahan_bakus', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('cascade')->onUpdate('cascade');
        });
    }
}