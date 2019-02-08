@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
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
               <a class="btn btn-sm btn-outline-secondary px-1 py-0" href="{{ route('permissions.index') }}">
                  <i class="fas fa-angle-double-left"></i>
                  Cancel
               </a>
               <button type="submit" class="btn btn-sm btn-outline-bprimary px-1 py-0" name="submit" value="new">
                  <i class="far fa-hdd"></i> Save & New
               </button>
               <button type="submit" class="btn btn-sm btn-outline-success px-1 py-0" name="submit" value="save">
                  <i class="far fa-save"></i> Save & Close
               </button>
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
                  <div class="form-group {{ $errors->has('core') ? 'has-error' : '' }}">
                     {{ Form::label('core', 'Core Module?', ['class'=>'required']) }}
                     {{ Form::select('core', ['0'=>'Non-Core', '1'=>'Core', '2'=>'Module'], 0, ['class'=>'form-control form-control-sm']) }}
                     <small class="form-text"></small>
                     <span class="text-danger">{{ $errors->first('core') }}</span>
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