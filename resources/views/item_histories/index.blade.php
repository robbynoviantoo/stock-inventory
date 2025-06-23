@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-3">📚 Semua Riwayat Barang</h4>

    <div class="section-card">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Sumber</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $history)
                <tr>
                    <td>{{ $history->item->name }}</td>
                    <td>
                        <span class="badge bg-{{ $history->type === 'in' ? 'success' : 'danger' }}">
                            {{ strtoupper($history->type) }}
                        </span>
                    </td>
                    <td>{{ $history->quantity }}</td>
                    <td>{{ $history->source ?? '-' }}</td>
                    <td>{{ $history->note ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($history->date)->format('d M Y') }}</td>
                    <td>{{ $history->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada histori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $histories->links() }}
        </div>
    </div>
</div>
@endsection
