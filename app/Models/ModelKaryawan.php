<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelKaryawan extends Model
{
      
    protected $table = "tbl_karyawan";
    protected $fillable = ["password"];
    protected $guarded = [];
    public $timestamps = false;
}
