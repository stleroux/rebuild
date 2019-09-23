@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
   {{ Html::style('css/switch.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   @include('admin.users.blocks.mostPermissions')
   @include('admin.users.blocks.mostLogins')
   @include('admin.users.blocks.mostAssignedPermissions')
@endsection

@section('content')

   {!! Form::open(['route' => 'admin.users.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">
         <!--CARD HEADER-->
         <div class="card-header section_header p-2">
            <i class="fas fa-user"></i>
            New User
            <span class="float-sm-right">
               <div class="btn-group">
                  {{-- @include('admin.users.buttons.addAllPermissions', ['size'=>'xs'])
                  @include('admin.users.buttons.removeAllPermissions', ['size'=>'xs']) --}}
                  @include('admin.users.buttons.back', ['size'=>'xs'])
                  @include('admin.users.buttons.reset', ['size'=>'xs'])
                  @include('admin.users.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <!--CARD BODY-->
         <div class="card-body section_body p-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                     Profile
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="permissions-tab" data-toggle="tab" href="#permissions" role="tab" aria-controls="permissions" aria-selected="true">
                     Permissions
                  </a>
               </li>
              {{--  <li class="nav-item">
                  <a class="nav-link" id="core-tab" data-toggle="tab" href="#core" role="tab" aria-controls="core" aria-selected="true">
                     Core Permissions
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="nonCore-tab" data-toggle="tab" href="#nonCore" role="tab" aria-controls="nonCore" aria-selected="false">
                     Non-Core Permissions
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="modules-tab" data-toggle="tab" href="#modules" role="tab" aria-controls="modules" aria-selected="false">
                     Modules Permissions
                  </a>
               </li> --}}
               <li class="nav-item">
                  <a class="nav-link" id="instructions-tab" data-toggle="tab" href="#instructions" role="tab" aria-controls="instructions" aria-selected="true">
                     Instructions
                  </a>
               </li>
            </ul>

            <div class="tab-content pb-0 mb-0" id="myTabContent">
               <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  @include('admin.users.inc.create.profile')
               </div>
               <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="permissions-tab">
                  @include('admin.users.inc.create.permissions')
               </div>
              {{--  <div class="tab-pane fade" id="core" role="tabpanel" aria-labelledby="core-tab">
                  @include('admin.users.inc.create.core')
               </div>
               <div class="tab-pane fade" id="nonCore" role="tabpanel" aria-labelledby="nonCore-tab">
                  @include('admin.users.inc.create.nonCore')
               </div>
               <div class="tab-pane fade" id="modules" role="tabpanel" aria-labelledby="modules-tab">
                  @include('admin.users.inc.create.modules')
               </div> --}}
               <div class="tab-pane fade" id="instructions" role="tabpanel" aria-labelledby="instructions-tab">
                  @include('admin.users.inc.instructions')
               </div>
            </div>
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>
      </div>
      
   {!! Form::close() !!}

@endsection
