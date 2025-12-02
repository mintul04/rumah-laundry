@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Laporan Transaksi Laundry</h1>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h2>{{ $totalTransactions }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Total Pendapatan</h5>
                    <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5>Rata-rata/Transaksi</h5>
                    <h2>Rp {{ number_format($averageTransaction, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Pelanggan Aktif</h5>
                    <h2>{{ $topCustomers->count() }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabel Detail Transaksi -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Detail Transaksi</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Order</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->no_order }}</td>
                        <td>{{ $transaction->nama_pelanggan }}</td>
                        <td>{{ $transaction->tanggal_transaksi }}</td>
                        <td>
                            <span class="badge bg-success">{{ $transaction->pembayaran }}</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">{{ $transaction->status_order }}</span>
                        </td>
                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Export Options -->
    <div class="text-end mb-4">
        <a href="{{ route('reports.export.pdf') }}" class="btn btn-danger">
            📄 Export PDF
        </a>
        <a href="{{ route('reports.export.excel') }}" class="btn btn-success">
            📊 Export Excel
        </a>
    </div>
</div>
@endsection