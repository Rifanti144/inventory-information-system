<div class="field">
  <label for="warehouse_name">Warehouse Name</label>
  <input type="text" id="warehouse_name" name="warehouse_name" value="{{ old('warehouse_name', $warehouse->warehouse_name ?? '') }}" required>
  @error('warehouse_name') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="aisle_number">Aisle Number</label>
  <input type="text" id="aisle_number" name="aisle_number" value="{{ old('aisle_number', $warehouse->aisle_number ?? '') }}" required>
  @error('aisle_number') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="rack_code">Rack Code</label>
  <input type="text" id="rack_code" name="rack_code" value="{{ old('rack_code', $warehouse->rack_code ?? '') }}" required>
  @error('rack_code') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="physical_capacity">Physical Capacity</label>
  <input type="text" id="physical_capacity" name="physical_capacity" value="{{ old('physical_capacity', $warehouse->physical_capacity ?? '') }}" required>
  @error('physical_capacity') <p class="field-error">{{ $message }}</p> @enderror
</div>
