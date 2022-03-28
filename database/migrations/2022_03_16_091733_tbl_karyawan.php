<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tbl_karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nik');
            $table->string('nama_karyawan');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('tgl_lahir');
            $table->string('jabatan');
            $table->integer('role');
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
        Schema::dropIfExists('tbl_karyawan');
    }
}
