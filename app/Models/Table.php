<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    const AVAILABLE          = 'available';
    const OCCUPIED           = 'occupied';
    const REQUESTING_BILLOUT = 'requesting_for_billout';
    const CLEANING           = 'cleaning';

    protected $table = 'tables';
    protected $guarded = ['id'];

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
