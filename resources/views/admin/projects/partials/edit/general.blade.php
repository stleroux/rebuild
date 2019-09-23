{{-- GENERAL INFORMATION --}}
<div class="card mb-2">
   <div class="card-header card_header p-1">
       General Information
   </div>
   <div class="card-body section_body p-2">

      <div class="form-row pt-2">
         <!-- Name -->
         <div class="col-xs-12 col-sm-4">
            <div class="form-group">
               <label for="name" class="required">Name</label>
               <input type="text" name="name" value="{{ old('name') ?? $project->name }}" class="form-control form-control-sm">
               <div class="pl-1 bg-danger">{{ $errors->first('name') }}</div>
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
               <div class="pl-1 bg-danger">{{ $errors->first('category') }}</div>
            </div>
         </div>
      </div>
      
      <div class="form-row">
         <!-- Description -->
         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
               <label for="description" class="required">Project Description</label>
               <textarea name="description" class="form-control form-control-sm w-100" rows="3">{{ old('description') ?? $project->description }}</textarea>
               <div class="pl-1 bg-danger">{{ $errors->first('description') }}</div>
            </div>
         </div>
      </div>
      
   </div>
</div>
