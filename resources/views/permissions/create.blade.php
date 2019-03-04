@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('permissions.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::open(array('route' => 'permissions.store', 'method'=>'POST')) !!}
      <div class="card">
         
         <div class="card-header card_header">
            <i class="fas fa-shield-alt"></i>
            New Permission
            <div class="float-right">
               @include('common.buttons.cancel', ['model'=>'permission', 'type'=>''])
               @include('common.buttons.reset', ['model'=>'permission', 'type'=>''])
               @include('common.buttons.save&new', ['model'=>'permission', 'type'=>''])
               @include('common.buttons.save', ['model'=>'permission', 'type'=>''])
            </div>
         </div>
         
         <div class="card-body card_body">
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Name', ['class'=>'required']) }}
                     {!! Form::text('name', null, array('class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                     <small class="form-text">Will be used in code</small>
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                     {{ Form::label('display_name', 'Display Name', ['class'=>'required']) }}
                     {!! Form::text('display_name', null, array('class'=>'form-control form-control-sm')) !!}
                     <small class="form-text">As displayed in user interface</small>
                     <span class="text-danger">{{ $errors->first('display_name') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                     {{ Form::label('model', 'Model', ['class'=>'required']) }}
                     {!! Form::text('model', null, array('class'=>'form-control form-control-sm')) !!}
                     <small class="form-text">Used for sorting and grouping permissions</small>
                     <span class="text-danger">{{ $errors->first('model') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                     {{ Form::label('type', 'Core Module?', ['class'=>'required']) }}
                     {{ Form::select('type', ['0'=>'Non-Core', '1'=>'Core', '2'=>'Module'], 0, ['class'=>'form-control form-control-sm']) }}
                     <small class="form-text"></small>
                     <span class="text-danger">{{ $errors->first('type') }}</span>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {{ Form::label('description', 'Allow member to', ['class'=>'required']) }}
                     {!! Form::text('description', null, array('class'=>'form-control form-control-sm')) !!}
                     <small class="form-text"></small>
                     <span class="text-danger">{{ $errors->first('description') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   {!! Form::close() !!}

@endsection