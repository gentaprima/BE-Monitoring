<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_poin', function (Blueprint $table) {
            $table->id();
            $table->integer('poin');
            $table->integer('insentif');
            $table->unsignedBigInteger('id_karyawan')->unsigned();
            $table->foreign('id_karyawan')->references('id')->on('tbl_karyawan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
