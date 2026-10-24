<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index', ['items' => Item::orderBy('id')->get()]);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Item::create($this->validated($request));

        return redirect()->route('items.index')->with('status', 'Item added.');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item): RedirectResponse
    {
        $item->update($this->validated($request));

        return redirect()->route('items.index')->with('status', 'Item updated.');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('items.index')->with('status', 'Item deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'item_name' => ['required', 'string', 'max:255'],
            'tech_spec' => ['nullable', 'string', 'max:5000'],
            'unit_size' => ['nullable', 'string', 'max:255'],
            'category' => ['required', Rule::in(Item::CATEGORIES)],
        ]);
    }
}
