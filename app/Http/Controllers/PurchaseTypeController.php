<?php

namespace App\Http\Controllers;

use App\Models\PurchaseType;
use Illuminate\Http\Request;

class PurchaseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PurchaseType::all();
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
        ]);
        $data['name'] = $request->input('name');
        PurchaseType::create($data);
        return response()->json(['msg' => 'Purchase type added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseType $purchaseType)
    {
        return $purchaseType;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseType $purchaseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseType $purchaseType)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data['name'] = $request->input('name');
        $purchaseType->update($data);
        return response()->json(['msg' => 'Purchase type updated successully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseType  $purchaseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseType $purchaseType)
    {
        $purchaseType->delete();
        return response()->json(['msg' => 'deleted successfully']);
    }
}
