<div class="card mb-2">
	<div class="card-header block_header p-2">
		<i class="far fa-image"></i>
		Project Image(s)
	</div>
	@if($project->images->count() >= 1)
		<div class="card-body p-0 m-0">
			<div id="projectsImageSlider" class="carousel slide mb-0" data-ride="carousel">

				<ol class="carousel-indicators">
					@foreach($project->images as $image)
						<li data-target="#projectsImageSlider" data-slide-to="{{ $image->id }}" class="{{ ($loop->first) ? 'active' : '' }}"></li>
					@endforeach
				</ol>

				<div class="carousel-inner">
					@foreach($project->images as $image)
					<div class="carousel-item {{ ($loop->first) ? 'active' : '' }} text-center">
						
						<a href="" data-toggle="modal" data-target="#imageModal{{ $image->id }}">
							<img class="w-100" src="/_projects/{{ $project->id }}/thumbs/{{ $image->name }}" alt="{{ $image->name }}">
						</a>
						
						<a href="" data-toggle="modal" data-target="#imageModal{{ $image->id }}_XL" class="btn btn-sm btn-block btn-primary">View Larger</a>
						

						<div class="modal fade" id="imageModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="imageModalLabel">{{ $project->name }}</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span>&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>{{ Html::image('/_projects/'. $project->id . '/' . $image->name, "", array('height'=>'100%','width'=>'100%')) }}</p>
								 	</div>
								 	<div class="modal-footer">
										<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="imageModal{{ $image->id }}_XL" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
							<div class="modal-dialog modal-xl" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title" id="imageModalLabel">{{ $project->name }}</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span>&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>{{ Html::image('/_projects/'. $project->id . '/' . $image->name, "", array('height'=>'100%','width'=>'100%')) }}</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>

					</div>
					@endforeach
				</div>

				@if($project->images->count() > 1)
					<a class="carousel-control-prev" href="#projectsImageSlider" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>

					<a class="carousel-control-next" href="#projectsImageSlider" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				@endif
			</div>
		</div>
	@else
		<img src="/images/no_image.jpg" alt="No Image" height="100%" width="100%">
	@endif
</div>


