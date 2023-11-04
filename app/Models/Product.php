<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'model', 'specification', 'purchase_price', 'supplier', 'stocks', 'product_img'
    ] ;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id');
    }
}
