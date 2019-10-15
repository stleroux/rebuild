<div class="card mb-3">
	<div class="card-header section_header p-2">
		
			<i class="fa fa-plus-square" aria-hidden="true"></i>
			{{-- <i class="fa fa-file-text-o" aria-hidden="true"></i> --}}
			Create Article
			@include('admin.articles.buttons.save', ['size'=>'xs'])
		
	</div>
	<div class="card-body section_body p-2">
		<div class="row">
			
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
					{!! Form::label('title', 'Title', ['class'=>'required']) !!}
					{!! Form::text('title', null, ['class' => 'form-control form-control-sm', 'autofocus', 'onfocus' => 'this.focus();this.select()']) !!}
					<div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
				</div>
			</div>
			
{{-- 			<div class="col-xs-12 col-sm-3 col-md-3">
				<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
					{{ Form::label('category_id', 'Category', ['class'=>'required']) }}
					{{ Form::select('category_id', array('' => '-- Category --') + $categories, null , ['class' => 'form-control form-control-sm']) }}
					<div class="pl-1 bg-danger">{{ $errors->first('category_id') }}</div>
				</div>
			</div> --}}

<div class="col-xs-12 col-sm-6 col-md-3">
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
</div>

			{{-- @if(checkACL('publisher')) --}}
				<div class="col-xs-12 col-sm-3 col-md-3">
					<div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
						{{ Form::label('published_at', 'Publish(ed) On') }}
						{{ Form::text('published_at', null, ['class'=>'form-control form-control-sm', 'id'=>'datetime']) }}
						<div class="pl-1 bg-danger">{{ $errors->first('published_at') }}</div>
					</div>
				</div>
			{{-- @endif --}}

		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				
				<div class="form-group {{ $errors->has('description_eng') ? 'has-error' : '' }}">
					{!! Form::label('description_eng', 'Description (En)', ['class'=>'required']) !!}
					{!! Form::textarea('description_eng', null, ["class" => "form-control form-control-sm simple"]) !!}
					<div class="pl-1 bg-danger">{{ $errors->first('description_eng') }}</div>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">

				<div class="form-group {{ $errors->has('description_fre') ? 'has-error' : '' }}">
					{!! Form::label('description_fre', 'Description (Fr)') !!}
					{!! Form::textarea('description_fre', null, ['class'=>'form-control form-control-sm simple']) !!}
					<div class="pl-1 bg-danger">{{ $errors->first('description_fre') }}</div>
				</div>

			</div>
		</div>
		
	</div>
</div>