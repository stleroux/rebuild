<div id="accordion" class="sticky">

   <div class="card">
      <div class="card-header p-0" id="headingMainTOC">
         <div class="mb-0">
            <button onclick="window.location='#mainTOC';" class="btn btn-block" data-toggle="collapse" data-target="#collapseMainTOC" aria-expanded="false" aria-controls="collapseMainTOC">
               TOC
            </button>
         </div>
      </div>
   </div>
   <div id="collapseMainTOC" class="collapse collapse" aria-labelledby="headingMainTOC" data-parent="#accordion">
      <div class="card-body p-0">
         <div class="list-group">
         </div>
      </div>
   </div>

   @include('help.categories.toc')
   
   @include('help.recipes.toc')

</div>
