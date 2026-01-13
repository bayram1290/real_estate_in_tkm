@extends('layouts.front')

@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-top: 9%;">
                    <div class="banner_area">
                        <h3 class="page_title">{{__('messages.register')}}</h3>
                        <div class="page_location">
                            <a href="{{route('index')}}">{{__('messages.home')}}</a>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span>{{__('messages.register')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <section class="reg_popup">
        <!-- Modal -->
        <div id="myModal">
            <div class="modal-dialog toggle_area" role="document">
                <div class="modal-header toggle_header">
                    <h4 class="inner-title">{{__('messages.create_account')}}</h4>
                </div>
                <div class="modal-body">
                    <form class="registation" action="{{url('/register')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{--<div class="radio_option">--}}
                            {{--<input type="radio" name="role" value="user" checked>--}}
                            {{--<label>General User</label>--}}
                            {{--<input type="radio" name="role" value="agent">--}}
                            {{--<label>Agent</label>--}}
                        {{--</div>--}}
                        <div class="signup_option">
                            <div class="form-group{{$errors->has('name') ? ' has-error' : ''}}">
                                <input type="text" class="form-control input_1"
                                       value="{{isset($user) ? $user->name . $user->last_name : old('name')}}"
                                       name="name" placeholder="{{__('messages.nickname')}}" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('first_name') ? ' has-error' : ''}}">
                                <input type="text" class="form-control input_1" name="first_name"
                                       value="{{isset($user) ? $user->name : old('first_name')}}"
                                       placeholder="{{__('messages.first_name')}}" required>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('last_name') ? ' has-error' : ''}}">
                                <input type="text" class="form-control input_1" name="last_name"
                                       value="{{isset($user) ? $user->last_name : old('last_name')}}"
                                       placeholder="{{__('messages.last_name')}}" required>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('avatar') ? ' has-error' : ''}}">
                                <input type="file" class="form-control input_1" name="avatar">
                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                                <input type="email" class="form-control input_1" name="email"
                                       value="{{isset($user) ? $user->email : old('email')}}"
                                       placeholder="{{__('messages.email_address')}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('phone') ? ' has-error' : ''}}">
                                <input type="text" class="form-control input_1" id="phone" name="phone" placeholder="{{__('messages.phone_number')}}" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('add_phone') ? ' has-error' : ''}}">
                                <input type="text" class="form-control input_1" id="phone2" name="add_phone" placeholder="{{__('messages.add_phone_number')}}">
                                @if ($errors->has('add_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('add_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" class="form-control input_1" name="password" placeholder="{{__('messages.password')}}" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input_1" name="password_confirmation" placeholder="{{__('messages.confirm_password')}}" required>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--{!! NoCaptcha::renderJs() !!}--}}
                                {{--{!! NoCaptcha::display() !!}--}}
                                {{--@if ($errors->has('g-recaptcha-response'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        </div>
                        <div class="submit_area">
                            <button type="submit" name="submit" class="btn btn-default">{{__('messages.sign_up')}}</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"> <span>{{__('messages.click_and_read_our_terms_and_condition')}}<a href="#">{{__('messages.terms_and_condition')}}</a></span> </div>
            </div>
        </div>
    </section>
    <!-- End Modules and Popup -->
@endsection
@section('scripts')
    <script src="/js/mask.js"></script>
@endsection
