{{-- <div style="padding-top: 5px"></div>

@if(session('dart-success'))
   <div id="display-dart-success">
      <div class="card mb-2">
         <div class="card-header p-2">{{ session('dart-success') }}</div>
      </div>
   </div>
@endif


@if (session('dart-error'))
   <div id="display-dart-danger">
      <div class="card mb-2">
         <div class="card-header p-2">{{ session('dart-error') }}</div>
      </div>
   </div>
@endif


@if (count($errors) > 0)
   <div id="display-dart-error">
      <div class="card mb-2">
         <div class="card-header p-2">
            @foreach ($errors->all() as $error)
               <li> {{ $error }} </li>
            @endforeach
         </div>
      </div>
   </div>
@endif
 --}}


 <div class="card mb-2">

   <div class="card-header p-2">Messages</div>

   <div class="card-body p-2">

      @if ($message = Session::get('dart-success'))
         <div class="text-light" id="display-dart-success">{{ Session('dart-success') }}</div>
         <div class="p-0" id="display-dart-empty"><br /></div>

      @elseif ($message = Session::get('dart-error'))
         <div class="text-light" id="display-dart-error">{{ Session('dart-error') }}</div>
         <div class="p-0" id="success-empty"><br /></div>

      @elseif(count($errors) > 0)
         @foreach ($errors->all() as $error)
            <div class="text-danger" id="display-dart-error">{{ $error }}</div>
            <div class="p-0" id="success-empty"><br /></div>
         @endforeach

      @else
         <div class="p-0"><br /></div>
      @endif

   </div>

</div>
