<div class="panel panel-primary">

	<div class="panel-heading">
		<h3 class="panel-title">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Article Details
		</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					{!! Form::label("title", "Title", ['class'=>'required']) !!}
					{!! Form::text("title", null, ["class" => "form-control form-control-sm", "autofocus", 'onfocus' => 'this.focus();this.select()']) !!}
					<span class="text-danger">{{ $errors->first('title') }}</span>
				</div>
			</div>
{{-- 			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
					{{ Form::label('category_id', 'Category', ['class'=>'required']) }}
					{{ Form::select('category_id', $categories, null, ['class'=>'form-control form-control-sm']) }}
					<span class="text-danger">{{ $errors->first('category_id') }}</span>
				</div>
			</div> --}}
{{-- <div class="col-xs-12 col-sm-6 col-md-3">
   <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}" >
      {!! Form::label("category_id", "Category", ['class'=>'required']) !!}
      <select name="category_id" id="catSelect" class="form-control form-control-sm">
         <option selected>Select One</option>
         @foreach ($categories as $category)
            <option disabled>{{ ucfirst($category->name) }}</option>
            @foreach ($category->children as $children)
               <option value="{{ $children->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- {{ ucfirst($children->name) }}</option>
            @endforeach
         @endforeach
      </select>
		<div class="pl-1 bg-danger">{{ $errors->first('category_id') }}</div>
   </div>
</div> --}}

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
			{{-- @if(checkACL('publisher')) --}}
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
						{{ Form::label('published_at', 'Publish(ed) On') }}
						{{ Form::text('published_at', null, ['class'=>'form-control form-control-sm required', 'id'=>'datetime']) }}
						<span class="text-danger">{{ $errors->first('published_at') }}</span>
					</div>
				</div>
			{{-- @endif --}}
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
					{!! Form::label('description_eng', 'Description (En)', ['class'=>'required']) !!}
					{!! Form::textarea('description_eng', null, ["class" => "form-control form-control-sm simple"]) !!}
					<span class="text-danger">{{ $errors->first('description_eng') }}</span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
					{!! Form::label('description_fre', 'Description (Fr)') !!}
					{!! Form::textarea('description_fre', null, ["class" => "form-control form-control-sm simple"]) !!}
					<span class="text-danger">{{ $errors->first('description_fre') }}</span>
				</div>
			</div>
		</div>

	</div>

</div>