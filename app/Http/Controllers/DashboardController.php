<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('/', [
            "total_menus" => Menu::count(),

            "total_sales" => Transaction::whereDate('created_at', now()->toDateString())
                                ->sum('total_transaction'),

            "total_income" => Transaction::whereDate('created_at', now()->toDateString())
                                ->sum('total_transaction'),

            "invoice" => Transaction::whereDate('created_at', now()->toDateString())->count(),

            "cashier" => User::where('level_id', 2)->count(),
            "admin" => User::where('level_id', 3)->count(),
            "manager" => User::where('level_id', 2)->count(), // Periksa apakah level manager benar 2

            "total_user" => User::count(),

            "total_paid" => Transaction::where('status', 'paid')->count(),
            "total_unpaid" => Transaction::where('status', 'unpaid')->count(),
        ]);
    }
}
