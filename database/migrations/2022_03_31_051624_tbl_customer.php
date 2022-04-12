<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_customer', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('nama_customer');
            $table->string('email')->unique();
            $table->date('tgl_lahir');
            $table->string('no_rek');
            $table->string('jenis_kelamin');
            $table->string('telepon');
            $table->string('tgl_pendaftaran');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_customer');
    }
}
