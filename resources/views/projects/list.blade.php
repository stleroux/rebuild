@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <!--CARD HEADER-->
            <div class="card-header section_header p-2">
               <i class="fab fa-pagelines"></i>
               Projects
               <span class="float-right">
                  @include('projects.addins.links.help', ['size'=>'xs', 'bookmark'=>'projects'])
                  @include('projects.finishes.addins.links.finishes', ['size'=>'xs'])
                  @include('projects.materials.addins.links.materials', ['size'=>'xs'])
                  @include('projects.addins.links.add', ['size'=>'xs'])
               </span>
            </div>

            <!--CARD BODY-->
            @if($projects->count() > 0)
               <div class="card-body section_body pb-1">
                  <table id="datatable" class="table table-hover table-sm text-dark">
                     <thead>
                        <tr>
                           <th>ID</th>
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
                              <td>{{ $project->id }}</td>
                              <td>{{ $project->name }}</td>
                              <td>{{ $project->category }}</td>
                              <td>{{ $project->views }}</td>
                              <td>{{ $project->images()->count() }}</td>
                              <td>{{ $project->finishes()->count() }}</td>
                              <td>{{ $project->materials()->count() }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $project->created_at}}">{{ $project->created_at ? $project->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
                                 @include('projects.addins.links.show', ['size'=>'xs'])
                                 @if(checkPerm('projects_edit'))
                                    @include('projects.addins.links.edit', ['size'=>'xs'])
                                 @endif

                                 @if(checkPerm('projects_delete'))
                                    @include('projects.addins.links.delete', ['size'=>'xs'])
                                 @endif
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="card-body card_body py-2">
                  {{ setting('no_records_found') }}
               </div>
            @endif
            
         </div>
      </div>
   </div>

@endsection
