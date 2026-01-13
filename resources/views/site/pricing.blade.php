@extends('layouts.front')
@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-top: 9%">
                    <div class="banner_area">
                        <h3 class="page_title">{{__('messages.pricing')}}</h3>
                        <div class="page_location">
                            <a href="{{route('index')}}">{{__('messages.home')}}</a>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span>{{__('messages.pricing')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Start Pricing Plans -->
    <section id="pricing">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-row">
                        <h3 class="section_title_blue">{{__('messages.our')}} {{__('messages.plans')}}</h3>
                        <div class="sub-title">
                            {{--<p>Pellentesque porttitor dolor natoque pretium. Scelerisque Quisque, vel curabitur lobortis potenti primis praesent volutpat mi nonummy faucibus tempor consequat vulputate.</p>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="common-plan">
                        <span>Basic</span>
                        <div class="price">$0.00</div>
                        <p>Free subscribe for 30 days and we’ll list your property for customer search</p>
                        <ul class="features">
                            <li>Single Property Listing</li>
                            <li>30 Days Available / One time</li>
                            <li>One User Access</li>
                            <li>Email support available</li>
                            <li>No transacti help</li>
                        </ul>
                        <a href="#" class="btn btn-default">Get Started</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="feature-plan">
                        <span>Pro</span>
                        <div class="price">$29.99</div>
                        <p>Subscribe for 1 year property listing and keep your property top of the search list.</p>
                        <ul class="features">
                            <li>Unlimited Property Listing</li>
                            <li>1 Year Available</li>
                            <li>Unlimited User Access</li>
                            <li>Live Support 24/7 Days</li>
                            <li>Any type Transacti Facility and Help</li>
                            <li>Top Listing On Search</li>
                            <li>Suggest People and Advartisement</li>
                        </ul>
                        <a href="#" class="btn btn-default">Get Started</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="common-plan">
                        <span>Standard</span>
                        <div class="price">$9.99</div>
                        <p>Free subscribe for 30 days and we’ll list your property for customer search</p>
                        <ul class="features">
                            <li>Unlimited Property Listing</li>
                            <li>6 Month Available</li>
                            <li>One User Access</li>
                            <li>Live Support 24/7 Days</li>
                            <li>Any type Transacti Facility and Help</li>
                        </ul>
                        <a href="#" class="btn btn-default">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Plans -->
@endsection