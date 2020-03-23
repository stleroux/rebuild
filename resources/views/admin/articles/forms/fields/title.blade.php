<div class="col-xs-12 col-sm-6 col-md-6">

   <div class="form-group">
   
      @if($showFields == 'add' || $showFields == 'edit')

         <label for="title" class="required">Title</label>
         <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control form-control-sm" onfocus="this.select()" >
         <div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>

      @else

         <label for="title">Title</label>
         <div class="card bg-light text-dark rounded p-1">
            {{ $article->title }}
         </div>
   
      @endif

   </div>

</div>
