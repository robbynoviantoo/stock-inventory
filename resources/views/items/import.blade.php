@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">⬆️ Import Data Barang</h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('items.import') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File Excel/CSV</label>
                    <input type="file" name="file" class="form-control" required accept=".xlsx,.xls,.csv">
                </div>

                <button type="submit" class="btn btn-primary">Import</button>
                <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

            <hr>
            <p class="text-muted mt-3">
                Pastikan file memiliki header: <code>name, stock, purchase_price, selling_price, source</code>
            </p>
        </div>
    </div>
</div>
@endsection