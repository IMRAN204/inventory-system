<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Investment;
use App\Models\Order;
use App\Models\Product;
use App\Models\PurchaseType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInvestment = Investment::sum('amount');

        $productOnHandQuantity = Product::sum('quantity');
        $productOnHandAmount = Product::sum('price');
        $totalDelivered = Order::where('status', 2)->count();
        $totalDeliveredAmount = Order::where('status', 2)->sum('price');
        $totalReturn = Order::where('status', 3)->count();
        $totalReturnAmount = Order::where('status', 3)->sum('price');
        $totalShipping = Order::where('status', 1)->count();
        $totalShippingAmount = Order::where('status', 1)->sum('price');
        $totalPending = Order::where('status', 0)->count();
        $totalPendingAmount = Order::where('status', 0)->sum('price');

        $totalExpense = Expense::sum('amount');

        $purchaseCredit = PurchaseType::where('name', 'credit')->value('id');
        $productOnCredit = Product::where('purchase_type_id', $purchaseCredit)->sum('price');
        $expenseTypeCredit = ExpenseType::where('name', 'credit')->value('id');
        $expenseCredit = Expense::where('expense_type_id', $expenseTypeCredit)->sum('amount');
        $loan = Investment::where('name', 'loan')->sum('amount');
        $creditPaid = ExpenseType::where('name', 'credit paid')->value('id');
        $loanPaid = ExpenseType::where('name', 'loan paid')->value('id');
        $paid = Expense::where('expense_type_id', $creditPaid)->orWhere('expense_type_id', $loanPaid)->sum('amount');
        $accountsPayable = $productOnCredit + $expenseCredit + $loan - $paid;

        $purchaseAdvance = PurchaseType::where('name', 'advance')->value('id');
        $productOnAdvance = Product::where('purchase_type_id', $purchaseAdvance)->sum('price');
        $expenseTypeAdvance = ExpenseType::where('name', 'advance')->value('id');
        $expenseAdvance = Expense::where('expense_type_id', $expenseTypeAdvance)->sum('amount');
        $advance = Investment::where('name', 'advance')->sum('amount');
        $advanceReduceId = ExpenseType::where('name', 'advance reduce')->value('id');
        $advanceReduce = Expense::where('expense_type_id', $advanceReduceId)->sum('amount');
        $expenseTypeAdvanceReturn = ExpenseType::where('name', 'advance return')->value('id');
        $expenseAdvanceReturn = Expense::where('expense_type_id', $expenseTypeAdvanceReturn)->sum('amount');

        $advancePayment = $productOnAdvance + $expenseAdvance + $advance - $advanceReduce - $expenseAdvanceReturn;

        $investedLiquid = Investment::whereNot('name', 'loan')->whereNot('name', 'advance')->sum('amount');
        $expenseTypeAdvanceReduce = ExpenseType::where('name', 'advance reduce')->value('id');
        $expenseNotCredit = Expense::whereNot('expense_type_id', $expenseTypeCredit)->whereNot('expense_type_id', $expenseTypeAdvanceReduce)->whereNot('expense_type_id', $expenseTypeAdvanceReturn)->sum('amount');
        $productNotCredit = Product::whereNot('purchase_type_id', $purchaseCredit)->sum('price');
        
        $cashLiquid = $investedLiquid + $totalDeliveredAmount + $expenseAdvanceReturn - $expenseNotCredit - $productNotCredit;
        $totalPurchase = Product::sum('price');

        $investedWithoutLoanLiquid = Investment::whereNot('name', 'loan')->sum('amount');
        $investedLoanLiquid = Investment::where('name', 'loan')->sum('amount');
        $opening = $productOnHandAmount + $investedWithoutLoanLiquid - $investedLoanLiquid;

        $closing = $cashLiquid + $paid + $productOnHandAmount + $advancePayment - $accountsPayable;

        $profit = $closing - $opening;

        
        return $data = [
            'totalInvestment' => $totalInvestment,
            'productOnHandQuantity' => $productOnHandQuantity,
            'productOnHandAmount' => $productOnHandAmount,
            'totalDelivered' => $totalDelivered,
            'totalDeliveredAmount' => $totalDeliveredAmount,
            'totalReturn' => $totalReturn,
            'totalReturnAmount' => $totalReturnAmount,
            'totalShipping' => $totalShipping,
            'totalShippingAmount' => $totalShippingAmount,
            'totalPending' => $totalPending,
            'totalPendingAmount' => $totalPendingAmount,
            'totalExpense' => $totalExpense,
            'accountsPayable' => $accountsPayable,
            'advancePayment' => $advancePayment,
            'totalPurchase' => $totalPurchase,
            'cashLiquid' => $cashLiquid,
            'profit' => $profit,
        ];
    }
}
