<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelReminder extends Model
{
    protected $table = "tbl_reminder";
    protected $guarded = [];
    public $timestamps = false;
}
