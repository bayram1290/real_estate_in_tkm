@extends('layouts.front')

@section('content')
	<!-- Banner Section Start -->
	<section id="banner">
		<div class="container">
			<div class="page_location">
				<a href="{{route('index')}}">{{__('messages.home')}}</a>
				<i class="fa fa-angle-right" aria-hidden="true"></i>
				<span class="it_cap">{{__('messages.my_profile')}}</span>
			</div>
			<h3 class="page_title m-b-0">{{__('messages.my_profile')}}</h3>
		</div>
	</section>
	<!-- Banner Section End -->

	<!-- Profile Setting Start -->
	<section id="profile_setting">
		<div class="container">
			<div class="row">
				@include('layouts.profile')
				<div class="col-md-8 col-sm-12 prof_back">						
					<div class="row">
						<div class="col-md-4 col-sm-12 prof_side_info">							
							<div class="prifile_picture">
								<form class="avata-form" action="{{route('profile.image.edit')}}" method="post" enctype="multipart/form-data">
									{{csrf_field()}}
									<img src="{{$profile->avatar}}" alt="" />
									<input type="file" name="user_image" id="avata-upload">
									<label class="avata-edit" for="avata-upload"><i class="flaticon-tool-1"></i></label>
								</form>
							</div>
							<div class="avata-info">
								<span>{{__('messages.first_name')}}</span> {{$profile->first_name}} {{$profile->last_name}}({{$user->name}})</div>
							<div class="avata-info">
								<span>E-mail</span> {{$user->email}}</div>
							<!-- <div class="avata-info"><span>Role:</span> User</div> -->
							<div class="avata-info"><span>{{__('messages.user_status')}}</span>
								@foreach($accounts as $account)	
									@if($account->id == ($profile->agent + 1))
										@if(Config::get('app.locale') == 'ru') {{$account->type_ru}}
										@elseif(Config::get('app.locale') == 'en') {{$account->type_en}}
										@elseif(Config::get('app.locale') == 'tm') {{$account->type_tm}}
										@endif
									@endif
								@endforeach
							</div>							
						</div>
						<hr>
						<div class="col-md-8 col-sm-12">							
							<form class="profile_area" method="post" action="{{route('profile.edit.submit',['id' => Auth::id()])}}">
								{{csrf_field()}}
                                <div class="personal_infor">									
									<h4 class="inner-title">{{__('messages.personal_information')}}</h4>
									<div class="information_form">
										<div class="row">
											<div class="col-md-12">
												<label class="profile_label">{{__('messages.agent_id')}}</label>
												<input type="text" name="agentid" class="form-control cusBorRad6" placeholder="PO19281" disabled>
											</div>
											<div class="col-md-12">
												<label class="profile_label f_c">{{__('messages.your_first_name')}}</label>
												<input type="text" name="first_name" class="form-control white_form" value="{{$profile->first_name}}">
											</div>
											<div class="col-md-12">
												<label class="profile_label">{{__('messages.your_last_name')}}</label>
												<input type="text" name="last_name" class="form-control white_form" value="{{$profile->last_name}}">
											</div>
											<div class="col-md-12">
												<label class="profile_label">{{__('messages.nickname')}}</label>
												<input type="text" name="name" class="form-control white_form" value="{{$user->name}}">
											</div>
											<div class="col-md-12">
												<label class="profile_label">{{__('messages.your_email')}} :</label>
												<input type="email" name="email" class="form-control white_form" value="{{$user->email}}">
											</div>
											<div class="col-md-12">
												<label class="profile_label">{{__('messages.phone_number')}} :</label>
												<input type="tel" name="phone" class="form-control white_form" value="{{$user->phone}}">
											</div>
                                            <div class="col-md-12">
                                                <label class="profile_label">{{__('messages.add_phone_number')}} :</label>
                                                <input type="tel" name="add_phone" class="form-control white_form" value="{{$profile->add_phone}}">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="profile_label">{{__('messages.about_me')}} :</label>
                                                <textarea class="form-control white_form" name="about">{{$profile->about}}</textarea>
                                            </div>
										</div>
									</div>
								</div>								
								<div class="save_change">
									<button class="btn btn-default" type="submit">{{__('messages.save_changes')}}</button>									
								</div>
							</form>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Profile Setting End -->
@endsection
@section('scripts')
	<script>
		var ul = document.querySelectorAll('.list');
		ul.forEach(function (list) {
            list.addEventListener('click',function (e) {
                var id = e.target.getAttribute('id');
                //console.log(e.target.getAttribute('id'));
                location.href = "http://localhost/edit/" + id;
            });
        });
	</script>
    <script>
        document.getElementById('avata-upload').onchange = function (ev) {
            document.querySelector('.avata-form').submit();
        }
    </script>
@endsection