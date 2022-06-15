<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanteenStoreName extends Model
{
    use HasFactory;
    protected $table = "canteen_store_names";
    protected $primaryKey = 'seller_id';
    public function owner()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
