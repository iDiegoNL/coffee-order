<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'visible', 'in_stock', 'product_id',
    ];

    /**
     * Get the products for this addon.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
