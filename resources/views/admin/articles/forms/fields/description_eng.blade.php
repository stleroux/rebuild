<div class="col-xs-12 col-sm-12 col-md-12">

   <div class="form-group">
      
      @if($showFields == 'add' || $showFields == 'edit')

         <label for="description_eng" class="required">Description (EN)</label>
         <textarea name="description_eng" id="description_eng" class="form-control form-control-sm simple">{{ $article->description_eng ?? old('description_eng') }}</textarea>
         <div class="pl-1 bg-danger">{{ $errors->first('description_eng') }}</div>

      @else

         <label for="description_fre">Description (EN)</label>
         <div class="card bg-light text-dark rounded p-1">
            {!! $article->description_eng ?: 'Not Available' !!}
         </div>

      @endif

   </div>

</div>
