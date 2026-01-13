@extends('layouts.front')
@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5" style="margin-top: 9%;">
                    <div class="banner_area">
                        <h3 class="page_title mt-3">{{__('messages.policy_of_conf')}}</h3>
                        <div class="page_location">
                            <a href="{{route('index')}}">{{__('messages.home')}}</a>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span>{{__('messages.list_properties')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <section id="terms_condition">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="terms_sidebar">
                        <ul>
                            <li>
                                <a href="{{route('rules')}}">{{__('messages.rules_usage')}}</a>
                            </li>
                            <hr>
                            <li>
                                <a href="{{route('license')}}">{{__('messages.license')}}</a>
                            </li>
                            <hr>
                            <li class="active">
                                <a href="{{route('confidentiality')}}">{{__('messages.policy_of_conf')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="terms_description">
                        {!! $documents->confidentiality !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection