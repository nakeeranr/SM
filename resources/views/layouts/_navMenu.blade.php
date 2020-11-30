

@if (Auth::guest())

@else

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index-2.html">
              <div class="brand-logo"><img class="logo" src="{{ asset('images/logo/logo.png') }}"/></div>
              <h2 class="brand-text mb-0">Frest</h2></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
        data-icon-style="lines">

        <li class="@if (Route::currentRouteName() == 'home') active @endif nav-item">
            <a href="{{ route('home') }}"><i class="menu-livicon" data-icon="desktop"></i>
            <span class="menu-item" data-i18n="Analytics">Home</span>
            </a>
        </li>

        @role(['Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'permissions')) active @endif nav-item">
            <a href="{{ route('permissions.index') }}"><i class="menu-livicon" data-icon="lock"></i>
            <span class="menu-item" data-i18n="Permissions">Permissions</span>
            </a>
        </li>
        @endrole

        @role(['Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'roles')) active @endif nav-item">
            <a href="{{ route('roles.index') }}"><i class="menu-livicon" data-icon="two-pointers"></i>
            <span class="menu-item" data-i18n="Permissions">Roles</span>
            </a>
        </li>
        @endrole

        @role(['Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'users')) active @endif nav-item">
            <a href="{{ route('admin-users.index') }}"><i class="menu-livicon" data-icon="Users"></i>
            <span class="menu-item" data-i18n="Permissions">Admin Users</span>
            </a>
        </li>
        @endrole

        @role(['Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'organizations')) active @endif nav-item">
            <a href="{{ route('organizations.index') }}"><i class="menu-livicon" data-icon="notebook"></i>
            <span class="menu-item" data-i18n="Permissions">Organizations</span>
            </a>
        </li>
        @endrole

        @role(['Administrator','School Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'students')) active @endif nav-item">
            <a href="{{ route('students.index') }}"><i class="menu-livicon" data-icon="Users"></i>
            <span class="menu-item" data-i18n="Permissions">Students</span>
            </a>
        </li>
        @endrole

        @role(['Administrator','School Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'sections')) active @endif nav-item">
            <a href="{{ route('sections.index') }}"><i class="menu-livicon" data-icon="Users"></i>
            <span class="menu-item" data-i18n="Permissions">Sections</span>
            </a>
        </li>
        @endrole

        @role(['Administrator','School Administrator'])
        <li class="@if (str_contains(Route::currentRouteName(), 'org-admin')) active @endif nav-item">
            <a href="{{ route('org-admin.index') }}"><i class="menu-livicon" data-icon="Users"></i>
            <span class="menu-item" data-i18n="Permissions">Organization Admins</span>
            </a>
        </li>
        @endrole

        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->


    @endif
