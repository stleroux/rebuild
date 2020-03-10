<div class="form-row">
   <!-- TITLE -->
   <div class="col-xs-12 col-sm-4">
      <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
         {!! Form::label('title', 'Title', ['class'=>'required']) !!}
         {!! Form::text('title', null, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
      </div>
   </div>
   <!-- COLLECTION NUMBER -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('col_no') ? 'has-error' : '' }}">
         {!! Form::label('col_no', 'Collection No', ['class'=>'required']) !!}
         {!! Form::text('col_no', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('col_no') }}</div>
      </div>
   </div>
   <!-- GENRE -->
   <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
      <div class="form-group">
         {{ Form::label('category', 'Genre', ['class'=>'required']) }}
         <select name="category" value="{{ old('category') ?? $movie->category }}" id="category" class="form-control form-control-sm">
            @foreach($movie->categoriesOptions() as $categoryOptionKey => $categoryOptionValue)
               <option value="{{ $categoryOptionKey }}" {{ $movie->category == $categoryOptionValue ? 'selected' : '' }}>{{ $categoryOptionValue }}</option>
            @endforeach
         </select>
         <div class="pl-1 bg-danger">{{ $errors->first('category') }}</div>
      </div>
   </div>
   <!-- PUBLISH DATE -->
   <div class="col-xs-12 col-sm-3 col-md-3">
      <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
         {{ Form::label('published_at', 'Publish(ed) On') }}
         <div class="input-group input-group-sm">
            {{ Form::date('published_at', date('Y-m-d', strtotime($movie->published_at))) }}
            <div class="input-group-append">
               <span class="input-group-text input-group-text-sm"><i class="far fa-calendar-alt"></i></span>
            </div>
         </div>
         <div class="pl-1 bg-danger">{{ $errors->first('published_at') }}</div>
      </div>
   </div>
</div>

<div class="form-row">
   <!-- RUNNING TIME -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('running_time') ? 'has-error' : '' }}">
         {!! Form::label('running_time', 'Running Time', ['class'=>'']) !!}
         {!! Form::text('running_time', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('running_time') }}</div>
      </div>
   </div>
   <!-- IMDB No -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('original_title') ? 'has-error' : '' }}">
         {!! Form::label('original_title', 'IMDB No', ['class'=>'']) !!}
         {!! Form::text('original_title', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('original_title') }}</div>
      </div>
   </div>
   <!-- UPC -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('upc') ? 'has-error' : '' }}">
         {!! Form::label('upc', 'UPC', ['class'=>'']) !!}
         {!! Form::text('upc', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('upc') }}</div>
      </div>
   </div>
   <!-- RATING -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('rating') ? 'has-error' : '' }}">
         {!! Form::label('rating', 'Rating', ['class'=>'']) !!}
         {!! Form::text('rating', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('rating') }}</div>
      </div>
   </div>
   <!-- STUDIO -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('studio') ? 'has-error' : '' }}">
         {!! Form::label('studio', 'Studio', ['class'=>'']) !!}
         {!! Form::text('studio', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('studio') }}</div>
      </div>
   </div>
   <!-- PRODUCTION YEAR -->
   <div class="col-xs-12 col-sm-2">
      <div class="form-group {{ $errors->has('production_year') ? 'has-error' : '' }}">
         {!! Form::label('production_year', 'Production Year', ['class'=>'']) !!}
         {!! Form::text('production_year', null, ['class' => 'form-control form-control-sm']) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('production_year') }}</div>
      </div>
   </div>
</div>

<div class="form-row">
   <!-- OVERVIEW -->
   <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group {{ $errors->has('overview') ? 'has-error' : '' }}">
         {!! Form::label('overview', 'Overview', ['class'=>'']) !!}
         {!! Form::textarea('overview', null, ["class" => "form-control form-control-sm simple"]) !!}
         <div class="pl-1 bg-danger">{{ $errors->first('overview') }}</div>
      </div>
   </div>
</div>
