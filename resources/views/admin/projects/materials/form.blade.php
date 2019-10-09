<div class="form-row">

   {{-- NAME --}}
   <div class="form-group col-md-3">
      {{ Form::label('name', 'Name', ['class'=>'required']) }}
      {{ Form::text('name', old('name') ?? $material->name, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('name') }}</div>
   </div>

</div>

<div class="form-row">
   
   {{-- TYPE --}}
   <div class="form-group col-md-3">
      {{ Form::label('type', 'Type') }}
      {{ Form::text('type', old('type') ?? $material->type, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('type') }}</div>
   </div>

   {{-- MANUFACTURER --}}
   <div class="form-group col-md-3">
      {{ Form::label('manufacturer', 'Manufacturer') }}
      {{ Form::text('manufacturer', old('manufacturer') ?? $material->manufacturer, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('manufacturer') }}</div>
   </div>

   {{-- UPC CODE --}}
   <div class="form-group col-md-3">
      {{ Form::label('upc', 'UPC Code') }}
      {{ Form::text('upc', old('upc') ?? $material->upc, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('upc') }}</div>
   </div>

</div>

<div class="form-row">
   
   {{-- NOTES --}}
   <div class="form-group col-md-6">
      {{ Form::label('notes', "Notes") }}
      {{ Form::textarea('notes', old('notes') ?? $material->notes, ['class'=>'form-control form-control-sm', disabled()]) }}
      <div class="bg-danger">{{ $errors->first('notes') }}</div>
   </div>
   
</div>
