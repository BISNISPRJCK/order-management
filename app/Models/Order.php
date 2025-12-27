<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'customer_id',
        'status',
        'total',
    ];

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
