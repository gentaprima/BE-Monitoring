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
            $table->unsignedBigInteger('id_leads_product')->unsigned();
            $table->date('tgl');
            $table->foreign('id_leads_product')->references('id')->on('tbl_leads_product')->onDelete('cascade');
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
