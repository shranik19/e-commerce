<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    

    public function payment(){
        return $this->belongsTo(Payments::class);
    }
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function getTotalAttribute($value){
        return $value/100;
    }
}
