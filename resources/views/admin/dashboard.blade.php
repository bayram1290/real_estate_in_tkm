@section('header')
    <link href="{{ asset('css/dashboard/morris.css') }}" rel="stylesheet">
	<link href="{{ asset('css/dashboard/jquery.toast.css') }}" rel="stylesheet">
	<link href="{{ asset('css/dashboard/tablesaw.css') }}" rel="stylesheet">
	<link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
@endsection
@extends('admin.app')
@section('content')
	<!-- Page wrapper  -->
	<div class="page-wrapper">
		<!-- Container fluid  -->
		<div class="container-fluid">
			<!-- Bread crumb and right sidebar toggle -->
			<div class="row page-titles">
				<div class="col-md-5 align-self-center">
					<h4 class="text-themecolor">Панель управления</h4>
				</div>
				<div class="col-md-7 align-self-center text-right">
					<div class="d-flex justify-content-end align-items-center">
						<ol class="breadcrumb">
							<li class="breadcrumb-item active">Панель управления</li>
						</ol>						
					</div>
				</div>
			</div>
			<!-- End Bread crumb and right sidebar toggle -->
			<!-- Info box -->
			<!--.row -->
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-uppercase">Все объявления</h5>
							<div class="d-flex align-items-center no-block m-t-20 m-b-10">
								<h1><i class="ti-home text-info"></i></h1>
								<div class="ml-auto">
									<h1 class="text-muted">{{App\Property::count()}}</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-uppercase">Объявления о продаже</h5>
							<div class="d-flex align-items-center no-block m-t-20 m-b-10">
								<h1><i class="icon-tag text-purple"></i></h1>
								<div class="ml-auto">
									<h1 class="text-muted">{{App\Property::where('saleOrRent', 1)->count()}}</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-uppercase">Объявления для аренды</h5>
							<div class="d-flex align-items-center no-block m-t-20 m-b-10">
								<h1><i class="icon-tag text-danger"></i></h1>
								<div class="ml-auto">
									<h1 class="text-muted">{{App\Property::where('saleOrRent', 0)->count()}}</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-uppercase">Общий доход</h5>
							<div class="d-flex align-items-center no-block m-t-20 m-b-10">
								<h1><i class="ti-wallet text-success"></i></h1>
								<div class="ml-auto">
									<h1 class="text-muted">8170 TMT</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<!-- End Info box -->
			<!-- Over Visitor, Our income , slaes different and  sales prediction -->			
			<div class="row">
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<div class="d-flex m-b-40 align-items-center">
								<h5 class="card-title">СТАТИСТИКИ ОБЪЯВЛЕНИЯ</h5>
								<div class="ml-auto">
									<ul class="list-inline font-12">
										<li><i class="fa fa-circle text-cyan"></i> Продажа</li>
										<li><i class="fa fa-circle text-primary"></i> Аренда</li>
										<li><i class="fa fa-circle text-purple"></i> Все</li>
									</ul>
								</div>
							</div>
							<div id="morris-bar-chart" style="height:352px;"></div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="row">
						<div class="col-md-12">
							<div class="card m-b-15">
								<div class="card-body">
									<h5 class="card-title">ПРОДАЖА НЕДВИЖИМОСТИ</h5>
									<div class="row">
										<div class="col-6 m-t-30">
											<h1 class="text-info">9000 TMT</h1>
											<p class="text-muted">АПРЕЛЬ 2017</p> <b>(150 продажи)</b> </div>
										<div class="col-6">
											<div id="sparkline2dash" class="text-right"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card bg-purple m-b-15">
								<div class="card-body">
									<h5 class="text-white card-title">НЕДВИЖИМОСТЬ В АРЕНДУ</h5>
									<div class="row">
										<div class="col-6 m-t-30">
											<h1 class="text-white">8500 TMT</h1>
											<p class="text-white">APRIL 2017</p> <b class="text-white">(110 продаж)</b> </div>
										<div class="col-md-6 col-sm-6 col-6">
											<div id="sales1" class="text-right"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>								
			<!-- Comment - table -->
			
			<!-- row -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">ОЖИДАЮЩИЕ ЗАПРОСЫ ДЛЯ ОБЪЯВЛЕНИЯ</h5>
							<div class="table-responsive">
								<table class="table product-overview">
									<thead>
										<tr>
											<th>Объект</th>
											<th>Клиент</th>
											<th>Фото</th>
											<th>Свойство</th>
											<th>Тип сделки</th>
											<th>Дата Подачи Объявления</th>
											<th>Статус</th>
											<th>Действия</th>
										</tr>
									</thead>
									<tbody>
									@foreach($pending_properties as $property)
										<tr>
											<td><a href="{{route('property.admin.description',['id' => $property->id])}}">{{$property->title}}</a></td>
											<td>{{$property->profile->first_name}} {{$property->last_name}}</td>
											<td> <img src="/{{ $property->profile->avatar}}" alt="iMac" width="50" height="50" style="border-radius: 50%"> </td>
											<td>{{$property->type->name}}</td>
											<td>{{$property->saleOrRent ? 'Продажа' : 'Аренда'}}</td>
											<td>{{$property->created_at->diffForHumans()}}</td>
											<td> <span class="label label-success font-weight-100">Оплаченный</span> </td>
											<td><a href="{{route('approve.property',['id' => $property->id])}}" class="text-dark p-r-10" data-toggle="tooltip" title="Подтвердить"><i style="font-size: 20px" class="ti-plus"></i></a> <a href="{{route('delete.property',['id' => $property->id])}}" class="text-dark" title="Удалить" data-toggle="tooltip"><i style="font-size: 20px" class="ti-trash"></i></a></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<!-- End Comment - chats -->
			<!-- Over Visitor, Our income , slaes different and  sales prediction -->
			<!-- .row  -->
			<div class="row">
				<div class="col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-sm-12 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">ПОСЛЕДНИЕ ОБЪЯВЛЕНИЯ</h5>
							@foreach($recent_properties as $property)
								<div class="d-flex no-block m-b-20 m-t-30">
									<div class="p-r-15">
										<a href="javascript:void(0)"><img src="{{$property->img}}" alt="property" width="100"></a>
									</div>
									<div>
										<h5 class="card-title m-b-5"><a href="javascript:void(0)" class="link">{{$property->address}}</a></h5>
										<span class="text-muted">{{date('d M Y',strtotime($property->created_at))}} | {{$property->profile->first_name}} {{$property->last_name}}</span>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-uppercase">Число зарег.пользователей</h5>
							<div class="d-flex align-items-center no-block m-t-20 m-b-10">
								<h1><i class="icon-tag text-dark"></i></h1>
								<div class="ml-auto">
									<h1 class="text-muted">{{App\User::where('agent', 0)->count()}}</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-uppercase">Число посещений</h5>
							<div class="d-flex align-items-center no-block m-t-20 m-b-10">
								<h1><i class="icon-tag text-success"></i></h1>
								<div class="ml-auto">
									<h1 class="text-muted">{{DB::table('visitlogs')->count()}}</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row  -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="card-title">УВЕДОМЛЕНИЕ</div>							
							@if( $cnt_notifs > 0 )
								@foreach( $notifications as $notification )
									@php $msg = explode("|", $notification->message); @endphp
									<table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-minimap>
										<thead class="bg-dark text-white">
											<tr>
												<th scope="col" data-tablesaw-priority="persist">Пользователь</th>
												<th scope="col">Сообщение</th>
												<th scope="col">Дата</th>
												<th class="text-center" scope="col">Действие</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="title">
													<label class="inbox-user">{{$notification->username}}</label>
												</td>
												<td class="inbox-msg">
													<a href="#">
														<b>{{$notification->title}}</b> - {{$msg[1]}}
													</a>
												</td>
												<td><small>{{date('d M Y',strtotime($notification->created_at))}}</small></td>
												<td class="text-center">
													<button class="btn btn-danger delNotif" data-id="{{$notification->id}}"><i class="fa fa-trash-o fa-lg"></i></button>
												</td>
											</tr>
										</tbody>
									</table>
								@endforeach
							@else
								<p>Уведомления пока нет.</p>
							@endif
						</div>
					</div>
				</div>
			</div>
			<!-- End Page Content -->
		</div>
		<!-- End Container fluid  -->
	</div>
	<!-- End Page wrapper  -->
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

	<!-- Page plugins -->
    <!--morris JavaScript -->
    <script src="{{ asset('js/dashboard/raphael-min.js') }}"></script>
    <script src="{{ asset('js/dashboard/morris.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.sparkline.min.js') }}"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('js/dashboard/jquery.toast.js') }}"></script>
    <!-- Chart JS -->
	<script src="{{ asset('js/dashboard/dashboard1.js') }}"></script>
	<!-- jQuery peity -->
    <script src="{{ asset('js/dashboard/tablesaw.js') }}"></script>
    <script src="{{ asset('js/dashboard/tablesaw-init.js') }}"></script>
@endsection