<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="/admin" class="simple-text logo-mini">
      {{ __('EC') }}
    </a>
    <a href="/admin" class="simple-text logo-normal">
      {{ __('e-Commerce') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'dashboard') active @endif">
        <a href="{{ route('dashboard') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @if(auth()->user()->is_super)
      <li>
        <a data-toggle="collapse" href="#admins">
            <i class="fas fa-user-secret"></i>
          <p>
            {{ __("Admins") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="admins">
          <ul class="nav">
            <li class="@if ($activePage == 'newadmin') active @endif">
              <a href="{{ route('admins.create') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("New Admin") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'admins') active @endif">
              <a href="{{ route('admins.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Admins Management") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      <li>
        <a data-toggle="collapse" href="#users">
            <i class="fas fa-users"></i>
          <p>
            {{ __("Users") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="users">
          <ul class="nav">
            <li class="@if ($activePage == 'newuser') active @endif">
              <a href="{{ route('users.create') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("New User") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'users') active @endif">
              <a href="{{ route('users.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Users Management") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="@if ($activePage == 'icons') active @endif">
        <a href="{{ route('page.index','icons') }}">
          <i class="now-ui-icons education_atom"></i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'maps') active @endif">
        <a href="{{ route('page.index','maps') }}">
          <i class="now-ui-icons location_map-big"></i>
          <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'notifications') active @endif">
        <a href="{{ route('page.index','notifications') }}">
          <i class="now-ui-icons ui-1_bell-53"></i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'table') active @endif">
        <a href="{{ route('page.index','table') }}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'typography') active @endif">
        <a href="{{ route('page.index','typography') }}">
          <i class="now-ui-icons text_caps-small"></i>
          <p>{{ __('Typography') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>