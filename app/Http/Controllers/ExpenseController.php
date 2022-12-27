<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Expense::with('expense_type')->latest()->get();
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
            'amount' => 'required',
            'expense_type_id' => 'required',
        ]);
        $data = [
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'expense_type_id' => $request->input('expense_type_id'),
        ];
        Expense::create($data);
        return response()->json(['msg' => 'Expense created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Expense::with('expense_type')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required',
            'expense_type_id' => 'required',
        ]);
        $data = [
            'name' => $request->input('name'),
            'amount' => $request->input('amount'),
            'expense_type_id' => $request->input('expense_type_id'),
        ];
        $expense->update($data);
        return response()->json(['msg' => 'Expense updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response()->json(['msg' => 'Expense deleted successfully']);
    }
}
