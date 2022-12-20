<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMedia extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'contact'];

    public function oders(){
        return $this->hasMany(Order::class);
    }
}
