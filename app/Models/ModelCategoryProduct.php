<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCategoryProduct extends Model
{
    protected $table = "tbl_category_product";
    protected $guarded = [];
    public $timestamps = false;
}
