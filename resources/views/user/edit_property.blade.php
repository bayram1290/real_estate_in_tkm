@extends('layouts.front')
@section('style')
    <style>
        img {
            width: auto;
        }
    </style>
@endsection
@section('content')

    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <h3 class="page_title">{{__('messages.edit_property')}}</h3>
            <p class="add_prop_user_agreem_reminder m-b-30">
                <b class="it_cap">{{__('messages.note')}}:</b>
                {{__('messages.add_prop_reminder1')}} <a href="{{route('rules')}}"><strong>{{__('messages.user_agreement')}}</strong></a> {{__('messages.and')}} <a href="{{route('license')}}"><strong>{{__('messages.privacy_policy')}}</strong></a>
            </p>
        </div>
    </section>
    <!-- Banner Section End -->

    <section id="submit_property">
        <div class="container back_container">
            <form action="{{route('property.resubmit',['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" id="lat_db" name="lat_db" value="{{$property->lat}}">
                <input type="hidden" id="lng_db" name="lng_db" value="{{$property->lng}}">
                
                @if(!$property->saleOrRent)
                    @if($property->object_names_id == 1)
                        @include('types.edit.rent_apartments')
                    @endif

                    @if($property->object_names_id == 2)
                        @include('types.edit.rent_elite_apartments')
                    @endif

                    @if($property->object_names_id == 3)
                        @include('types.edit.rent_house')
                    @endif

                    @if($property->object_names_id == 4)
                        @include('types.edit.rent_cottage')
                    @endif

                    @if($property->object_names_id == 5)
                        @include('types.edit.rent_parthouse')
                    @endif

                    @if($property->object_names_id == 6)
                        @include('types.edit.rent_office')
                    @endif

                    @if($property->object_names_id == 7)
                        @include('types.edit.rent_building')
                    @endif

                    @if($property->object_names_id == 10)
                        @include('types.edit.rent_warehouse')
                    @endif

                    @if($property->object_names_id == 8)
                        @include('types.edit.rent_tradeplace')
                    @endif

                    @if($property->object_names_id == 11)
                        @include('types.edit.rent_bussiness')
                    @endif
                @else
                    @if($property->object_names_id == 1)
                        @include('types.edit.sale_apartment')
                    @endif

                    @if($property->object_names_id == 2)
                        @include('types.edit.sale_elite_apartments')
                    @endif

                    @if($property->object_names_id == 3)
                        @include('types.edit.sale_house')
                    @endif

                    @if($property->object_names_id == 4)
                        @include('types.edit.sale_cottage')
                    @endif

                    @if($property->object_names_id == 5)
                        @include('types.edit.sale_parthouse')
                    @endif

                    @if($property->object_names_id == 6)
                        @include('types.edit.sale_office')
                    @endif

                    @if($property->object_names_id == 7)
                        @include('types.edit.sale_building')
                    @endif

                    @if($property->object_names_id == 10)
                        @include('types.edit.sale_warehouse')
                    @endif

                    @if($property->object_names_id == 8)
                        @include('types.edit.sale_tradeplace')
                    @endif

                    @if($property->object_names_id == 9)
                        @include('types.edit.sale_manufacture')
                    @endif

                    @if($property->object_names_id == 11)
                        @include('types.edit.sale_business')
                    @endif
                @endif
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        var oz_cnt = 0, oz_cnt1 = 0;

        $('.form-group .col-md-8 #rent_room').on('change', function () {
            if ($(this).val() == '1') {
                $(this).parents('.form-group').find('.cSingle').removeClass('hide').parent().find('.cMultiple').addClass('hide');
            }
            else {
                $(this).parents('.form-group').find('.cSingle').addClass('hide').parent().find('.cMultiple').removeClass('hide');
            }
        });

        $('.s_detail').on('click', function () {
            $('.ann_wrap').removeClass('hide');
            $('.s_detail').addClass('hide');
        });

        $('.anwrap .cusSpan #vent_0, .anwrap .cusSpan #vent_1, .anwrap .cusSpan #vent_2, .anwrap .cusSpan #vent_3, .anwrap .cusSpan #vent_4, .anwrap .cusSpan #vent_5, .anwrap .cusSpan #vent_6, .anwrap .cusSpan #vent_7, .anwrap .cusSpan #vent_8, .anwrap .cusSpan #cond_0, .anwrap .cusSpan #cond_1, .anwrap .cusSpan #cond_2, .anwrap .cusSpan #cond_3, .anwrap .cusSpan #cond_4, .anwrap .cusSpan #cond_5, .anwrap .cusSpan #cond_6, .anwrap .cusSpan #cond_7, .anwrap .cusSpan #cond_8, .anwrap .cusSpan #heat_0, .anwrap .cusSpan #heat_1, .anwrap .cusSpan #heat_2, .anwrap .cusSpan #heat_3, .anwrap .cusSpan #heat_4, .anwrap .cusSpan #heat_5, .anwrap .cusSpan #heat_6, .anwrap .cusSpan #heat_7, .anwrap .cusSpan #heat_8, .anwrap .cusSpan #fextin_0, .anwrap .cusSpan #fextin_1, .anwrap .cusSpan #fextin_2, .anwrap .cusSpan #fextin_3, .anwrap .cusSpan #fextin_4, .anwrap .cusSpan #fextin_5, .anwrap .cusSpan #fextin_6, .anwrap .cusSpan #fextin_7, .anwrap .cusSpan #fextin_8').mouseup(function () {
            $(this).parent().parent().find('.radOn input').prop('checked', false);
            if (!$(this).parent().find('input').is(':checked')) {
                $(this).parent().parent().find('.radOn:first input').prop('checked', true);
            }
        });

        $('.anwrap label input[name="vent_type"], .anwrap label input[name="cond_type"], .anwrap label input[name="heat_type"], .anwrap label input[name="fextin_type"]').on('change', function () {
            $(this).parent().parent().find('span input').prop('checked', true);
        });

        $('div .24_wrap').mouseup(function(){
            $(this).parent().find('div.wrap_24').find('div input').prop('disabled', true);
            if($(this).find('input').is(':checked')){ 
                $(this).parent().find('div.wrap_24').find('div input').prop('disabled', false);
            }
        });

        $('div span label.f_wrap').mouseup(function () {
            $(this).parent().parent().find('div input').addClass('pass_txt').prop('disabled', true);
            if ($(this).parent().find('input').is(':checked')) {
                $(this).parent().parent().find('div input').removeClass('pass_txt').prop('disabled', false);
            }
        });

        $('div div label.undeposit').mouseup(function () {
            $(this).parent().parent().find('div input[name="own_deposit"]').addClass('pass_txt').prop('disabled', true);
            if ($(this).parent().find('input').is(':checked')) {
                $(this).parent().parent().find('div input[name="own_deposit"]').removeClass('pass_txt').prop('disabled', false);
            }
        });

        $('div span .commis_wrap').mouseup(function () {
            $(this).parent().parent().find('input[type="number"]').val(null).prop('disabled', true).prop('required', false);
            if ($(this).parent().find('input').is(':checked')) {
                $(this).parent().parent().find('input[type="number"]').prop('disabled', false).prop('required', true);
            }

        });

        $('div span .en_free_wrap').mouseup(function () {
            $(this).parent().parent().find('div input').prop('disabled', true);
            if ($(this).parent().find('input').is(':checked')) {
                $(this).parent().parent().find('div input').prop('disabled', false);
            }
        });

        $('div div div select.poss_app').change(function () {
            // var named = $(this).attr('id').substr(0, 2);
            // if (named == 'to' || named == 'pt') {
            //     named = 'appoint';
            // } else {
            //     named = 'appoint_act';
            // }
            // var elem = '<input type="hidden" id="appoint' + oz_cnt + '" name="' + named + '[]" value="' + $(this).val() + '"/><div class="tag_spec">' + $(this).find('option:selected').text() + '<a href="javascript:void(0)" class="tag_spec_close" data-tag="appoint' + oz_cnt + '"><i class="fa fa-times-circle"></i></a></div>';
            var elem = '<input type="hidden" id="appoint' + oz_cnt + '" name="appoint[]" value="' + $(this).val() + '"/><div class="tag_spec">' + $(this).find('option:selected').text() + '<a href="javascript:void(0)" class="tag_spec_close" data-tag="appoint' + oz_cnt + '"><i class="fa fa-times-circle"></i></a></div>';
            $(this).parent().parent().parent().find('div.appoint_wrap').append(elem);
            oz_cnt += 1;
        });

        $(document).on('click', 'div div div a.tag_spec_close', function () {
            if( ($(this).parent().parent().find('input[type=hidden]').length-1)==0 ) {
                
                $(this).parents('div.appoint_wrap').prev().find('input').addClass('err_feed');
                $(this).parents('div.appoint_wrap').prev().find('div[data-tooltip]').removeClass('hide').next().removeClass('sel_err_invis');
            }
            
            var valed, targ = $(this).data('tag');
            valed = $(this).parent().parent().find('input[id="' + targ + '"]').val();
            $(this).parent().parent().find('input[id="' + targ + '"]').remove();

            if( $(this).parent().parent().parent().find('div.nbuyk_g select option:selected').val() == valed) {
                $(this).parent().parent().parent().find('div.nbuyk_g select option:selected').prop("selected", false).parent().find('option:first').prop("selected", "selected");
            }
            $(this).parent().remove();
        });

        $('input.p_appoit').on('keydown keyup keypress', function () {
            $(this).next().find('select').prop('disabled', false);
            if ($(this).val()) {
                $(this).next().find('select').prop('disabled', true);
            }
        });

        /* If apartment in debt, show the amount field in edit elite apartment property */
        $('input:radio[name="home_pur_debt"]').on('change', function(){ 
            var targ = $(this).parents('.form-group').next();
            if( $(this).val() == '1' ){
                targ.addClass('hide');
                targ.find('input').removeAttr('required');
            }else{
                targ.removeClass('hide');
                targ.find('input').prop('required', true);
            }
        });

        /* if the building is occupied for some period in single commercial, show the release date, otherwise hide the field */
        $('input:radio[name="occ_room"]').on('change', function(){
            var lease_cont = $(this).parents('.form-group').next();
            $(this).val() == '1' ? lease_cont.removeClass('hide') : lease_cont.addClass('hide');
        });

        /* Property edit form feedback checkers start */
        $('input[name="tot_area"], input[name="floor"], input[name="tot_floor"], input[name="a_build"], input[name="lArea"]').focus(function(){
            var attr = $(this).attr('required');
            if(typeof attr !== typeof undefined && attr !== false){
                $(this).removeClass('err_feed');
                $(this).next().addClass('hide').next().addClass('sel_err_invis');
            }
        }).focusout(function(){            
            var attr = $(this).attr('required');

            if(typeof attr !== typeof undefined && attr !== false) {

                if($(this).val() && checkZero($(this).val())) {
                    
                    $(this).removeClass('err_feed');

                    if( $(this).data('dcheck') == '2' ){
                        var fValue=$(this).parent().prev().prev().prev().find('input').val();

                        if( fValue && checkZero(fValue) ){ 
                            $(this).next().addClass('hide'); 
                        }else{ 
                            $(this).next().removeClass('hide'); 
                        }
                    }else if( $(this).data('dcheck') == '1' ){
                        var fValue1 = $(this).parent().next().next().next().find('input').val();

                        if(fValue1 && checkZero(fValue1)) { 
                            $(this).parent().next().next().next().find('div').addClass('hide');
                        }else{ 
                            $(this).parent().next().next().next().find('div').removeClass('hide');
                        }
                    }else{ 
                         $(this).next().addClass('hide').next().addClass('sel_err_invis');
                    }
                } else {
                    $(this).addClass('err_feed'); 
                    $(this).next().removeClass('hide').next().removeClass('sel_err_invis'); 

                }

            }
        });

        $('input[name="price"]').focus(function() {
            var attr = $(this).attr('required');

            if (typeof attr !== typeof undefined && attr !== false) {
                $(this).removeClass('err_feed');
                $(this).next().next().addClass('hide').next().addClass('sel_err_invis');
            }

        }).focusout(function() {
            var attr = $(this).attr('required');

            if (typeof attr !== typeof undefined && attr !== false){
                if($(this).val() && checkZero($(this).val())) {
                    
                    $(this).removeClass('err_feed'); 
                    $(this).next().next().addClass('hide').next().addClass('sel_err_invis');

                } else {
                    
                    $(this).addClass('err_feed'); 
                    $(this).next().next().removeClass('hide').next().removeClass('sel_err_invis'); 
                }
            }
        });
        $('input[name="rent_part"]').focus(function(){
            var attr = $(this).attr('required');
            if (typeof attr !== typeof undefined && attr !== false){
                $(this).removeClass('err_feed');
                $(this).next().addClass('hide').next().addClass('sel_err_invis');
            }
        }).focusout(function(){
            var attr = $(this).attr('required'), flag=true;
            if(typeof attr !== typeof undefined && attr !== false){

                $(this).addClass('err_feed'); 
                $(this).next().removeClass('hide').next().removeClass('sel_err_invis');;

                if($(this).val().startsWith('0.')){
                    $(this).val(parseFloat($(this).val()).toFixed(2));
                    if($(this).val()!=='0.00'){
                        $(this).removeClass('err_feed'); 
                        $(this).next().addClass('hide').next().addClass('sel_err_invis');;
                        flag = false;                        
                    }
                }else if($(this).val().endsWith('%') && ($(this).val().length < 4)){
                    var i=0, num;
                    while(i<$(this).val().length-1){
                        if(!isFinite($(this).val().substr(i,1))){flag=false;break;}
                        i++;
                    }                   
                    if(flag){
                        num = parseInt($(this).val().substr(0, $(this).val().length -1));
                        if(num > 0 && num <100){
                            $(this).removeClass('err_feed'); 
                            $(this).next().addClass('hide').next().addClass('sel_err_invis');;
                            flag = false;
                        }
                    }else{ flag=true; }
                }else if($(this).val().match(/\b\d+\/\d+\b/) && !$(this).val().startsWith('-')){
                    flag = false;
                    $(this).removeClass('err_feed'); 
                    $(this).next().addClass('hide').next().addClass('sel_err_invis');;
                }
                if(flag){ $(this).val(null); }
            }
        });
        $(document).on("focusout", "button[data-id$='tot_rooms'], button[data-id*='prepayment'], button[data-id*='t_premises'], button[data-id*='property_type'], button[data-id*='land_status'], button[data-id*='poss_appoint']", function(){
            var attr = $(this).parent().find('select').attr('required');
            if (typeof attr !== typeof undefined && attr !== false){
                $(this).removeClass('err_feed');
                $(this).parent().next().addClass('hide').next().addClass('sel_err_invis');
                if(!$(this).next().next().val()){
                    $(this).addClass('err_feed');
                    $(this).parent().next().removeClass('hide').next().removeClass('sel_err_invis');
                }
            }
        });
        $(document).on('focusout', 'button[data-id*="f_activity"]', function(){
            $(this).parent().next().addClass('hide').next().addClass('sel_err_invis');
            $(this).parent().parent().find('input[type="text"]').removeClass('err_feed');
            if($(this).parent().parent().next().find('input[type=hidden]').length==0){
                $(this).parent().parent().find('input[type="text"]').addClass('err_feed');
                $(this).parent().next().removeClass('hide').next().removeClass('sel_err_invis');
            }
        });
        $('select[name="tot_rooms"], select[name="prepayment"], select[name="t_premises"], select[name="property_type"], select[name="land_status"], select[name="t_build"]').on('change', function(){
             $(this).parent().find('button').removeClass('err_feed');
             $(this).parent().next().addClass('hide').next().addClass('sel_err_invis');
        });
        $('select[name="f_activity"]').on('change', function(){
            $(this).parent().prev().removeClass('err_feed');
            $(this).parent().next().addClass('hide').next().addClass('sel_err_invis');
        });

        $(document).on('focusout', 'button[data-id^="city_select"]', function(){
            $(this).removeClass('err_feed');
            $(this).parent().next().addClass('sel_err_invis');
            if(!$(this).next().next().val()){
                $(this).addClass('err_feed');
                $(this).parent().next().removeClass('sel_err_invis');
            }
        });
        $('select[name="city"]').on('change', function(){
            $(this).parent().find('button').removeClass('err_feed');
            $(this).parent().next().addClass('sel_err_invis');
        });

        $('input[name="address"]').focus(function(){
            $(this).removeClass('err_feed');
            $(this).next().addClass('sel_err_invis');
        }).focusout(function(){
            if($(this).val() && checkZero($(this).val())){
                $(this).removeClass('err_feed'); 
                $(this).next().addClass('sel_err_invis');
            }else{
                $(this).addClass('err_feed'); 
                $(this).next().removeClass('sel_err_invis'); 
            }
        });        
        $('input:radio[name="rent_type"]').on('change', function(){
            $(this).parent().parent().find('label').removeClass('radio_err_feed').removeClass('radio_err_feed1').find('div').addClass('hide');
        });
        $('input:radio[name="sale_type"]').on('change', function(){
            $(this).parent().parent().find('label').removeClass('radio_err_feed2').removeClass('radio_err_feed1').find('div').addClass('hide');
        }); 
        $('input#rent_p_appoit, input#sale_p_appoit').focus(function(){            
            $(this).removeClass('err_feed');
            $(this).next().next().next().addClass('hide').next().addClass('sel_err_invis');
        }).focusout(function(){
            if( $(this).parent().next().find('input[type=hidden]').length > 0 ){
                $(this).removeClass('err_feed');
                $(this).next().next().next().addClass('hide').next().addClass('sel_err_invis');
            }else{
                $(this).addClass('err_feed');
                $(this).next().next().next().removeClass('hide').next().removeClass('sel_err_invis');
            }
        });
        /* Property edit form feedback checkers end */

        function possKeyPress(e, elemt) {
            e = e || window.event;
            // var named = elemt.id.substring(0, 2);
            if (e.keyCode == 13) {
                // if (named == 'to' || named == 'pt') {
                //     named = 'ex_appoint';
                // } else {
                //     named = 'ex_appoint_act';
                // }
                elemt.parentNode.parentNode.getElementsByClassName("appoint_wrap")[0].innerHTML += '<input type="hidden" id="ex_appoint' + oz_cnt1 + '" name="ex_appoint[]" value="' + elemt.value + '"/><div class="tag_spec">' + elemt.value + '<a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint' + oz_cnt1 + '"><i class="fa fa-times-circle"></i></a></div>';
                oz_cnt1 += 1;
                return false;
            }
            return true;
        }

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
                if (input.files.length < 6) {
                    c_id = input.className.substring(10);
                    $('#fileupload' + c_id + ' img').remove();
                    for (let i = 0; i < input.files.length; i++) { //for multiple files
                        (function (file) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                img = document.createElement('img');
                                div = document.querySelector('#fileupload' + c_id);

                                label = document.querySelector('#label' + c_id);
                                let num = i * 200;
                                let num_str = num.toString();

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
                } else {
                    event.preventDefault();
                }
            }
        }

        $('.browse_submit *[class^="img_upload"]').change(function () {
            readURL(this);
        });
        function checkZero(tValue){
            var z_flag = true;
            switch(tValue){
                case '':
                case '.':
                case '.0':
                case '0.':
                case '0':
                case '0.0':
                case '.00':
                case '0.00':
                    z_flag = false;
                break;                
            }
            return z_flag;
        }

        $('.browse_submit *[class^="img_upload"]').change(function(){ readURL(this);});
    </script>

    <script>
        function initMap() {

            var marker;
            var maps;

            var lat = document.getElementById('lat_db').value;
            var lng = document.getElementById('lng_db').value;

            var map = document.querySelector('.myMap');
            var num = map.id;
            num = num.substring(4);
            var latlng = new google.maps.LatLng(lat, lng);
            map = new google.maps.Map(document.getElementById(`map_${num}`), {
                zoom: 10,
                center: latlng,
                styles: [{"featureType":"water","elementType":"all","stylers":[{"hue":"#76aee3"},{"saturation":38},{"lightness":-11},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#8dc749"},{"saturation":-47},{"lightness":-17},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#c6e3a4"},{"saturation":17},{"lightness":-2},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#cccccc"},{"saturation":-100},{"lightness":13},{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"hue":"#5f5855"},{"saturation":6},{"lightness":-31},{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[]}]
            });
            map.set('id', num);
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: '{{ asset($settings->map_icon) }}',
            });

            map.addListener('click', function (e) {
                marker.setMap(null);
                document.getElementById(`lat_${num}`).value = e.latLng.lat();
                document.getElementById(`lng_${num}`).value = e.latLng.lng();
                placeMarkerAndPanTo(e.latLng, map, num)
            });


            function placeMarkerAndPanTo(latLng, map, i) {
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: '{{ asset($settings->map_icon) }}',
                });

                function setMapOnAll(map) {
                    marker.setMap(map);
                }

                map.addListener('click', function (e) {
                    setMapOnAll(null);
                    document.getElementById(`lat_${i}`).value = e.latLng.lat();
                    document.getElementById(`lng_${i}`).value = e.latLng.lng();
                    placeMarkerAndPanTo(e.latLng, map, i);
                });
                map.panTo(latLng);
            }
        }

        function showInput() {
            const both = event.target.querySelector('input');
            const prop = event.target.id;
            if (both.value == 5) {
                const ex_input = document.getElementById(`ex_parking_spots_${prop}`);
                ex_input.style.display = 'block';
                const first_input = document.getElementById(`first-${prop}`);
                const part = first_input.innerHTML;
                first_input.innerHTML = part + ' наземной парковки';
                const second_input = document.getElementById(`second-${prop}`);
                second_input.innerHTML = part + ' подземной парковки';
            }
        }

        function hideInput() {
            const prop = event.target.id;
            const ex_input = document.getElementById(`ex_parking_spots_${prop}`);
            ex_input.style.display = 'none';
            const first_input = document.getElementById(`first-${prop}`);
            first_input.innerHTML = '{{__('messages.place_num')}}';
            const second_input = document.getElementById(`second-${prop}`);
            second_input.innerHTML = '{{__('messages.place_num')}}';
        }

        $('input[name="tot_area"], input[name="kitchen"], input[name="resid"], input[name="ceil"], input[name="a_build"], input[name="freight_cap"], input[name="telpher_cap"], input[name="passenger_cap"], input[name="cr_over_cap"], input[name="cr_beam_cap"], input[name="cr_rail_cap"], input[name="cr_gantry_cap"]').blur( function(){ 
            $(this).parseNumber({ format: "# ###.00", locale: "us" }); 
            $(this).formatNumber({format: "# ###.00", locale: "us"});
        });
        $('input[name="price"], input[name="own_deposit"], input[name="lArea"], input[name="cost"], input[name="land"], input[name="entry_cost"]').blur( function(){ 
            $(this).parseNumber({ format: "# ###.0", locale: "us" }); 
            $(this).formatNumber({format: "# ###.0", locale: "us"}); 
        });
        $('input[name="tot_area"], input[name="resid"], input[name="kitchen"], input[name="ceil"], input[name="price"], input[name="own_deposit"], input[name="lArea"], input[name="cost"], input[name="a_build"], input[name="land"], input[name="entry_cost"], input[name="freight_cap"], input[name="telpher_cap"], input[name="passenger_cap"], input[name="cr_over_cap"], input[name="cr_beam_cap"], input[name="cr_rail_cap"], input[name="cr_gantry_cap"]').on('keyup keypress blur change', function(){ 
            $(this).val($(this).val().replace(/[,]/g, ".")); 
        });
        $('input[name="floor"], input[name="tot_floor"], input[name="num_beds"], input[name="elec_pow"], [name="place_num"], input[name="min_rent"], input[name="elevs"], input[name="travs"], input[name="escals"], input[name="from_hour"], input[name="to_hour"], input[name="freight"], input[name="telpher"], input[name="passenger"], input[name="cr_over"], input[name="cr_beam"], input[name="cr_rail"], input[name="cr_gantry"]').on('keyup keypress blur change', function(){ 
            $(this).val($(this).val().replace(/[.,]/g, "")); 
        });
        $('input[name="grid"]').on('keyup change focusout', function() {
            if($(this).val().indexOf('x') > -1) {                
                var rest = $(this).val().split('x', 2);
                $(this).val(rest[0].replace(/\D/g,"")+'x'+rest[1].replace(/\D/g,""));
            }else{
                $(this).val($(this).val().replace(/\D/g,""));
            }
        });
        $('input[name="tot_area"], input[name="kitchen"], input[name="resid"], input[name="ceil"], input[name="a_build"], input[name="freight_cap"], input[name="telpher_cap"], input[name="passenger_cap"], input[name="cr_over_cap"], input[name="cr_beam_cap"], input[name="cr_rail_cap"], input[name="cr_gantry_cap"]').blur( function(){ 
            $(this).parseNumber({ format: "# ###.00", locale: "us" }); 
            $(this).formatNumber({format: "# ###.00", locale: "us"});
        });
        $('input[name="price"], input[name="own_deposit"], input[name="lArea"], input[name="cost"], input[name="land"], input[name="entry_cost"], input[name="mon_profit"]').blur( function(){ 
            $(this).parseNumber({ format: "# ###.0", locale: "us" }); 
            $(this).formatNumber({format: "# ###.0", locale: "us"}); 
        });
        $('input[name="tot_area"], input[name="resid"], input[name="kitchen"], input[name="ceil"], input[name="price"], input[name="own_deposit"], input[name="lArea"], input[name="cost"], input[name="a_build"], input[name="land"], input[name="entry_cost"], input[name="freight_cap"], input[name="telpher_cap"], input[name="passenger_cap"], input[name="cr_over_cap"], input[name="cr_beam_cap"], input[name="cr_rail_cap"], input[name="cr_gantry_cap"], input[name="mon_profit"]').on('keyup keypress blur change', function(){ 
            $(this).val($(this).val().replace(/[,]/g, ".")); 
        });
        $('input[name="floor"], input[name="tot_floor"], input[name="num_beds"], input[name="elec_pow"], [name="place_num"], input[name="min_rent"], input[name="elevs"], input[name="travs"], input[name="escals"], input[name="from_hour"], input[name="to_hour"], input[name="freight"], input[name="telpher"], input[name="passenger"], input[name="cr_over"], input[name="cr_beam"], input[name="cr_rail"], input[name="cr_gantry"]').on('keyup keypress blur change', function(){ 
            $(this).val($(this).val().replace(/[.,]/g, "")); 
        });
        $('input[name="grid"]').on('keyup change focusout', function() {
            if($(this).val().indexOf('x') > -1) {                
                var rest = $(this).val().split('x', 2);
                $(this).val(rest[0].replace(/\D/g,"")+'x'+rest[1].replace(/\D/g,""));
            }else{
                $(this).val($(this).val().replace(/\D/g,""));
            }
        });

        /* Load input field as showed if parking field is marked as both */
        $('input[name="parking"]').each(function(){
            if( $(this).attr('id') == 'both_park' && $(this).is(":checked") ){
                $(this).parent().parent().parent().next().next().removeAttr('style');
                $(this).parent().parent().parent().next().next().next().removeAttr('style');
            }
         });

        /* Function adds possible appointment from input text field in mobile version */
        $('input.p_appoit').on('keyup', function() {
            if( $(window).width() < 992 ) {
                if( $(this).val() ) {
                    $(this).parent().find('div.mob_poss_btn').removeClass('hide');
                } else {
                    $(this).parent().find('div.mob_poss_btn').addClass('hide');
                }
            }
            
        });

        $('button.mob_poss_accept').on('click', function() { 
            var elem = $(this).parent().parent().find('input');
            // var named = elem.attr('id').substring(0, 2);
            var elem_value = elem.val(); 
            // if( named=='to' || named == 'pt'){
            //     named='ex_appoint';
            // } else {
            //     named='ex_appoint_act';
            // }            
            // $(this).parent().parent().next('div.appoint_wrap').append('<input type="hidden" id="ex_appoint' + oz_cnt1 +'" name="' + named + '[]" value="' + elem_value + '"/><div class="tag_spec">' + elem_value + '<a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint' + oz_cnt1 + '"><i class="fa fa-times-circle"></i></a></div>' );
            $(this).parent().parent().next('div.appoint_wrap').append('<input type="hidden" id="ex_appoint' + oz_cnt1 +'" name="ex_appoint[]" value="' + elem_value + '"/><div class="tag_spec">' + elem_value + '<a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint' + oz_cnt1 + '"><i class="fa fa-times-circle"></i></a></div>' );
            elem.val('');
            $(this).parent().addClass('hide');
            oz_cnt1+=1;
            $(this).parent().prev().trigger("focusout");
        });

        /*Data tooltip initialization for sale type info link */
        $('a[data-toggle="tooltip"]').tooltip();
        
        /*Modal link initialization for sale type info link */
        $('a.diff_tooltip').on('click', function(){
            $.alert({
                title: "{{ __('messages.what_diff') }}",
                content: "<br><div class='text-left'><b>{{ __('messages.free1') }}</b> {{ __('messages.free1_sale_exp') }}</div><br><div class='text-left'><b>{{ __('messages.alternative') }}</b> {{ __('messages.alt_sale_exp') }}",
                animation: 'scale',
                closeAnimation: 'bottom',
                backgroundDismiss: true,
                buttons: {
                    okay: {
                        text: 'OK',
                        btnClass: 'btn-blue'
                    }
                }
            });
        });

        /* Onload page, show only cities related to the selected district */
        @if(Request::is('edit/*'))
            $('select[name="city"]').find('option').each( function() { 
                if( $(this).attr('id') == '{{ $property->velayat_id }}' ) {
                    $(this).removeClass('hide');                    
                } 
            });
        @endif
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=mykey&callback=initMap" async defer></script>    
@endsection