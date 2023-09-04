<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use CrudTrait;
    use HasFactory;
    use InteractsWithMedia;
    protected $casts=[
        'images'=>'array',
    ];
    protected $guarded=[];
    public function formatted_amount(){
        return "RS ".$this->price;
    }


    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name']=$value;
        $this->attributes['slug']=str()->slug($this->name);
    }

    public function setPriceAttribute($value){
        $this->attributes['price']=$value*100;
    }
    public function getPriceAttribute($value){
        return $value/100;
    }
     public function setImagesAttribute($value)
     {
        $this->uploadMultipleFilesToDisk($value,'images','public','products');
     }
}
