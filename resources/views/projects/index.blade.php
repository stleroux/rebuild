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
               {{-- <i class="fa fa-sitemap"></i> --}}
               Projects
               <span class="float-right">
                  <a href="{{ route('materials.index') }}">Materials</a>
                  @include('projects.addins.links.help', ['bookmark'=>'projects'])
                  @include('projects.addins.links.add', ['model'=>'project'])
               </span>
            </div>

            <!--CARD BODY-->
            @if($projects->count() > 0)
               <div class="card-body card_body pb-0">
                  {{-- @include('common.alphabet', ['model'=>'woodproject', 'page'=>'index']) --}}
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Category</th>
                           <th>Description</th>
                           <th>Created On</th>
                           <th>Updated On</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($projects as $project)
                           <tr>
                              <td>{{ $project->id }}</td>
                              <td><a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
                              <td>{{ $project->category }}</td>
                              <td>{{ $project->description }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $project->created_at}}">{{ $project->created_at ? $project->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td data-order="{{ $project->updated_at}}">{{ $project->updated_at ? $project->updated_at->format('M d, Y') : 'no data found' }}</td>
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
               <div class="card-body card_body">
                  {{ setting('no_records_found') }}
               </div>
            @endif
            
         </div>
      </div>
   </div>

@endsection
