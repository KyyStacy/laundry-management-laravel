<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'jenis_laundry',
        'jumlah',
        'harga',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
