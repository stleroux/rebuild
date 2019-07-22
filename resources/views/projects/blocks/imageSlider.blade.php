<div class="card mb-2">
   <div class="card-header block_header">
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
               <div class="carousel-item {{ ($loop->first) ? 'active' : '' }}">
                  <img class="d-block w-100" src="/_projects/{{ $project->id }}/thumbs/{{ $image->name }}" height="auto" alt="{{ $image->name }}">
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
