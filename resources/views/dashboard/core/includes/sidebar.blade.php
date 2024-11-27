<!-- Main Sidebar Container -->
<aside class="main-sidebar bg-white">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/ELRYAD.png') }}" alt="ELRYAD Logo" class="" style="width: 75%">
        {{--        <span class="brand-text font-weight-light">@lang('dashboard.RMS')</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="
                    {{auth()->user()->image == null ? asset("img/user2-160x160.jpg") : auth()->user()->image}}
                    " class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(),['/'])? 'menu-open': '' }}">
                    <a href="{{ url('/') }}"
                        class="nav-link {{ Route::currentRouteName() == 'home' ? 'activeNav' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>

                {{--                @if (auth()->user()->hasPermission('reports-read')) --}}

                <li
                    class="nav-item  {{ in_array(request()->route()->getName(),['reports.index', 'reports.edit', 'reports.create'])? 'menu-open': '' }} {{ Route::currentRouteName()=='reports.index'?'activeNav':'' }}">
                    <a href="{{ route('reports.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-paste"></i>
                        <p>
                            @lang('dashboard.Reports')
                        </p>
                    </a>
                </li>
                {{--                @endif --}}
                @if (auth()->user()->hasPermission('teams-read'))
                    <li
                        class="nav-item  {{ in_array(request()->route()->getName(),['teams.index', 'teams.edit', 'teams.create'])? 'menu-open': '' }} {{ Route::currentRouteName()=='teams.index'?'activeNav':'' }}">
                        <a href="{{ route('teams.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                @lang('dashboard.Teams')
                            </p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('members-read'))
                    <li
                        class="nav-item  {{ in_array(request()->route()->getName(),['members.index', 'members.edit', 'members.create'])? 'menu-open': '' }} {{ Route::currentRouteName()=='members.index'?'activeNav':'' }}">
                        <a href="{{ route('members.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                @lang('dashboard.Members')
                            </p>
                        </a>
                    </li>
                @endif


                {{--                @if (auth()->user()->hasPermission('statistics-read')) --}}

                {{--                    <li class="nav-item  {{ in_array(request()->route()->getName(), []) ? 'menu-open' : '' }}"> --}}
                {{--                        <a href="{{ route('members.index') }}" class="nav-link disabled"> --}}
                {{--                            <i class="nav-icon fas fa-chart-bar"></i> --}}
                {{--                            <p> --}}
                {{--                                @lang('dashboard.Statistics') --}}
                {{--                            </p> --}}
                {{--                        </a> --}}
                {{--                    </li> --}}
                {{--                @endif --}}

                {{--                @if (auth()->user()->hasPermission('settings-read')) --}}


                <li
                    class="nav-item  {{ in_array(request()->route()->getName(),['settings.edit'])? 'menu-open': '' }} {{ Route::currentRouteName()=='settings.edit'?'activeNav':'' }}">
                    <a href="{{ route('settings.edit', auth()->user()->id) }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('dashboard.Settings')
                        </p>
                    </a>
                </li>
                {{--                @endif --}}

                @if (auth()->user()->hasPermission('permissions-update'))
                    <li
                        class="nav-item  {{ in_array(request()->route()->getName(),['roles.index'])? 'menu-open': '' }}">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="fas fa-user-tag"></i>
                            <p>
                                @lang('dashboard.Roles_Permissions')
                            </p>
                        </a>
                    </li>
                @endif


                {{--                @endif --}}


                                @if(auth()->user()->hasRole('admin'))
                <li class="nav-item  {{ in_array(request()->route()->getName(), ['roles.index']) ? 'menu-open' : '' }} {{ Route::currentRouteName()=='roles.index'?'activeNav':'' }}">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('dashboard.Roles_Permissions')
                        </p>
                    </a>
                </li>
                                @endif
            </ul>


        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
