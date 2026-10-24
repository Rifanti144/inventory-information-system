<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        return view('warehouses.index', ['warehouses' => Warehouse::orderBy('id')->get()]);
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Warehouse::create($this->validated($request));

        return redirect()->route('warehouses.index')->with('status', 'Warehouse added.');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse): RedirectResponse
    {
        $warehouse->update($this->validated($request));

        return redirect()->route('warehouses.index')->with('status', 'Warehouse updated.');
    }

    public function destroy(Warehouse $warehouse): RedirectResponse
    {
        $warehouse->delete();

        return redirect()->route('warehouses.index')->with('status', 'Warehouse deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'warehouse_name' => ['required', 'string', 'max:255'],
            'aisle_number' => ['required', 'string', 'max:255'],
            'rack_code' => ['required', 'string', 'max:255'],
            'physical_capacity' => ['required', 'string', 'max:255'],
        ]);
    }
}
