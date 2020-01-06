<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'size', 'syrup', 'milk', 'status',
    ];

    /**
     * Get the product in the order
     * TODO: Multiple products in one order
     */
    public function product()
    {
        return $this->hasOne('App\Product');
    }

    /**
     * Get the user that belongs to the order
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
