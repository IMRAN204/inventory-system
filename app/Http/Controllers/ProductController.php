<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
//use Image;
// use Intervention\Image\ImageServiceProvider;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
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
            'name'=> 'required',
            'product_code' =>'required|unique:products,product_code',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'required',
            'supplier'=> 'required',
            'purchase_type_id' => 'required',
        ]);

        $image = $request->input('image');
        if(isset($image)){
            $id = Product::count();
            if($id > 0){ 
                $id = Product::latest()->first()->id;
                $id += 1;
            }
            else{
                $id = 1;
            }

            $imageName = $request->input('name').'-'.$request->input('product_code').'.webp';
            $height = 800;
            $width = 800;
            $path = 'public/images/uploads/products/';
            // $image-> move(public_path('public/Images/uploads/products/'), $imageName);
            Image::make($image)->fit($width, $height)->save(public_path($path) . $imageName, 50, 'webp');
        }

        $data = [
            'name'=> $request->input('name'),
            'product_code'=> $request->input('product_code'),
            'category_id' => $request->input('category_id'),
            'quantity' => $request->input('quantity'),
            'price'=> $request->input('price'),
            'image'=> $imageName,
            'supplier'=> $request->input('supplier'),
            'purchase_type_id' => $request->input('purchase_type_id'),
        ];

        Product::create($data);
        return response()->json(['msg' => 'Product added successfully']);

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}