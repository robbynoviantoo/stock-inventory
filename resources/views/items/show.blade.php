@extends('layouts.app')

@section('content')
<div class="container">
<x-breadcrumbs :breadcrumbs="[
    'Data Barang' => route('items.index'),
    'Lihat' => route('items.show', $item->id),
]" />

    <h2>{{ $item->name }}</h2>
    <p><strong>Stok:</strong> {{ $item->stock }}</p>
    <p><strong>Harga Beli:</strong> Rp {{ number_format($item->purchase_price, 0, ',', '.') }}</p>
    <p><strong>Harga Jual:</strong> Rp {{ number_format($item->selling_price, 0, ',', '.') }}</p>
    <p><strong>Sumber:</strong> {{ $item->source }}</p>

    <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('items.history', $item->id) }}" class="btn btn-primary">Tambah Histori</a>

    <h4 class="mt-4">Riwayat Barang</h4>
    <div class="section-card">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Sumber</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item->histories as $history)
                <tr>
                    <td>{{ $history->date }}</td>
                    <td>{{ strtoupper($history->type) }}</td>
                    <td>{{ $history->quantity }}</td>
                    <td>{{ $history->source }}</td>
                    <td>{{ $history->note }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection