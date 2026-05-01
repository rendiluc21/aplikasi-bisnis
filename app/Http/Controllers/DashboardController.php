<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $lowStockItems = Item::where('stok', '<', 5)->orderBy('stok', 'asc')->get();

        $totalAset = Item::select(DB::raw('SUM(stok * harga_beli) as total'))->first()->total ?? 0;

        $totalItems = Item::count();
        $totalStok = Item::sum('stok');

        return view('dashboard.index', compact('lowStockItems', 'totalAset', 'totalItems', 'totalStok'));
    }
}
