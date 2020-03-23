<div class="col-xs-12 col-sm-3 col-md-3">

   <div class="form-group">
      
      @if($showFields == 'add' || $showFields == 'edit')

         <label for="published_at">Publish(ed) On</label>
         <div class="input-group input-group-sm">
            <input type="text" name="published_at" value="{{ old('published_at') ?? $article->published_at }}" class="form-control form-control-sm" id="datePicker" autocomplete="off" />
            <div class="input-group-append"><span class="input-group-text input-group-text-sm"><i class="far fa-calendar-alt"></i></span></div>
         </div>
         <div class="pl-1 bg-danger">{{ $errors->first('published_at') }}</div>

      @else

         <label for="published_at">Publish(ed) On</label>
         <div class="card bg-light text-dark rounded p-1">
            {{ $article->published_at ?? 'Not Available' }}
         </div>

      @endif

   </div>

</div>
