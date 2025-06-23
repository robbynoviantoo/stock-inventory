<div id="sidebar" class="bg-light border-end p-3" style="min-height: 100vh; width: 220px; flex-shrink: 0;">
    <h5 class="mb-3">📋 Menu</h5>
    <div class="list-group">
        <a href="{{ route('items.index') }}" class="list-group-item list-group-item-action">
            📦 Data Barang
        </a>
        <a href="{{ route('items.create') }}" class="list-group-item list-group-item-action">
            ➕ Tambah Barang
        </a>
<br>
        <a href="{{ route('item_histories.index') }}" class="list-group-item list-group-item-action">
            📚 Semua Riwayat
        </a>
    </div>
</div>