<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelProduct extends Model
{
    protected $table = "tbl_product";
    // protected $fillable = ["remember_token"];
    protected $guarded = [];
    public $timestamps = false;
}
