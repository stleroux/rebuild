@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($permission, ['route'=>['permissions.update', $permission->id], 'method'=>'PUT']) !!}
      {{ Form::token() }}
      
      <div class="card">
         
         <div class="card-header section_header p-2">
            <i class="fas fa-shield-alt"></i>
            Edit Permission
            <div class="float-right">
               <div class="btn-group">
                  @include('permissions.buttons.back', ['size'=>'xs'])
                  @include('permissions.buttons.update', ['size'=>'xs'])
               </div>
            </div>
         </div>
         
         <div class="card-body section_body p-2">
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
                  <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                     <label for="type">Core Module?</label>
                        <select name="type" value="{{ old('type') ?? $permission->type }}" id="type" class="form-control form-control-sm">
                           @foreach($permission->typesOptions() as $typeOptionKey => $typeOptionValue)
                              <option value="{{ $typeOptionKey }}" {{ $permission->type == $typeOptionValue ? 'selected' : '' }}>{{ $typeOptionValue }}</option>
                           @endforeach
                        </select>
                     <span class="text-danger">{{ $errors->first('type') }}</span>
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

         <div class="card-footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   {!! Form::close() !!}

@endsection