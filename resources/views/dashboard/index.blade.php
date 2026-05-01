@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1>📊 Dashboard</h1>
    </div>

    <div class="stats">
        <div class="stat-card">
            <h3>📋 Total Jenis Barang</h3>
            <div class="value">{{ $totalItems }}</div>
        </div>
        <div class="stat-card">
            <h3>📦 Total Stok</h3>
            <div class="value">{{ number_format($totalStok) }}</div>
        </div>
        <div class="stat-card">
            <h3>💰 Total Nilai Aset</h3>
            <div class="value">Rp {{ number_format($totalAset, 2, ',', '.') }}</div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>⚠️ Peringatan Stok Tipis (< 5)</h2>
        </div>
        @if($lowStockItems->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStockItems as $item)
                            <tr>
                                <td class="font-mono">{{ $item->kode_barang }}</td>
                                <td><strong>{{ $item->nama_barang }}</strong></td>
                                <td>{{ $item->kategori }}</td>
                                <td><strong>{{ $item->stok }}</strong></td>
                                <td>Rp {{ number_format($item->harga_beli, 2, ',', '.') }}</td>
                                <td>
                                    @if($item->stok == 0)
                                        <span class="badge badge-danger">❌ Habis</span>
                                    @elseif($item->stok < 3)
                                        <span class="badge badge-danger">🔴 Kritis</span>
                                    @else
                                        <span class="badge badge-warning">⚠️ Tipis</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="icon">✅</div>
                <p><strong>Semua stok aman.</strong><br>Tidak ada barang dengan stok di bawah 5.</p>
            </div>
        @endif
    </div>

    <div class="card mt-1">
        <div class="card-header">
            <h2>📋 Daftar Semua Barang</h2>
            <a href="{{ route('items.create') }}" class="btn btn-success btn-sm">+ Tambah</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Item::orderBy('stok', 'asc')->get() as $item)
                        <tr>
                            <td class="font-mono">{{ $item->kode_barang }}</td>
                            <td><strong>{{ $item->nama_barang }}</strong></td>
                            <td>{{ $item->kategori }}</td>
                            <td>Rp {{ number_format($item->harga_beli, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->harga_jual, 2, ',', '.') }}</td>
                            <td>
                                @if($item->stok < 5)
                                    <span class="badge badge-warning">{{ $item->stok }}</span>
                                @else
                                    {{ $item->stok }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
