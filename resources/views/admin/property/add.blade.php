@extends('admin.app')
@section('header')
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('css/dashboard/morris.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('css/dashboard/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('')}}">

    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('css/dashboard/dashboard1.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    @yield('header')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
@endsection
@section('content')
    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add Property</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Add Property</li>
                        </ol>
                        <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="pro-add-form" action="{{route('submit.property')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="pname">Заголовок</label>
                                    <input type="text" class="form-control" name="title" id="pname" placeholder="Enter Title"> </div>
                                {{--<div class="form-group">--}}
                                    {{--<label for="plocation">Property Location</label>--}}
                                    {{--<input type="email" class="form-control" id="plocation" placeholder="Enter Location"> </div>--}}
                                <div class="form-group">
                                    <label for="pdesc">Описание</label>
                                    <textarea class="form-control" rows="5" name="description" id="pdesc" placeholder="Enter Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Аренда / Продажа</label>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" name="status" class="custom-control-input" value="0">
                                                <label class="custom-control-label" for="customRadio3">Аренда</label>
                                            </div>
                                            <div class="custom-control custom-radio m-l-15">
                                                <input type="radio" id="customRadio4" name="status" class="custom-control-input" value="1">
                                                <label class="custom-control-label" for="customRadio4">Продажа</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="plocation">Цена</label>
                                    <input type="number" class="form-control" name="price" id="plocation" placeholder="Введите сумму"> </div>
                                <div class="form-group">
                                    <label for="paddress">Адрес</label>
                                    <textarea class="form-control" name="address" rows="3" id="paddress"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="tch1">Комнаты</label>
                                            <input id="tch1" type="number" value="" name="rooms" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline">
                                        </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="psqft">Площадь</label>
                                            <input type="text" class="form-control" name="area" id="psqft">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="status">Статус</label>
                                            <select class="form-control custom-select" name="accepted" id="status">
                                                <option value="1">Активно</option>
                                                <option value="0">Ожидающий подтверждения</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="type">Тип недвижимости</label>
                                            <select class="form-control custom-select" name="type" id="type">
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}">{{$type->name_ru}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="city">Город</label>
                                            <select class="form-control custom-select" name="city" id="city">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Features</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                           @foreach($features as $feature)
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" value="{{$feature->id}}" name="features[]" class="custom-control-input" id="customCheck{{$feature->id}}">
                                                    <label class="custom-control-label" for="customCheck{{$feature->id}}">{{$feature->feature}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{--<div class="col-sm-4">--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input type="checkbox" class="custom-control-input" id="customCheck4">--}}
                                                {{--<label class="custom-control-label" for="customCheck4"> Fireplace </label>--}}
                                            {{--</div>--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input type="checkbox" class="custom-control-input" id="customCheck5">--}}
                                                {{--<label class="custom-control-label" for="customCheck5"> Doorman</label>--}}
                                            {{--</div>--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input type="checkbox" class="custom-control-input" id="customCheck6">--}}
                                                {{--<label class="custom-control-label" for="customCheck6"> Swimming Pool</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input type="checkbox" class="custom-control-input" id="customCheck7">--}}
                                                {{--<label class="custom-control-label" for="customCheck7"> Gym </label>--}}
                                            {{--</div>--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input type="checkbox" class="custom-control-input" id="customCheck8">--}}
                                                {{--<label class="custom-control-label" for="customCheck8"> Parking</label>--}}
                                            {{--</div>--}}
                                            {{--<div class="custom-control custom-checkbox">--}}
                                                {{--<input type="checkbox" class="custom-control-input" id="customCheck9">--}}
                                                {{--<label class="custom-control-label" for="customCheck9"> laundry</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                                {{--<h5 class="card-title">Dimensions</h5>--}}
                                {{--<hr>--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<label for="diningroom">Dining Room</label>--}}
                                            {{--<input type="text" class="form-control" id="diningroom" data-mask="99x99"> </div>--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<label for="kitchen">Kitchen</label>--}}
                                            {{--<input type="text" class="form-control" id="kitchen" data-mask="99x99"> </div>--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<label for="livingroom">Living Room</label>--}}
                                            {{--<input type="text" class="form-control" id="livingroom" data-mask="99x99"> </div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<label for="mbedroom">Master Bedroom</label>--}}
                                            {{--<input type="text" class="form-control" id="mbedroom" data-mask="99x99"> </div>--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<label for="bed2">Bedroom 2</label>--}}
                                            {{--<input type="text" class="form-control" id="bed2" data-mask="99x99"> </div>--}}
                                        {{--<div class="col-sm-4">--}}
                                            {{--<label for="otherroom">Other Room</label>--}}
                                            {{--<input type="text" class="form-control" id="otherroom" data-mask="99x99"> </div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label class="inner-title">{{__('messages.pin_location')}}</label>
                                    <div id="map" style="height: 400px; width: 100%;"></div>
                                    <input type="hidden" id="lat" name="lat">
                                    <input type="hidden" id="lng" name="lng">
                                </div>
                                <div class="form-group">
                                    <label for="input-file-now">Изображения</label>
                                    <input type="file" name="img[]" id="input-file-now" class="dropify" multiple required/>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Добавить</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .row -->
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
                                <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
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
    <!-- /.row -->
    <!-- .row -->
    <!-- /.row -->
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
                        <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
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
@endsection
@section('footer')
    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/dashboard/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/dashboard/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/dashboard/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/dashboard/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{ asset('js/dashboard/raphael-min.js') }}"></script>
    <script src="{{ asset('js/dashboard/morris.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.sparkline.min.js') }}"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('js/dashboard/jquery.toast.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('js/dashboard/dashboard1.js') }}"></script>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {lat: 37.9601, lng: 58.3261},
                styles: [{"featureType":"water","elementType":"all","stylers":[{"hue":"#76aee3"},{"saturation":38},{"lightness":-11},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#8dc749"},{"saturation":-47},{"lightness":-17},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#c6e3a4"},{"saturation":17},{"lightness":-2},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#cccccc"},{"saturation":-100},{"lightness":13},{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"hue":"#5f5855"},{"saturation":6},{"lightness":-31},{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[]}]
            });

            var marker = new google.maps.Marker({
                position: map.center,
                map: map,
                draggable:true,
                icon: 'http://unicoderbd.com/theme/html/uniland/img/marker_blue.png'
            });

            function setMapOnAll(map) {
                marker.setMap(map);
            }

            map.addListener('click', function(e) {
                setMapOnAll(null);
                document.getElementById('lat').value = e.latLng.lat();
                document.getElementById('lng').value = e.latLng.lng();
                placeMarkerAndPanTo(e.latLng, map);
            });
        }

        function placeMarkerAndPanTo(latLng, map) {
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: 'http://unicoderbd.com/theme/html/uniland/img/marker_blue.png'
            });
            function setMapOnAll(map) {
                marker.setMap(map);
            }
            map.addListener('click', function(e) {
                setMapOnAll(null);
                document.getElementById('lat').value = e.latLng.lat();
                document.getElementById('lng').value = e.latLng.lng();
                placeMarkerAndPanTo(e.latLng, map);
            });
            map.panTo(latLng);
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXcbrsAcnO7l3WKuJrHVsjP0J4RFsE9wM&callback=initMap">
    </script>
@endsection