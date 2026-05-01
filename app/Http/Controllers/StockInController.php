<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockIn;
use Illuminate\Http\Request;

class StockInController extends Controller
{
    public function index()
    {
        $stockIns = StockIn::with('item')->orderBy('tanggal', 'desc')->get();
        return view('stock-ins.index', compact('stockIns'));
    }

    public function create()
    {
        $items = Item::orderBy('nama_barang')->get();
        return view('stock-ins.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|exists:items,kode_barang',
            'supplier' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        StockIn::create($validated);

        return redirect()->route('stock-ins.index')->with('success', 'Transaksi barang masuk berhasil disimpan.');
    }
}
