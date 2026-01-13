@extends('layouts.front')

@section('content')    
    <!-- Banner Section End -->
    <section class="login-box">
        <!-- Modal -->
        @if(Session::has('verify'))
            <div class="alert alert-danger verify">
                {{Session::get('verify')}}
            </div>
        @endif
        <div id="myModal_two">
            <div class="modal-dialog toggle_area" role="document">
                <div class="modal-header toggle_header">
                    <h4 class="inner-title">{{__('messages.login1')}}</h4>
                </div>
                <div class="modal-body login_body">
                    <p>{{__('messages.welcome')}}</p>
                    <div class="login_option">
                        <form class="signin" action="{{url('/login')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('email') ? '  has-error' : '' }}">
                                <input type="email" name="email" class="form-control input_1" placeholder="{{__('messages.email_address')}}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" class="form-control input_1" placeholder="{{__('messages.password')}}">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-default">{{__('messages.login')}}</button>
                            </div>
                        </form>
                        <div class="submit_area m-t-20"><span class="m-l-5">{{__('messages.lost_password')}} <a class="forgot_pass_a" href="{{url('/password/reset')}}">{{__('messages.click_here')}}</a></span></div>
                        <div class="orLine">
                            <span class="side_or_line"></span>
                            <span class="or_txt">&nbsp;&nbsp;{{__('messages.or')}}&nbsp;&nbsp;</span>
                            <span class="side_or_line"></span>
                        </div>
                        <a style="margin-top: 5%;border-radius:0" href="{{route('register.google')}}" class="btn btn-success1"><i class="fa spec_google"></i> {{ __('messages.google_login') }}</a>
                    </div>                    
                </div>
                <div class="modal-footer"><span>{{__('messages.click_and_read_our_terms_and_condition')}}<a href="#">{{__('messages.terms_and_condition')}}</a></span></div>
            </div>
        </div>
    </section>
    <!-- End Modules and Popup -->
@endsection

