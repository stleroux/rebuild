@extends ('layouts.backend')

@section ('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section ('content')

      <div class="form-row">
         <div class="col-12">
            <!-- MAIN CARD -->
            <div class="card">
               <!-- MAIN CARD HEADER -->
               <div class="card-header">
                  <i class="fa fa-edit"></i>
                  Edit Project
                  <span class="float-right">
                     {!! Form::model($project, ['route'=>['projects.update', $project->id], 'method' => 'POST', 'files' => true]) !!}
                     @csrf
                     @method("PATCH")
                     @include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
                     @include('projects.addins.links.back', ['model'=>'project'])
                     @include('projects.addins.buttons.update', ['model'=>'project'])
                  </span>
               </div>
               <!-- MAIN CARD BODY -->
               <div class="card-body p-2">
                  
                     <div class="form-row">

                        <div class="col-md-7">
                           @include('projects.partials.general')
                        </div>
                        <div class="col-md-5">
                           @include('projects.partials.others')
                        </div>
                     </div>
                  {!! Form::Close() !!}
                  
                  <div class="form-row">
                     <div class="col-md-4">
                        @include('projects.partials.materials')
                     </div>
                     <div class="col-md-4">
                        @include('projects.partials.finishes')
                     </div>
                     <div class="col-md-4">
                        @include('projects.partials.images')
                     </div>
                  </div>

               </div>
               <!-- MAIN CARD FOOTER -->
               <div class="card-footer p-1">
                  Fields marked with an <span class="required"></span> are required
               </div>
            </div>
         </div>
      </div>
   




      {{-- @include('projects.form') --}}
   

@endsection