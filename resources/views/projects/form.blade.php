<ul class="nav nav-tabs pt-0 pl-0 bg-secondary" id="myTab" role="tablist">
{{--    <li class="nav-item">
      <a
         class="nav-link active"
         id="general-tab"
         data-toggle="tab"
         href="#general"
         role="tab"
         aria-controls="general"
         aria-selected="true">
         General Information
      </a>
   </li> --}}
   <li class="nav-item">
      <a
         class="nav-link active"
         id="materials-tab"
         data-toggle="tab"
         href="#materials"
         role="tab"
         aria-controls="materials"
         aria-selected="false">
         Materials Used
      </a>
   </li>
   <li class="nav-item">
      <a
         class="nav-link"
         id="finishes-tab"
         data-toggle="tab"
         href="#finishes"
         role="tab"
         aria-controls="finishes"
         aria-selected="false">
         Finishes Applied
      </a>
   </li>
{{--    <li class="nav-item">
      <a
         class="nav-link"
         id="others-tab"
         data-toggle="tab"
         href="#others"
         role="tab"
         aria-controls="others"
         aria-selected="false">
         Other Information
      </a>
   </li> --}}
</ul>

<div class="tab-content pb-0 mb-0" id="myTabContent">
{{--    <div
      class="tab-pane fade show active"
      id="general"
      role="tabpanel"
      aria-labelledby="general-tab">
      @include('projects.partials.general')
   </div> --}}
   <div
      class="tab-pane fade show active"
      id="materials"
      role="tabpanel"
      aria-labelledby="materials-tab">
      @include('projects.partials.materials')
   </div>
   <div
      class="tab-pane fade"
      id="finishes"
      role="tabpanel"
      aria-labelledby="finishes-tab">
      @include('projects.partials.finishes')
   </div>
{{--    <div
      class="tab-pane fade"
      id="others"
      role="tabpanel"
      aria-labelledby="others-tab">
      @include('projects.partials.others')
   </div> --}}
</div>
