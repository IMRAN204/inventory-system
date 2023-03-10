<?php

namespace App\Http\Resources;

use App\Models\DeliveryMedia;
use App\Models\Order;
use Faker\Core\File;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    
    public function toArray($request)
    {
        $path = 'public/images/uploads/orders/';
        $delivery = DeliveryMedia::where('id', $this->delivery_media_id)->value('name');
        return [
            "id" => $this->id,
            "product_code" => $this->product_code,
            "customer_name" => $this->customer_name,
            "address" => $this->address,
            "phone" => $this->phone,
            "quantity" => $this->quantity,
            "price" => $this->price - $this->discount,
            "image" => url($path . $this->image),
            "discount" => $this->discount,
            "weight" => $this->weight,
            "area" => $this->area,
            "delivery_media_id" => $delivery,
            "status" => $this->status,
            'date' => $this->created_at->format('d-m-Y'),

        ];
    }
}
