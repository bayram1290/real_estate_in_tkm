@extends('admin.app')
@section('header')
    <link href="{{ asset('css/dashboard/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
@endsection
@section('content')
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
                    <h4 class="text-themecolor">Список разрешённых объявлений</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
                            <li class="breadcrumb-item active">Опубликовано</li>
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
            <!-- .row -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Поиск</h5>
                            <form method="POST" action="{{route('accepted.property.search')}}" role="form" class="row">
                                {{ csrf_field() }}
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group has-info">
                                        <select class="form-control custom-select" name="type_deal">
                                            <option value="0">{{__('messages.rent')}}</option>
                                            <option value="1">{{__('messages.sale')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group has-info">
                                        <select class="form-control custom-select" name="type_deal_sel">
                                            <option value="0">{{__('messages.any_type')}}</option>
                                            @foreach($types_ru as $type)
                                                <option value="{{$type->id}}">{{$type->name_ru}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group has-info">
                                        <select class="form-control custom-select" name="type_object">
                                            <option id="3" value="0">{{__('messages.any_object')}}</option>
                                            @foreach($objects_ru as $object)
                                                <option id="{{$object->type_id}}" value="{{$object->id}}">{{$object->name_ru}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group has-info">
                                        <select class="form-control custom-select" name="velayat_select" id="velayat_select">
                                            <option id="all_vel" value="0">{{__('messages.all_velayats')}}</option>
                                            @foreach($velayats as $velayat)
                                                <option value="{{$velayat->id}}">{{$velayat->velayat}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-group has-info">
                                        <select class="form-control" name="etrap" id="city_select">
                                            <option value="0">{{__('messages.all_etraps')}}</option>
                                            @foreach($cities as $city)
                                                <option id="{{$city->velayat_id}}" value="{{$city->id}}">{{$city->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-1">
                                    <button type="submit" class="btn btn-dark btn-block form-control srch_btn"><i class="fa fa-search text-white"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- .row -->
            <div class="row">
                @if($properties->count() > 0)
                    @foreach($properties as $property)
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <img class="card-img-top" src="/img/property_grid/{{$property->img}}" alt="Card image cap">
                                    <div class="card-img-overlay">
                                        <span class="badge badge-danger badge-pill">{{$property->saleOrRent ? "Продажа" : "Аренда"}}</span>
                                    </div>
                                    <div class="card-body bg-light">
                                        <h4 class="card-title">{{  $property->title }}</h4>
                                        <div class="row">
                                            <div class="col-md-8 col-sm-12"><h4 class="text-primary">&#36; {{$property->price}} {{$property->saleOrRent ? "" : "/в мес."}}</h4></div>
                                            <div class="col-md-4 col-sm-12">
                                                <a href="{{route('property.return.pending', ['id' => $property->id])}}" title="Suspend" class="btn btn-info float-right">
                                                    <i class="fa fa-lg fa-clock-o"></i>
                                                </a>
                                                <a href="{{route('property.admin.description', ['id' => $property->id])}}" title="Посмотреть Описание" class="btn btn-success float-right right_button">
                                                    <i class="fa fa-lg fa-text-height"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body border-top">
                                        <div class="d-flex no-block align-items-center">
                                            <span><img src="/assets/images/property/pro-bath.png"></span>
                                            <span class="p-10 text-muted">Object</span>
                                            <span class="ml-auto badge badge-pill badge-secondary pull-right">{{$property->object->name_ru}}</span>
                                        </div>
                                        <div class="d-flex no-block align-items-center">
                                            <span><img src="/assets/images/property/pro-bed.png"></span>
                                            <span class="p-10 text-muted">Area</span>
                                            <span class="ml-auto badge badge-pill badge-secondary pull-right">{{$property->area}} sq.m</span>
                                        </div>
                                        <div class="d-flex no-block align-items-center">
                                            <span><img src="/assets/images/property/pro-garage.png"></span>
                                            <span class="p-10 text-muted">City</span>
                                            <span class="ml-auto badge badge-pill badge-secondary pull-right">{{$property->city->city}}</span>
                                        </div>
                                    </div>
                                    <div class="card-body border-top">
                                        <div class="d-flex no-block align-items-center">
                                            <a href="javascript:void(0) " class="m-r-15"><img alt="img " class="thumb-md img-circle " src="/{{$property->profile->avatar}}"></a>
                                            <div>
                                                <h5 class="card-title m-b-0">{{$property->profile->first_name}} {{$property->profile->last_name}}</h5>
                                                <small class="text-muted">{{$property->user->properties->count()}} Объявлений</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body bg-light">
                                    <h4 class="card-title text-center">{{__('Нет записи')}}</h4>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
                <!-- /item -->
                <div class="col-md-12 m-t-30 m-b-30">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{$properties->currentPage() - 1 === 0 ? 'disabled' : ''}}">
                            <a class="page-link" href="{{url()->current()}}?page={{$properties->currentPage() - 1}}" ><i class="fa fa-angle-left"></i></a>
                        </li>
                        @for($i = 1; $i <= $properties->lastPage(); $i++)
                            <li class="page-item {{$i === $properties->currentPage()? 'active' : ''}}">
                                <a class="page-link" href="{{url()->current()}}?page={{$i}}">{{$i}} <span class="sr-only">(current)</span></a>
                            </li>
                        @endfor
                        <li class="page-item {{$properties->lastPage() >= $properties->currentPage() + 1 ? '' : 'disabled'}}">
                            <a class="page-link" href="{{url()->current()}}?page={{$properties->currentPage() + 1}}"><i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
                </div>
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
        document.addEventListener('DOMContentLoaded',() => {
            const city = document.getElementById('city_select');
            const velayat = document.getElementById('velayat_select');
            const any_velayat = document.getElementById('all_vel');
            if (any_velayat){
                $("#city_select option").each(function() {
                    if (this.val != 0){
                        this.className = 'hide';
                    }
                    city.selectedIndex = '0';
                    velayat.selectedIndex = '0';
                });
            }
            else{
                $("#city_select option").each(function() {
                    if (this.id != 1){
                        this.className = 'hide';
                    }
                });
            }
        });
        const velayat = document.getElementById('velayat_select');
        velayat.addEventListener('change',(e) => {
            let velayat_id = e.target.value;
            $("#city_select option").each(function()
            {
                if (this.id === velayat_id){
                    this.classList.remove('hide');
                    this.classList.add('show');
                }
                else{
                    this.classList.remove('show');
                    this.classList.add('hide');
                }
                if (this.id == 0){
                    this.classList.remove('hide');
                    this.classList.add('show');
                }
            });
        });
    </script>
@endsection