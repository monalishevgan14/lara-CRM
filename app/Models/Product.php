<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'user_id'
    ];

    // Product belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Product has many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
