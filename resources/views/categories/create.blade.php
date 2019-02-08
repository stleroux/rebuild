@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
   {{-- @include('categories.create.form') --}}
   @include('categories.blocks.help')
@endsection

@section('content')
   {!! Form::open(['route' => 'categories.store']) !!}
      <div class="card">
         <div class="card-header card_header">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Category
            <span class="float-right">
               <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
                  <i class="fas fa-angle-double-left"></i>
                  Cancel
               </a>
               {{ Form::button('<i class="fas fa-sync-alt"></i> Reset Form', ['type'=>'reset', 'class'=>'btn btn-sm btn-outline-secondary px-1 py-0']) }}
               {{ Form::button('<i class="fa fa-save"></i> Save ', ['type' => 'submit', 'class' => 'btn btn-sm btn-outline-success px-1 py-0'])  }}
            </span>
         </div>
         <div class="card-body card_body pb-0">
            <div class="row">
               <div class="col">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Category Name', ['class'=>'required']) }}
                     {{ Form::text('name', null, ['class' => 'form-control form-control-sm', 'autofocus']) }}
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                     {{ Form::label('value', 'Value') }}
                     {{ Form::text('value', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('value') }}</span>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group {{ $errors->has('module_id') ? 'has-error' : '' }}">
                     {{ Form::label('module_id', 'Module', ['class'=>'required']) }}
                     {{ Form::select('module_id', array(''=>'Select a module') + $modules, null, ['class'=>'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('module_id') }} </span>
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
   {!! Form::close() !!}

@endsection