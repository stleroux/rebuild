@csrf

<div class="card-body card_body p-0">
   <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
         <a
            class="nav-link active"
            id="general-tab"
            data-toggle="tab"
            href="#general"
            role="tab"
            aria-controls="general"
            aria-selected="true">
            General
         </a>
      </li>
      <li class="nav-item">
         <a
            class="nav-link"
            id="woodInfo-tab"
            data-toggle="tab"
            href="#woodInfo"
            role="tab"
            aria-controls="woodInfo"
            aria-selected="true">
            Wood Info
         </a>
      </li>
      <li class="nav-item">
         <a
            class="nav-link"
            id="dimensions-tab"
            data-toggle="tab"
            href="#dimensions"
            role="tab"
            aria-controls="dimensions"
            aria-selected="false">
            Dimensions
         </a>
      </li>
      <li class="nav-item">
         <a
            class="nav-link"
            id="modules-tab"
            data-toggle="tab"
            href="#modules"
            role="tab"
            aria-controls="modules"
            aria-selected="false">
            Modules Permissions
         </a>
      </li>
      <li class="nav-item">
         <a
            class="nav-link"
            id="profile-tab"
            data-toggle="tab"
            href="#profile"
            role="tab"
            aria-controls="profile"
            aria-selected="false">
            Profile
         </a>
      </li>
   </ul>

   <div class="tab-content pb-0 mb-0" id="myTabContent">
      <div
         class="tab-pane fade show active"
         id="general"
         role="tabpanel"
         aria-labelledby="general-tab">
         @include('woodprojects.partials.general')
      </div>
      <div
         class="tab-pane fade"
         id="woodInfo"
         role="tabpanel"
         aria-labelledby="woodInfo-tab">
         @include('woodprojects.partials.woodInfo')
      </div>
      <div
         class="tab-pane fade"
         id="dimensions"
         role="tabpanel"
         aria-labelledby="dimensions-tab">
         @include('woodprojects.partials.dimensions')
      </div>
      <div
         class="tab-pane fade"
         id="modules"
         role="tabpanel"
         aria-labelledby="modules-tab">
         {{-- @include('users.inc.create.modules') --}}
      </div>
      <div
         class="tab-pane fade"
         id="profile"
         role="tabpanel"
         aria-labelledby="profile-tab">
         {{-- @include('users.inc.create.profile') --}}
      </div>
   </div>
</div>

{{-- @include('woodprojects.partials.general') --}}
{{-- @include('woodprojects.partials.woodInfo') --}}
{{-- @include('woodprojects.partials.dimensions') --}}