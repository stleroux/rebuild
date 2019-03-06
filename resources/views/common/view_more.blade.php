@guest
   <div class="col-md-12">
      <div class="card mb-2">
         <div class="card-header">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            Want to see more?
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
         </div>
         <div class="card-body">
            {{ $message }}, please <a href="{{ route('login') }}">LOGIN</a> if you are already a member or <a href="{{ route('register') }}">REGISTER</a> an account if you are not.
         </div>
      </div>
   </div>
@endauth
