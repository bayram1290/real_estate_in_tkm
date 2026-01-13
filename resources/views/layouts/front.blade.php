<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Продажа и аренда недвижимости в Туркменистане">
    <meta name="keywords" content="real estate, property, property search, agent, apartments, booking, business, idx, housing, real estate agency, rental">
    <meta name="author" content="Bayram - ATM">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ $settings->site_title }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset($settings->site_icon) }}">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link rel="stylesheet" href="/fonts/flaticon.css">
    <link rel="stylesheet" href="/css/color.css" id="color-change">
    <link rel="stylesheet" href="/css/jslider.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/loader.css">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <link rel="stylesheet" href="/css/confirm.min.css">
    <link rel="stylesheet" href="/css/dashboard/dropify.min.css">
    <link rel="stylesheet" href="/css/checkbox.min.css">
    <link rel="stylesheet" href="/css/jquery.dm-uploader.css">
    @yield('style')
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        /*
        *  STYLE 2
        */
        #style-2::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }
        #style-2::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }
        #style-2::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #1a1a1a;
        }
    </style>
</head>
<body class="pagewrap login_and_Signup" id="style-2">

<!-- Page Loader -->
<div class="loading-page" scroll="no">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>
<!-- End Loader -->
<header id="header">    
    <!-- Top Header Start -->
    @if(Auth::id() && !Auth::user()->verified)
        <div class="text-center" style="background-color: green; height: 100px">
            @if(Session::has('email_sent'))
                <p style="color: white;" >{{Session::get('email_sent')}}</p>
            @else
                <p style="color: white;">Пожалуйста подтвердите свой аккаунт, письмо было отправлено при регистрации. Если письмо не пришло посмотрите в СПАМЕ.</p>
                <p style="color: white;">Или можете <a href="{{route('verify.send.email')}}" style="color: white; text-decoration: underline">отправить письмо для подтверждения снова</a></p>
            @endif
        </div>
    @endif
    <div id="top_header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-5">
                    <div class="top_contact">
                        <ul>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> {{__('messages.need_support')}} ? +993 12 48-63-67</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-7">
                    <div class="top_right">
                        <ul>
                            <li>
                                <div class="lan-drop"> <a href="#" style="text-transform: uppercase" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{App::getLocale()}} <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @if(!App::isLocale('ru'))
                                            <li><a href="/cngloc/ru">Рус</a></li>
                                        @endif
                                        @if(!App::isLocale('en'))
                                            <li><a href="/cngloc/en">Eng</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            @if(!Auth::check())
                                <li><a href="/register" class="toogle_btn" >{{__('messages.register')}}</a></li>
                                <li class="hidden-sm hidden-xs"><a href="/login" class="toogle_btn" >{{__('messages.login')}}</a></li>
                            @else
                                <li id="top_name" class="hidden-sm hidden-xs">
                                    <a href="{{Auth::user()->admin ? route('dashboard') : route('profile.user')}}">
                                        {{Auth::user()->name}}
                                    </a>
                                </li>
                                <li id="top_name" class="t_show">
                                    <a href="javascript:void(0)">{{Auth::user()->name}}</a>
                                </li>
                                <li class="hidden-sm hidden-xs"><a href="{{Auth::user()->admin ? route('dashboard') : route('my_properties')}}">{{Auth::user()->admin ? "Админ панель" : __('messages.dashboard')}}</a></li>
                                <li class="hidden-sm hidden-xs">
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('messages.logout')}}</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Header End -->

    <!-- Nav Header Start -->
    <div id="nav_header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <nav class="navbar navbar-default nav_edit">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">                            
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <button class="btn navbar-toggle mob_add_prop" onclick="location.href='{{route('property.submit.page')}}'">
                                <i class="fa fa-plus-circle fa-2x pr_col"></i>
                            </button> 
                            <a class="navbar-brand" href="/"><img class="nav-logo" src="/img/top_logo.png" alt="Realestate Logo image"></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse my_nav" id="bs-example-navbar-collapse-1">
                            @auth
                                @if( !Auth::user()->admin )
                                    <div class="submit_property">
                                        <a href="{{route('property.submit.page')}}"><i class="fa fa-plus" aria-hidden="true"></i>{{__('messages.new_property')}}</a>
                                    </div>
                                @endif    
                            @else
                                <div class="submit_property">
                                    <a href="{{route('property.submit.page')}}"><i class="fa fa-plus" aria-hidden="true"></i>{{__('messages.new_property')}}</a>
                                </div>
                            @endauth    
                            <ul class="nav navbar-nav navbar-right nav_text" id="main_navbar">
                                @auth
                                    @if( Auth::user()->admin )
                                        <li class="dropdown t_show">
                                            <a href="{{route('dashboard')}}" class="dropdown-toggle">Админ панель</a>
                                        </li>
                                    @else
                                        <li class="dropdown t_show">
                                            <a href="{{ route('profile.user')}}" class="dropdown-toggle {{ Request::url() === route('profile.user') ? 't_active' : '' }}" >{{__('messages.my_profile')}}</a>
                                        </li>
                                        <li class="dropdown t_show">
                                            <a href="{{ route('my_properties')}}" class="dropdown-toggle {{ Request::url() === route('my_properties') ? 't_active' : '' }}" >{{__('messages.my_properties')}}</a>
                                        </li>
                                        <li class="dropdown t_show">
                                            <a href="{{ route('favorite.properties')}}" class="dropdown-toggle {{ Request::url() === route('favorite.properties') ? 't_active' : '' }}" >{{__('messages.favorited_properties')}}</a>
                                        </li>
                                        <li class="dropdown t_show">
                                            <a href="{{ route('property.submit.page')}}" class="dropdown-toggle {{ Request::url() === route('property.submit.page') ? 't_active' : '' }}">{{__('messages.submit_property')}}</a>
                                        </li>
                                        <li class="dropdown t_show">
                                            <a href="{{ route('user.change_pswd')}}" class="dropdown-toggle {{ Request::url() === route('user.change_pswd') ? 't_active' : '' }}">{{__('messages.change_password')}}</a>
                                        </li>    
                                    @endif    
                                @else                                    
                                    <li class="dropdown t_show">
                                        <a href="/login" class="toogle_btn" >{{__('messages.login')}}</a>
                                    </li>
                                @endauth
                                <li class="dropdown t_show">
                                    <hr style="margin: 0">
                                </li>
                                <li class="dropdown">
                                    <a href="/" class="dropdown-toggle {{ Request::url() === route('index') ? 't_active' : '' }}">{{__('messages.home')}}</a>
                                </li>
                                <li class="dropdown">
                                    <a href="/properties-list" class="dropdown-toggle {{ Request::url() === route('list') ? 't_active' : '' }}">{{__('messages.properties')}} </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{route('contact')}}" class="dropdown-toggle {{ Request::url() === route('contact') ? 't_active' : '' }}" >{{__('messages.contacts')}}</a>
                                </li>
                                @if(Auth::guest())
                                    <li class="dropdown">
                                        @if(empty(Cookie::get('favorite')))
                                            <a id="empty_link_guest" href="javascript:void(0)">
                                                <i class="fa fa-star prim_txt_color m-r-3"></i>
                                                <span id="count_fav">{{$fav_num}}</span>
                                            </a>
                                        @else
                                            <a href="{{route('favorite.guest')}}">
                                                <i class="fa fa-star prim_txt_color m-r-3"></i>
                                                <span id="count_fav">{{$fav_num}}</span>
                                            </a>
                                        @endif
                                    </li>
                                @else
                                    <li class="dropdown cBr">
                                        @if(empty(Auth::user()->favorite_properties))
                                            <a id="empty_link_user" href="javascript:void(0)">
                                                <i class="fa fa-star prim_txt_color m-r-3"></i>
                                                <span id="count_fav">{{$fav_num}}</span>
                                            </a>
                                        @else
                                            <a href="{{route('favorite.properties')}}">
                                                <i class="fa fa-star prim_txt_color m-r-3"></i>
                                                <span id="count_fav">{{$fav_num}}</span>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="dropdown t_show">
                                        <hr style="margin: 0">
                                    </li>
                                    <li class="dropdown t_show">
                                        <a href="{{ url('/logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-toggle" >{{__('messages.logout')}}</a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif                                
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Header End -->
</header>

@yield('content')


<!-- Footer Section Start -->
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer_widget">
                    <div class="footer-logo"><a href="{{ route('index') }}"><img class="logo-bottom" src="{{ asset($settings->site_bottom_logo) }}" alt=""></a></div>
                    <div class="footer_contact">
                        <p class="spec">@if(Lang::locale() == 'ru') {{$settings->about_ru}}
                                @elseif(Lang::locale() == 'en') {{$settings->about_en}}
                                @else {{$settings->about_tm}}
                                @endif</p>
                    </div>
                    <div class="socail_area">
                        <ul>
                            <li><a href="{{ $settings->faceboook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $settings->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $settings->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="{{ $settings->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_widget">
                    <div class="footer-title">
                        <h4>{{__('messages.get_in_touch')}}</h4>
                    </div>
                    <div class="footer_contact">
                        <ul class="spec">
                            <li> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <div class="ftr-list">
                                    <h6 class="touch-title">{{__('messages.office_address')}}</h6>
                                    <span>{{ $settings->contact_address }}</span>
                                </div>
                            </li>
                            <li> <i class="fa fa-phone" aria-hidden="true"></i>
                                <div class="ftr-list">
                                    <h6 class="touch-title">{{__('messages.call_US_24')}}</h6>
                                    <span>{{trim($settings->contact_phone)}}
                                        @if($settings->contact_phone1), 
                                            &nbsp;{{trim($settings->contact_phone1)}}
                                        @endif
                                        @if($settings->contact_phone2)
                                            ,&nbsp;{{trim($settings->contact_phone2)}}
                                        @endif</span>
                                </div>
                            </li>
                            <li> <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <div class="ftr-list">
                                    <h6 class="touch-title">{{__('messages.email_address')}}</h6>
                                    <span>{{ $settings->contact_email }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_widget">
                    <div class="footer-title">
                        <h4>{{ __('messages.q_links') }}</h4>
                    </div>
                    <div class="footer_contact">
                        <ul class="capitalize spec">
                            <li>
                                <a href="{{route('property.submit.page')}}">{{ __('messages.q_submit_property') }}</a>
                            </li>
                            <li>
                                <a href="{{route('rules')}}">{{ __('messages.rules_usage') }}</a>
                            </li>
                            <li>
                                <a href="{{route('license')}}">{{ __('messages.license') }}</a>
                            </li>
                            <li>
                                <a href="{{route('confidentiality')}}">{{ __('messages.policy_of_conf') }}</a>
                            </li>                 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer_area">
                    <div class="footer-title">
                        <h4>{{__('messages.newslatter')}}</h4>
                    </div>
                    <div class="footer_contact">
                        <p class="spec">{{__('messages.newslatter_txt')}}</p>
                        <div class="news_letter">
                            <form action="{{route('newsletter.subscribe')}}" method="post">
                                {{csrf_field()}}
                                <div class="{{$errors->has('subscribe_email') ? ' has-error' : ''}}">
                                    <input type="email" name="subscribe_email" placeholder="{{__('messages.email_address')}}" class="news_email">
                                    @if ($errors->has('subscribe_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subscribe_email') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <button type="submit" name="submit" class="btn btn-default">{{__('messages.subscribe')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer Section End -->

<!-- Bottom Footer Start -->
<div id="bottom_footer">
    <div class="reserve_text"> <span>{{__('messages.copyright')}}</span> </div>
</div>
<!-- Bottom Footer End -->

<!-- Scroll to top -->
<div class="scroll-to-top">
    <a href="#" class="scroll-btn @if( Request::is('single-property/living/*') || Request::is('single-property/commercial/*'))scroll-btn_spec @endif" data-target=".pagewrap"><i class="fa fa-angle-up" aria-hidden="true"></i>
    </a>
</div>
<!-- End Scroll To top -->
<!-- All Javascript Plugin File here -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-select.js"></script>
<script src="/js/YouTubePopUp.jquery.js"></script>
<script src="/js/jquery.fancybox.pack.js"></script>
<script src="/js/jquery.fancybox-media.js"></script>
<script src="/js/owl.js"></script>
<script src="/js/mixitup.js"></script>
<script src="/js/validate.js"></script>
<script src="/js/wow.js"></script>
<script src="/js/jshashtable-2.1_src.js"></script>
<script src="/js/jquery.numberformatter-1.2.3.js"></script>
<script src="/js/tmpl.js"></script>
<script src="/js/jquery.dependClass-0.1.js"></script>
<script src="/js/draggable-0.1.js"></script>
<script src="/js/jquery.slider.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/toastr.min.js"></script>
<script src="/js/confirm.min.js"></script>
<script>

    function selectChanged() {
        var type = $('#type').val();
        var filter = $('#filter').val();
        $.ajax({
            url:"/filter",
            type:"POST",
            data:{type:type,filter:filter,_token: "{{ csrf_token() }}"},
            success:function (msg) {
                $('#property-grid').html(msg.filtered_properties);
                var ul = document.createElement('ul');
                ul.className = 'pagination';
                for (var i = msg.links.from; i <= msg.links.last_page; i++){
                    var li = document.createElement('li');
                    var a = document.createElement('a');
                    a.href = 'http://example.com/filter?page=' + i;
                    var text = document.createTextNode(i);
                    a.appendChild(text);
                    li.appendChild(a);
                    ul.appendChild(li);
                }
                $('#pagination').html(ul);
            }
        })
    }
    window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted ||
            ( typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
            // Handle page restore.
            window.location.reload();
        }
    });

    @if(Session::has('success'))
        toastr.success('{{Session::get('success')}}');
    @endif
    @if(Session::has('fail'))
        toastr.info('{{Session::get('fail')}}');
    @endif
    @if(Session::has('add_property'))
        toastr.success("{{__('messages.added_property')}}");
    @endif    
    @if(Session::has('complaint_success'))
        toastr.success("{{__('messages.complaint_success')}}");
    @endif
    @if(Session::has('success_ship'))
        toastr.success("{{__('messages.success_ship')}}");
    @endif
    @if(Session::has('subscribe_success'))
        toastr.success("{{__('messages.subscribe_success')}}");
    @endif
    @if(Session::has('expired_reactivated'))
        toastr.success("{{__('messages.expired_reactivated')}}");
    @endif

    function postFav(id){
        $.ajax({
            url: "/make-favorite/null",
            type:"POST",
            data:{id:id,_token: "{{ csrf_token() }}"},
            success:function (msg) {
                $('#count_fav').text(msg.count);
            }
        });
    }

    function postDec(id){
        $.ajax({
            url:"/decrease-favorite",
            type:"POST",
            data:{id:id,_token: "{{ csrf_token() }}"},
            success:function (msg) {
                $('#count_fav').text(msg.count);
            }
        });
    }

    function favLinks(){
        if( document.getElementById('empty_link_guest') ){
            document.getElementById('empty_link_guest').href = '{{route('favorite.guest')}}';
        }
        if( document.getElementById('empty_link_user') ){
            document.getElementById('empty_link_user').href = '{{route('favorite.properties')}}';
        }
    }
    
    function getLike(){
        const i = event.target;
        const parEl = i.parentElement.parentElement;        
        const id = parEl.id;
        favLinks();
        parEl.setAttribute( "onClick", "decreaseLike()" );
        document.getElementById('property_' + id).className = "fa fa-star star_i";
        postFav(id);
    }

    function decreaseLike() {
        const i = event.target;
        const parEl = i.parentElement.parentElement;
        const id = parEl.id;
        favLinks();
        parEl.setAttribute( "onClick", "getLike()" );
        document.getElementById('property_' + id).className = "fa fa-star-o star_i";
        postDec(id);
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded',() => {
        const object = document.getElementById('object_select');
        const type = document.getElementById('type_select');
        const any_type = document.getElementById('3');
        if (any_type){
            $("#object_select option").each(function() {
                if (this.id != 3){
                    this.className = 'hide';
                }
                object.selectedIndex = '0';
                type.selectedIndex = '0';
            });
        }
        else{
            $("#object_select option").each(function() {
                if (this.id != 1){
                    this.className = 'hide';
                }
            });
        }
    });
</script>
<script>
    @if(Request::is('edit/*'))
        $('select[name="city"] option').addClass('hide');
        $('button#times').click(function(){
            if( ! $('input[name="changeInImage"]').length ){
                $('div[id^="drag_"]').next().find('.row .col-md-12').append('<input type="hidden" name="changeInImage" value="1" />');
            }
        });        
    @else
        $('select[name="city"] option:not(:first-child)').addClass('hide');
    @endif

    $('select[name="velayat"]').on('change', function(){
        var c_id = $(this).attr('id').substring(14);
        var unit = $(this).val();
        var sel = $(this).parent().parent().parent().next().find('div div select[name="city"]');
        var cnt = sel.find('option').length;

        sel.find('option:not(:first-child)').addClass('hide');

        $('div button[data-id="city_select_'+c_id+'"]').parent().find('div ul li').each( function(index) { 
            $(this).attr('aria-selected', false).find('a').addClass('hide'); 
            
                if( index == 0 ) { 
                    $(this).addClass('selected').attr('aria-selected', true);
                } 
        });

        $('button[data-id="city_select_'+c_id+'"] span.filter-option').text("{{__('messages.no_select')}}");
        $('select#city_select_'+ c_id).val(null);
        
        for( var i=1; i<cnt; i++ ) {
            if( sel.find('option:eq('+i+')').attr('id')==unit ) {

                sel.find('option:eq('+i+')').removeAttr('class');
                $('div button[data-id="city_select_'+c_id+'"]').parent().find('div ul li[data-original-index="'+ i +'"] a').removeClass('hide');

            }
        }
    });
</script>
<!-- Image drag and drop uploader -->
<script src="/js/jquery.dm-uploader.js"></script>
<script src="/js/draganddrop.js"></script>
<script>
    sizeError = () => {
        $.alert({
            title:'Картинка не может быть загружена',
            content:'Размер картинки больше 3МБ',
            theme:'supervan'
        });
        event.preventDefault();
    };
    $(function(){
        for (var i = 1; i < 23; i++){
            $(`#drag_${i}`).dmUploader({ //
                url: '{!! route('load.image') !!}',
                maxFileSize: 2000000,
                extFilter: ["jpg", "jpeg", "png", "gif"],
                headers: {
                    'X-CSRF-TOKEN': "{!! csrf_token() !!}"
                },
                onDragEnter: function(){
                    // Happens when dragging something over the DnD area
                    this.addClass('active_box');
                },
                onDragLeave: function(){
                    // Happens when dragging something OUT of the DnD area
                    this.removeClass('active_box');
                },
                onInit: function(){
                    // Plugin is ready to use
                    // ui_add_log('Penguin initialized :)', 'info');
                },
                onComplete: function(){
                    // All files in the queue are processed (success or error)
                    // ui_add_log('All pending tranfers finished');
                },
                onNewFile: function(id, file){
                    // When a new file is added using the file selector or the DnD area
                    // ui_add_log('New file added #' + id);
                    // ui_multi_add_file(id, file);
                    file_upload(id,file,this[0].id);
                },
                onBeforeUpload: function(id){
                    // about tho start uploading a file
                    // ui_add_log('Starting the upload of #' + id);
                    // ui_multi_update_file_progress(id, 0, '', true);
                    // ui_multi_update_file_status(id, 'uploading', 'Uploading...');
                },
                onUploadProgress: function(id, percent){
                    // Updating file progress
                    // ui_multi_update_file_progress(id, percent);
                    uploadProgress(id,percent);
                    //console.log(percent);
                },
                onUploadSuccess: function(id, data){
                    // A file was successfully uploaded
                    // ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
                    // ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
                    // ui_multi_update_file_status(id, 'success', 'Upload Complete');
                    // ui_multi_update_file_progress(id, 100, 'success', false);
                    let i = 0;                    
                    createImageArray(id,data,this[0].id);
                    i++;
                    @if(Request::is('edit/*'))
                        if( ! $('input[name="changeInImage"]').length ){
                            $('div[id^="drag_"]').next().find('.row .col-md-12').append('<input type="hidden" name="changeInImage" value="1" />');
                        }
                    @endif       
                },
                onUploadError: function(id, xhr, status, message){
                    // Happens when an upload error happens
                    // ui_multi_update_file_status(id, 'danger', message);
                    // ui_multi_update_file_progress(id, 0, 'danger', false);
                },
                onFallbackMode: function(){
                    // When the browser doesn't support this plugin :(
                    // ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
                },
                onFileSizeError: function(file){
                    // ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
                    sizeError();
                }
            });
        }
    });
</script>
<script>
    function showBtn(x) {
        x.children[1].children[1].style.display = 'block';
        x.children[1].children[2].style.display = 'block';
    }
    function hideBtn(x) {
        x.children[1].children[1].style.display = 'none';
        x.children[1].children[2].style.display = 'none';
    }
    makeMain = (x,id) =>{
        const mainImg = document.getElementById(`mainImg_${id}`);
        mainImg.value = x.previousSibling.previousSibling.src;
        $.alert({
            title:'Изменение',
            content:'Главная картинка изменена',
            theme:'supervan'
        });
        event.preventDefault();
    };
    deleteImg = (x,id) =>{
        $.ajax({
            type : 'POST',
            url : '/submit-property/delete/image',
            data: {
                _token:$('meta[name="csrf-token"]').attr('content'),
                url:x.previousSibling.previousSibling.previousSibling.previousSibling.src
            },
            success:function (data) {
               const img = document.getElementById(data);
               img.remove();
            }
        });        

        x.parentNode.parentNode.parentNode.remove();
        event.preventDefault();
    };
    function empty(event, id) {
        $r_val=check_Req(event, id);
        
        if(!$r_val){
            $.alert({ 
                title:'example.com',
                icon: 'fa fa-warning',
                content: "{{ __('messages.req_fields')}}",
                scroll:false,
                animation: 'RotateY',
                closeAnimation: 'scaleY',
                animationBounce: 1.5,
                type: 'red',
                draggable:false,
                onOpen:function() { 
                    $('body').addClass('stop-scrolling');
                },
                onDestroy:function() { 
                    $('html, body').animate({ 
                        scrollTop: $(".back_container form").offset().top 
                    }, 1000);
                    $('body').removeClass('stop-scrolling');
                }
            });            
         }        
        return $r_val; 
    }
    function disableScroll() {
        if (window.addEventListener) // older FF
            window.addEventListener('DOMMouseScroll', preventDefault, false);
        window.onwheel = preventDefault; // modern standard
        window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
        window.ontouchmove  = preventDefault; // mobile
        document.onkeydown  = preventDefaultForScrollKeys;
    }
    function enableScroll() {
        if (window.removeEventListener)
            window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.onmousewheel = document.onmousewheel = null;
        window.onwheel = null;
        window.ontouchmove = null;
        document.onkeydown = null;
    }

    function checkZero(tValue){
            var z_flag = true;
            switch(tValue){
                case '':
                case '.':
                case '.0':
                case '0.':
                case '0':
                case '0.0':
                case '.00':
                case '0.00':
                    z_flag = false;
                break;                
            }
            return z_flag;
        }

    function check_Req(e, f_id) {
        var $result, $sel1, $par = $(e.target).parents('form');
        var $sel1, $sel2, $inp1, $inp2;
        
        $result = true;
        $sel1 = $par.find('select[name="velayat"]');
        $sel2 = $par.find('select[name="city"]');
        $inp1 = $par.find('input[name="address"]');
        $inp2 = $par.find('input[name="price"]');

        $par.find('input[type=number]').each(function(){

            var attr_required = $(this).attr('required');
            
            if( (typeof attr_required == typeof undefined || attr_required == false) && !checkZero($(this).val())) {
                $(this).val("");
            }

        });        
        
        if(!$sel1.val()){             
            $result=false; 
            help_feed1($sel1.parent());
        }

        if(!$sel2.val()){ 
            $result=false;
            help_feed1($sel2.parent());            
        }
        if(!$inp1.val() || !checkZero($inp1.val())) {
            $result=false;
            help_feed2($inp1);
        }
        if(!$inp2.val() || !checkZero($inp2.val())) { 
            $result=false; 
            help_feed5($inp2);
        }
        switch(f_id){
            case 1:
            case 8:
            case 9:
            case 15:
            case 16:
            case 17:
                var $tmp1=$par.find('select[name="tot_rooms"]');

                if(!$tmp1.val()) { 
                    $result=false;
                    help_feed1($tmp1.parent());
                }
        }
        switch(f_id){
            case 1:
            case 2:
            case 3:
            case 4:            
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
            case 13:
            case 14:
            case 15:
            case 16:
            case 17:
                var $tmp2=$par.find('input[name="tot_area"]');
                
                if(!$tmp2.val() || !checkZero($tmp2.val())) { 
                    $result=false;
                    help_feed2($tmp2);
                    
                }
        }
        switch(f_id){
            case 1:
            case 4:
            case 6:
            case 7:
            case 8:
            case 11:
            case 13:
            case 14:
            case 15:
            case 16:
                var $tmp3=$par.find('input[name="floor"]');
                
                if(!$tmp3.val() || !checkZero($tmp3.val())) { 
                    $result=false;
                    help_feed2($tmp3);                    
                }
        }
        switch(f_id){
            case 1:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
            case 16:
                var $tmp4=$par.find('input[name="tot_floor"]');
                
                if(!$tmp4.val() || !checkZero($tmp4.val())) { 
                    $result=false;
                    help_feed2($tmp4);
                }
        }
        switch(f_id){
            case 2:
            case 3:
            case 9:
            case 10:
            case 17:
                var $tmp5=$par.find('input[name="lArea"]');
                
                if(!$tmp5.val() || !checkZero($tmp5.val())) { 
                    $result=false;
                    help_feed2($tmp5);
                }
        }
        switch(f_id){
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
                var $tmp6=$par.find('select[name="prepayment"]');
                
                if(!$tmp6.val()) {
                    $result=false;
                    help_feed1($tmp6.parent());
                }
        }
        switch(f_id){
            case 3:
            case 10:            
                var $tmp6=$par.find('input[name="rent_part"]');
                
                if(!$tmp6.val() || !checkZero($tmp6.val())) { 
                    $result=false;
                    help_feed2($tmp6);
                }
        }
        switch(f_id){
            case 4:
            case 5:
            case 6:
                var $tmp7=true;
                $par.find('input[name="rent_type"]').each(function(){ 
                    if($(this).prop('checked')){ 
                        $tmp7=false;
                    }
                });
                
                if($tmp7){ 
                    $result=false;
                    $par.find('label:nth-child(1) input[name="rent_type"]').parent().addClass('radio_err_feed'); 
                    $par.find('label:nth-child(2) input[name="rent_type"]').parent().addClass('radio_err_feed1').find('div').removeClass('hide').removeClass('sel_err_invis'); 
                }
        }
        switch(f_id){            
            case 12:
                var $tmp8=$par.find('input[name="a_build"]'); 
                
                if(!$tmp8.val() || !checkZero($tmp8.val())) {
                    $result=false;
                    help_feed2($tmp8);
                }
        }        
        switch(f_id){
            case 6:
            case 13:
                var $tmp9=$par.find('select[name="t_premises"]');
                
                if(!$tmp9.val()) {
                    $result=false;
                    help_feed1($tmp9.parent());
                }
        }
        switch(f_id){
            case 7:
            case 14:
                var $tmp10=$par.find('select[name="property_type"]');
                
                if(!$tmp10.val()) { 
                    $result = false;
                    help_feed1($tmp10.parent());
                }
        }
        switch(f_id){
            case 7:
            case 14:
                if($par.find('input:hidden[name^="appoint"]').length==0 && $par.find('input:hidden[name^="ex_appoint"]').length==0) {

                    $result = false;
                    $par.find('input.p_appoit').addClass('err_feed');
                    $par.find('input.p_appoit').next().next().removeClass('hide').next().removeClass('sel_err_invis');
                }
        }
        switch(f_id){
            case 8:
            case 16:
                var $tmp11 = true;
                $par.find('input[name="sale_type"]').each(function(){
                    if( $(this).prop('checked') ){ $tmp11=false; } 
                });

                if($tmp11){ 
                    $result=false;
                    $par.find('label:nth-child(1) input[name="sale_type"]').parent().addClass('radio_err_feed2'); 
                    $par.find('label:nth-child(2) input[name="sale_type"]').parent().addClass('radio_err_feed1').find('div').removeClass('hide').removeClass('sel_err_invis');
                }
        }
        switch(f_id){
            case 9:
            case 10:            
                var $tmp12=$par.find('select[name="land_status"]');
                
                if(!$tmp12.val()) { 
                    $result = false;
                    help_feed1($tmp12.parent());
                }
        }
        switch(f_id){
            case 12:
                var $tmp12=$par.find('select[name="t_build"]'); 
                
                if(!$tmp12.val()){
                    $result = false;
                    help_feed1($tmp12.parent());
                }
        }

        switch( f_id ){
            case 16:
                var $tmp13 = true;
                $par.find('input[name="home_pur_debt"]').each(function() {
                    if( $(this).prop('checked') ){ $tmp13=false; }
                });

                /* if home purchase status not selected */
                if( $tmp13 ){
                    $par.find('label:nth-child(1) input[name="home_pur_debt"]').parent().addClass('radio_err_feed2'); 
                    $par.find('label:nth-child(2) input[name="home_pur_debt"]').parent().addClass('radio_err_feed1').find('div').removeClass('hide').removeClass('sel_err_invis');
                } else {
                    /* if with debt option is selected, check amount field in add elite property */
                    var $tmp14=$par.find('input[name="debt_amount"]');
                    if( $tmp14.attr('required') && ( !$tmp14.val() || !checkZero($tmp14.val()) ) ) {
                        $result=false;
                        help_feed2($tmp14);
                    }
                }
        }
        return $result;
    }

    function help_feed1(ref){
        ref.find('button').addClass('err_feed');
        ref.next().removeClass('hide').removeClass('sel_err_invis');
        ref.next().next().removeClass('sel_err_invis');
    }
    function help_feed2(ref1){
        ref1.addClass('err_feed');
        ref1.next().removeClass('hide').removeClass('sel_err_invis');
        ref1.next().next().removeClass('sel_err_invis');
    }
    function help_feed3(ref2){
        ref2.addClass('err_feed');
        ref2.parent().next().next().next().find('div').removeClass('hide');
    }
    function help_feed4(ref3){
        ref3.addClass('err_feed');
        ref3.next().removeClass('hide');
    }
    function help_feed5(ref4){
        ref4.addClass('err_feed').next().next().removeClass('hide').next().removeClass('sel_err_invis');
    }    
</script>
@yield('scripts')
</body>
</html>