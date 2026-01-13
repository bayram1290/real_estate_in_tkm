@extends('admin.app')
@section('header')
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/bootstrap-formhelpers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Мой профиль</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                            <li class="breadcrumb-item active">Настройки сайта</li>
                        </ol>
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Доб. объявление</button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->


            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row el-element-overlay">

                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs profile-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#parameters" role="tab">Параметры</a> </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings" role="tab">Настройки</a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">



                            <!--second tab-->
                            <div class="tab-pane active" id="parameters" role="tabpanel">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header bg-info">
                                                    <h4 class="m-b-0 text-white">Графическая и презентационная</h4>
                                                    <br>
                                                </div>
                                                <div class="card-body form-horizontal">
                                                    <div class="form-body">
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="stitle" class="control-label text-right">Надпись:</label></div>
                                                                <div class="col-md-9"><label id="stitle" class="control-label text-right cFade m-l-10">{{ $settings->site_title }}</label></div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="sicon" class="control-label text-right">Иконка:</label></div>
                                                                <div class="col-md-9">
                                                                    <img class="icon_cont" id="sicon" src="{{ asset($settings->site_icon) }}" alt="Site Icon">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="slogo" class="control-label text-right">Логотип навигации:</label></div>
                                                                <div class="col-md-9">
                                                                    <img class="logo_cont m-l-10" id="slogo" src="{{ asset($settings->site_logo) }}" alt="Изображение логотипа">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="sblogo" class="control-label text-right">Нижний логотип:</label></div>
                                                                <div class="col-md-9">
                                                                    <img class="logo_cont ml-auto mr-auto" id="sblogo" src="{{ asset($settings->site_bottom_logo) }}" alt="Изображение логотипа">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="row">
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-4"><label for="sbanner_image" class="control-label text-right banner_img_text">Изображение баннера:</label></div>
                                                                <div class="col-md-8">
                                                                    <img id="sbanner_image" src="{{ asset($settings->site_banner_img) }}" alt="Фоновое изображение" class="banner_img">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-header bg-info">
                                                    <h4 class="m-b-0 text-white">Контактные и социальные</h4>
                                                    <br>
                                                </div>
                                                <div class="card-body form-horizontal">
                                                    <div class="form-body">
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="sphone" class="control-label text-right">Телефон:</label></div>
                                                                <div class="col-md-9">
                                                                    <p id="sphone" class="form-control-static cFade">
                                                                        {{ $tel_1 }}
                                                                        @if($tel_2!=='')
                                                                            , {{  $tel_2 }}
                                                                        @endif
                                                                        @if($tel_3!='')
                                                                            , {{  $tel_3 }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="semail" class="control-label text-right">Эл. адрес:</label></div>
                                                                <div class="col-md-9">
                                                                    <p id="semail" class="form-control-static cFade">{{ $settings->contact_email }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-12 p-l-0 m-b-20">
                                                                <div class="sett_about_lbl"><label for="saddress" class="control-label text-right">Адрес:</label></div>
                                                                <div class="col">
                                                                    <p id="saddress" class="form-control-static cFade">{{ $settings->contact_address }}</p>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 p-l-0 m-b-20">
                                                                <div class="sett_about_lbl"><label for="sabout" class="control-label text-right">О нас (на русском):</label></div>
                                                                <div class="col">
                                                                    <p id="sabout" class="form-control-static cFade">{{ $settings->about_ru }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 p-l-0 m-b-20">
                                                                <div class="sett_about_lbl"><label for="sabout" class="control-label text-right">О нас (на английском):</label></div>
                                                                <div class="col">
                                                                    <p id="sabout" class="form-control-static cFade">{{ $settings->about_en }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 p-l-0 m-b-20">
                                                                <div class="sett_about_lbl"><label for="sabout" class="control-label text-right">О нас (на туркменском):</label></div>
                                                                <div class="col">
                                                                    <p id="sabout" class="form-control-static cFade">{{ $settings->about_tm }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <h3 class="card-title f_sans">Карта Google</h3>
                                                        <hr class="m-t-0 m-b-40">
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="lat_lang" class="control-label text-right">Широта / Долгота:</label></div>
                                                                <div class="col-md-9">
                                                                    <p id="lat_lang" class="form-control-static cFade">{{ $settings->map_latitude }} / {{ $settings->map_longitude }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="sapi_key" class="control-label text-right f_sans">Ключ API:</label></div>
                                                                <div class="col-md-9">
                                                                    <p id="sapi_key" class="form-control-static cFade">{{ $settings->api_key}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="smap_icon" class="control-label text-right m-t-10">Иконка на карте:</label></div>
                                                                <div class="col-md-9">
                                                                    <img class="smap_icon" id="smap_icon" src="{{ asset($settings->map_icon) }}" alt="Изображение логотипа">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="smap_tag" class="control-label text-right">Тег для местоположения:</label></div>
                                                                <div class="col-md-9">
                                                                    <p id="smap_tag" class="form-control-static cFade">{{ $settings->map_tag }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <hr class="m-t-0 m-b-40">
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="logo" class="control-label text-right f_sans">Facebook:</label></div>
                                                                <div class="col-md-9">
                                                                    <p class="form-control-static cFade">{{ $settings->faceboook }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="logo" class="control-label text-right f_sans">Twitter:</label></div>
                                                                <div class="col-md-9">
                                                                    <p class="form-control-static cFade">{{ $settings->twitter }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="logo" class="control-label text-right f_sans">LinkedIn:</label></div>
                                                                <div class="col-md-9">
                                                                    <p class="form-control-static cFade">{{ $settings->linkedin }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="logo" class="control-label text-right f_sans">Instagram:</label></div>
                                                                <div class="col-md-9">
                                                                    <p class="form-control-static cFade">{{ $settings->instagram }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="card-header bg-info">
                                                    <h4 class="m-b-0 text-white">Дополнительная</h4>
                                                    <br>

                                                </div>
                                                <div class="card-body form-horizontal">
                                                    <div class="form-body">

                                                        <div class="row">
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="ads_block" class="control-label text-right m-t-5">Кол. рекламных блоков:</label></div>
                                                                <div class="col-md-9">
                                                                    <div class="list-group">
                                                                        <div class="list-group-item text-center cFade">{{ $ad_cnt }}</div>
                                                                        <div class="list-group-item text-center cFade">
                                                                            <form action="{{ route('advertisement') }}">
                                                                                {{csrf_field()}}
                                                                                <button type="submit" class="btn btn-info">&nbsp;<i class="ti-settings">&nbsp;</i>Редактировать</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 row">
                                                                <div class="col-md-3"><label for="logo" class="control-label text-right">Города для объявлений:</label></div>
                                                                <div class="col-md-9">
                                                                    <div class="list-group">

                                                                        @foreach($cities as $city)
                                                                            <div class="list-group-item text-center cFade">
                                                                                {{ $city->city }}
                                                                                @if($city->velayat_id!==6)
                                                                                    &nbsp;/&nbsp;{{  $city->velayat->velayat }}
                                                                                @endif
                                                                            </div>
                                                                        @endforeach

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel">
                                <form action="{{ route('site.settings.edit') }}" method="POST" class="form-horizontal p-t-20" role="form" enctype="multipart/form-data">

                                    {{csrf_field()}}
                                    @include('admin.incls.errors')

                                    <div class="col-lg-12">
                                        <div class="card setting_form_back">
                                            <div class="card-body m-l-20 m-r-20">
                                                <h3 class="card-title">Основной</h3>
                                                <hr class="m-t-0 m-b-40">
                                                <br>
                                                <div class="form-group row">
                                                    <label for="title" class="col-sm-3 control-label">Надпись сайта</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-tag"></i></span></div>
                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Введите надпись сайта" value="{{ $settings->site_title }}" tabindex="1" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="icon" class="col-sm-12 control-label">Иконка</label>
                                                        <br>
                                                        <input type="file" name="icon" class="dropify input-file-now-custom-3" data-height="500" data-default-file="{{ asset($settings->site_icon) }}"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="logo" class="col-sm-12 control-label">Логотип навигации</label>
                                                        <br>
                                                        <input type="file" id="logo" name="logo" class="input-file-now-custom-3 dropify" data-height="500" data-default-file="{{ asset($settings->site_logo) }}"/>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="blogo" class="col-sm-12 control-label">Нижний логотип</label>
                                                        <br>
                                                        <input type="file" id="blogo" name="bottom_logo" class="input-file-now-custom-3 dropify" data-height="500" data-default-file="{{ asset($settings->site_bottom_logo) }}"/>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="banner_img" class="col-sm-12 control-label">Изображение баннера</label>
                                                        <br>
                                                        <input type="file" id="banner_img" name="banner_img" class="dropify input-file-now-custom-3" data-height="500" data-default-file="{{ asset($settings->site_banner_img) }}"/>
                                                    </div>
                                                </div>
                                                <br><br><br>
                                                <div class="form-group row">
                                                    <label for="phone" class="col-sm-3 control-label">Телефон</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                                            <input type="text" class="form-control input-medium bfh-phone" name="phone" id="phone" placeholder="Введите контактный телефон" value="{{ $tel_1 }}" data-country="TM" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="phone1" class="col-sm-3 control-label">Телефон 2 (Опциональный)</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                                            <input type="text" class="form-control input-medium bfh-phone" name="phone1" id="phone1" placeholder="Введите дополнительный телефон" value="{{ $tel_2 !=='' ? $tel_2 : '' }}" data-country="TM">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="phone" class="col-sm-3 control-label">Телефон 3 (Опциональный)</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                                            <input type="text" class="form-control input-medium bfh-phone" name="phone2" id="phone" placeholder="Введите дополнительный телефон" value="{{ $tel_3 !=='' ? $tel_3 : '' }}" data-country="TM">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3 control-label">Эл. адрес</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                                                            <input type="email" class="form-control input-medium" name="email" id="email" placeholder="Введите контактный эл. адрес" value="{{ $settings->contact_email }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="address" class="col-sm-3 control-label">Адрес</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa fa-address-card"></i></span></div>
                                                            <input type="text" class="form-control input-medium" name="address" id="address" placeholder="Введите контактный адрес" value="{{ $settings->contact_address }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="about" class="col-sm-3 control-label">О нас</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-info-circle"></i></span></div>
                                                            <textarea name="about" class="form-control input-medium" id="about" cols="30" rows="10" placeholder="Введите текст о нас" required>{{ $settings->about }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="latitude" class="col-sm-3 control-label">Широта местоположения</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe"></i></span></div>
                                                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Введите широту местоположения" value="{{ $settings->	map_latitude }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="longitude" class="col-sm-3 control-label">Долгота местоположения</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-globe"></i></span></div>
                                                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Введите долготу местоположения" value="{{ $settings->map_longitude }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="api_key" class="col-sm-3 control-label">Ключ API</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                                                            <input type="text" class="form-control" id="api_key" name="api_key" placeholder="Введите ключ API" value="{{ $settings->api_key }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label for="map_icon" class="col-sm-3 control-label">Иконка на карте</label>
                                                        <br>
                                                        <input type="file" id="map_icon" name="map_icon" class="dropify input-file-now-custom-3" data-height="500" data-default-file="{{ asset($settings->map_icon) }}"/>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <label for="map_tag" class="col-sm-3 control-label">Тег для местоположения</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-map-marker"></i></span></div>
                                                            <input type="text" class="form-control" id="map_tag" name="map_tag" placeholder="Введите тег для местоположения" value="{{ $settings->map_tag }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-facebook-square"></i></span></div>
                                                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Введите учетную запись facebook" value="{{ $settings->faceboook }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-twitter-square"></i></span></div>
                                                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Введите учетную запись twitter" value="{{ $settings->twitter }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="linkedin" class="col-sm-3 control-label">LinkedIn</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-linkedin-square"></i></span></div>
                                                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Введите учетную запись linkedin" value="{{ $settings->linkedin }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="instagram" class="col-sm-3 control-label">Instagram</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-instagram"></i></span></div>
                                                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Введите учетную запись instagram" value="{{ $settings->instagram }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success set_btn"> <i class="fa fa-check"></i> Сохранить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-lg-12">
                                    <div class="card setting_form_back">
                                        <div class="card-body m-l-20 m-r-20">
                                            <h3 class="card-title">Город</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="form-group row">
                                                <label for="api_key" class="col-sm-3 control-label">Города для объявлений</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <form action="{{route('site.settings.city.add')}}" method="POST" class="w-100 form-horizontal" name="city_add" role="form">
                                                            {{csrf_field()}}

                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Город</th>
                                                                    <td>Велаят</td>
                                                                    <th>Обновить</th>
                                                                    <th>Удалить</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php ($i=1)
                                                                @foreach($cities as $city1)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$city1->city}}</td>
                                                                        <td>
                                                                            @if($city1->velayat_id!==6)
                                                                                {{ $city1->velayat->velayat }}
                                                                            @endif
                                                                        </td>
                                                                        <td><a href="{{ route('site.settings.city.edit', ['id' => $city1->id ]) }}"><i class="fa fa-pencil text-inverse m-l-20"></i></a></td>
                                                                        <td class="m-l-5"><a onclick="return confirm('Вы уверены, что хотите удалить?')" href="{{ route('site.settings.city.delete', ['id' =>  $city1->id]) }}"><i class="fa fa-close text-danger m-l-20"></i></a></td>
                                                                    </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td>{{$i}}</td>
                                                                    <td>
                                                                        <div class="form-group row">
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control" name="city" placeholder="Введите новый город" required/>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <select name="velayat" id="velayat" class="form-control">
                                                                                @foreach($velayats as $velayat)
                                                                                    <option value="{{$velayat->id}}">{{ $velayat->velayat }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td><button class="fa_succ_back" type="submit"><i class="fa fa-plus fa_succ"></i></button></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- Row -->
            <!-- ============================================================== -->
            <!-- End PAge Content -->

            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <div class="right-sidebar">
                <div class="slimscrollright">
                    <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                    <div class="r-panel-body">
                        <ul id="themecolors" class="m-t-20">
                            <li><b>With Light sidebar</b></li>
                            <li><a href="javascript:void(0)" data-skin="skin-default" class="default-theme">1</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-green" class="green-theme">2</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-red" class="red-theme">3</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-blue" class="blue-theme working">4</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-purple" class="purple-theme">5</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-megna" class="megna-theme">6</a></li>
                            <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                            <li><a href="javascript:void(0)" data-skin="skin-default-dark" class="default-dark-theme ">7</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-purple-dark" class="purple-dark-theme">11</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-megna-dark" class="megna-dark-theme ">12</a></li>
                        </ul>
                        <ul class="m-t-20 chatonline">
                            <li><b>Chat option</b></li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/1.jpg') }}" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/2.jpg') }}" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/3.jpg') }}" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/4.jpg') }}" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/5.jpg') }}" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/6.jpg') }}" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/7.jpg') }}" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="{{ asset('admin/dashboard/users/8.jpg') }}" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
@endsection
@section('footer')
    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/dashboard/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/dashboard/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/dashboard/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('js/dashboard/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/dashboard/custom.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/dropify.min.js') }}"></script>

    <script src="{{ asset('js/dashboard/bootstrap-formhelpers.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap-formhelpers.min.js') }}"></script>

    <script src="{{ asset('js/dashboard/jquery.toast.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.dropify').dropify();
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function(event, element){
                return confirm("Вы действительно хотите удалить \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element){
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function(event, element){
                console.log('Имеет ошибки');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify');
            $('#toggleDropify').on('click', function(e){
                e.preventDefault();
                if (drDestroy.isDropified()){ drDestroy.destroy();} else{ drDestroy.init();}
            });


            @if(Session::has('city_update'))
                $.toast({
                    heading: 'Успешно',
                    text: '{{ Session::get('city_update') }}',
                    position: 'top-right',
                    loaderBg:'#90c923',
                    icon: 'success',
                    hideAfter: 3500,
                    stack: 6
                });
            @endif

            @if(Session::has('city_delete'))
                $.toast({
                    heading: 'Успешно',
                    text: '{{ Session::get('city_delete') }}',
                    position: 'top-right',
                    loaderBg: '#90c923',
                    icon: 'success',
                    hideAfter: 3500,
                    stack: 6
                });
            @endif

            @if(Session::has('new_city'))
                $.toast({
                    heading: 'Успешно',
                    text: '{{ Session::get('new_city') }}',
                    position: 'top-right',
                    loaderBg:'#90c923',
                    icon: 'success',
                    hideAfter: 3500,
                    stack: 6
                });
            @endif

            @if(Session::has('site_setting'))
            $.toast({
                heading: 'Успешно',
                text: '{{ Session::get('site_setting') }}',
                position: 'top-right',
                loaderBg:'#90c923',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
            @endif

        });

        @if(Session::has('admin_update'))
        toastr.success(" {{ Session::get('admin_update') }}  ");
        @endif


    </script>
@endsection