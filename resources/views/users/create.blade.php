@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/switch.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('content')

   {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

      <div class="card">
         <!--CARD HEADER-->
         <div class="card-header card_header">
            <span class="h5 align-middle">
               <i class="fas fa-user"></i>
               New User
            </span>
            <span class="float-sm-right">
               @include('common.buttons.back', ['model'=>'user', 'type'=>''])
               @if(checkPerm('user_create'))
                  @include('common.buttons.reset', ['model'=>'user', 'type'=>''])
                  @include('common.buttons.save', ['model'=>'user', 'type'=>''])
               @endif
            </span>
         </div>

         <!--CARD BODY-->
         <div class="card-body card_body p-0">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
                     User Details
                  </a>
               </li>
               <li class="nav-item">
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
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                     Profile
                  </a>
               </li>
            </ul>

            <div class="tab-content pb-0 mb-0" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  @include('users.inc.create.details')
               </div>
               <div class="tab-pane fade" id="core" role="tabpanel" aria-labelledby="core-tab">
                  @include('users.inc.create.core')
               </div>
               <div class="tab-pane fade" id="nonCore" role="tabpanel" aria-labelledby="nonCore-tab">
                  @include('users.inc.create.nonCore')
               </div>
               <div class="tab-pane fade" id="modules" role="tabpanel" aria-labelledby="modules-tab">
                  @include('users.inc.create.modules')
               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  @include('users.inc.create.profile')
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
