<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

   <div class="form-group">
      
      @if($showFields == 'add' || $showFields == 'edit')

         <label for="category" class="required">Category</label>
         <select name="category" value="{{ old('category') ?? $article->category }}" id="category" class="form-control form-control-sm">
            @foreach($article->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
               <option value="{{ $categoryOptionKey }}" {{ $article->category == $categoryOptionValue ? 'selected' : '' }}>{{ $categoryOptionValue }}</option>
            @endforeach
         </select>
         <div class="pl-1 bg-danger">{{ $errors->first('category') }}</div>
      
      @else

         <label for="category">Category</label>
         <div class="card bg-light text-dark rounded p-1">
            {{ $article->category ?? 'Not Available' }}
         </div>

      @endif
   
   </div>

</div>
