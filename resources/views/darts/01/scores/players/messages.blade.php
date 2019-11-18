<div style="padding-top: 5px"></div>

@if(session('dart-success'))
   <div id="display-dart-success">
      <div class="card mb-2">
         <div class="card-header p-2">{{ session('success') }}</div>
      </div>
   </div>
@endif


@if (session('dart-error'))
   <div id="display-dart-danger">
      <div class="card mb-2">
         <div class="card-header p-2">{{ session('error') }}</div>
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
