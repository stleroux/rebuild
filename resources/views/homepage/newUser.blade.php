{{-- NEW USER --}}
@auth
   @if(auth::user()->login_count <= setting('login_count_warning'))
      <div class="card mb-2">
         <div class="section_header p-2">New User</div>
         <div class="card_body p-2">
            <p>Welcome to the site new user.</p>
            <p>We hope you will enjoy your stay with us.</p>
            <p>Feel free to browse around.</p>
         </div>
      </div>
   @endif
@endauth
