@extends('admin.app')
@section('header')
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
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
					<h4 class="text-themecolor">Редактировать город</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Панель управления</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('site.settings') }}">Настройки сайта</a></li>
							<li class="breadcrumb-item active">Город для объявлений</li>
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
					@include('admin.incls.errors')
						<form action="{{ route('site.settings.city.update', ['id'=> $city->id]) }}" method="POST" class="form-horizontal p-t-20" role="form">
							{{ csrf_field() }}
							<div class="col-lg-12">
								<div class="card">
									<div class="form-body m-l-20 m-r-20">
										<h3 class="card-title">Редактировать город</h3>
										<hr>
										<br>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">                                                            
													<label for="icty" class="col-sm-3 control-label">Город</label>
													<input type="text" id="city" name="city" class="form-control" value="{{ $city->city }}" required>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">                                                   
													<label for="velayat" class="col-sm-3 control-label">Велаят</label>
													<select class="form-control custom-select" data-placeholder="Выберите велаят" name="velayat" tabindex="1" required>
														@foreach($velayats as $velayat)
															<option value="{{$velayat->id}}"
																@if($velayat->id==$city->velayat_id)
																	selected
																@endif
																>{{ $velayat->velayat }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions m-l-20 m-r-20">
										<button type="submit" type="submit" class="btn btn-success m-r-15"><i class="fa fa-check"></i> Сохранить</button>
										<a href="{{ route('site.settings') }}" class="btn btn-inverse btn_def">Отмена</a>
									</div>
								</div>
							</div>
						</form>
						
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
    
    <!--Custom JavaScript -->
    <script src="{{ asset('js/dashboard/custom.min.js') }}"></script>
@endsection