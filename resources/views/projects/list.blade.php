@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
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
            <div class="card-header card_header">
               <i class="fab fa-pagelines"></i>
               Projects
               <span class="float-right">
                  @include('projects.addins.links.help', ['bookmark'=>'projects'])
                  @include('projects.finishes.addins.links.finishes')
                  @include('projects.materials.addins.links.materials')
                  @include('projects.addins.links.add', ['model'=>'project'])
               </span>
            </div>

            <!--CARD BODY-->
            @if($projects->count() > 0)
               <div class="card-body card_body pb-1">
                  {{-- @include('common.alphabet', ['model'=>'woodproject', 'page'=>'index']) --}}
                  <table id="datatable" class="table table-hover table-sm">
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
                              <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                              <td>{{ $project->category }}</td>
                              <td>{{ $project->views }}</td>
                              <td>{{ $project->images()->count() }}</td>
                              <td>{{ $project->finishes()->count() }}</td>
                              <td>{{ $project->materials()->count() }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $project->created_at}}">{{ $project->created_at ? $project->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
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
               <div class="card-body card_body pb-1">
                  {{ setting('no_records_found') }}
               </div>
            @endif
            
         </div>
      </div>
   </div>

@endsection
