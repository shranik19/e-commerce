<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function payment(){
        return $this->belongsTo(Payments::class);
    }
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
}
