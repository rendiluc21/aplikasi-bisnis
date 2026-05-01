<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'harga_beli',
        'harga_jual',
        'stok',
    ];

    public static function generateKodeBarang(): string
    {
        $date = now()->format('Ymd');
        $prefix = 'BRG-' . $date . '-';

        return DB::transaction(function () use ($prefix) {
            // Lock table row for this date prefix to prevent race conditions
            $lastItem = self::where('kode_barang', 'like', $prefix . '%')
                ->orderBy('kode_barang', 'desc')
                ->lockForUpdate()
                ->first();

            if ($lastItem) {
                $lastNumber = (int) substr($lastItem->kode_barang, -3);
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }

            // Keep incrementing until we find available unique code
            while (self::where('kode_barang', $prefix . $newNumber)->exists()) {
                $newNumber = str_pad((int)$newNumber + 1, 3, '0', STR_PAD_LEFT);
            }

            return $prefix . $newNumber;
        });
    }

    public function stockIns()
    {
        return $this->hasMany(StockIn::class, 'kode_barang', 'kode_barang');
    }

    public function stockOuts()
    {
        return $this->hasMany(StockOut::class, 'kode_barang', 'kode_barang');
    }
}
