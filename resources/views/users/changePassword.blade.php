@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('users.blocks.mostPermissions')
   @include('users.blocks.mostLogins')
   @include('users.blocks.mostAssignedPermissions')
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
   {!! Form::open(array('route'=>['changePassword.update', $user->id], 'method'=>'PUT')) !!}
      {{ Form::token() }}
      {{-- <input type="text" name="id" value="{{ $user->id }}" /> --}}
      <div class="card mb-2">
         <!--CARD HEADER-->
         <div class="card-header section_header p-2">
            Change Password for {{ ucfirst($user->username) }}
            <span class="float-sm-right">
               @include('users.buttons.back', ['size'=>'xs'])

               @if(checkPerm('user_edit'))
                  <button type="submit" class="btn btn-xs btn-info" title="Change Password">
                     <i class="far fa-save"></i>
                     {{-- Change Password --}}
                  </button>
               @endif
            </span>
         </div>

         <!--CARD BODY-->
         <div class="card-body section_body">
            <div class="row">
               <div class="col-xs-12 col-sm-6 col-md-3">
                  <div class="form-group">
                     <strong>Password:</strong>
                     {!! Form::text('password', null, array('placeholder'=>'Password', 'class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xs-12 col-sm-6 col-md-3">
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
