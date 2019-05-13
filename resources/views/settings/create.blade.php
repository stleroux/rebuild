@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('settings.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::open(array('route' => 'settings.store', 'method'=>'POST')) !!}
      <div class="card">
         
         <div class="card-header card_header">
            <i class="fas fa-cog"></i>
            New Site Setting
            <div class="float-right">
               <a class="btn btn-sm btn-outline-secondary px-1 py-0" href="{{ route('settings.index') }}">
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
                  <div class="form-group {{ $errors->has('key') ? 'has-error' : '' }}">
                     {{ Form::label('key', 'Key', ['class'=>'required']) }}
                     {!! Form::text('key', null, array('class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                     <span class="text-danger">{{ $errors->first('key') }}</span>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                     {{ Form::label('value', 'Value Name', ['class'=>'required']) }}
                     {!! Form::text('value', null, array('class'=>'form-control form-control-sm')) !!}
                     <span class="text-danger">{{ $errors->first('value') }}</span>
                  </div>
               </div>
               <div class="col-1">
                  <div class="form-group {{ $errors->has('tab') ? 'has-error' : '' }}">
                     {{ Form::label('tab', 'Tab', ['class'=>'required']) }}
                     {!! Form::select('tab', ['general'=>'General', 'profile'=>'Profile', 'invoicer'=>'Invoicer'], ['class'=>'form-control form-control-sm']) !!}
                     <span class="text-danger">{{ $errors->first('tab') }}</span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                     {{ Form::label('description', 'Description', ['class'=>'required']) }}
                     {!! Form::text('description', null, array('class'=>'form-control form-control-sm')) !!}
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