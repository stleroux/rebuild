@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('categories.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')
{{--    {!! Form::open(['route' => 'categories.store']) !!}
      <div class="card mb-3">
         <div class="card-header card_header">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Category
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'category', 'type'=>''])
               @include('categories.blocks.help', ['model'=>'category', 'type'=>''])
               @include('common.buttons.cancel', ['model'=>'category', 'type'=>''])
               @include('common.buttons.reset', ['model'=>'category', 'type'=>''])
               @include('common.buttons.save', ['model'=>'category', 'type'=>''])
            </span>
         </div>
         <div class="card-body card_body pb-0">
            <div class="row">
               <div class="col-3">
                  <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                     {!! Form::label('category','Main Category') !!}
                     <select name="category" id="category" class="form-control input-sm", autofocus="autofocus">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('category') }} </span>
                  </div>
               </div>

               <div class="col-3">
                  <div class="form-group {{ $errors->has('subcategory') ? 'has-error' : '' }}">
                     {!! Form::label('subcategory','Sub Category') !!}
                     <select name="subcategory" id="subcategory" class="form-control input-sm">
                        <option value=""></option>
                     </select>
                     <span class="text-danger">{{ $errors->first('subcategory') }} </span>
                  </div>
               </div>

               <div class="col-3">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Category Name', ['class'=>'required']) }}
                     {{ Form::text('name', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                     {{ Form::label('value', 'Value') }}
                     {{ Form::text('value', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('value') }}</span>
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {{ Form::label('description', 'Description') }}
                     {{ Form::textarea('description', null, ['class' => 'form-control form-control-sm', 'rows'=>3]) }}
                     <span class="text-danger">{{ $errors->first('description') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer px-1 py-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!} --}}

   @include('categories.create.category')
   @include('categories.create.sub')
   @include('categories.create.main')



@endsection

