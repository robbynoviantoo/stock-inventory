@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>

    <div class="section-card">
        <form action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Stok Awal</label>
                <input type="number" name="stock" class="form-control" value="0" min="0">
            </div>
            <div class="mb-3">
                <label>Harga Beli</label>
                <input type="number" step="0.01" name="purchase_price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga Jual</label>
                <input type="number" step="0.01" name="selling_price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Sumber Barang</label>
                <input type="text" name="source" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection