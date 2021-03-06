<div class="row">
   <div class="col-2">
      <div class="nav flex-column nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
@foreach ($groups as $g=>$a)
   @if($loop->first)
      @php
         $class = "nav-link py-1 px-2 active";
      @endphp
   @else
      @php
         $class = "nav-link py-1 px-2";
      @endphp
   @endif
   <a class="{{ $class }}"
      id="v-pills-{{ $a->model }}-tab"
      data-toggle="tab"
      href="#v-pills-{{ $g->model }}"
      role="tab"
      aria-controls="v-pills-{{ $g->model }}"
      aria-selected="false">
      {{ ucwords($g->model) }}
   </a>
@endforeach
         {{-- <a class="nav-link py-1 px-2 active"
            id="v-pills-home-tab"
            data-toggle="tab"
            href="#v-pills-home"
            role="tab"
            aria-controls="v-pills-home"
            aria-selected="true">
            Home
         </a>
         <a class="nav-link py-1 px-2"
            id="v-pills-profile-tab"
            data-toggle="tab"
            href="#v-pills-profile"
            role="tab"
            aria-controls="v-pills-profile"
            aria-selected="false">
            Profile
         </a>
         <a class="nav-link py-1 px-2"
            id="v-pills-messages-tab"
            data-toggle="tab"
            href="#v-pills-messages"
            role="tab"
            aria-controls="v-pills-messages"
            aria-selected="false">
            Messages
         </a>
         <a class="nav-link py-1 px-2"
            id="v-pills-settings-tab"
            data-toggle="tab"
            href="#v-pills-settings"
            role="tab"
            aria-controls="v-pills-settings"
            aria-selected="false">
            Settings
         </a> --}}
      </div>
   </div>
   <div class="col-9">
      <div class="tab-content" id="v-pills-tabContent">
         @foreach($models as $m)
            @if($loop->first)
               @php
                  $class = "tab-pane fade show active";
               @endphp
            @else
               @php
                  $class = "tab-pane fade";
               @endphp
            @endif
            <div
               class="{{ $class }}"
               id="v-pills-{{ $m->model }}"
               role="tabpanel"
               aria-labelledby="v-pills-{{ $m->model }}-tab">
               {{-- {{ ucwords($m->model) }} --}}
               @foreach($permissions as $p)
                  <li>{{ $p->name }}</li>
               @endforeach
            </div>
         @endforeach
         {{-- <div
            class="tab-pane fade"
            id="v-pills-profile"
            role="tabpanel"
            aria-labelledby="v-pills-profile-tab">
            Profile
         </div>
         <div
            class="tab-pane fade"
            id="v-pills-messages"
            role="tabpanel"
            aria-labelledby="v-pills-messages-tab">
            Messages
         </div>
         <div
            class="tab-pane fade"
            id="v-pills-settings"
            role="tabpanel"
            aria-labelledby="v-pills-settings-tab">
            Settings
         </div> --}}
      </div>
   </div>
</div>
