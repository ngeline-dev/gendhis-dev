<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJasaFotoModel extends Model
{
    use HasFactory;

    protected $table = "tb_master_jasa_foto";
    protected $guarded = ["id"];
}
