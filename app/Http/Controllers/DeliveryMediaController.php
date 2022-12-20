<?php

namespace App\Http\Controllers;

use App\Models\DeliveryMedia;
use Illuminate\Http\Request;

class DeliveryMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeliveryMedia::all();
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
            'name' => 'required',
            'contact' => 'required',
        ]);
        $data =[
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
        ];
        DeliveryMedia::create($data);
        return response()->json(['msg' => 'Delivery Media added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryMedia  $deliveryMedia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deliveryMedia = DeliveryMedia::findOrFail($id);
        return $deliveryMedia;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryMedia  $deliveryMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryMedia $deliveryMedia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryMedia  $deliveryMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $deliveryMedia = DeliveryMedia::findOrFail($id);
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
        ]);
        $data =[
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
        ];
        $deliveryMedia->update($data);
        return response()->json(['msg' => 'Delivery Media Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryMedia  $deliveryMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deliveryMedia = DeliveryMedia::findOrFail($id);
        $deliveryMedia->delete();
    }
}
