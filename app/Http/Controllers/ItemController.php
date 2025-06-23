<?php

namespace App\Http\Controllers;

use App\Exports\ItemExport;
use App\Imports\ItemImport;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function data(Request $request)
    {
        $items = Item::query();
        return DataTables::of($items)
            ->addColumn('aksi', function ($item) {
                return '<a href="' . route('items.show', $item) . '" class="btn btn-sm btn-info">Detail</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'integer|min:0',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'source' => 'nullable|string',
        ]);

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Item $item)
    {
        $item->load('histories');
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'integer|min:0',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'source' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }

    public function importPage()
    {
        return view('items.import');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'File tidak valid atau terlalu besar.');
        }

        Excel::import(new ItemImport, $request->file('file'));

        return redirect()->route('items.index')->with('success', 'Data barang berhasil diimport.');
    }

    public function export($format)
    {
        $format = strtolower($format);
        $valid = ['xlsx', 'csv', 'pdf'];

        if (!in_array($format, $valid)) {
            abort(404);
        }

        return Excel::download(new ItemExport, 'data-barang.' . $format);
    }
}
