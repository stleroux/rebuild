@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
   @include('projects.blocks.imageSlider')
   @include('projects.blocks.leave_comment')
   @include('projects.blocks.purchase')  
@endsection

@section('content')

<div class="card">
	<div class="card-header section_header p-2">
		{{-- <span class="h5 align-middle pt-2"> --}}
         <i class="fab fa-pagelines"></i>
         {{ ucwords($project->name) }} Project Information
      {{-- </span> --}}
		<span class="float-right">
         @include('projects.addins.links.edit', ['size'=>'xs'])
         @include('projects.addins.links.back', ['size'=>'xs'])
      </span>
	</div>
	<div class="card-body section_body p-2">
		@include('projects.partials.show.general')
      @auth
         @include('projects.partials.show.others')
         @include('projects.partials.show.materials')
         @include('projects.partials.show.finishes')
      @endauth
      @guest
         @include('common.view_more')
      @endguest
		@include('projects.partials.show.comments')
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