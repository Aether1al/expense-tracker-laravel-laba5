<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function add_expenses()
    {
        $categories = Category::all();

        return view('add_expenses', compact('categories'));
    }

    public function add_expense(Request $request)
    {
        $validate = $request->validate([
            'category' => 'required | exists:categories,id',
            'sum' => 'required | numeric | min:0.01',
            'text' => 'nullable | string | max:255',
            'date' => 'required | date | before_or_equal:today',
        ]);

        Expense::create([
            'amount' => $validate['sum'],
            'category_id' => $validate['category'],
            'user_id' => auth()->id(),
            'description' => $validate['text'] ?? null,
            'spent_at' => $validate['date'],
        ]);

        return redirect('/add_expenses')->with('success', 'Трата добавлена!');
    }

    public function all_expenses(Request $request)
    {
        $query = Expense::where('user_id', auth()->id())
            ->orderBy('spent_at', 'desc');

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->month) {
            $query->where('spent_at', 'like', $request->month . '%');
        }

        $expenses = $query->get();
        $categories = Category::all();
        $expenses = Expense::paginate(10);

        return view('all_expenses', compact('expenses', 'categories'));
    }

    public function edit_expense($id)
    {
        $expense = Expense::findOrFail($id);
        $categories = Category::all();

        return view('edit_expense', compact('expense', 'categories'));
    }

    public function update_expense(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);

        $expense->update([
            'category_id' => $request->category,
            'amount' => $request->sum,
            'description' => $request->text,
            'spent_at' => $request->date,
        ]);

        return redirect('/all_expenses');
    }

    public function delete_expense($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect('/all_expenses');
    }

    public function card_expense($id)
    {
        $expense = Expense::with('category')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('/card_expense', compact('expense'));
    }



}
