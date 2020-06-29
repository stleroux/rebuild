@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.articles.blocks.sidebar')
   @include('admin.articles.blocks.archives')
@endsection

@section('content')

   <div class="card mb-3">

      <div class="card-header section_header p-2">
         <i class="fa fa-eye"></i>
         Article Audits
         <div class="float-right">
            <div class="btn-group">
               @include('admin.articles.buttons.back', ['size'=>'xs', 'model'=>'article'])
            </div>
         </div>
      </div>

      <div class="card-body section_body p-2">
         <table class="table table-sm table-striped table-hover">
            
            <thead class="">
               <tr>
                  {{-- <th scope="col">Model</th> --}}
                  <th scope="col">ID</th>
                  <th scope="col">Action</th>
                  <th scope="col">User</th>
                  <th scope="col">Time</th>
                  <th scope="col">Old Values</th>
                  <th scope="col">New Values</th>
               </tr>
            </thead>

            <tbody id="audits">
               @foreach($audits as $audit)
                  <tr>
                     {{-- <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td> --}}
                     <td>{{ $audit->id }}</td>
                     <td>{{ ucfirst($audit->event) }}</td>
                     <td>{{ $audit->user->username }}</td>
                     <td>{{ $audit->created_at }}</td>
                     <td>
                        <table class="table table-sm">
                           @foreach($audit->old_values as $attribute => $value)
                              <tr>
                                 <td><b>{{ $attribute }}</b></td>
                                 <td>{{ $value }}</td>
                              </tr>
                           @endforeach
                        </table>
                     </td>
                     <td>
                        <table class="table table-sm">
                           @foreach($audit->new_values as $attribute => $value)
                              <tr>
                                 <td><b>{{ $attribute }}</b></td>
                                 <td>{{ $value }}</td>
                              </tr>
                           @endforeach
                        </table>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>

   </div>

{{-- </div> --}}
@endsection