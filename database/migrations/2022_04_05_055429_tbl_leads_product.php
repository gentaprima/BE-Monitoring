<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLeadsProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_leads_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_leads')->unsigned();
            $table->unsignedBigInteger('id_program')->unsigned();
            $table->integer('status');
            $table->string('alasan')->nullable();
            $table->foreign('id_leads')->references('id')->on('tbl_leads')->onDelete('cascade');
            $table->foreign('id_program')->references('id')->on('tbl_program')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_leads_product');
    }
}
