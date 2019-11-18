@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

   {!! Form::open(array('route'=>'darts.games.store'), ['class'=>'form-inline']) !!}
      {{ Form::token() }}

      <div class="card">
         
         <div class="card-header section_header p-2">Create New Game - Step 1</div>
         
         <div class="card-body section_body p-2">
            <div class="card">
               <div class="card-header card_header p-2">
                  Select Game Type
               </div>
               <div class="card-body section_body p-2">
                  <div class="col-sm-3">
                     <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        {{-- {{ Form::label ('type', 'Game Type', ['class'=>'required']) }} --}}
                        {{ Form::select('type', ['301'=>'301', '501'=>'501', '701'=>'701', '1001'=>'1001', 'cricket'=>'Cricket'], null, ['placeholder'=>'Pick one...', 'class'=>'form-control form-control-sm']) }}
                        <div class="pl-1 bg-danger">{{ $errors->first('type') }}</div>
                     </div>
                  </div>
               </div>
               <div class="card-footer p-1">
                  Fields marked with an<span class="required"></span> are required.
                  <span class="float-right">
                     {{ Form::submit ('Next Step', array('class'=>'btn btn-xs btn-primary')) }}
                  </span>
               </div>
            </div>
         </div>

      </div>
   {!! Form::close() !!}
@endsection
