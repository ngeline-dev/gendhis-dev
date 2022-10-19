<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderModel;
use App\Models\User;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = "tb_transaksi";
    protected $guarded = ["id"];

    public function getOrderFromTransaksi()
    {
        return $this->belongsTo(OrderModel::class, 'order_id', 'id');
    }

    public function getAdminFromTransaksi()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
