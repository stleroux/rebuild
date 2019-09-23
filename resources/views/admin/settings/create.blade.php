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

   {!! Form::open(array('route' => 'admin.settings.store', 'method'=>'POST')) !!}
      <div class="card">
         
         <div class="card-header card_header">
            <i class="fas fa-cog"></i>
            New Site Setting
            <div class="float-right">
               <div class="btn-group">
                  <a class="btn btn-sm btn-secondary px-1 py-0" href="{{ route('admin.settings.index') }}">
                     <i class="fas fa-angle-double-left"></i>
                     Cancel
                  </a>
                  <button type="submit" class="btn btn-sm btn-info px-1 py-0" name="submit" value="new">
                     <i class="far fa-hdd"></i> Save & New
                  </button>
                  <button type="submit" class="btn btn-sm btn-success px-1 py-0" name="submit" value="save">
                     <i class="far fa-save"></i> Save & Close
                  </button>
               </div>
            </div>
         </div>
         
         <div class="card-body section_body">
            <div class="row">
               <div class="col-sm-4">
                  <div class="form-group">
                     {{ Form::label('key', 'Key', ['class'=>'required']) }}
                     {!! Form::text('key', null, array('class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                     <div class="bg-danger">{{ $errors->first('key') }}</div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="form-group">
                     {{ Form::label('value', 'Value Name', ['class'=>'required']) }}
                     {!! Form::text('value', null, array('class'=>'form-control form-control-sm')) !!}
                     <div class="bg-danger">{{ $errors->first('value') }}</div>
                  </div>
               </div>
               <div class="col-2">
                  <div class="form-group">
                     {{ Form::label('tab', 'Tab', ['class'=>'required']) }}
                     {!! Form::select('tab', ['general'=>'General', 'profile'=>'Profile', 'invoicer'=>'Invoicer'], null, ['class'=>'form-control form-control-sm']) !!}
                     <div class="bg-danger">{{ $errors->first('tab') }}</div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group">
                     {{ Form::label('description', 'Description', ['class'=>'required']) }}
                     {!! Form::text('description', null, array('class'=>'form-control form-control-sm')) !!}
                     <div class="bg-danger">{{ $errors->first('description') }}</div>
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