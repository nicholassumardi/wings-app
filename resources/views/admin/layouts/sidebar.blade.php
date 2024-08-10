<!-- BEGIN: SideNav-->
<aside
    class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark gradient-45deg-deep-purple-blue sidenav-gradient sidenav-active-rounded">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{url('admin')}}"><img
                    class="hide-on-med-and-down " src="{{asset('website/wings.png') }}" alt="materialize logo" /><img
                    class="show-on-medium-and-down hide-on-med-and-up"
                    src="{{ url('assets/images/logo/materialize-logo-color.png') }}" alt="materialize logo" /><span
                    class="logo-text hide-on-med-and-down">Wings</span></a><a class="navbar-toggler" href="#"><i
                    class="material-icons">radio_button_checked</i></a></h1>
    </div>
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
        data-menu="menu-navigation" data-collapsible="menu-accordion">
        <li class="{{ Request::segment(2) == '' ? 'active' : '' }} bold">
            <a class="waves-effect waves-cyan " href="{{url('admin')}}"><i
                    class="material-icons">settings_input_svideo</i><span class="menu-title"
                    data-i18n="Dashboard">Dashboard</span></a>
        </li>
        <li class="{{ Request::segment(2) == 'task_management' ? 'active' : '' }} bold">
            <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                    class="material-icons">dvr</i><span class="menu-title" data-i18n="Templates">Task
                    Management</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="{{url('admin/task_management')}}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">List Task</span></a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="navigation-header"><a class="navigation-header-text">Settings</a><i
                class="navigation-header-icon material-icons">more_horiz</i>
        </li>
        <li
            class="{{ Request::segment(2) == 'user_setting' || Request::segment(2) == 'role_setting' ? 'active' : '' }} bold">
            <a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                    class="material-icons">face</i><span class="menu-title" data-i18n="User">User</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="{{url('admin/role_setting')}}"><i
                        class="material-icons">radio_button_unchecked</i><span data-i18n="View">Role</span></a>
                     </li>
                    <li><a href="{{url('admin/user_setting')}}"><i
                                class="material-icons">radio_button_unchecked</i><span data-i18n="List">List
                                User</span></a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
    <div class="navigation-background"></div><a
        class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
        href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
</aside>
<!-- END: SideNav-->