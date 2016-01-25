<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'slug', 'name',
        'description',
        'price', 'picture'];

    public function users()
    {

    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function cartItem()
    {
        return $this->hasOne('App\Models\CartItem');
    }
}
