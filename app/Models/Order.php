<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // protected $fillable = ['product_id', 'customer_name', 'address', 'phone', 'quantity', 'price', 'area'];
    protected $guarded=[];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function cutomers()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery_medias()
    {
        return $this->belongsTo(DeliveryMedia::class);
    }
}