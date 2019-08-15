{{-- WARNING --}}
@auth
   @if(
      (Auth::user()->first_name == '') OR
      (Auth::user()->last_name == '') OR
      (Auth::user()->email == ''))
         <div class="card mb-2">
            <div class="card-header text-white bg-danger p-2">
               <i class="fa fa-exclamation" aria-hidden="true"></i>
               Your user profile is incomplete!
            </div>
            <div class="card-body p-2">
               Please rectify this oversight by clicking <a href="{{ route('profile.edit', Auth::user()->id) }}">here</a>
            </div>
         </div>
   @endif
@endauth
