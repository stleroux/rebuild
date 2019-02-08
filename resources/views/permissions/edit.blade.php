@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($permission, ['route'=>['permissions.update', $permission->id], 'method'=>'PUT']) !!}
      {{ Form::token() }}
      
      <div class="card">
         
         <div class="card-header card_header">
            <i class="fas fa-shield-alt"></i>
            Edit Permission
            <div class="float-right">
               <a class="btn btn-sm btn-outline-secondary px-1 py-0" href="{{ route('permissions.index') }}">
                  <i class="fas fa-angle-double-left"></i>
                  Cancel
               </a>
                <button type="submit" class="btn btn-sm btn-outline-bprimary px-1 py-0">
                  <i class="fa fa-save"></i>
                  Update
               </button>
            </div>
         </div>
         
         <div class="card-body card_body">
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                     {{ Form::label('name', 'Name', ['class'=>'required']) }}
                     {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control form-control-sm', 'readonly')) !!}
                     <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                     {{ Form::label('display_name', 'Display Name', ['class'=>'required']) }}
                     {!! Form::text('display_name', null, array('placeholder' => 'Display Name','class' => 'form-control form-control-sm', 'autofocus')) !!}
                     <span class="text-danger">{{ $errors->first('display_name') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                     {{ Form::label('model', 'Model', ['class'=>'required']) }}
                     {!! Form::text('model', null, array('placeholder' => 'Model','class' => 'form-control form-control-sm')) !!}
                     <span class="text-danger">{{ $errors->first('model') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('core') ? 'has-error' : '' }}">
                     {{ Form::label('core', 'Core Module?', ['class'=>'required']) }}
                     {{ Form::select('core', [ '0' => 'No', '1' => 'Yes'], null, ['class' => 'form-control form-control-sm', 'placeholder' => '']) }}
                     <span class="text-danger">{{ $errors->first('core') }}</span>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {{ Form::label('description', 'Allow member to', ['class'=>'required']) }}
                     {!! Form::text('description', null, array('placeholder' => 'Description','class' => 'form-control form-control-sm')) !!}
                     <span class="text-danger">{{ $errors->first('description') }}</span>
                  </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  
               </div>
            </div>
         </div>

         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   {!! Form::close() !!}

@endsection