<div class="form-row">
   <div class="form-group col-md-3">
      <label for="name" class="required">Name</label>
      <input type="text" name="name" value="{{ old('name') ?? $material->name }}" class="form-control form-control-sm">
      <div class="bg-danger">{{ $errors->first('name') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-3">
      <label for="type">Type</label>
      <input type="text" name="type" value="{{ old('type') ?? $material->type }}" class="form-control form-control-sm">
      <div class="bg-danger">{{ $errors->first('type') }}</div>
   </div>
   <div class="form-group col-md-3">
      <label for="manufacturer">Manufacturer</label>
      <input type="text" name="manufacturer" value="{{ old('manufacturer') ?? $material->manufacturer }}" class="form-control form-control-sm">
      <div class="bg-danger">{{ $errors->first('manufacturer') }}</div>
   </div>
   <div class="form-group col-md-3">
      <label for="upc">UPC Code</label>
      <input type="text" name="upc" value="{{ old('upc') ?? $material->upc }}" class="form-control form-control-sm">
      <div class="bg-danger">{{ $errors->first('upc') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-6">
      <label for="notes">Notes</label>
      <textarea name="notes" class="form-control form-control-sm">{{ old('notes') ?? $material->notes }}</textarea>
      <div class="bg-danger">{{ $errors->first('notes') }}</div>
   </div>
</div>

@csrf
