<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = "food";
    // protected $with = ['category', 'store', 'orderItems'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function store()
    {
        return $this->belongsTo(CanteenStoreName::class, 'store_id', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'food_id');
    }
}
