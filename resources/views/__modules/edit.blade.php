@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('modules.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::model($module, ['route'=>['modules.update', $module->id], 'method'=>'PUT']) !!}
      {{ Form::token() }}

      <div class="row">
         <div class="col">
            <div class="card">
               <!--CARD HEADER-->
               <div class="card-header card_header">
                  <i class="fa fa-cubes"></i>
                  Edit Module
                  <span class="float-right">
                     {{-- <a href="{{ route('modules.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
                        <i class="fas fa-angle-double-left"></i>
                        Cancel
                     </a>
                     <button type="submit" class="btn btn-sm btn-outline-bprimary px-1 py-0">
                        <i class="fa fa-save"></i>
                        Update
                     </button> --}}
                     @include('common.buttons.cancel', ['model'=>'module', 'type'=>''])
                     @include('common.buttons.reset', ['model'=>'module', 'type'=>''])
                     @include('common.buttons.save', ['model'=>'module', 'type'=>''])
                  </span>
               </div>

               <div class="card-body card_body">
                  <div class="row">
                     <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                           {{ Form::label ('name', 'Name', ['class'=>'required']) }}
                           {{ Form::text ('name', null, ['class' => 'form-control form-control-sm', 'autofocus', "onfocus"=>"this.focus();this.select()"]) }}
                           <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="card-footer pt-1 pb-1 pl-2">
                  Fields marked with an <span class="required"></span> are required
               </div>
            </div>
         </div>
      </div>

   {{ Form::Close() }}

@stop

@section ('scripts')
@stop