<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class vehiclecontroller extends Controller
{
    const TYPES = ['forklift', 'trolley', 'pickup'];
    const STATUSES = ['available', 'maintenance'];
    public function index(Request $request) 
    {
        $vehicle = vehicle::query()
            ->when($request->q, fn ($query, $search) => $query->where('serial', 'like', "%{$search}"))
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
 
        return view('vehicles.index', [
            'vehicles' => $vehicle,
            'statuses' => self::STATUSES,
        ]);
    }
 
    // CREATE: show the form
    public function create()
    {
        return view('vehicles.create', [
            'types'    => self::TYPES,
            'statuses' => self::STATUSES,
        ]);
    }
 
    // CREATE: save to the database
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
 
        vehicle::create($data);
 
        return redirect()->route('vehicles.index')->with('success', 'vehicle added.');
    }
 
    // UPDATE: show the form with existing data
    public function edit(vehicle $vehicle)
    {
        return view('vehicles.edit', [
            'vehicle'  => $vehicle,
            'types'    => self::TYPES,
            'statuses' => self::STATUSES,
        ]);
    }
 
    // UPDATE: save changes
    public function update(Request $request, vehicle $vehicle)
    {
        $data = $request->validate($this->rules($vehicle));
 
        $vehicle->update($data);
 
        return redirect()->route('vehicles.index')->with('success', 'vehicle updated.');
    }
 
    // DELETE
    public function destroy(vehicle $vehicle)
    {
        $vehicle->delete();
 
        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted.');
    }
 
    // Shared validation. ignore($vehicle) lets an edit keep its own serial.
    private function rules(?vehicle $vehicle = null): array
    {
        return [
            'serial' => ['required', 'string', 'max:12', Rule::unique('vehicles', 'serial')->ignore($vehicle)],
            'type'   => ['required', Rule::in(self::TYPES)],
            'status' => ['required', Rule::in(self::STATUSES)],
        ];
    }
}
    