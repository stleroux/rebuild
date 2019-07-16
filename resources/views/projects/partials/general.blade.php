{{-- GENERAL INFORMATION --}}
<div class="card mb-2">
   <div class="card-header p-1">General Information</div>
   <div class="card-body p-2">

      <div class="form-row pt-2">
         <!-- Name -->
         <div class="col-xs-12 col-sm-4">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
               {{-- {!! Form::label('name', 'Project Name', ['class'=>'required']) !!}
               {!! Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!} --}}
               <label for="name" class="required">Name</label>
               <input type="text" name="name" value="{{ old('name') ?? $project->name }}" class="form-control form-control-sm">
               <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
         </div>

         <!-- Category -->
         <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
            <div class="form-group">
               <label for="category" class="required">Category</label>
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
         <!-- Description -->
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
               {{-- {!! Form::label('description', 'Project Description', ['class'=>'required']) !!}
               {!! Form::textarea('description', null, ['class' => 'form-control form-control-sm', 'rows'=>3]) !!} --}}
               <label for="description" class="required">Project Description</label>
               <textarea name="description" class="form-control form-control-sm w-100" rows="3">{{ old('description') ?? $project->description }}</textarea>
               <span class="text-danger">{{ $errors->first('description') }}</span>
            </div>
         </div>
      </div>
      
   </div>
</div>
