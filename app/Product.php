<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'visible', 'in_stock',
    ];

    /**
     * Get the addons for the product.
     */
    public function addon()
    {
        return $this->hasMany('App\Addon');
    }

    /**
     * Get the user favorite for the product.
     */
    public function favorite()
    {
        return $this->hasOne('App\Favorite');
    }
}
