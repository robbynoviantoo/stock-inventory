<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemHistory;
use Illuminate\Http\Request;

class ItemHistoryController extends Controller
{
    public function index()
    {
        $histories = ItemHistory::with('item')->latest()->paginate(10);

        return view('item_histories.index', compact('histories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'source' => 'nullable|string',
            'note' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        // Update stock
        if ($validated['type'] === 'in') {
            $item->increment('stock', $validated['quantity']);
        } else {
            if ($item->stock < $validated['quantity']) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Stok tidak mencukupi untuk pengeluaran.');
            }
            $item->decrement('stock', $validated['quantity']);
        }

        ItemHistory::create($validated);

        return redirect()
            ->route('items.show', $item->id)
            ->with('success', 'Histori berhasil ditambahkan.');
    }

    public function destroy(ItemHistory $itemHistory)
    {
        $item = $itemHistory->item;

        // Revert stock
        if ($itemHistory->type === 'in') {
            $item->decrement('stock', $itemHistory->quantity);
        } else {
            $item->increment('stock', $itemHistory->quantity);
        }

        $itemHistory->delete();

        return redirect()
            ->route('items.show', $item->id)
            ->with('success', 'Histori berhasil dihapus dan stok dikembalikan.');
    }
}
