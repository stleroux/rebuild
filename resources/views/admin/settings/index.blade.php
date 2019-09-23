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

   {!! Form::model($settings, ['route'=>['admin.settings.updateAll'], 'method'=>'PUT']) !!}
   {{ Form::token() }}
   
      <div class="col p-0">
            
            <div class="card mb-3">
            
               <div class="card-header section_header p-0">
                  <div class="float-right pt-2">
                     <div class="btn-group pr-2">
                        @include('admin.settings.buttons.update', ['size'=>'xs'])
                        @include('admin.settings.buttons.add', ['size'=>'xs'])
                     </div>
                  </div>
                  
                  <ul class="nav nav-tabs">
                     <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="site-tab" data-toggle="tab" href="#site" role="tab" aria-controls="site" aria-selected="false">Site</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" id="invoicer-tab" data-toggle="tab" href="#invoicer" role="tab" aria-controls="invoicer" aria-selected="false">Invoicer</a>
                     </li>
                  </ul>
               </div>

               <div class="card-body section_body px-3 py-0">
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active section_body" id="general" role="tabpanel" aria-labelledby="general-tab">
                        @include('admin.settings.tab_general')
                     </div>
                     <div class="tab-pane fade section_body" id="site" role="tabpanel" aria-labelledby="site-tab">
                        @include('admin.settings.tab_site')
                     </div>
                     <div class="tab-pane fade section_body" id="invoicer" role="tabpanel" aria-labelledby="invoicer-tab">
                        @include('admin.settings.tab_invoicer')
                     </div>
                  </div>
               </div>
            
            </div>

      </div>

   {{ Form::close() }}

@endsection

@section('scripts')

@endsection