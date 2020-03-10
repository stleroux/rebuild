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

@section('content')


   <form style="display:inline;">
      {!! csrf_field() !!}

      <div class="card mb-3">

         <div class="card-header section_header p-2">
            Article Audit History
            <div class="float-right">
               <div class="btn-group">
                  {{-- @include('admin.articles.buttons.help', ['size'=>'xs', 'bookmark'=>''])
                  @include('admin.articles.buttons.unpublishAll', ['size'=>'xs'])
                  @include('admin.articles.buttons.trashAll', ['size'=>'xs'])
                  @include('admin.articles.buttons.add', ['size'=>'xs']) --}}
                  @include('admin.articles.buttons.back', ['size'=>'xs'])
               </div>
            </div>
         </div>
         
         {{-- @if($articles->count()) --}}
            {{-- <div class="text-center">
               <div class="btn-group p-1">
                  <a href="{{ route('admin.articles.future') }}" class="{{ Request::is('admin/articles/future') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
                  @foreach($letters as $value)
                     <a href="{{ route('admin.articles.future', $value) }}" class="{{ Request::is('admin/articles/future/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
                  @endforeach
               </div>
            </div> --}}
         {{-- @endif --}}
         
         <div class="card-body section_body p-2">
         
            {{-- @if($audits->count())
               <table id="datatable" class="table table-hover table-sm searchHighlight">
                  <thead>
                     <tr>
                        <th>Audit ID</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Field Name</th>
                        <th>From</th>
                        <th>Old Value</th>
                        <th>To</th>
                        <th>New Value</th>
                        <th>On</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($article->audits as $a)
                        <tr>
                           <td>{{ $a->id }}</td>
                           <td>{{ $a->user->fullName }}</td>
                           <td>{{ $a->old_value }}1</td>
                           <td>
                              <a href="{{ route('admin.articles.audit', $a->id) }}">Audit Details</a>
                           </td>
                        </tr>                        
                     @endforeach
                  </tbody>
               </table>
            @else
               {{ setting('no_records_found') }}
            @endif --}}
            <ul>
@forelse ($audits as $audit)
   <li>
      @lang('article.updated.metadata', $audit->getMetadata())

      @foreach ($audit->getModified() as $attribute => $modified)
         <ul>
            <li>@lang('article.'.$audit->event.'.modified.'.$attribute, $modified)</li>
         </ul>
      @endforeach
   </li>
@empty
   <p>@lang('article.unavailable_audits')</p>
@endforelse
</ul>




         </div>
      </div>

   </form>

@endsection
