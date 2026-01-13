@extends('admin.incls.layout')

@section('topbar')
    <!-- Topbar header - style you can find in pages.scss -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <!-- Logo -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <!-- Logo icon --><b>
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->                        
                        <!-- Light Logo icon -->
                        <img src="{{ asset('images/dashboard/logo-icon1.png') }}" alt="homepage" class="light-logo"/>
                    </b>
                    <!--End Logo icon -->
                    <span class="hidden-xs"><span class="font-bold">Example</span> com</span>
                </a>
            </div>
            <!-- End Logo -->
            
            <div class="navbar-collapse">
                <!-- toggle and nav items -->
                <ul class="navbar-nav mr-auto">
                    <!-- This is  -->
                    <li class="nav-item"><a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark"
                                            href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    <li class="nav-item"><a
                                class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                                href="javascript:void(0)"><i class="icon-menu"></i></a></li>
                    <!-- Search -->
                    <li class="nav-item">
                        <form class="app-search d-none d-md-block d-lg-block">
                            <input type="text" class="form-control" placeholder="Поиск ... ">
                        </form>
                    </li>
                </ul>

                <!-- User profile and search -->
                <ul class="navbar-nav my-lg-0">
                    <!-- User Profile -->
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('images/dashboard/users/1.jpg') }}" alt="user">
                            <span class="hidden-md-down">Байрам &nbsp;<i class="fa fa-angle-down"></i></span> 
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <!-- Profile-->
                            <a href="{{route('profile')}}" class="dropdown-item {{ strpos(Route::currentRouteName(), 'profile') !== false ? 'active' : null }}"><i class="ti-user"></i> Мой профиль</a>
                            <div class="dropdown-divider"></div>
                            <!-- Site settings-->
                            <a href="{{ route('site.settings') }}" class="dropdown-item {{ strpos(Route::currentRouteName(), 'site.settings') !== false ? 'active' : null }}"><i class="ti-settings"></i> Настройки сайта</a>
                            <div class="dropdown-divider"></div>
                            <!-- Logout -->
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Выйти</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hide">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    <!-- End User Profile -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- End Topbar header -->
@endsection
@section('sidebar')
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="user-pro"><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                            aria-expanded="false"><img src="{{ asset('images/dashboard/users/1.jpg') }}"
                                                                       alt="user-img" class="img-circle"><span
                                    class="hide-menu">Админ</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('profile')}}"><i class="ti-user"></i> Профиль</a></li>
                            <li><a href="{{route('site.settings')}}"><i class="ti-settings"></i> Настройки сайта</a>
                            </li>
                            </li>
                            <li>
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Выйти</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-small-cap">--- ЛИЧНОЕ</li>
                    <li><a class="waves-effect waves-dark" href="{{ route('dashboard')  }}"><i class="ti-home"></i><span
                                    class="hide-menu">Панель упр.</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="{{ route('advertisement')  }}"><i class="ti-shopping-cart-full"></i><span
                                    class="hide-menu">Реклама</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="{{ route('complaints')  }}"><i class="ti-comment-alt"></i><span
                                    class="hide-menu">Жалобы</span></a>
                    </li>
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                    class="ti-layout-grid2"></i><span class="hide-menu">Планирование</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="app-calendar.html">Календарь</a></li>
                            <li><a href="app-contact.html">Контакты</a></li>
                        </ul>
                    </li>

                    <li class="nav-small-cap">--- НЕДВИЖИМОСТЬ</li>
                    <li
                        @if(Session::has('active_tab_accepted'))
                            class="active"                        
                        @endif                        
                    ><a class="waves-effect waves-dark" href="{{route('accepted.property')}}"><i
                                    class="fa fa-check-circle"></i><span class="hide-menu">Опубликовано</span></a>
                    </li>
                    <li 
                        @if(Session::has('active_tab_pending')) 
                            class="active"                        
                        @endif                        
                    ><a class="waves-effect waves-dark" href="{{route('pending.property')}}"><i
                                    class="fa fa-clock-o"></i><span class="hide-menu">В ожидании</span></a>
                    </li>
                    <li
                        @if(Session::has('active_tab_expired')) 
                            class="active"                        
                        @endif                        
                    ><a class="waves-effect waves-dark" href="{{route('expired.property')}}"><i
                                    class="fa fa-ban"></i><span class="hide-menu">Истекший</span></a>
                    </li>
                    <li class="nav-small-cap">--- Документы по сайту</li>
                    <li><a class="waves-effect waves-dark" href="{{route('admin.rules')}}"><i
                                    class="fa fa-check-circle"></i><span class="hide-menu">Правила пользования сайтом</span></a>
                    </li>
                    <li
                            @if(Session::has('active_tab_pending'))
                            class="active"
                            @endif
                    ><a class="waves-effect waves-dark" href="{{route('admin.license')}}"><i
                                    class="fa fa-clock-o"></i><span class="hide-menu">Лицензионое Соглашение</span></a>
                    </li>

                    <li
                            @if(Session::has('active_tab_pending'))
                            class="active"
                            @endif
                    ><a class="waves-effect waves-dark" href="{{route('admin.confidentiality')}}"><i
                                    class="fa fa-clock-o"></i><span class="hide-menu">Политика Конфидециальности</span></a>
                    </li>

                    <li class="nav-small-cap">--- ПОЛЬЗОВАТЕЛИ</li>
                    <li><a class="waves-effect waves-dark" href="{{route('admin.users')}}"><i
                                    class="fa fa-users"></i><span class="hide-menu">Список пользоват.</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="{{route('admin.users.deleted')}}"><i
                                    class="fa fa-user-md"></i><span
                                    class="hide-menu">Заблокировн. пользователи</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="{{route('admin.user.create')}}"><i
                                    class="fa fa-user-plus"></i><span class="hide-menu">Доб. пользователь</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="{{route('api.keys')}}"><i
                                    class="fa fa-user-plus"></i><span class="hide-menu">Ключи API</span></a>
                    </li>
                    <li><a class="waves-effect waves-dark" href="{{route('visitlog')}}" target="_blank"><i
                                    class="fa fa-user-plus"></i><span class="hide-menu">лог пользователей</span></a>
                    </li>

                    <li><a class="waves-effect waves-dark" href="{{route('property.admin.upload')}}" target="_blank"><i
                                    class="fa fa-user-plus"></i><span class="hide-menu">Upload</span></a>
                    </li>
                    <li class="nav-small-cap">--- SUPPORT</li>
                    <li><a class="waves-effect waves-dark" href="pages-faq.html" aria-expanded="false"><i
                                    class="fa fa-circle-o text-info"></i><span class="hide-menu">FAQs</span></a></li>
                    <li>
                        <a class="waves-effect waves-dark" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" aria-expanded="false"><i
                                    class="fa fa-circle-o text-danger"></i><span class="hide-menu">Log Out</span></a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>

                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
@endsection