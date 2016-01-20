<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['slug', 'name', 'description'];


    public function users()
    {

    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
