@extends('layouts.app')

@section('title', 'Transaksi Barang Masuk')

@section('content')
    <div class="page-header">
        <h1>📥 Daftar Barang Masuk</h1>
        <a href="{{ route('stock-ins.create') }}" class="btn btn-success btn-lg">+ Tambah Barang Masuk</a>
    </div>

    <div class="card">
        @if($stockIns->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockIns as $index => $stockIn)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($stockIn->tanggal)->format('d M Y') }}</td>
                                <td class="font-mono">{{ $stockIn->kode_barang }}</td>
                                <td><strong>{{ $stockIn->item->nama_barang ?? '-' }}</strong></td>
                                <td>{{ $stockIn->supplier }}</td>
                                <td><span class="badge badge-success">+{{ $stockIn->jumlah }}</span></td>
                                <td>{{ $stockIn->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="icon">📥</div>
                <p><strong>Belum ada transaksi barang masuk.</strong><br><a href="{{ route('stock-ins.create') }}">Tambah transaksi sekarang</a> untuk mencatat barang masuk.</p>
            </div>
        @endif
    </div>
@endsection
