<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'quantity', 'price', 'image', 'supplier', 'purchase_type_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchase_types(){
        return $this->belongsTo(PurchaseType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
