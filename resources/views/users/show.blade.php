@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
   {{ Html::style('css/switch.css') }}
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

   {!! Form::model($user) !!}

      <div class="card mb-3">
         <!--CARD HEADER-->
         <div class="card-header section_header p-2">
            <i class="fas fa-user"></i>
            View User :: {{ $user->first_name }} {{ $user->last_name }}
            <span class="float-sm-right">
               <div class="btn-group">
                  @include('users.buttons.back', ['size'=>'xs'])
               </div>
            </span>
         </div>
         
         <!--CARD BODY-->
         <div class="card-body section_body p-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item p-0">
                  <a class="nav-link py-1 px-2 active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                     Profile
                  </a>
               </li>
               <li class="nav-item p-0">
                  <a class="nav-link py-1 px-2" id="core-tab" data-toggle="tab" href="#core" role="tab" aria-controls="core" aria-selected="false">
                     Core Permissions
                  </a>
               </li>
               <li class="nav-item p-0">
                  <a class="nav-link py-1 px-2" id="nonCore-tab" data-toggle="tab" href="#nonCore" role="tab" aria-controls="nonCore" aria-selected="false">
                     Non-Core Permissions
                  </a>
               </li>
               <li class="nav-item p-0">
                  <a class="nav-link py-1 px-2" id="modules-tab" data-toggle="tab" href="#modules" role="tab" aria-controls="modules" aria-selected="false">
                     Modules Permissions
                  </a>
               </li>
               <li class="nav-item p-0">
                  <a class="nav-link py-1 px-2" id="instructions-tab" data-toggle="tab" href="#instructions" role="tab" aria-controls="instructions" aria-selected="false">
                     Instructions
                  </a>
               </li>
            </ul>

            <div class="tab-content pb-0 mb-0" id="myTabContent">
               <div class="tab-pane fade" id="instructions" role="tabpanel" aria-labelledby="instructions-tab">
                  @include('users.inc.show.instructions')
               </div>
               <div class="tab-pane fade" id="core" role="tabpanel" aria-labelledby="core-tab">
                  @include('users.inc.show.core')
               </div>
               <div class="tab-pane fade" id="nonCore" role="tabpanel" aria-labelledby="nonCore-tab">
                  @include('users.inc.show.nonCore')
               </div>
               <div class="tab-pane fade" id="modules" role="tabpanel" aria-labelledby="modules-tab">
                  @include('users.inc.show.modules')
               </div>
               <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  @include('users.inc.show.profile')
               </div>
            </div>
         </div>

         <!-- CARD FOOTER -->
         {{-- <div class="card-footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div> --}}
      </div>
      
{{ Form::close() }}

@endsection
