<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockOut extends Model
{
    protected $fillable = [
        'kode_barang',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($stockOut) {
            DB::table('items')
                ->where('kode_barang', $stockOut->kode_barang)
                ->decrement('stok', $stockOut->jumlah);
        });
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_barang', 'kode_barang');
    }
}
