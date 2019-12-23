<div class="form-row">
   <div class="col-xs-12 col-sm-6 col-md-6">
      <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
         {!! Form::label('title', 'Title', ['class'=>'required']) !!}
         {!! Form::text('title', $article->title, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
      </div>
   </div>

   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
      <div class="form-group">
         {{ Form::label('category', 'Category', ['class'=>'required']) }}
         <select name="category" value="{{ old('category') ?? $article->category }}" id="category" class="form-control form-control-sm">
            @foreach($article->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
               <option value="{{ $categoryOptionKey }}" {{ $article->category == $categoryOptionValue ? 'selected' : '' }}>{{ $categoryOptionValue }}</option>
            @endforeach
         </select>
         <div class="pl-1 bg-danger">{{ $errors->first('category') }}</div>
      </div>
   </div>

   <div class="col-xs-12 col-sm-3 col-md-3">
      <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
         {{ Form::label('published_at', 'Publish(ed) On') }}
         <div class="input-group input-group-sm">
            <input type="text" name="published_at" value="{{ old('published_at') ?? $article->published_at }}" class="form-control form-control-sm" id="datePicker" />
            <div class="input-group-append">
               <span class="input-group-text input-group-text-sm"><i class="far fa-calendar-alt"></i></span>
            </div>
         </div>
         <div class="pl-1 bg-danger">{{ $errors->first('published_at') }}</div>
      </div>
   </div>
</div>

<div class="form-row">
   <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
         {!! Form::label('description_eng', 'Description (En)', ['class'=>'required']) !!}
         {!! Form::textarea('description_eng', $article->description_eng, ["class" => "form-control form-control-sm simple"]) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('description_eng') }}</div>
      </div>
   </div>
</div>

<div class="form-row">
   <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
         {!! Form::label('description_fre', 'Description (Fr)') !!}
         {!! Form::textarea('description_fre', $article->description_fre, ['class'=>'form-control form-control-sm simple']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('description_fre') }}</div>
      </div>
   </div>
</div>
