<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = "order_items";
    // protected $with = ['food', 'store', 'deliveryman'];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
    public function store()
    {
        return $this->belongsTo(CanteenStoreName::class, 'store_id', 'id');
    }
    public function deliveryman()
    {
        return $this->belongsTo(User::class, 'deliverman_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function payment()
    {
        return $this->hasOne(Transaction::class, 'order_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'order_item_id');
    }
}
