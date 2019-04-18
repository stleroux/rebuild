@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('settings.sidebar')
@endsection

@section('right_column')
   @include('settings.blocks.create')
@endsection

@section('content')

{{-- {{ $settings }} --}}
   {!! Form::model($settings, ['route'=>['settings.update'], 'method'=>'PUT']) !!}
   {{ Form::token() }}
   
      <div class="row">
         <div class="col">
            <div class="card mb-2">
               <div class="card-header p-1 m-0">
                  <div class="float-right">
                     <button type="submit" class="btn btn-sm btn-outline-bprimary">
                     <i class="fa fa-save"></i>
                     Update Site Settings
                     </button>
                  </div>
                  
                  <ul class="nav nav-tabs card-header-tabs">
                     <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                     </li>
                  </ul>

               </div>
               <div class="card-body py-2">
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        @include('settings.tabs.general')
                     </div>
                     <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        @include('settings.tabs.profile')
                     </div>
                     <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        @include('settings.tabs.contact')
                     </div>
                  </div>
               </div>

{{--                <div class="card-footer p-1">
                  <button type="submit" class="btn btn-sm btn-outline-bprimary px-1 py-0 float-right">
                     <i class="fa fa-save"></i>
                     Update Site Settings
                  </button>
               </div> --}}
               
            </div>
         </div>
      </div>

   {{ Form::close() }}

@endsection

@section('scripts')

@endsection