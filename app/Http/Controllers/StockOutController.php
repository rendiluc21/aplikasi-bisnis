<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockOut;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = StockOut::with('item')->orderBy('tanggal', 'desc')->get();
        return view('stock-outs.index', compact('stockOuts'));
    }

    public function create()
    {
        $items = Item::where('stok', '>', 0)->orderBy('nama_barang')->get();
        return view('stock-outs.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|exists:items,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $item = Item::where('kode_barang', $validated['kode_barang'])->first();

        if ($item->stok < $validated['jumlah']) {
            return back()->withInput()->withErrors(['jumlah' => 'Stok tidak mencukupi. Stok saat ini: ' . $item->stok]);
        }

        StockOut::create($validated);

        return redirect()->route('stock-outs.index')->with('success', 'Transaksi barang keluar berhasil disimpan.');
    }
}
