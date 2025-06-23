<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Item([
            'name' => $row['name'],
            'stock' => $row['stock'],
            'purchase_price' => $row['purchase_price'],
            'selling_price' => $row['selling_price'],
            'source' => $row['source'] ?? null,
        ]);
    }
}
