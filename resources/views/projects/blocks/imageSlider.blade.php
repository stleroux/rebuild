<div class="card mb-2">
   <div class="card-header block_header">
      <i class="fab fa-pagelines"></i>
      Popular Projects
   </div>
   <div class="card-body p-0 m-0">
      <div id="projectsImageSlider" class="carousel slide mb-0" data-ride="carousel">
         


         <ol class="carousel-indicators">
            @foreach($project->images as $image)
               <li data-target="#projectsImageSlider" data-slide-to="{{ $image->id }}" class="{{ ($loop->first) ? 'active' : '' }}"></li>
            @endforeach
            {{-- <li data-target="#projectsImageSlider" data-slide-to="0" class="active"></li>
            <li data-target="#projectsImageSlider" data-slide-to="1"></li>
            <li data-target="#projectsImageSlider" data-slide-to="2"></li> --}}
         </ol>
      
         



         <div class="carousel-inner">
            @foreach($project->images as $image)
            <div class="carousel-item {{ ($loop->first) ? 'active' : '' }}">
               <img class="d-block w-100" src="/_projects/{{ $image->name }}" height="auto" alt="{{ $image->name }}">
            </div>
            @endforeach
{{--             <div class="carousel-item">
               <img class="d-block w-100" src="_woodProjects/main_images/bench1_1518614756.jpg" height="auto" alt="Second slide">
            </div>
            <div class="carousel-item">
               <img class="d-block w-100" src="_woodProjects/main_images/hall-table_1518615064.jpg" height="auto" alt="Third slide">
            </div> --}}
         </div>
         









         <a class="carousel-control-prev" href="#projectsImageSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>

         <a class="carousel-control-next" href="#projectsImageSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
   </div>
</div>
