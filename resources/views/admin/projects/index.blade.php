@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   @include('projects.blocks.popularProjects')
@endsection

@section('content')
   
   <div class="row">
      <div class="col">
         <div class="card mb-3">
            <!--CARD HEADER-->
            <div class="card-header section_header p-2">
               <i class="fab fa-pagelines"></i>
               Projects
               <span class="float-right">
                  <div class="btn-group">
                     @include('admin.projects.buttons.help', ['size'=>'xs', 'bookmark'=>'projects'])
                     @include('admin.projects.buttons.BEProjects', ['size'=>'xs'])
                     @include('admin.projects.finishes.buttons.finishes', ['size'=>'xs'])
                     @include('admin.projects.materials.buttons.materials', ['size'=>'xs'])
                     @include('admin.projects.buttons.add', ['size'=>'xs'])
                  </div>
               </span>
            </div>

            <!--CARD BODY-->
            <div class="card-body section_body p-2">
               @if($projects->count() > 0)
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           {{-- <th>ID</th> --}}
                           <th>Name</th>
                           <th>Category</th>
                           <th>Views</th>
                           <th>Images</th>
                           <th>Finish(es)</th>
                           <th>Material(s)</th>
                           <th>Created On</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($projects as $project)
                           <tr>
                              {{-- <td>{{ $project->id }}</td> --}}
                              <td>{{ $project->name }}</td>
                              <td>{{ $project->category }}</td>
                              <td>{{ $project->views }}</td>
                              <td>{{ $project->images()->count() }}</td>
                              <td>{{ $project->finishes()->count() }}</td>
                              <td>{{ $project->materials()->count() }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $project->created_at}}">{{ $project->created_at }}</td>
                              <td class="text-right">
                                 <div class="btn-group">
                                    @include('admin.projects.buttons.show', ['size'=>'xs'])
                                    @include('admin.projects.buttons.edit', ['size'=>'xs'])
                                    @include('admin.projects.buttons.delete', ['size'=>'xs'])
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               @else
                  {{ setting('no_records_found') }}
               @endif
            </div>
            
         </div>
      </div>
   </div>

@endsection
