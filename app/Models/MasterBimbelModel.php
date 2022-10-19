<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBimbelModel extends Model
{
    use HasFactory;

    protected $table = "tb_master_bimbel";
    protected $guarded = ["id"];
}
