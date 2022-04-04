<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblReminder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_reminder', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer')->unsigned();
            $table->unsignedBigInteger('id_karyawan')->unsigned();
            $table->date('tgl');
            $table->foreign('id_customer')->references('id')->on('tbl_customer')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_reminder');
    }
}
