<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'amount', 'expense_type_id'];

    public function expense_type()
    {
        return $this->belongsTo(ExpenseType::class);
    }
}
