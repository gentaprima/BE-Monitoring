<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLeadsProduct extends Model
{
    protected $table = "tbl_leads_product";
    protected $guarded = [];
    public $timestamps = false;
}
