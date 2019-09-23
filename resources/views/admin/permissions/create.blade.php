@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
   {{-- {{ Html::style('css/switch.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   {{-- @include('users.blocks.mostPermissions') --}}
   {{-- @include('users.blocks.mostLogins') --}}
   {{-- @include('users.blocks.mostAssignedPermissions') --}}
@endsection

@section('content')

   {{-- {!! Form::open(array('route' => 'permissions.store')) !!} --}}

      <div class="card mb-3">
         <!--CARD HEADER-->
         <div class="card-header section_header p-2">
            <i class="fas fa-user"></i>
            Permissions
         </div>
         
         <!--CARD BODY-->
         <div class="card-body section_body p-2">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="single-tab" data-toggle="tab" href="#single" role="tab" aria-controls="single" aria-selected="false">
                     Single
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="bread-tab" data-toggle="tab" href="#bread" role="tab" aria-controls="bread" aria-selected="false">
                     BREAD
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="instructions-tab" data-toggle="tab" href="#instructions" role="tab" aria-controls="instructions" aria-selected="true">
                     Instructions
                  </a>
               </li>
            </ul>

            <div class="tab-content pb-0 mb-0" id="myTabContent">
               <div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab">
                  @include('admin.permissions.inc.create.single')
               </div>
               <div class="tab-pane fade" id="bread" role="tabpanel" aria-labelledby="bread-tab">
                  @include('admin.permissions.inc.create.bread')
               </div>
               <div class="tab-pane fade" id="instructions" role="tabpanel" aria-labelledby="instructions-tab">
                  @include('admin.permissions.inc.create.instructions')
               </div>
            </div>
         </div>

         <!-- CARD FOOTER -->
         {{-- <div class="card-footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div> --}}
      </div>
      
@endsection
