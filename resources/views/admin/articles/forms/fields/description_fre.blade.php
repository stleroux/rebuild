<div class="col-xs-12 col-sm-12 col-md-12">

   <div class="form-group">
   
      @if($showFields == 'add' || $showFields == 'edit')

         <label for="description_fre" class="required">Description (FR)</label>
         <textarea name="description_fre" id="description_fre" class="form-control form-control-sm simple">{{ $article->description_fre ?? old('description_fre') }}</textarea>
         <div class="pl-1 bg-danger">{{ $errors->first('description_fre') }}</div>

      @else

         <label for="description_fre">Description (FR)</label>
         <div class="card bg-light text-dark rounded p-1">
            {!! $article->description_fre ?: 'Not Available' !!}
         </div>

      @endif

   </div>

</div>
