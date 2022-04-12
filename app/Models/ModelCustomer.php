<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCustomer extends Model
{
    protected $table = "tbl_customer";
    protected $guarded = [];
    public $timestamps = false;
}
