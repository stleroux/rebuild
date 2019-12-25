@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   {{-- @include('recipes.menu') --}}
@endsection

@section('right_column')
   @include('recipes.blocks.archives')
   @include('recipes.blocks.sidebar')
   @include('recipes.blocks.popular')
@endsection

@section('content')

   <div class="card mb-3">
      <div class="card-header section_header p-2">
         <i class="fas fa-address-card" aria-hidden="true"></i>
         Recipe Archives for 
         @if ($month == 1) January 
         @elseif ($month == 2) February 
         @elseif ($month == 3) March 
         @elseif ($month == 4) April 
         @elseif ($month == 5) May 
         @elseif ($month == 6) June 
         @elseif ($month == 7) July 
         @elseif ($month == 8) August 
         @elseif ($month == 9) September 
         @elseif ($month == 10) October 
         @elseif ($month == 11) November 
         @elseif ($month == 12) December 
         @endif
         {{ $year }}
         <span class="float-right">
            {{-- @include('recipes.addins.links.back', ['size'=>'xs']) --}}
         </span>
      </div>
      <div class="card-body section_body p-2 text-light">
         <table id="datatable" class="table table-hover table-sm text-light">
            <thead>
               <tr>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Views</th>
                  <th>Author</th>
                  <th>Create Date</th>
                  <th>Publish Date</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ($archives as $archive)
                  <tr>
                     <td>{{ $archive->title }}</td>
                     <td>{{ ucwords($archive->category->name) }}</td>
                     <td>{{ $archive->views }}</td>
                     <td>@include('common.authorFormat', ['model'=>$archive, 'field'=>'user'])</td>
                     <td>@include('common.dateFormat', ['model'=>$archive, 'field'=>'created_at'])</td>
                     <td>@include('common.dateFormat', ['model'=>$archive, 'field'=>'published_at'])</td>
                     <td class="text-right">
                        <a href="{{ route('recipes.show', $archive->id) }}" class="btn btn-xs btn-primary text-light">
                           <i class="far fa-eye"></i>
                        </a>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>

@endsection
