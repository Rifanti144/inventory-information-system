<div class="field">
  <label for="item_name">Item Name</label>
  <input type="text" id="item_name" name="item_name" value="{{ old('item_name', $item->item_name ?? '') }}" required>
  @error('item_name') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="tech_spec">Technical Specifications</label>
  <textarea id="tech_spec" name="tech_spec" rows="3">{{ old('tech_spec', $item->tech_spec ?? '') }}</textarea>
  @error('tech_spec') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="unit_size">Unit Size</label>
  <input type="text" id="unit_size" name="unit_size" placeholder="e.g. 10cm x 20cm" value="{{ old('unit_size', $item->unit_size ?? '') }}">
  @error('unit_size') <p class="field-error">{{ $message }}</p> @enderror
</div>

<div class="field">
  <label for="category">Category</label>
  <select id="category" name="category" required>
    <option value="" disabled @selected(old('category', $item->category ?? '') === '')>Select Category</option>
    @foreach (\App\Models\Item::CATEGORIES as $category)
      <option value="{{ $category }}" @selected(old('category', $item->category ?? '') === $category)>{{ $category }}</option>
    @endforeach
  </select>
  @error('category') <p class="field-error">{{ $message }}</p> @enderror
</div>
