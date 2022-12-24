<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use Intervention\Image\Facades\Image;
use App\Models\Order;
use App\Models\Product;
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
        // return $request->all();

        $this->validate($request, [
            'product_code' => 'required',
            'customer_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required',
            'weight' => 'required',
            'discount' => 'required',
            'area' => 'required',
            'delivery_media_id' => 'required',
        ]);

        $productID = Product::where('product_code', $request->input('product_code'))->value('id');

        $image = $request->input('image');
        if (isset($image)) {
            $id = Order::count();
            if ($id > 0) {
                $id = Order::latest()->first()->id;
                $id += 1;
            } else {
                $id = 1;
            }

            $imageName = 'order' . '-' . $id . '.webp';
            $height = 800;
            $width = 800;
            $path = 'public/images/uploads/orders/';
            // $image-> move(public_path('public/Images/uploads/orders/'), $imageName);
            Image::make($image)->fit($width, $height)->save(public_path($path) . $imageName, 50, 'webp');
        }

        // $data = [
        //     'product_id'=> $request->input('product_id'),
        //     'customer_name' => $request->input('customer_name'),
        //     'address' => $request->input('address'),
        //     'phone' => $request->input('phone'),
        //     'quantity' => $request->input('quantity'),
        //     'price'=> $request->input('price'),
        //     'image'=> $imageName,
        //     'weight'=> $request->input('weight'),
        //     'discount'=> $request->input('discount'),
        //     'area' => $request->input('area'),
        //     'delivery_media_id' => $request->input('delivery_media_id'),
        //     'status' => 1,
        // ];
        $data = $request->all();
        $data['image'] = $imageName;
        $data['status'] = 0;
        $data['product_id'] = $productID;

        // $isProduct = Product::findOrFail($request->input('product_id'))->count();
            // return $data;
        if (Product::where('product_code', $request->input('product_code'))->count() > 0) {
            $productQuantity = Product::where('product_code', $request->input('product_code'))->value('quantity');
            if ($productQuantity >= $request->input('quantity')) {
                $restQuantity['quantity'] = $productQuantity - $request->input('quantity');
                Product::where('id', $productID)->update($restQuantity);
                Order::create($data);
                return response()->json(['msg' => 'Order Created Successfully']);
            } else {
                return response()->json(['msg' => 'Product quantity is not available']);
            }
        } else {
            return response()->json(['msg' => 'Product is not available']);
        }
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
        // return $order;
        $data['status'] = 1;
        $order->update($data);
        return response()->json(['msg' => 'order status updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['msg' => 'order deleted successfully']);
    }

    public function invoice()
    {
        $orders = Order::where('status', 0)->get();
        return OrderResource::collection($orders);
    }
}
