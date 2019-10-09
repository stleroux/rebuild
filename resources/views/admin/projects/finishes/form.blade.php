<div class="form-row">
   
   {{-- NAME --}}
   <div class="form-group col-md-3">
      {{ Form::label('name', 'Name', ['class'=>'required']) }}
      {{ Form::text('name', old('name') ?? $finish->name, ['class'=>'form-control form-control-sm', disabled()] ) }}
      <div class="bg-danger">{{ $errors->first('name') }}</div>
   </div>

</div>

<div class="form-row">
   
   {{-- COLOR NAME --}}
   <div class="form-group col-md-3">
      {{ Form::label('color_name', "Color Name") }}
      {{ Form::text('color_name', old('color_name') ?? $finish->color_name, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('color_name') }}</div>
   </div>
   
   {{-- COLOR CODE --}}
   <div class="form-group col-md-3">
      {{ Form::label('color_code', 'Color Code') }}
      {{ Form::text('color_code', old('color_code') ?? $finish->color_code, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('color_code') }}</div>
   </div>

   {{-- SHEEN --}}
   <div class="form-group col-md-3">
      {{ Form::label('sheen', 'Sheen') }}
      <select name="sheen" id="sheen" class="form-control form-control-sm", {!! disabled() !!}>
         @foreach($finish->sheenOptions() as $sheenOptionKey => $sheenOptionValue)
            <option value="{{$sheenOptionKey}}" {{ $finish->sheen == $sheenOptionValue ? 'selected' : '' }}>{{ $sheenOptionValue }}</option>
         @endforeach
      </select>
      <div class="bg-danger">{{ $errors->first('sheen') }}</div>
   </div>

</div>

<div class="form-row">
   
   {{-- TYPE --}}
   <div class="form-group col-md-3">
      {{ Form::label('type', 'Type') }}
      {{ Form::text('type', old('type') ?? $finish->type, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('type') }}</div>
   </div>

   {{-- MANUFACTURER --}}
   <div class="form-group col-md-3">
      {{ Form::label('manufacturer','Manufacturer') }}
      {{ Form::text('manufacturer', old('manufacturer') ?? $finish->manufacturer, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('manufacturer') }}</div>
   </div>
   
   {{-- UPC CODE --}}
   <div class="form-group col-md-3">
      {{ Form::label('upc', 'UPC Code') }}
      {{ Form::text('upc', old('upc') ?? $finish->upc, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('upc') }}</div>
   </div>

</div>

<div class="form-row">
   
   {{-- NOTES --}}
   <div class="form-group col-md-6">
      {{ Form::label('notes', 'Notes') }}
      {{ Form::textarea('notes', old('notes') ?? $finish->notes, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('notes') }}</div>
   </div>

</div>
