@extends('admin.app')
@section('header')
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('css/dashboard/morris.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('css/dashboard/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('css/dashboard/dashboard1.css') }}" rel="stylesheet">
    @yield('header')
@endsection
@section('content')
    <div class="page-wrapper">
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Жалобы</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Панель упр.</a></li>
                            <li class="breadcrumb-item active">Жалобы</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Start Page Content -->
            <div class="row">
                <div class="col-12">
                <!-- Column -->
                    <!-- Column -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Static</h4>
                            <div id="staticgrid">
                                <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                    <table class="jsgrid-table table table-striped table-hover">
                                        <tr class="jsgrid-header-row">
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">
                                                <strong>Имя</strong>
                                            </th>
                                            <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable"><strong>Жалоба</strong></th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable"><strong>Описание</strong></th>
                                            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable">Email</th>
                                            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"><strong>Телефон</strong></th>
                                            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"><strong>Ссылка на объект</strong></th>
                                            <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable"><strong>Ответить</strong></th>
                                        </tr>
                                        <tr class="jsgrid-filter-row" style="display: none;">
                                            <td class="jsgrid-cell"><input type="text"
                                                                                                 class="form-control input-sm">
                                            </td>
                                            <td class="jsgrid-cell jsgrid-align-right" style="width: 70px;"><input
                                                        type="number" class="form-control input-sm"></td>
                                            <td class="jsgrid-cell"><input type="text"
                                                                                                 class="form-control input-sm">
                                            </td>
                                            <td class="jsgrid-cell jsgrid-align-center" style="width: 100px;"><select
                                                        class="form-control input-sm">
                                                    <option value="0"></option>
                                                    <option value="1">United States</option>
                                                    <option value="2">Canada</option>
                                                    <option value="3">United Kingdom</option>
                                                    <option value="4">France</option>
                                                    <option value="5">Brazil</option>
                                                    <option value="6">China</option>
                                                    <option value="7">Russia</option>
                                                </select></td>
                                            <td class="jsgrid-cell jsgrid-align-center"><input
                                                        type="checkbox" readonly=""></td>
                                        </tr>
                                        <tr class="jsgrid-insert-row" style="display: none;">
                                            <td class="jsgrid-cell"><input type="text"
                                                                                                 class="form-control input-sm">
                                            </td>
                                            <td class="jsgrid-cell jsgrid-align-right"><input
                                                        type="number" class="form-control input-sm"></td>
                                            <td class="jsgrid-cell" ><input type="text"
                                                                                                 class="form-control input-sm">
                                            </td>
                                            <td class="jsgrid-cell jsgrid-align-center"><select
                                                        class="form-control input-sm">
                                                    <option value="0"></option>
                                                    <option value="1">United States</option>
                                                    <option value="2">Canada</option>
                                                    <option value="3">United Kingdom</option>
                                                    <option value="4">France</option>
                                                    <option value="5">Brazil</option>
                                                    <option value="6">China</option>
                                                    <option value="7">Russia</option>
                                                </select></td>
                                            <td class="jsgrid-cell jsgrid-align-center" ><input
                                                        type="checkbox"></td>
                                        </tr>
                                        <div class="jsgrid-grid-body">
                                                <tbody>
                                                @foreach($complaints as $complaint)
                                                    <tr class="jsgrid-row">
                                                        <td class="jsgrid-cell">{{$complaint->name}}</td>
                                                        <td class="jsgrid-cell">{{$complaint->complaint->ru}}
                                                        </td>
                                                        <td class="jsgrid-cell jsgrid-align-center">
                                                            {{$complaint->detail->ru}}
                                                        </td>
                                                        <td class="jsgrid-cell jsgrid-align-right" >
                                                            {{$complaint->email}}
                                                        </td>
                                                        <td class="jsgrid-cell jsgrid-align-right" >
                                                            {{$complaint->phone}}
                                                        </td>
                                                        <td class="jsgrid-cell jsgrid-align-right" >
                                                            <a href="{{route('single',['id' => $complaint->property_id])}}">{{$complaint->property->title}}</a>
                                                        </td>
                                                        <td class="jsgrid-cell jsgrid-align-right" >
                                                            <a href="{{route('reply.complaint')}}"><button class="btn btn-primary">Reply</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                </div>
            </div>
            
            <!-- End PAge Content -->
            
            
            <!-- Right sidebar -->
            
            <!-- .right-sidebar -->
            <div class="right-sidebar">
                <div class="slimscrollright">
                    <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span>
                    </div>
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
                            <li><a href="javascript:void(0)" data-skin="skin-default-dark"
                                   class="default-dark-theme ">7</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-green-dark" class="green-dark-theme">8</a>
                            </li>
                            <li><a href="javascript:void(0)" data-skin="skin-red-dark" class="red-dark-theme">9</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-blue-dark" class="blue-dark-theme">10</a>
                            </li>
                            <li><a href="javascript:void(0)" data-skin="skin-purple-dark"
                                   class="purple-dark-theme">11</a></li>
                            <li><a href="javascript:void(0)" data-skin="skin-megna-dark"
                                   class="megna-dark-theme ">12</a></li>
                        </ul>
                        <ul class="m-t-20 chatonline">
                            <li><b>Chat option</b></li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Varun Dhavan <small
                                                class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Genelia Deshmukh <small
                                                class="text-warning">Away</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Ritesh Deshmukh <small
                                                class="text-danger">Busy</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Arijit Sinh <small
                                                class="text-muted">Offline</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Govinda Star <small
                                                class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img"
                                                                  class="img-circle"> <span>John Abraham<small
                                                class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Hritik Roshan<small
                                                class="text-success">online</small></span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img"
                                                                  class="img-circle"> <span>Pwandeep rajan <small
                                                class="text-success">online</small></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- End Right sidebar -->
            
        </div>
        
        <!-- End Container fluid  -->
        
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
    
    <!-- This page plugins -->
    
    <!--morris JavaScript -->
    <script src="{{ asset('js/dashboard/raphael-min.js') }}"></script>
    <script src="{{ asset('js/dashboard/morris.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.sparkline.min.js') }}"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('js/dashboard/jquery.toast.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('js/dashboard/dashboard1.js') }}"></script>
    <script src="../assets/node_modules/jsgrid/db.js"></script>
    <script type="text/javascript" src="../assets/node_modules/jsgrid/jsgrid.min.js"></script>
    <script src="{{asset('js/pages/jsgrid-init.js')}}"></script>
@endsection