<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = ['id'];

    public function table()
    {
        return $this->belongsTo('App\Table');
    }

    public function items()
    {
        return $this->hasMany('App\CartItem');
    }
}
