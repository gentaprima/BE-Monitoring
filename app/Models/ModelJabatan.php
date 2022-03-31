<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelJabatan extends Model
{
    protected $table = "tbl_jabatan";
    // protected $fillable = ["remember_token"];
    protected $guarded = [];
    public $timestamps = false;
}
