<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   "
    data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    {{-- <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2" type="text" name="Search"
                            placeholder="Explore Materialize" data-search="template-list">
                        <ul class="search-list collection display-none"></ul>
                    </div> --}}
                    <ul class="navbar-list right">
                        <li class="hide-on-med-and-down"><a
                                class="waves-effect waves-block waves-light toggle-fullscreen"
                                href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
                        {{-- <li class="hide-on-large-only search-input-wrapper"><a
                                class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i
                                    class="material-icons">search</i></a></li> --}}
                        {{-- <li><a class="waves-effect waves-block waves-light notification-button"
                                href="javascript:void(0);" data-target="notifications-dropdown"><i
                                    class="material-icons">notifications_none<small
                                        class="notification-badge">5</small></i></a></li> --}}
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                                data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                        src="{{ url('assets/images/avatar/avatar-7.png') }}"
                                        alt="avatar"><i></i></span></a>
                        </li>
                    </ul>
                    <!-- notifications-dropdown-->
                    {{-- <ul class="dropdown-content" id="notifications-dropdown">
                        <li>
                            <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
                        </li>
                        <li class="divider"></li>
                        <li><a class="black-text" href="#!"><span
                                    class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new
                                order
                                has been placed!</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours
                                ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span
                                    class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days
                                ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span
                                    class="material-icons icon-bg-circle teal small">settings</span> Settings
                                updated</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days
                                ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span
                                    class="material-icons icon-bg-circle deep-orange small">today</span> Director
                                meeting
                                started</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days
                                ago</time>
                        </li>
                        <li><a class="black-text" href="#!"><span
                                    class="material-icons icon-bg-circle amber small">trending_up</span> Generate
                                monthly
                                report</a>
                            <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week
                                ago</time>
                        </li>
                    </ul> --}}
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="user-profile-page.html"><i
                                    class="material-icons">person_outline</i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a class="grey-text text-darken-1" href="{{url('logout')}}"><i
                                    class="material-icons">keyboard_tab</i> Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- END: Header-->