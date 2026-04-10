<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrderProduct extends Model
{
    protected $table = 'customer_orders_products';
    public $timestamps = false;
    protected $fillable = ['quantity', 'price', 'order_id', 'product_id'];

    public function order(){
        return $this->belongsTo(CustomerOrder::class);

    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
