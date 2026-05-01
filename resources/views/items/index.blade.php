@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')
    <div class="page-header">
        <h1>📋 Master Barang</h1>
        <a href="{{ route('items.create') }}" class="btn btn-success btn-lg">+ Tambah Barang</a>
    </div>

    <div class="card">
        @if($items->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
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
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="icon">📋</div>
                <p><strong>Belum ada data barang.</strong><br><a href="{{ route('items.create') }}">Tambah barang sekarang</a> untuk memulai.</p>
            </div>
        @endif
    </div>
@endsection
