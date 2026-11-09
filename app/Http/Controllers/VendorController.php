<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Vendor::class);

        return view('vendors.index', [
            'vendors' => Vendor::with('user')->orderBy('id')->get(),
        ]);
    }

    public function create()
    {
        Gate::authorize('create', Vendor::class);

        return view('vendors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', Vendor::class);

        Vendor::create($this->validated($request));

        return redirect()->route('vendors.index')->with('status', 'Vendor added.');
    }

    public function edit(Vendor $vendor)
    {
        Gate::authorize('update', $vendor);

        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor): RedirectResponse
    {
        Gate::authorize('update', $vendor);

        $vendor->update($this->validated($request));

        return redirect()->route('vendors.index')->with('status', 'Vendor updated.');
    }

    public function destroy(Vendor $vendor): RedirectResponse
    {
        Gate::authorize('delete', $vendor);

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
