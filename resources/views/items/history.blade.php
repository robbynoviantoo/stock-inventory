@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Histori untuk: {{ $item->name }}</h2>
    <div class="section-card">
        <form action="{{ route('item_histories.store') }}" method="POST">
            @csrf
            <input type="hidden" name="item_id" value="{{ $item->id }}">

            <div class="mb-3">
                <label>Jenis</label>
                <select name="type" class="form-control" required>
                    <option value="in">Masuk</option>
                    <option value="out">Keluar</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Sumber</label>
                <input type="text" name="source" class="form-control">
            </div>
            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="note" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('items.show', $item) }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection