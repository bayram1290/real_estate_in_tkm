@extends('admin.app')
@section('header')
    
    <link href="{{ asset('css/dashboard/contact-app-page.css') }}" rel="stylesheet">    
    
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard/bootstrap-formhelpers.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/dashboard/toastr.min.css') }}" rel="stylesheet">
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
							<li class="breadcrumb-item active">Мой профиль</li>
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

                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card"> <img class="card-img" src="{{asset('images/dashboard/users/admin_back.jpg')}}" height="456" alt="Card image">
                            <div class="card-img-overlay card-inverse text-white social-profile d-flex justify-content-center">
                                <div class="align-self-center"> <img src="{{asset($profile_info->avatar)}}" class="img-circle" width="100">
                                    <hr>
                                    <h4 class="card-title">{{ $profile_info->full_name }}</h4>
                                    <h6 class="card-subtitle">{{$email}}</h6>
                                    <p class="text-white">{{ $profile_info->about }}</p>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">                                
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Профиль</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Настройки</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                
                               
                                
                                <!--second tab-->
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header bg-info">
                                                        <h4 class="m-b-0 text-white">Личная информация</h4>
                                                        <br>
                                                    </div>
                                                    <div class="card-body form-horizontal">
                                                        <div class="form-body">                                                            
                                                                

                                                            <div class="row">
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label for="sname" class="control-label text-right col-md-4">Имя пользователя:</label>
                                                                        <div class="col-md-8">
                                                                            <p id="sname" class="form-control-static">{{$username}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label for="sfname" class="control-label text-right col-md-4">Полное имя:</label>
                                                                        <div class="col-md-8">
                                                                            <p id="sfname" class="form-control-static">{{$profile_info->full_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label for="stel" class="control-label text-right col-md-4">Телефон:</label>
                                                                        <div class="col-md-8">
                                                                            <p id="stel" class="form-control-static">{{ $phone }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label for="swtel" class="control-label text-right col-md-4">Раб. телефон:</label>
                                                                        <div class="col-md-8">
                                                                            <p id="swtel" class="form-control-static">{{ $w_phone }}</p>
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
                                    
                                    <div class="card-body">
                                        <form action="{{ route('admin.profile.update') }}" method="POST" class="form-horizontal p-t-20" role="form" enctype="multipart/form-data">
                                            
                                            @include('admin.incls.errors')

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Профиль изображения</h4>                                                            
                                                            <input type="file" id="input-file-now-custom-3" name="avatar" class="dropify" data-height="500" data-default-file="{{ asset($profile_info->avatar) }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        
                                                        <div class="form-group row">
                                                            <label for="name" class="col-sm-3 control-label">Имя пользователя*</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя пользователя" value="{{ $username }}" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="full_name" class="col-sm-3 control-label">Полное имя</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></div>
                                                                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Введите полное имя" value="{{ $profile_info->full_name }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label for="email" class="col-sm-3 control-label">Эл. адрес*</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope-open"></i></span></div>
                                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Введите эл. адрес" value="{{ $email }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="phone" class="col-sm-3 control-label">Тел*</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                                                    <input type="text" class="form-control input-medium bfh-phone" name="phone" id="phone" placeholder="Введите основной телефон" value="{{$phone}}" data-country="TM" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="workPhone" class="col-sm-3 control-label">Рабочий телефон</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                                                    <input type="text" class="form-control input-medium bfh-phone" name="workPhone" id="workPhone" placeholder="Введите рабочий телефон" value="{{ $profile_info->work_phone }}" data-country="TM">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="password" class="col-sm-3 control-label {{ $errors->has('password') ? 'has-error' : ''}}">Пароль</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password_confirmation" class="col-sm-3 control-label">Повт. пароль</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Повторите пароль">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="about" class="col-sm-3 control-label">О себе</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-info"></i></span></div>
                                                                    <textarea name="about" class="form-control" id="about" cols="30" rows="10" placeholder="Введите краткое описание о себе">{{ $profile_info->about }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row m-b-0">
                                                            <div class="offset-sm-3 col-sm-9">
                                                                <button type="submit" class="btn btn-success waves-effect waves-light">Обновить профиль</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

    <script src="{{ asset('js/dashboard/toastr.min.js') }}"></script>
    <script>
        @if(Session::has('admin_update'))
            toastr.success(" {{ Session::get('admin_update') }}  ");
        @endif

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
        });
    </script>

@endsection