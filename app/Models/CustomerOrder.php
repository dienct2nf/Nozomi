<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    protected $table = 'customer_orders';
    protected $fillable = ['customer_id', 'status'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'customer_orders_products', 'order_id', 'product_id');
    }
}
