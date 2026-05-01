<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50);
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kode_barang')->references('kode_barang')->on('items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_outs');
    }
};
