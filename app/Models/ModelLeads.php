<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelLeads extends Model
{
    protected $table = "tbl_leads";
    protected $guarded = [];
    public $timestamps = false;
}
