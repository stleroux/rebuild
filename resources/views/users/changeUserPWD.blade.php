@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   @if (count($errors) > 0)
      <div class="alert alert-danger">
         <strong>Whoops!</strong> There were some problems with your input.<br><br>
         <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
   @endif

   {{-- {!! Form::open(['method'=>'post', 'route'=>['users.changeUserPWDPost', $user->id]]) !!} --}}
   {!! Form::open(array('route'=>['users.changeUserPWDPost', $user->id], 'method'=>'POST')) !!}
      {{ Form::token() }}
      {{-- <input type="text" name="id" value="{{ $user->id }}" /> --}}
      <div class="card">
         <!--CARD HEADER-->
         <div class="card-header card_header">
            <span class="h5 align-middle pt-2">
               Change User Password
            </span>
            <span class="float-sm-right">
               @include('common.buttons.cancel', ['model'=>'user', 'type'=>''])

               @if(checkPerm('user_edit'))
                  <button type="submit" class="btn btn-sm btn-outline-primary" title="Change Password">
                     <i class="far fa-save"></i>
                     {{-- Change Password --}}
                  </button>
               @endif
            </span>
         </div>

         <!--CARD BODY-->
         <div class="card-body card_body">
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                     <strong>Password:</strong>
                     {!! Form::text('password', null, array('placeholder'=>'Password', 'class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                     <strong>Confirm Password:</strong>
                     {!! Form::text('password_confirmation', null, array('placeholder'=>'Confirm Password', 'class'=>'form-control form-control-sm')) !!}
                  </div>
               </div>
            </div>
            {{-- @include('users.form', ['disabled'=>'']) --}}
         </div>
      </div>



   {!! Form::close() !!}

@endsection
