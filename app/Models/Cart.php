<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    const COMPLETED = 'completed';
    const ACTIVE    = 'active';
    const CONFIRMED = 'confirmed';
    const PENDING   = 'pending';
    const CANCELLED = 'cancelled';

    protected $table = 'carts';
    protected $guarded = ['id'];

    public function table()
    {
        return $this->belongsTo('App\Models\Table');
    }

    public function items()
    {
        return $this->hasMany('App\Models\CartItem');
    }
}
