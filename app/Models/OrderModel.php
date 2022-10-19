<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailOrderModel;
use App\Models\ProdukModel;
use App\Models\User;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = "tb_order";
    protected $guarded = ["id"];

    public function getDetailOrderFromOrder()
    {
        return $this->belongsTo(DetailOrderModel::class, 'id', 'order_id');
    }

    public function getProdukFromOrder()
    {
        return $this->belongsTo(ProdukModel::class, 'produk_id', 'id');
    }

    public function getCustomerFromOrder()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function getAdminFromOrder()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
