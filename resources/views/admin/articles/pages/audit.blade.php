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
         
            <div id="article" class="container" data-metadata='{!! $audit->getMetadata(true) !!}' data-modified='{!! $audit->getModified(true) !!}'>
    <div v-model="metadata">
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.id')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.audit_id }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.event')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.audit_event }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.user')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.user_name }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.ip_address')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.audit_ip_address }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.user_agent')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.audit_user_agent }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.tags')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.audit_tags.join() }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <strong>@lang('common.url')</strong>
            </div>
            <div class="col-md-9">@{{ metadata.audit_url }}</div>
        </div>
    </div>

    <hr/>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>@lang('common.attribute')</th>
                <th>@lang('common.old')</th>
                <th>@lang('common.new')</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(value, attribute) in modified">
                <td><strong>@{{ attribute }}</strong></td>
                <td class="danger">@{{ value.old }}</td>
                <td class="success">@{{ value.new }}</td>
            </tr>
        </tbody>
    </table>
</div>
            
         </div>
      </div>

   </form>

@endsection
