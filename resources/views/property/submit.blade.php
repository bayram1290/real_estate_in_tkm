@extends('layouts.front')
@section('style')
    <style>
        img{
            width: auto;
        }
    </style>
@endsection
@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-top: 9%">
                    <div class="banner_area">
                        <h3 class="page_title">{{__('messages.submit_property')}}</h3>
                        <div class="page_location">
                            <a href="{{route('index')}}">{{__('messages.home')}}</a>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                            <span>{{__('messages.submit_property')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->
    <section id="submit_property">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="/submit-property" method="post" class="submit_form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="basic_information">
                            <h4 class="inner-title">{{__('messages.basic_information')}}</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="{{__('messages.property_title')}}" name="title" value="{{old('title')}}" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="0">{{__('messages.rent')}}</option>
                                        <option value="1">{{__('messages.sale')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select name="type" id="type_select" class="form-control" required>
                                        @if(isset($types_ru))
                                            @foreach($types_ru as $type)
                                                <option value="{{$type->id}}">{{$type->name_ru}}</option>
                                            @endforeach
                                        @elseif(isset($types_en))
                                            @foreach($types_en as $type)
                                                <option value="{{$type->id}}">{{$type->name_en}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select name="object" id="object_select" class="form-control" required>
                                        @if(isset($objects_ru))
                                            @foreach($objects_ru as $object)
                                                <option id="{{$object->type_id}}" value="{{$object->id}}">{{$object->name_ru}}</option>
                                            @endforeach
                                        @elseif(isset($objects_en))
                                            @foreach($objects_en as $object)
                                                <option id="{{$object->type_id}}" value="{{$object->id}}">{{$object->name_en}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" placeholder="{{__('messages.area_m')}}" name="area" value="{{old('area')}}" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" placeholder="{{__('messages.price_m')}}" name="price" value="{{old('price')}}" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" placeholder="{{__('messages.number_of_rooms')}}" name="rooms" value="{{old('rooms')}}" class="form-control" required>
                                </div>
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="important_facts">--}}
                                        {{--<label>Do you have any installment system for payment?</label>--}}
                                        {{--<div class="radio_check">--}}
                                            {{--<input type="checkbox" id="radio_1" name="question" value="Yes">--}}
                                            {{--<label for="radio_1"><span>No</span><span>Yes</span></label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="important_facts">--}}
                                        {{--<label>Have any insurance of this property?</label>--}}
                                        {{--<div class="radio_check">--}}
                                            {{--<input type="checkbox" id="radio_2" name="question" value="Yes">--}}
                                            {{--<label for="radio_2"><span>No</span><span>Yes</span></label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="important_facts">--}}
                                        {{--<label>Is there any labilities of third party with this property?</label>--}}
                                        {{--<div class="radio_check">--}}
                                            {{--<input type="checkbox" id="radio_3" name="question" value="Yes">--}}
                                            {{--<label for="radio_3"><span>No</span><span>Yes</span></label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="alert alert-warning">{{__('messages.please_input')}}</div>
                        </div>
                        <div class="basic_information" id="living_inforamtion">
                            <h4 class="inner-title">Об Объекте</h4>
                            <div class="row">

                                <div class="col-md-4 col-sm-12">
                                    <input type="number" placeholder="Этаж" name="floor" value="{{old('floor')}}" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <input type="number" placeholder="Этажей в доме" name="floors_in_home" value="{{old('floor')}}" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <input type="number" placeholder="Сколько санузлов" name="toilets" value="{{old('toilets')}}" class="form-control" required>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select name="repair" id="repair" class="form-control" required>
                                        <option disabled selected>Ремонт</option>
                                        <option value="0">Кометический</option>
                                        <option value="1">Евро</option>
                                        <option value="2">Дизайнерский</option>
                                        <option value="3">Без ремонта</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select name="type_property" id="type_property" class="form-control" required>
                                        <option disabled selected>{{__('messages.type_of_properties')}}</option>
                                        @foreach($type_properties as $type)
                                            <option value="{{$type->id}}">{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select name="toilet_type" id="toilet_type" class="form-control" required>
                                        <option value="0">Совмещенный санузел</option>
                                        <option value="1">Разделенный санузел</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <input class="form-control" type="number" name="pass_lift" placeholder="Пассаржиский лифт">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <input class="form-control" type="number" name="service_lift" placeholder="Грузовой лифт">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <select class="form-control" name="balcony" id="balcony" style="height: 46px;">
                                        <option selected disabled>Балкон</option>
                                        <option value="1">Есть</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                            <div class="alert alert-warning">{{__('messages.please_input')}}</div>
                        </div>
                        <div class="description">
                            <h4 class="inner-title">{{__('messages.description')}}</h4>
                            <textarea name="description" placeholder="Type Description..." class="form_description" required>{{old('description')}}</textarea>
                            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
                        </div>
                        <div class="property_location">
                            <h4 class="inner-title">{{__('messages.property_location')}}</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <select class="form-control" name="velayat" id="velayat_select">
                                                <option id="all_vel" disabled selected>{{__('messages.all_velayats')}}</option>
                                                @foreach($velayats as $velayat)
                                                    <option value="{{$velayat->id}}">{{$velayat->velayat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <select class="form-control" name="city" style="height: 46px" id="city_select">
                                                <option disabled selected>{{__('messages.all_cities')}}</option>
                                                @foreach($cities as $city)
                                                    <option id="{{$city->velayat_id}}" value="{{$city->id}}">{{$city->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            <input type="text" name="address" value="{{old('address')}}" placeholder="{{__('messages.property_address')}}" class="form-control" required>
                                        </div>
                                        {{--<div class="col-md-6 col-sm-6">--}}
                                            {{--<input type="text" placeholder="State" class="form-control">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4 col-sm-4">--}}
                                            {{--<input type="text" placeholder="Zip Code" class="form-control">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4 col-sm-6">--}}
                                            {{--<select class="selectpicker form-control" data-live-search="true">--}}
                                                {{--<option>Selcet Country</option>--}}
                                                {{--<option>USA</option>--}}
                                                {{--<option>Germany</option>--}}
                                                {{--<option>Netherland</option>--}}
                                                {{--<option>France</option>--}}
                                                {{--<option>England</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="check_feature">
                            <h4 class="inner-title">Доп. информация об объекте</h4>
                            <div class="row">
                                <div class="check_submit">
                                    <ul>
                                            @if(isset($features_ru))
                                                @foreach($features_ru as $feature)
                                                    <li>
                                                        <input id="feature_{{$feature->id}}" type="checkbox" name="features[]" value="{{$feature->id}}" class="submit_checkbox">
                                                        <label for="feature_{{$feature->id}}"></label>
                                                        <span>{{$feature->feature_ru}}</span>
                                                    </li>
                                                @endforeach
                                            @elseif(isset($features_en))
                                                @foreach($features_en as $feature)
                                                    <li>
                                                        <input id="feature_{{$feature->id}}" type="checkbox" name="features[]" value="{{$feature->id}}" class="submit_checkbox">
                                                        <label for="feature_{{$feature->id}}"></label>
                                                        <span>{{$feature->feature_en}}</span>
                                                    </li>
                                                @endforeach
                                            @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-warning">Check the extra features and facility of the property, it will show with the property.</div>
                        </div>
                        <div class="upload_media">
                            <h4 class="inner-title">{{__('messages.upload_photo')}}</h4>
                            <p>Felis etiam erat curabitur bibendum iaculis quisque placerat egestas. Nullam, lacus dis et consectetuer rhoncus etiam. Non vitae turpis curae; lacus sociosqu. Quisque. Lobortis aliquam penatibus mi. </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="browse_submit fileupload-example-label" style="position: relative">
                                        {{--<span>add photos</span>--}}
                                        <input name="img[]" type="file" id="fileupload-example-1" multiple required/>
                                        <label id="label" for="fileupload-example-1">{{__('messages.click_for_upload')}}</label>
                                        {{--<span>File Upload1</span>--}}
                                        {{--<input type="file" id="input-file-now" class="dropify" multiple required/>--}}
                                        {{--<label for="input-file-now">Your so fresh input file — Default version</label>--}}
                                    </div>
                                </div>
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="browse_submit">--}}
                                        {{--<span>add documents</span>--}}
                                        {{--<input type="file" id="fileupload-example-2"/>--}}
                                        {{--<label class="fileupload-example-label" for="fileupload-example-2">Drop your document file here or Click</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<div class="video_upload">--}}
                                        {{--<input type="url" placeholder="Add property video links or URL" class="form-control">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <div class="alert alert-warning">Please uplaod the photo of the property, please keep the photo size 760X410 ratio and please upload the PDF or Doc file at the document attachment.</div>
                        </div>
                        <h4 class="inner-title">{{__('messages.pin_location')}}</h4>
                        <div id="map" style="height: 400px; width: 100%;"></div>
                        <div class="property_owner">
                            {{--<h4 class="inner-title">Input Contact Details</h4>--}}
                            {{--<p>Felis etiam erat curabitur bibendum iaculis quisque placerat egestas. Nullam, lacus dis et consectetuer rhoncus etiam. Non vitae turpis curae; lacus sociosqu. Quisque. Lobortis aliquam penatibus mi. </p>--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<input type="text" placeholder="Full Name" class="form-control">--}}
                                {{--</div>--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<input type="email" placeholder="Email Address" class="form-control">--}}
                                {{--</div>--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<input type="text" placeholder="Phone Number" class="form-control">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">
                            <div class="browse_submit">
                                <button name="submit" class="btn btn-default">submit property</button>
                                <p><span>note</span> : Your property will under review for 24 Hours after submission *</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    {{--<script src="/js/dashboard/dropify.min.js"></script>--}}
    <script>
        function addNewStyle(newStyle) {
            var styleElement = document.getElementById('styles_js');
            if (!styleElement) {
                styleElement = document.createElement('style');
                styleElement.type = 'text/css';
                styleElement.id = 'styles_js';
                document.getElementsByTagName('head')[0].appendChild(styleElement);
            }
            styleElement.appendChild(document.createTextNode(newStyle));
        }

        function readURL(input) {

            if (input.files && input.files[0]) {
                for (let i = 0; i < input.files.length; i++) { //for multiple files
                    (function (file) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            const div = document.querySelector('.browse_submit');
                            const label = document.querySelector('#label');
                            let num = i * 200;
                            let num_str = num.toString();

                            console.log(num_str);
                            img.style.position = 'absolute';
                            img.style.top = 0;
                            img.style.left = `${num_str}px`;
                            //console.log(img.style.left);
                            img.id = 'img';
                            addNewStyle('#img {width:200px !important;}');
                            img.height = 100;
                            img.src = e.target.result;

                            div.insertBefore(img, label);
                        };
                        // reader.readAsText(file, "UTF-8");
                        reader.readAsDataURL(file);
                    })(input.files[i]);
                }
            }
        }

        $("#fileupload-example-1").change(function() {
            readURL(this);
        });
    </script>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {lat: 37.9601, lng: 58.3261},
                styles: [{"featureType":"water","elementType":"all","stylers":[{"hue":"#76aee3"},{"saturation":38},{"lightness":-11},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#8dc749"},{"saturation":-47},{"lightness":-17},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#c6e3a4"},{"saturation":17},{"lightness":-2},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#cccccc"},{"saturation":-100},{"lightness":13},{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"hue":"#5f5855"},{"saturation":6},{"lightness":-31},{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[]}]
            });

            var marker = new google.maps.Marker({
                position: map.center,
                map: map,
                draggable:true,
                icon: 'http://unicoderbd.com/theme/html/uniland/img/marker_blue.png'
            });

            function setMapOnAll(map) {
                marker.setMap(map);
            }

            map.addListener('click', function(e) {
                setMapOnAll(null);
                document.getElementById('lat').value = e.latLng.lat();
                document.getElementById('lng').value = e.latLng.lng();
                placeMarkerAndPanTo(e.latLng, map);
            });
        }

        function placeMarkerAndPanTo(latLng, map) {
            var marker = new google.maps.Marker({
                position: latLng,
                map: map,
                icon: 'http://unicoderbd.com/theme/html/uniland/img/marker_blue.png'
            });
            function setMapOnAll(map) {
                marker.setMap(map);
            }
            map.addListener('click', function(e) {
                setMapOnAll(null);
                document.getElementById('lat').value = e.latLng.lat();
                document.getElementById('lng').value = e.latLng.lng();
                placeMarkerAndPanTo(e.latLng, map);
            });
            map.panTo(latLng);
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=mykey&callback=initMap">
    </script>
@endsection