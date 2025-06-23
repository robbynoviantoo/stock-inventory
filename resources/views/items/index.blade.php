@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-wrap gap-2 mb-3">
        <a href="{{ route('items.create') }}" class="btn btn-primary">
            ➕ Tambah Barang
        </a>

        <a href="{{ route('items.import.page') }}" class="btn btn-secondary">
            ⬆️ Import 
        </a>

        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                ⬇️ Export
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('items.export', 'xlsx') }}">Export Excel</a></li>
                <li><a class="dropdown-item" href="{{ route('items.export', 'csv') }}">Export CSV</a></li>
                <li><a class="dropdown-item" href="{{ route('items.export', 'pdf') }}">Export PDF</a></li>
            </ul>
        </div>
    </div>

    <div class="section-card">
        <table class="table table-bordered" id="items-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Sumber</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Responsive extension JS -->
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(function() {
        $('#items-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true, // ini penting untuk responsivitas
            ajax: "{{ route('items.data') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'stock',
                    name: 'stock'
                },
                {
                    data: 'purchase_price',
                    name: 'purchase_price'
                },
                {
                    data: 'selling_price',
                    name: 'selling_price'
                },
                {
                    data: 'source',
                    name: 'source'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush