@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($setting, ['route'=>['admin.settings.update', $setting->id], 'method'=>'PUT']) !!}
      
      <div class="card">
         
         <div class="card-header section_header p-2">
            <i class="fas fa-shield-alt"></i>
            Edit Site Setting
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.settings.buttons.back', ['size'=>'xs'])
                  @include('admin.settings.buttons.reset', ['size'=>'xs'])
                  @include('admin.settings.buttons.update', ['size'=>'xs'])
               </div>
            </div>
         </div>
         
         <div class="card-body section_body p-2">
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group">
                     {{ Form::label('key', 'Key (Name)', ['class'=>'required']) }}
                     {!! Form::text('key', null, array('placeholder' => 'key','class' => 'form-control form-control-sm', 'readonly')) !!}
                     <div class="bg-danger">{{ $errors->first('key') }}</div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group">
                     {{ Form::label('value', 'Value', ['class'=>'required']) }}
                     {!! Form::text('value', null, array('placeholder' => 'Display Name','class' => 'form-control form-control-sm', 'autofocus')) !!}
                     <div class="bg-danger">{{ $errors->first('value') }}</div>
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     {{ Form::label('tab', 'Tab', ['class'=>'required']) }}
                     {!! Form::select('tab', ['general'=>'General', 'profile'=>'Profile', 'invoicer'=>'Invoicer'], $setting->tab, ['class'=>'form-control form-control-sm']) !!}
                     <div class="bg-danger">{{ $errors->first('tab') }}</div>
                  </div>
               </div>

               <div class="col-sm-12">
                  <div class="form-group">
                     {{ Form::label('description', 'Description', ['class'=>'required']) }}
                     {!! Form::text('description', null, array('placeholder' => 'Description','class' => 'form-control form-control-sm')) !!}
                     <div class="bg-danger">{{ $errors->first('description') }}</div>
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