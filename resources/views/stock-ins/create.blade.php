@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
    <div class="page-header">
        <h1>📥 Tambah Barang Masuk</h1>
        <a href="{{ route('stock-ins.index') }}" class="btn btn-primary">← Kembali</a>
    </div>

    <div class="card">
        <form action="{{ route('stock-ins.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_barang">📋 Pilih Barang *</label>
                <select name="kode_barang" id="kode_barang" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($items as $item)
                        <option value="{{ $item->kode_barang }}" {{ old('kode_barang') == $item->kode_barang ? 'selected' : '' }}>
                            {{ $item->kode_barang }} - {{ $item->nama_barang }} (Stok: {{ $item->stok }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="supplier">🏭 Supplier *</label>
                <input type="text" name="supplier" id="supplier" class="form-control" value="{{ old('supplier') }}" placeholder="Nama supplier" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="jumlah">📦 Jumlah Masuk *</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah') }}" min="1" placeholder="0" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">📅 Tanggal *</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan">📝 Keterangan (Opsional)</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
            </div>
            <div class="divider"></div>
            <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-success btn-lg">💾 Simpan Transaksi</button>
                <a href="{{ route('stock-ins.index') }}" class="btn btn-primary btn-lg">Batal</a>
            </div>
        </form>
    </div>
@endsection
