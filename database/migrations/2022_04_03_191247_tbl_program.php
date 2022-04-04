<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_program', function (Blueprint $table) {
            $table->id();
            $table->string('program');
            $table->unsignedBigInteger('id_product')->unsigned();
            $table->foreign('id_product')->references('id')->on('tbl_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_program');
    }
}
