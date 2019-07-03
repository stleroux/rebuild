{{-- GENERAL INFORMATION --}}
<div class="card">
   <div class="card-header p-1">General Information</div>
   <div class="card-body p-2">

      <div class="form-row pt-2">
         <div class="col-xs-12 col-sm-4">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
               {!! Form::label('name', 'Project Name', ['class'=>'required']) !!}
               {!! Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!}
               <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
         </div>
         <!-- Category -->
         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="form-group">
               <label for="category">Category</label>
               <select name="category" value="{{ old('category') ?? $project->category }}" id="category" class="form-control form-control-sm">
                  @foreach($project->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
                     <option value="{{ $categoryOptionKey }}" {{ $project->category == $categoryOptionValue ? 'selected' : '' }}>{{ $categoryOptionValue }}</option>
                  @endforeach
               </select>
               <div class="text-danger">{{ $errors->first('category') }}</div>
            </div>
         </div>
      </div>
      
      <div class="form-row">
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
               {!! Form::label('description', 'Project Description', ['class'=>'required']) !!}
               {!! Form::textarea('description', null, ['class' => 'form-control form-control-sm', 'rows'=>3]) !!}
               <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
         </div>
      </div>
      
   </div>
</div>
