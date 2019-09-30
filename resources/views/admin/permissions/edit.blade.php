@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($permission, ['route'=>['admin.permissions.update', $permission->id], 'method'=>'PUT']) !!}
      
      <div class="card">
         
         <div class="card-header section_header p-2">
            <i class="fas fa-shield-alt"></i>
            Edit Permission
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.permissions.buttons.back', ['size'=>'xs'])
                  @include('admin.permissions.buttons.update', ['size'=>'xs'])
               </div>
            </div>
         </div>
         
         <div class="card-body section_body p-2">
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" name="name" value="{{ $permission->name }}" class="form-control form-control-sm" readonly placeholder="Name" />
                     <div class="pl-1 bg-danger">{{ $errors->first('name') }}</div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group">
                     <label for="display_name" class="required">Display Name</label>
                     <input type="text" name="display_name" value="{{ $permission->display_name}}" class="form-control form-control-sm" placeholder="Display Name" autofocus />
                     <div class="pl-1 bg-danger">{{ $errors->first('display_name') }}</div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                     <label for="model">Model</label>
                     <input type="text" name="model" value="{{ $permission->model }}" placeholder="Model" class="form-control form-control-sm" />
                     <div class="pl-1 bg-danger">{{ $errors->first('model') }}</div>
                  </div>
               </div>
               <div class="col-sm-12">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     <label for="description">Allow member to</label>
                     <input type="text" name="description" value="{{ $permission->description }}" placeholder="Description" class="form-control form-control-sm" />
                     <div class="pl-1 bg-danger">{{ $errors->first('description') }}</div>
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

   {{ Form::close() }}

@endsection