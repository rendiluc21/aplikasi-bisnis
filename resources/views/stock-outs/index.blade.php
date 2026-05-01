@extends('layouts.app')

@section('title', 'Transaksi Barang Keluar')

@section('content')
    <div class="page-header">
        <h1>📤 Daftar Barang Keluar</h1>
        <a href="{{ route('stock-outs.create') }}" class="btn btn-success btn-lg">+ Tambah Barang Keluar</a>
    </div>

    <div class="card">
        @if($stockOuts->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockOuts as $index => $stockOut)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($stockOut->tanggal)->format('d M Y') }}</td>
                                <td class="font-mono">{{ $stockOut->kode_barang }}</td>
                                <td><strong>{{ $stockOut->item->nama_barang ?? '-' }}</strong></td>
                                <td><span class="badge badge-danger">-{{ $stockOut->jumlah }}</span></td>
                                <td>{{ $stockOut->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="icon">📤</div>
                <p><strong>Belum ada transaksi barang keluar.</strong><br><a href="{{ route('stock-outs.create') }}">Tambah transaksi sekarang</a> untuk mencatat barang keluar.</p>
            </div>
        @endif
    </div>
@endsection
