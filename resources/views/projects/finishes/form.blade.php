<div class="form-row">
   <div class="form-group col-md-3">
      <label for="name" class="required">Name</label>
      <input type="text" name="name" value="{{ old('name') ?? $finish->name }}" class="form-control form-control-sm">
      <div class="text-danger">{{ $errors->first('name') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-3">
      <label for="color_name">Color Name</label>
      <input color_name="text" name="color_name" value="{{ old('color_name') ?? $finish->color_name }}" class="form-control form-control-sm">
      <div class="text-danger">{{ $errors->first('color_name') }}</div>
   </div>
   <div class="form-group col-md-3">
      <label for="color_code">Color Code</label>
      <input type="text" name="color_code" value="{{ old('color_code') ?? $finish->color_code }}" class="form-control form-control-sm">
      <div class="text-danger">{{ $errors->first('color_code') }}</div>
   </div>
   <div class="form-group col-md-3">
      <label for="sheen">Sheen</label>
      {{-- <input type="text" name="sheen" value="{{ old('sheen') ?? $finish->sheen }}" class="form-control form-control-sm"> --}}
      <select name="sheen" id="sheen" class="form-control form-control-sm">
         @foreach($finish->sheenOptions() as $sheenOptionKey => $sheenOptionValue)
            <option value="{{$sheenOptionKey}}" {{ $finish->sheen == $sheenOptionValue ? 'selected' : '' }}>{{ $sheenOptionValue }}</option>
         @endforeach
      </select>
      <div class="text-danger">{{ $errors->first('sheen') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-3">
      <label for="type">Type</label>
      <input type="text" name="type" value="{{ old('type') ?? $finish->type }}" class="form-control form-control-sm">
      <div class="text-danger">{{ $errors->first('type') }}</div>
   </div>
   <div class="form-group col-md-3">
      <label for="manufacturer">Manufacturer</label>
      <input type="text" name="manufacturer" value="{{ old('manufacturer') ?? $finish->manufacturer }}" class="form-control form-control-sm">
      <div class="text-danger">{{ $errors->first('manufacturer') }}</div>
   </div>
   <div class="form-group col-md-3">
      <label for="upc">UPC Code</label>
      <input type="text" name="upc" value="{{ old('upc') ?? $finish->upc }}" class="form-control form-control-sm">
      <div class="text-danger">{{ $errors->first('upc') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-6">
      <label for="notes">Notes</label>
      <textarea name="notes" class="form-control form-control-sm">{{ old('notes') ?? $finish->notes }}</textarea>
      <div class="text-danger">{{ $errors->first('notes') }}</div>
   </div>
</div>

@csrf
