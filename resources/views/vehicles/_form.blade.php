@csrf

@if ($errors->any())
    <div class="alert error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<label for="serial">Serial Number</label>
<input id="serial" name="serial" class="field" maxlength="12" required
       value="{{ old('serial', $vehicle->serial ?? '') }}">

<label for="type">Type</label>
<select id="type" name="type" class="field">
    @foreach ($types as $t)
        <option value="{{ $t }}" @selected(old('type', $vehicle->type ?? '') === $t)>{{ ucfirst($t) }}</option>
    @endforeach
</select>

<label for="status">Status</label>
<select id="status" name="status" class="field">
    @foreach ($statuses as $s)
        <option value="{{ $s }}" @selected(old('status', $vehicle->status ?? 'available') === $s)>{{ ucfirst($s) }}</option>
    @endforeach
</select>

<div class="actions">
    <a href="{{ route('vehicles.index') }}" class="btn btn-dark">Cancel</a>
    <button class="btn">SAVE</button>
</div>