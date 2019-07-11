@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
  @include('projects.blocks.leave_comment')
  @include('projects.blocks.imageSlider')
@endsection

@section('content')
	
	<div class="card mb-3 bg-transparent">

		<div class="card-header card_header">
			
				<i class="fa fa-plus-square"></i>
				Show Project
				<span class="float-right">
					@include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
					@include('projects.addins.links.back', ['model'=>'project'])
				</span>
		</div>
		

		<div class="card-body p-1">
			<div class="row">
				<div class="col-8">
					Testing
				</div>
				<div class="col-4">
					<div class="w-100 jumbotron text text-center p-0 m-0">
						@if($image)
							<img src="/_projects/{{ $image->name }}" alt="{{ $project->name}}" height="100%" width="100%">
						@else
							<img src="/images/no_image.jpg" alt="No Image" height="100%" width="100%">
						@endif
					</div>
				</div>
			</div>
		</div>
</div>








@endsection
