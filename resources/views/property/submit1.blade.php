@extends('layouts.front')
@section('style')
    <style> img{ width: auto;}</style>
@endsection
@section('content')    
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <h3 class="page_title">{{__('messages.submit_property')}}</h3>
            <p class="add_prop_user_agreem_reminder m-b-30">
                <b class="it_cap">{{__('messages.note')}}:</b>
                {{__('messages.add_prop_reminder')}} <a href="{{route('rules')}}"><strong>{{__('messages.user_agreement')}}</strong></a> {{__('messages.and')}} <a href="{{route('license')}}"><strong>{{__('messages.privacy_policy')}}</strong></a>
            </p>
        </div>
    </section>
    <!-- Banner Section End -->
    <section id="submit_property">
        <div class="container back_container">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="basic_information">
                <h4 class="inner-title">{{__('messages.type_ann')}}</h4>
            </div>
            <div class="ann_wrap">
                <div class="form-group row hide" id="account_wrap">
                    <label for="account" class="col-md-4 col-sm-4 col-xs-4 form-label1">{{ __('messages.acc_type') }}</label>
                    <div class="btn-group toGGle col-md-8 col-sm-8 col-xs-8" id="account" data-toggle="buttons">
                        @foreach($accounts as $account)
                            <label class="btn btn-primary @if($account->id=='1') cusBorRad1 @else cusBorRad2 @endif">
                                <input type="radio" name="acc_type" value="{{$account->id}}">@if(Config::get('app.locale') == 'ru') {{$account->type_ru}}
                                @elseif(Config::get('app.locale') == 'en') {{$account->type_en}}
                                @elseif(Config::get('app.locale') == 'tm') {{$account->type_tm}}
                                @endif</label>
                        @endforeach
                    </div>
                </div>                            
                <div class="form-group row" id="deal_wrap">
                    <label for="deal" class="col-md-4 col-sm-4 col-xs-4 form-label1">{{ __('messages.deal_type') }}</label>
                    <div class="btn-group toGGle col-md-8 col-sm-8 col-xs-8" id="ttdeal" data-toggle="buttons">
                        @foreach($deals as $deal)
                            <label class="btn btn-primary @if($deal->id=='1') cusBorRad1 @else cusBorRad2 @endif">
                                <input type="radio" name="deal_type" value="{{$deal->id}}" data-type="{{$deal->id}}"> 
                                @if(Config::get('app.locale') == 'ru') {{$deal->deal_ru}}
                                @elseif(Config::get('app.locale') == 'en') {{$deal->deal_en}}
                                @elseif(Config::get('app.locale') == 'tm') {{$deal->deal_tm}}
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>                            
                {{--<div class="form-group row hide" id="rent_wrap">--}}
                    {{--<label for="rent" class="col-md-4 col-sm-4 col-xs-4 form-label1">{{ __('messages.rent_type') }}</label>--}} 
                    {{--<div class="btn-group toGGle col-md-8 col-sm-8 col-xs-8" id="rent" data-toggle="buttons">--}}
                        {{--@foreach($rents as $rent)--}}
                            {{--<label class="btn btn-primary @if($rent->id=='1') cusBorRad1 @else cusBorRad2 @endif">--}}
                                {{--<input type="radio" name="rent_type" value="{{$rent->id}}" data-type="{{$rent->id}}">--}} 
                                {{--@if(Config::get('app.locale') == 'ru') {{$rent->r_type_ru}}--}}
                                {{--@elseif(Config::get('app.locale') == 'en') {{$rent->r_type_en}}--}}
                                {{--@elseif(Config::get('app.locale') == 'tm') {{$rent->r_type_tm}}--}}
                                {{--@endif--}}
                                    {{--</label>--}}
                            {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group row hide" id="estate_wrap">
                    <label for="estate" class="col-md-4 col-sm-4 col-xs-4 form-label1">{{ __('messages.estate_type') }}</label>
                    <div class="btn-group toGGle col-md-8 col-sm-8 col-xs-8 m_p-r-0" id="estate" data-toggle="buttons">
                        @foreach($estates as $estate)
                            <label class="btn btn-primary @if($estate->id=='1') cusBorRad1 @else cusBorRad2 @endif">
                                <input type="radio" name="estate_type" value="{{$estate->id}}"> 
                                @if(Config::get('app.locale') == 'ru') {{$estate->e_type_ru}}
                                @elseif(Config::get('app.locale') == 'en') {{$estate->e_type_en}}
                                @elseif(Config::get('app.locale') == 'tm') {{$estate->e_type_tm}}
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group row hide" id="object_wrap">
                    <label for="object" class="col-md-4 col-sm-4 col-xs-4 form-label1">{{ __('messages.object') }}</label>
                    <div class="btn-group toGGle col-md-8 col-sm-8 col-xs-12 p-l-0" id="object"></div>
                </div>
            </div>
            <div class="btn s_detail hide">
                <span class="col-md-8 w-auto" id="sel_ob">Rent/Sale property</span>
                <div class="col-md-3 s_detBtn">{{ __('messages.change')}}</div>
            </div>            
            <hr>
            <div class="alert-box hide"><span>{{__('messages.notice')}}: </span>
                @if(Lang::locale() == 'ru')
                    {{__('messages.notice_txt1')}} (<i class="fa fa-certificate req_icon"></i>) {{__('messages.notice_txt2')}}
                @elseif(Lang::locale() == 'en')
                    {{__('messages.notice_txt1')}} (<i class="fa fa-certificate req_icon"></i>) {{__('messages.notice_txt2')}}
                @else
                @endif
            </div>                
            @include('types.rent_apartments')
            @include('types.rent_elite_apartments')
            @include('types.rent_house')
            @include('types.rent_parthouse')
            @include('types.rent_office')
            @include('types.rent_building')
            @include('types.rent_cottage')
            @include('types.rent_tradeplace')
            @include('types.rent_warehouse')
            @include('types.rent_bussiness')            
            @include('types.sale_apartment')
            @include('types.sale_elite_apartments')            
            @include('types.sale_house')
            @include('types.sale_cottage')
            @include('types.sale_parthouse')
            @include('types.sale_office')
            @include('types.sale_building')
            @include('types.sale_tradeplace')
            @include('types.sale_manufacture')
            @include('types.sale_warehouse')
            @include('types.sale_business')
        </div>
    </section>
@endsection
@section('scripts')
    
    <script>
        var oz_cnt=0, oz_cnt1=0;

        var d_ru, d_en, d_tm, ob_ru, ob_en, ob_tm;
        d_ru = {!! json_encode($p_deals_ru) !!};
        d_en = {!! json_encode($p_deals_en) !!};
        d_tm = {!! json_encode($p_deals_tm) !!};
        ob_ru = {!! json_encode($p_objects_ru) !!};
        ob_en = {!! json_encode($p_objects_en) !!};
        ob_tm = {!! json_encode($p_objects_tm) !!};

        // $('#account').on('click',function(){
        //     $('#deal .btn input, #estate .btn input').attr('checked', false); 
        //     $('#deal .btn, #estate .btn').removeClass('active');
        //     $('#deal_wrap').removeClass('hide');
        //     $('#estate_wrap, #object_wrap').addClass('hide');
        // });

        $('input[name="deal_type"]').on('change', function(){
            $('#estate .btn input').attr('checked', false);
            $('#estate .btn').removeClass('active');
            $('#object_wrap').addClass('hide');
            $('#estate_wrap').removeClass('hide');
        });

        $('input[name="estate_type"]').on('change', function(){
            $('#object_wrap').removeClass('hide');            
            objectPreview();
            $('input[name^="object"]').on('change', function(){ 
                $('.ann_wrap').addClass('hide');
                $('.s_detail').removeClass('hide');
                sDetailPreview();
                $('.alert-box').removeClass('hide');
            });
        });

        $('.form-group .col-md-8 #rent_room').on('change', function(){
            if($(this).val()=='1'){$(this).parents('.form-group').find('.cSingle').removeClass('hide').parent().find('.cMultiple').addClass('hide');}
            else{$(this).parents('.form-group').find('.cSingle').addClass('hide').parent().find('.cMultiple').removeClass('hide');}
        });

        $('.s_detail').on('click', function(){ $('.ann_wrap').removeClass('hide'); $('.s_detail').addClass('hide');});

        $('.anwrap .pretty #vent_0, .anwrap .pretty #vent_1, .anwrap .pretty #vent_2, .anwrap .pretty #vent_3, .anwrap .pretty #vent_4, .anwrap .pretty #vent_5, .anwrap .pretty #vent_6, .anwrap .pretty #vent_7, .anwrap .pretty #vent_8, .anwrap .pretty #cond_0, .anwrap .pretty #cond_1, .anwrap .pretty #cond_2, .anwrap .pretty #cond_3, .anwrap .pretty #cond_4, .anwrap .pretty #cond_5, .anwrap .pretty #cond_6, .anwrap .pretty #cond_7, .anwrap .pretty #cond_8, .anwrap .pretty #heat_0, .anwrap .pretty #heat_1, .anwrap .pretty #heat_2, .anwrap .pretty #heat_3, .anwrap .pretty #heat_4, .anwrap .pretty #heat_5, .anwrap .pretty #heat_6, .anwrap .pretty #heat_7, .anwrap .pretty #heat_8, .anwrap .pretty #fextin_0, .anwrap .pretty #fextin_1, .anwrap .pretty #fextin_2, .anwrap .pretty #fextin_3, .anwrap .pretty #fextin_4, .anwrap .pretty #fextin_5, .anwrap .pretty #fextin_6, .anwrap .pretty #fextin_7, .anwrap .pretty #fextin_8').mouseup(function(){
            
            $(this).parent().parent().find('.radOn input').prop('checked', false);
            
            if(!$(this).parent().find('input').is(':checked')){
                $(this).parent().parent().find('.radOn:first input').prop('checked', true);
            }
        });
        
        $('.anwrap label input[name="vent_type"], .anwrap label input[name="cond_type"], .anwrap label input[name="heating"], .anwrap label input[name="fextin_type"]').on('change',function(){ 
            $(this).parent().parent().find('.pretty input[type="checkbox"]').prop('checked', true); 
        });

        $('div .24_wrap').mouseup(function(){
            $(this).parent().find('div.wrap_24').find('div input').prop('disabled', true);
            if($(this).find('input').is(':checked')){ $(this).parent().find('div.wrap_24').find('div input').prop('disabled', false);}
        });

        $('div span label.f_wrap').mouseup(function(){
            $(this).parent().parent().find('div input').addClass('pass_txt').prop('disabled', true);
            if($(this).parent().find('input').is(':checked')){$(this).parent().parent().find('div input').removeClass('pass_txt').prop('disabled', false);} 
        });

        $('div div div.undeposit').mouseup(function(){
            $(this).parent().parent().find('div input[name="own_deposit"]').addClass('pass_txt').prop('disabled', true);
            if($(this).parent().find('input').is(':checked')){$(this).parent().parent().find('div input[name="own_deposit"]').removeClass('pass_txt').prop('disabled', false);}
        });

        $('div span .commis_wrap').mouseup(function(){
            $(this).parent().parent().find('input[type="number"]').val(null).prop('disabled', true).prop('required', false);
            if($(this).parent().find('input').is(':checked')){$(this).parent().parent().find('input[type="number"]').prop('disabled', false).prop('required', true);}

        });

        $('div span .en_free_wrap').mouseup(function(){
            $(this).parent().parent().find('div input[type="number"]').prop('disabled', true);
            if($(this).parent().find('input').is(':checked')){$(this).parent().parent().find('div input').prop('disabled', false); }
        });

        $('div div div select.poss_app').change(function(){
           var elem = '<input type="hidden" id="appoint'+ oz_cnt +'" name="appoint[]" value="'+ $(this).val() +'"/><div class="tag_spec">'+ $(this).find('option:selected').text() +'<a href="javascript:void(0)" class="tag_spec_close" data-tag="appoint'+ oz_cnt +'"><i class="fa fa-times-circle"></i></a></div>';
           $(this).parent().parent().parent().find('div.appoint_wrap').append(elem); oz_cnt+=1;
                      
        });

        $(document).on('click', 'div div div a.tag_spec_close', function(){ 
            if( ($(this).parent().parent().find('input[type=hidden]').length-1) == 0 ) {
                
                $(this).parents('div.appoint_wrap').prev().find('input').addClass('err_feed');
                $(this).parents('div.appoint_wrap').prev().find('div[data-tooltip]').removeClass('hide').next().removeClass('sel_err_invis');
            }

            var valed, targ = $(this).data('tag');
            valed=$(this).parent().parent().find('input[id="'+ targ +'"]').val(); 
            $(this).parent().parent().find('input[id="'+ targ +'"]').remove();

            
            if( $(this).parent().parent().parent().find('div.nbuyk_g select option:selected').val()==valed ) {
            
                $(this).parent().parent().parent().find('div.nbuyk_g select option:selected').prop("selected", false).parent().find('option:first').prop("selected", "selected");
            }
            $(this).parent().remove();
        });

        /* If apartment in debt, show the amount field in add elite apartment property */
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

        /* Property add form feedback checkers start */
        $('input[name="tot_area"], input[name="floor"], input[name="tot_floor"], input[name="a_build"], input[name="lArea"], input[name="debt_amount"]').focus(function(){
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

                    if($(this).data('dcheck') == '2') {
                        
                        var fValue=$(this).parent().prev().prev().prev().find('input').val();

                        if( fValue && checkZero(fValue) ){ 
                            $(this).next().addClass('hide'); 
                        }else{  
                            $(this).next().removeClass('hide');  }

                    } else if($(this).data('dcheck') == '1') {
                        var fValue1 = $(this).parent().next().next().next().find('input').val();

                        if(fValue1 && checkZero(fValue1)) { 
                            $(this).parent().next().next().next().find('div').addClass('hide');
                        } else { 
                            $(this).parent().next().next().next().find('div').removeClass('hide');
                        }

                    } else { 
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

        $(document).on('focusout', 'button[data-id^="velayat_select"], button[data-id^="city_select"]', function(){
            $(this).removeClass('err_feed');
            $(this).parent().next().addClass('sel_err_invis');
            if(!$(this).next().next().val()){
                $(this).addClass('err_feed');
                $(this).parent().next().removeClass('sel_err_invis');
            }
        });
        $('select[name="velayat"], select[name="city"]').on('change', function(){
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
        /* Property add form feedback checkers end */

        /* 1 start: Function adds possible appointment from input text field in mobile version */
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
            var elem_value = elem.val(); 
            $(this).parent().parent().next('div.appoint_wrap').append('<input type="hidden" id="ex_appoint' + oz_cnt1 +'" name="ex_appoint[]" value="' + elem_value + '"/><div class="tag_spec">' + elem_value + '<a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint' + oz_cnt1 + '"><i class="fa fa-times-circle"></i></a></div>' );
            elem.val('');
            $(this).parent().addClass('hide');
            oz_cnt1+=1;
            $(this).parent().prev().trigger("focusout");
        });
        /* 1 end */

        function objectPreview(){
            $('#object').empty();
            var i, locCnt, full_list_ru, full_list_en, full_list_tm, c_11 , c_12, c_21, c_22, myList, arCode, arCnt;
            
            c_11 = [0, 1, 2, 3, 4];            
            c_12 = [5, 6, 7, 9, 10];
            c_22 = [5, 6, 7, 8, 9, 10];
            
            full_list_ru = ['Квартира', 'Элитная квартира', 'Дом/дача', 'Коттедж', 'Часть дома', 'Офис', 'Здание', 'Торговая точка', 'Производство', 'Склад', 'Готовый бизнес'];
            full_list_en = ['Apartment', 'Elite apartment', 'House/detached house', 'Cottage', 'Part of the house', 'Office', 'Building', 'Outlet point', 'Production environment', 'Warehouse', 'Ready-made business'];
            full_list_tm = ['Kwartira', 'Elitniý kwartira', 'Jaý/daça', 'Kotež', 'Jaýyň bölegi', 'Ofis', 'Bina', 'Söwda nokady', 'Önümçilik ýeri', 'Sklad', 'Taýyn biznes'];
            
            if( "{{app()->getLocale()}}"=="ru" ) { 
                myList = full_list_ru.slice();
            } else if( "{{app()->getLocale()}}"=="en" ) {
                myList = full_list_en.slice();
            } else if( "{{app()->getLocale()}}"=="tm" ) {
                myList = full_list_tm.slice();
            }

            locCnt = 0;            
            i = $('input[name=deal_type]:checked').val() + $('input[name=estate_type]:checked').val();

            switch(i){
                case '11':
                case '21':
                    arCode=c_11; arCnt=5; passArr=0;
                    break;
                case '12':
                    arCode=c_12; arCnt=5; passArr=5;
                break;                
                case '22':
                    arCode=c_22; arCnt=6; passArr=5;
                break;
            }

            $('#object').append('<div class="col-md-6 col-sm-6 col-xs-6 anWrap p-l-0"></div>');

            while( locCnt < arCnt ) {
                
                if( locCnt == 3 ) $('#object').append('<div class="col-md-6 col-sm-6 col-xs-6 anWrap myDiv2"></div>');

                if( locCnt > 2 ){ 
                    $('#object .anWrap.myDiv2').append('<label class="radOn"><input type="radio" name="object" value="' + arCode[locCnt] + '"><span class="outer"><span class="inner"></span></span>' + myList[arCode[locCnt]] + '</label>');
                } else { 
                    $('#object .anWrap').append('<label class="radOn"><input type="radio" name="object" value="' + arCode[locCnt] + '"><span class="outer"><span class="inner"></span></span>' + myList[arCode[locCnt]] + '</label>');
                }
                
                locCnt++;                
            }            
        }

        function sDetailPreview(){
            var temp_txt, rents, sales;

            rents=['ar_kv', 'ar_elite_kv', 'ar_dom', 'ar_kott', 'ar_poldom', 'ar_ofis', 'ar_zdan', 'ar_torg', '', 'ar_sklad', 'ar_biznes']; /* one empty variable is added, to be the array size equal to 10 */
            sales=['prod_kv', 'prod_elite_kv', 'prod_dom', 'prod_kott', 'prod_poldom', 'prod_ofis', 'prod_zdan', 'prod_torg', 'prod_proiz', 'prod_sklad', 'prod_biznes']

            sel_obj = $('input[name=object]:checked').val();
            sel_deal = $('input[name=deal_type]:checked').val();
            
            $('.propObj').addClass('hide');

            if( parseInt(sel_deal) === 1 ){                 
                $('.' + rents[sel_obj]).removeClass('hide');
            }else if( parseInt(sel_deal) === 2 ){
                $('.' + sales[sel_obj]).removeClass('hide');
            }

            switch("{{app()->getLocale()}}"){
                case 'ru':
                    temp_txt = d_ru[sel_deal-1] + ' ' + ob_ru[sel_obj];
                break;
                case 'en':
                    temp_txt = ob_en[sel_obj] + ' ' + d_en[sel_deal-1];
                break;
                case 'tm':
                    temp_txt = d_tm[sel_deal-1] + ' ' + ob_tm[sel_obj];                    
                break;
            }
            $('#sel_ob').text(temp_txt);
        }

        $('input.p_appoit').on( 'keydown keyup keypress', function() { 
            $(this).next().find('select').prop('disabled', false);
            
            if( $(this).val() ){ 
                $(this).next().find('select').prop('disabled', true);
            } 
                
        });

        function possKeyPress(e, elemt){
            e=e || window.event;
            if(e.keyCode==13){

                if(elemt.value){
                    elemt.parentNode.parentNode.getElementsByClassName("appoint_wrap")[0].innerHTML += '<input type="hidden" id="ex_appoint'+ oz_cnt1 +'" name="ex_appoint[]" value="'+ elemt.value +'"/><div class="tag_spec">'+ elemt.value +'<a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint'+ oz_cnt1 +'"><i class="fa fa-times-circle"></i></a></div>'; 
                    oz_cnt1+=1; 
                    return false; 
                }
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
                if(input.files.length<6){
                    c_id = input.className.substring(10);
                    $('#fileupload'+c_id+' img').remove();
                    for (let i = 0; i < input.files.length; i++) { //for multiple files
                        (function (file) {
                            var reader = new FileReader();

                            reader.onload = function (e){                                
                                img = document.createElement('img');
                                div = document.querySelector('#fileupload'+c_id);
                                
                                label = document.querySelector('#label'+c_id);
                                let num = i * 200;
                                let num_str = num.toString();

                                img.style.position = 'absolute';
                                img.style.top = 0;
                                img.style.left = `${num_str}px`;                                
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
                }else{ event.preventDefault(); }
            }
        }        

        $('.browse_submit *[class^="img_upload"]').change(function(){ readURL(this);});
    </script>

    <script>
        function initMap() {
            var lis = document.querySelectorAll(".myMap");

            var markers = [];
            var maps = [];

            for (var i = 1; i <= lis.length; i++) {
                var latlng = new google.maps.LatLng(37.9601, 58.3261);
                maps[i] = new google.maps.Map(document.getElementById(`map_${i}`), {
                    zoom: 10,
                    center: latlng,
                    styles: [{
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{"hue": "#76aee3"}, {"saturation": 38}, {"lightness": -11}, {"visibility": "on"}]
                    }, {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{"hue": "#8dc749"}, {"saturation": -47}, {"lightness": -17}, {"visibility": "on"}]
                    }, {
                        "featureType": "poi.park",
                        "elementType": "all",
                        "stylers": [{"hue": "#c6e3a4"}, {"saturation": 17}, {"lightness": -2}, {"visibility": "on"}]
                    }, {
                        "featureType": "road.arterial",
                        "elementType": "all",
                        "stylers": [{"hue": "#cccccc"}, {"saturation": -100}, {"lightness": 13}, {"visibility": "on"}]
                    }, {
                        "featureType": "administrative.land_parcel",
                        "elementType": "all",
                        "stylers": [{"hue": "#5f5855"}, {"saturation": 6}, {"lightness": -31}, {"visibility": "on"}]
                    }, {
                        "featureType": "road.local",
                        "elementType": "all",
                        "stylers": [{"hue": "#ffffff"}, {"saturation": -100}, {"lightness": 100}, {"visibility": "simplified"}]
                    }, {"featureType": "water", "elementType": "all", "stylers": []}]
                });
                maps[i].set('id', i);
                markers[i] = new google.maps.Marker({
                    position: latlng,
                    map: maps[i],
                    icon: '{{ asset("$site_settings->map_icon") }}'
                });

                maps[i].addListener('click', function(e){
                    markers[this.get('id')].setMap(null);
                    document.getElementById(`lat_${this.get('id')}`).value = e.latLng.lat();
                    document.getElementById(`lng_${this.get('id')}`).value = e.latLng.lng();
                    placeMarkerAndPanTo(e.latLng, maps[this.get('id')], this.get('id'));
                    let map_id = this.get('id');
                })
            }

            function placeMarkerAndPanTo(latLng, map, i) {
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: '{{ asset("$site_settings->map_icon") }}'
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

        function showInput(){
            const both = event.target.querySelector('input');
            const prop = event.target.id;
            if (both.value == 5){
                const ex_input = document.getElementById(`ex_parking_spots_${prop}`);
                if (ex_input.id === 'ex_parking_spots_sale_manufacture'){
                    ex_input.style.display = 'block';
                    const first_input = document.getElementById(`first-${prop}`);
                    const part = first_input.innerHTML;
                    first_input.innerHTML = part + ' на терр. объекта';
                    const second_input = document.getElementById(`second-${prop}`);
                    second_input.innerHTML = part +  ' за терр. объекта';
                }
                else{
                    ex_input.style.display = 'block';
                    const first_input = document.getElementById(`first-${prop}`);
                    const part = first_input.innerHTML;
                    first_input.innerHTML = part + ' наземной парковки';
                    const second_input = document.getElementById(`second-${prop}`);
                    second_input.innerHTML = part +  ' подземной парковки';
                }
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
        
        $('input[name="tot_area"], input[name="kitchen"], input[name="resid"], input[name="ceil"], input[name="a_build"], input[name="freight_cap"], input[name="telpher_cap"], input[name="passenger_cap"], input[name="cr_over_cap"], input[name="cr_beam_cap"], input[name="cr_rail_cap"], input[name="cr_gantry_cap"], input[name="lArea"]').blur( function(){ 
            $(this).parseNumber({ format: "# ###.00", locale: "us" }); 
            $(this).formatNumber({format: "# ###.00", locale: "us"});
        }).on("focusout", function(){ 
            if($(this).val() === '.00' ) $(this).val('');
        });
        $('input[name="price"], input[name="own_deposit"], input[name="cost"], input[name="land"], input[name="entry_cost"], input[name="mon_profit"], input[name="debt_amount"]').blur( function(){ 
            $(this).parseNumber({ format: "# ###.0", locale: "us" }); 
            $(this).formatNumber({format: "# ###.0", locale: "us"}); 
        });
        $('input[name="tot_area"], input[name="resid"], input[name="kitchen"], input[name="ceil"], input[name="price"], input[name="own_deposit"], input[name="lArea"], input[name="cost"], input[name="a_build"], input[name="land"], input[name="entry_cost"], input[name="freight_cap"], input[name="telpher_cap"], input[name="passenger_cap"], input[name="cr_over_cap"], input[name="cr_beam_cap"], input[name="cr_rail_cap"], input[name="cr_gantry_cap"], input[name="mon_profit"], input[name="debt_amount"]').on('keyup keypress blur change', function(){ 
            $(this).val($(this).val().replace(/[,]/g, ".")); 
        });
        $('input[name="floor"], input[name="tot_floor"], input[name="num_beds"], input[name="elec_pow"], [name="place_num"], input[name="min_rent"], input[name="elevs"], input[name="travs"], input[name="escals"], input[name="freight"], input[name="telpher"], input[name="passenger"], input[name="cr_over"], input[name="cr_beam"], input[name="cr_rail"], input[name="cr_gantry"]').on('keyup keypress blur change', function(){ 
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
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=mykey&callback=initMap" async defer></script>    
@endsection
