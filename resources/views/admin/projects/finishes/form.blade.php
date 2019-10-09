{{-- @csrf --}}
{{-- @message_type(name) --}}
{{-- @message(World!) --}}
{{-- @routeis('admin.projects.finishes.show')
blah blah blah
@endrouteis

@hidden('admin.projects.finishes.show')

@endhidden --}}

{{ collect(request()->segments())->last() }}
<br />
{{ last(request()->segments()) }}

@php
   //Check if route name is show, if it is, make fields disabled
   $rName = (\Route::current()->getName() == 'admin.projects.finishes.show');
   if ($rName) {
      // echo "Value : " . $rName;
      $showDisabled = "disabled";
      $showHidden = "style=\"display:none\"";
   } else {
      $showDisabled = "";
      $showHidden = "";
   }
@endphp
      
<div class="form-row">
   <div class="form-group col-md-3">
      {{ Form::label('name', 'Name', ['class'=>'required']) }}
      {{ Form::text('name', old('name') ?? $finish->name, ['class'=>'form-control form-control-sm', $showDisabled] ) }}
      <div class="bg-danger">{{ $errors->first('name') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-3">
      {{ Form::label('color_name', "Color Name") }}
      {{ Form::text('color_name', old('color_name') ?? $finish->color_name, ['class'=>'form-control form-control-sm', $showDisabled]) }}
      <div class="bg-danger">{{ $errors->first('color_name') }}</div>
   </div>
   <div class="form-group col-md-3">
      {{ Form::label('color_code', 'Color Code') }}
      {{ Form::text('color_code', old('color_code') ?? $finish->color_code, ['class'=>'form-control form-control-sm', $showDisabled]) }}
      <div class="bg-danger">{{ $errors->first('color_code') }}</div>
   </div>

   <div class="form-group col-md-3">
      {{ Form::label('sheen', 'Sheen') }}
      <select name="sheen" id="sheen" class="form-control form-control-sm" {{ $showDisabled }}>
         @foreach($finish->sheenOptions() as $sheenOptionKey => $sheenOptionValue)
            <option value="{{$sheenOptionKey}}" {{ $finish->sheen == $sheenOptionValue ? 'selected' : '' }}>{{ $sheenOptionValue }}</option>
         @endforeach
      </select>
      <div class="bg-danger">{{ $errors->first('sheen') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-3">
      {{ Form::label('type', 'Type') }}
      {{ Form::text('type', old('type') ?? $finish->type, ['class'=>'form-control form-control-sm', $showDisabled]) }}
      <div class="bg-danger">{{ $errors->first('type') }}</div>
   </div>
   <div class="form-group col-md-3">
      {{ Form::label('manufacturer','Manufacturer') }}
      {{ Form::text('manufacturer', old('manufacturer') ?? $finish->manufacturer, ['class'=>'form-control form-control-sm', $showDisabled]) }}
      <div class="bg-danger">{{ $errors->first('manufacturer') }}</div>
   </div>
   <div class="form-group col-md-3">
      {{ Form::label('upc', 'UPC Code') }}
      {{ Form::text('upc', old('upc') ?? $finish->upc, ['class'=>'form-control form-control-sm', $showDisabled]) }}
      <div class="bg-danger">{{ $errors->first('upc') }}</div>
   </div>
</div>

<div class="form-row">
   <div class="form-group col-md-6">
      {{ Form::label('notes', 'Notes') }}
      {{ Form::textarea('notes', old('notes') ?? $finish->notes, ['class'=>'form-control form-control-sm', $showDisabled]) }}
      <div class="bg-danger">{{ $errors->first('notes') }}</div>
   </div>
</div>

