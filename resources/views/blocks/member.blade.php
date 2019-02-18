<div class="card mb-2">
   <div class="card-header block_header">ACCOUNT ({{ Auth::user()->username }})</div>
   <div class="list-group pt-0 pb-0">
      
      <a href="{{ route('profile.show', Auth::User()->id) }}"
         class="list-group-item list-group-item-action px-1 py-1 {{ Route::is('profile.edit', 'profile.show') ? 'active' : '' }}">
         <i class="fas fa-user-circle pl-2"></i>
         My Profile
      </a>

      <a href="{{ route('profile.resetPwd', Auth::user()->id) }}"
         class="list-group-item list-group-item-action px-1 py-1 {{ Route::is('profile.resetPwd') ? 'active' : '' }}">
         <i class="fas fa-user-lock pl-2"></i>
         Reset My Password
      </a>

      <a href="{{ route('logout') }}"
         class="list-group-item list-group-item-action py-1 px-1"
         onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
         <i class="fas fa-sign-out-alt pl-2"></i>
         {{ __('Logout') }}
      </a>

   </div>

   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
   </form>
</div>


      {{-- <a class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('profile*') ? 'menu_active' : '' }}"
         data-remote="true" href="#profile" id="categoria_4" data-toggle="collapse" data-parent="#sub_profile">
         <i class="fas fa-user pl-2"></i>
         Profile
         <span class="menu-ico-collapse float-right pr-2">
            <i class="fa fa-chevron-down"></i>
         </span>
      </a>

      <div class="collapse list-group-submenu" id="profile"> --}}
         {{-- @if(checkPerm('post_index')) --}}
            {{-- <a href="{{ route('profile.account', Auth::user()->id) }}"
               class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('profile/account') ? 'menu_active' : '' }}"
               data-parent="#sub_profile">
               <i class="fas fa-user-circle"></i>
               Account
            </a>
            <a href="{{ route('profile.preferences', Auth::user()->id) }}"
               class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('profile/preferences') ? 'menu_active' : '' }}"
               data-parent="#sub_profile">
               <i class="fas fa-user-tag"></i>
               Preferences
            </a>
            <a href="{{ route('profile.profile', Auth::user()->id) }}"
               class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('profile/profile') ? 'menu_active' : '' }}"
               data-parent="#sub_profile">
               <i class="fas fa-user-cog"></i>
               Profile
            </a>
            <a href="{{ route('profile.resetPwd', Auth::user()->id) }}"
               class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('profile/resetPwd') ? 'menu-active' : '' }}">
               <i class="fas fa-user-lock"></i>
               Reset My Password
            </a> --}}
         {{-- @endif --}}