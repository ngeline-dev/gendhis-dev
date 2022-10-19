<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTravelModel extends Model
{
    use HasFactory;

    protected $table = "tb_master_travel";
    protected $guarded = ["id"];
}
