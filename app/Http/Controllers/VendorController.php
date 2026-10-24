<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    public function index()
    {
        return view('vendors.index', ['vendors' => Vendor::orderBy('id')->get()]);
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Vendor::create($this->validated($request));

        return redirect()->route('vendors.index')->with('status', 'Vendor added.');
    }

    public function edit(Vendor $vendor)
    {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor): RedirectResponse
    {
        $vendor->update($this->validated($request));

        return redirect()->route('vendors.index')->with('status', 'Vendor updated.');
    }

    public function destroy(Vendor $vendor): RedirectResponse
    {
        $vendor->delete();

        return redirect()->route('vendors.index')->with('status', 'Vendor deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'vendor_name' => ['required', 'string', 'max:255'],
            'office_address' => ['required', 'string', 'max:255'],
            'company_legality' => ['required', Rule::in(Vendor::LEGALITIES)],
            'pic_name' => ['required', 'string', 'max:255'],
            'pic_contact' => ['required', 'string', 'max:255'],
        ]);
    }
}
