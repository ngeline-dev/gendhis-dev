<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterTravelModel;
use App\Models\MasterBimbelModel;
use App\Models\MasterJasaFotoModel;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = "tb_produk";
    protected $guarded = ["id"];

    public function getTravelFromProduk()
    {
        return $this->belongsTo(MasterTravelModel::class, 'id', 'produk_id');
    }

    public function getBimbelFromProduk()
    {
        return $this->belongsTo(MasterBimbelModel::class, 'id', 'produk_id');
    }

    public function getJasaFotoFromProduk()
    {
        return $this->belongsTo(MasterJasaFotoModel::class, 'id', 'produk_id');
    }
}
