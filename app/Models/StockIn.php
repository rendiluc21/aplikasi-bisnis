<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockIn extends Model
{
    protected $fillable = [
        'kode_barang',
        'supplier',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($stockIn) {
            DB::table('items')
                ->where('kode_barang', $stockIn->kode_barang)
                ->increment('stok', $stockIn->jumlah);
        });
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'kode_barang', 'kode_barang');
    }
}
