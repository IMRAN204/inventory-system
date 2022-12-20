<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id'=> 'required',
            'customer_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'quantity' => 'required',
            'price'=> 'required',
            'image' => 'required',
            'weight'=> 'required',
            'discount'=> 'required',
            'area' => 'required',
            'delivery_media_id' => 'required',
        ]);

        $image = $request->file('image');
        if(isset($image)){
            $id = Order::count();
            if($id > 0){
                $id = Order::latest()->first()->id;
                $id += 1;
            }
            else{
                $id = 1;
            }

            $imageName = 'order'.'-'.$id.'.webp';
            $height = 800;
            $width = 800;
            $path = '/images/uploads/orders/';
            $image-> move(public_path('public/Images/uploads/orders/'), $imageName);
        }

        $data = [
            'product_id'=> $request->input('product_id'),
            'customer_name' => $request->input('customer_name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'quantity' => $request->input('quantity'),
            'price'=> $request->input('price'),
            'image'=> $imageName,
            'weight'=> $request->input('weight'),
            'discount'=> $request->input('discount'),
            'area' => $request->input('area'),
            'delivery_media_id' => $request->input('delivery_media_id'),
        ];

        Order::create($data);
        return response()->json(['msg' => 'Order Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
