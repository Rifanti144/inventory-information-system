<div class="field">
  <label for="vendor_name">Vendor Name</label>
  <input type="text" id="vendor_name" name="vendor_name" value="{{ old('vendor_name', $vendor->vendor_name ?? '') }}" required>
  @error('vendor_name') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="office_address">Office Address</label>
  <input type="text" id="office_address" name="office_address" value="{{ old('office_address', $vendor->office_address ?? '') }}" required>
  @error('office_address') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="company_legality">Company Legality</label>
  <select id="company_legality" name="company_legality" required>
    <option value="" disabled @selected(old('company_legality', $vendor->company_legality ?? '') === '')>Select Legality</option>
    @foreach (\App\Models\Vendor::LEGALITIES as $legality)
      <option value="{{ $legality }}" @selected(old('company_legality', $vendor->company_legality ?? '') === $legality)>{{ $legality }}</option>
    @endforeach
  </select>
  @error('company_legality') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="pic_name">Person in Charge Name</label>
  <input type="text" id="pic_name" name="pic_name" value="{{ old('pic_name', $vendor->pic_name ?? '') }}" required>
  @error('pic_name') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="pic_contact">Person in Charge Contact</label>
  <input type="text" id="pic_contact" name="pic_contact" value="{{ old('pic_contact', $vendor->pic_contact ?? '') }}" required>
  @error('pic_contact') <p class="field-error">{{ $message }}</p> @enderror
</div>
