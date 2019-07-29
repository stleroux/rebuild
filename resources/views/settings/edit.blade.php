@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($setting, ['route'=>['settings.update', $setting->id], 'method'=>'PUT']) !!}
      {{ Form::token() }}
      
      <div class="card">
         
         <div class="card-header section_header">
            <i class="fas fa-shield-alt"></i>
            Edit Site Setting
            <div class="float-right">
               <a class="btn btn-sm btn-secondary px-1 py-0" href="{{ route('settings.index') }}">
                  <i class="fas fa-angle-double-left"></i>
                  Cancel
               </a>
                <button type="submit" class="btn btn-sm btn-info px-1 py-0">
                  <i class="fa fa-save"></i>
                  Update
               </button>
            </div>
         </div>
         
         <div class="card-body section_body">
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                     {{ Form::label('key', 'Key (Name)', ['class'=>'required']) }}
                     {!! Form::text('key', null, array('placeholder' => 'key','class' => 'form-control form-control-sm', 'readonly')) !!}
                     <span class="text-danger">{{ $errors->first('key') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                     {{ Form::label('value', 'Value', ['class'=>'required']) }}
                     {!! Form::text('value', null, array('placeholder' => 'Display Name','class' => 'form-control form-control-sm', 'autofocus')) !!}
                     <span class="text-danger">{{ $errors->first('value') }}</span>
                  </div>
               </div>
               <div class="col-1">
                  <div class="form-group {{ $errors->has('tab') ? 'has-error' : '' }}">
                     {{ Form::label('tab', 'Tab', ['class'=>'required']) }}
                     {!! Form::select('tab', ['general'=>'General', 'profile'=>'Profile', 'invoicer'=>'Invoicer'], $setting->tab, ['class'=>'form-control form-control-sm']) !!}
                     <span class="text-danger">{{ $errors->first('tab') }}</span>
                  </div>
               </div>

               <div class="col-sm-12">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {{ Form::label('description', 'Description', ['class'=>'required']) }}
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