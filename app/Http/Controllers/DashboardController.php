<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $categories = Category::all();

        $dashboardData = [];
        $totalAmount = 0;

        foreach ($categories as $category) {

            $spent = Expense::where('user_id', $userId)
                ->where('category_id', $category->id)
                ->whereMonth('spent_at', now()->month)
                ->whereYear('spent_at', now()->year)
                ->sum('amount');

            $totalAmount += $spent;

            $limit = $category->monthly_limit;

            $percent = 0;
            $remainder = null;
            $status = 'no_limit';

            if ($limit !== null) {
                $remainder = $limit - $spent;
                $percent = $limit > 0 ? round(($spent / $limit) * 100, 1) : ($spent > 0 ? 100 : 0);

                if ($percent < 80) {
                    $status = 'ok';
                } elseif ($percent >= 80 && $percent <= 100) {
                    $status = 'warning';
                } else {
                    $status = 'danger';
                }
            }

            $dashboardData[] = [
                'category' => $category,
                'spent' => $spent,
                'limit' => $limit,
                'remainder' => $remainder,
                'percent' => $percent,
                'status' => $status,
            ];
        }

        return view('index', compact('dashboardData', 'totalAmount'));
    }

}
