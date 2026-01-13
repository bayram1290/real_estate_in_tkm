@extends('layouts.front')
@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="page_location">
                <a href="{{route('index')}}">{{__('messages.home')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="it_cap">{{__('messages.change_password')}}</span>
            </div>
            <h3 class="page_title m-b-0">{{__('messages.change_password')}}</h3>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Profile Setting Start -->
    <section id="profile_setting">
        <div class="container">
            <div class="row">
                @include('layouts.profile')
                <div class="col-md-8 col-sm-12">
                    <div class="row">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="col-md-8 col-sm-8">
                            <h4 class="inner-title">{{__('messages.chng_pass')}}</h4>
                            <form class="submit_form" action="{{route('changePassword')}}" method="post">
                                {{csrf_field()}}
                                <div class="change_password">
                                    <div class="form-group">
                                        <input type="password" id="current-password" name="current-password" class="form-control white_form" placeholder="{{__('messages.curr_pass')}}" required>
                                    </div>
                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-group {{ $errors->has('new-password') ? ' has-error' : '' }}">
                                        <input type="password" name="new-password" id="new-password" class="form-control white_form" placeholder="{{__('messages.new_pass')}}" required>
                                    </div>
                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif
                                    <div class="form-group">
                                        <input type="password" name="new-password_confirmation" id="new-password-confirm" class="form-control white_form" placeholder="{{__('messages.new_pass_again')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <input id="send" class="btn btn-default" value="{{__('messages.save_changes')}}" type="submit">
                                    </div>
                                    <div class="alert alert-warning">{{__('messages.pass_cond')}}</div>
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