@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('projects.blocks.imageSlider')
   @include('projects.blocks.leave_comment')
   @include('projects.blocks.purchase')  
@endsection

@section('content')

   <div class="card mb-3">
      <div class="card-header section_header p-2">
         <div class="row d-flex justify-content-center">
            <div class="col-sm-4 float-left">
               <i class="fab fa-pagelines"></i>
               {{ ucwords($project->name) }} Project Information
            </div>
            <div class="col-sm-4 text-center">
               @include('admin.projects.buttons.previous', ['size'=>'xs', 'btn_label'=>'Prev'])
               @include('admin.projects.buttons.next', ['size'=>'xs', 'btn_label'=>'Next'])
            </div>
            <div class="col-sm-4 text text-right">
               <div class="btn-group">
                  {{-- @include('projects.buttons.previous', ['size'=>'xs'])
                  @include('projects.buttons.next', ['size'=>'xs']) --}}
                  @include('admin.projects.buttons.back', ['size'=>'xs'])
                  @include('admin.projects.buttons.edit', ['size'=>'xs'])
               </div>
            </div>
         </div>
	  </div>
   	<div class="card-body section_body p-2">
   		@include('admin.projects.partials.show.general')
         @auth
            @include('admin.projects.partials.show.others')
            @include('admin.projects.partials.show.materials')
            @include('admin.projects.partials.show.finishes')
         @endauth
         @guest
            @include('common.view_more')
         @endguest
   		{{-- @include('projects.partials.show.comments') --}}
         @include('common.comments', ['model'=>$project])
         {{-- {{ $projects->links() }} --}}
   	</div>
   </div>

@endsection


{{--
@if($image)
<img class="img-responsive w-100" src="/_projects/{{ $project->id }}/thumbs/{{ $image->name }}" alt="{{ $image->name }}">
<span class="text-light">Might be distorted</span>
@else
<img src="/images/no_image.jpg" alt="No Image" height="100%" width="100%">
@endif
--}}