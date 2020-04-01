<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategories;
use App\Expenses;

class ExpenseManagementController extends Controller
{
    public function expenseCategories()
    {
        return view('pages.expense_categories', ['expenseCategories' => ExpenseCategories::all()]);
    }

    public function addExpenseCategory()
    {
        $fields = request()->validate([
            'name' => ['required', 'min:2'],
            'description' => ['required', 'min:3']
        ]);

        ExpenseCategories::create([
            $fields
        ]);

        session()->flash('notice', 'Expense category added.');

        return redirect()->route('expense_categories');
    }

    public function updateExpenseCategory()
    {
        $expenseCategory = ExpenseCategories::findOrFail(request('id'));

        if (request('delete')) {
            $expenseCategory->delete();

            return redirect()->route('expense_categories');
        }

        $fields = request()->validate([
            'name' => ['required', 'min:2'],
            'description' => ['required', 'min:3']
        ]);

        $expenseCategory->update($fields);

        session()->flash('notice', 'Expense category updated.');

        return redirect()->route('expense_categories');
    }

    public function expenses()
    {
        return view('pages.expenses', ['expenses' => Expenses::where('user_id', auth()->user()->id)->get(), 'expenseCategories' => ExpenseCategories::all()]);
    }

    public function addExpense()
    {
        $fields = request()->validate([
            'expense_category_id' => ['required'],
            'amount' => ['required'],
            'entry_date' => ['required']
        ]);

        Expenses::create([
            'user_id' => auth()->user()->id,
            'expense_category_id' => request('expense_category_id'),
            'amount' =>  str_replace(',', '', request('amount')),
            'entry_date' => request('entry_date')
        ]);

        session()->flash('notice', 'Expense category added.');

        return redirect()->route('expenses');
    }

    public function updateExpense()
    {
        $expense = Expenses::findOrFail(request('id'));

        if (request('delete')) {
            $expense->delete();

            return redirect()->route('expenses');
        }

        $fields = request()->validate([
            'expense_category_id' => ['required'],
            'amount' => ['required'],
            'entry_date' => ['required']
        ]);

        $expense->update([
            'expense_category_id' => request('expense_category_id'),
            'amount' =>  str_replace(',', '', request('amount')),
            'entry_date' => request('entry_date')
        ]);

        session()->flash('notice', 'Expense updated.');

        return redirect()->route('expenses');
    }
}
