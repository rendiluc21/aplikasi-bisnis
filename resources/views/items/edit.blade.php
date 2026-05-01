@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <div class="page-header">
        <h1>✏️ Edit Barang</h1>
        <a href="{{ route('items.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <div class="card">
        <form action="{{ route('items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" class="form-control" value="{{ $item->kode_barang }}" disabled style="background: #f8f9fa; cursor: not-allowed;">
                <small style="color: #7f8c8d;">Kode barang digenerate otomatis dan tidak dapat diubah.</small>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang *</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ old('nama_barang', $item->nama_barang) }}" placeholder="Masukkan nama barang" required>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori *</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori', $item->kategori) }}" placeholder="Contoh: Elektronik, Aksesoris" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="harga_beli">💰 Harga Beli (Rp) *</label>
                    <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="{{ old('harga_beli', $item->harga_beli) }}" min="0" step="0.01" placeholder="0" required>
                    <small style="color: #7f8c8d;">Harga modal / harga beli barang</small>
                </div>
                <div class="form-group">
                    <label for="harga_jual">💵 Harga Jual (Rp) *</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ old('harga_jual', $item->harga_jual) }}" min="0" step="0.01" placeholder="0" required>
                    <small style="color: #7f8c8d;">Harga jual kepada pelanggan</small>
                </div>
            </div>
            <div class="divider"></div>
            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-success btn-lg">💾 Update Barang</button>
                <a href="{{ route('items.index') }}" class="btn btn-primary btn-lg">Batal</a>
            </div>
        </form>
    </div>
@endsection
