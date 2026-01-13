@extends('layouts.front')
@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="page_location">
                <a href="{{route('index')}}">{{__('messages.home')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span>{{__('messages.contacts')}}</span>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="p-t-10">
        <div class="container">
            <h2 class="section_title_blue first_cap">{{__('messages.get')}} <span class="prim_txt_color">{{__('messages.in_touch')}}</span></h2>
            <div class="row">
                <div class="col-md-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="contact_area">                        
                        <form id="contact-form" class="contact_message" action="{{route('mail.send')}}" method="post" novalidate="novalidate">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6{{$errors->has('firstname') ? ' has-error' : ''}}">
                                    <input class="form-control" id="firstname" type="text" name="firstname" placeholder="{{__('messages.first_name')}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-6{{$errors->has('lastname') ? ' has-error' : ''}}">
                                    <input class="form-control" id="lastname" type="text" name="lastname" placeholder="{{__('messages.last_name')}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-6{{$errors->has('email') ? ' has-error' : ''}}">
                                    <input class="form-control" id="email" type="text" name="email" placeholder="{{__('messages.email_address')}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-6{{$errors->has('subject') ? ' has-error' : ''}}">
                                    <input class="form-control" id="subject" type="text" name="subject" placeholder="{{__('messages.subject')}}">
                                </div>
                                <div class="form-group col-md-12 col-sm-12{{$errors->has('message') ? ' has-error' : ''}}">
                                    <textarea class="form-control" id="message" name="message" placeholder="{{__('messages.message')}}"></textarea>
                                </div>
                                <div class="form-group col-md-12 col-sm-12">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                                <br>
                                <div class="form-group col-md-12 col-sm-12 m-t-20">
                                    <input id="send" class="btn btn-default" type="submit" value="{{__('messages.send')}}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 t_m-t-80">
                    <div class="row">
                        <div class="col-lg-6 col-md-7">
                            <div class="contact_right">
                                <h5 class="inner-title">{{__('messages.office_address')}}</h5>
                                <p>{{$settings->contact_address}}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="contact_right">
                                <h5 class="inner-title">{{__('messages.contacts')}}</h5>
                                <ul class="contact_phone">
                                    @if( $settings->contact_phone )
                                        <li>{{ $settings->contact_phone}}<span class="t_show">,&nbsp;&nbsp;</span></li>    
                                    @endif
                                    @if( $settings->contact_phone1 )
                                        <li>{{ $settings->contact_phone1}}<span class="t_show">,&nbsp;&nbsp;</span></li>
                                    @endif
                                    @if( $settings->contact_phone2 )
                                        <li>{{ $settings->contact_phone2}}</li>
                                    @endif
                                    <br class="t_show">
                                    <li class="m-t-5">
                                        <a class="mail_btn" href="mailto:{{$settings->contact_email}}?subject=Real Estate контактная форма:"><b>{{$settings->contact_email}}</b></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="contact_map">
                        <div id="map" class="map-canvas"> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
@section('scripts')
    <script>
        function initMap(){
            var mapOptions = {
                zoom: 9,
                center: new google.maps.LatLng(37.901097, 58.362191),
                styles: [{"featureType":"water","elementType":"all","stylers":[{"hue":"#76aee3"},{"saturation":38},{"lightness":-11},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#8dc749"},{"saturation":-47},{"lightness":-17},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#c6e3a4"},{"saturation":17},{"lightness":-2},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#cccccc"},{"saturation":-100},{"lightness":13},{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"hue":"#5f5855"},{"saturation":6},{"lightness":-31},{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[]}] 
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(37.901097, 58.362191),
                map: map,
                icon: '{{ asset($settings->map_icon) }}',
                title: '{{ $settings->map_tag }}'
        });}
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-XXXXX-Y', 'auto');
            ga('send', 'pageview');
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=mykey&callback=initMap" async defer></script>    
@endsection