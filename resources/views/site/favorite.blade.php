@extends('layouts.front')

@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5" style="margin-top: 9%;">
                    <div class="banner_area">
                        <h3 class="page_title mt-3">{{__('messages.list_properties')}}</h3>
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
    <section id="property_area">
        <div class="container">
            <ul class="nav nav-tabs t_show" role="tablist">
                <li class="nav-item active"><a class="nav-link" id="nav-content-tab" data-toggle="tab" href="#nav-content" role="tab" aria-controls="nav-content" aria-selected="true">{{__('messages.property')}}</a></li>
                <li class="nav-item"><a class="nav-link" id="nav-search-tab" data-toggle="tab" href="#nav-search" role="tab" aria-controls="nav-search" aria-selected="false">{{__('messages.search')}}</a></li>
            </ul>
            <div class="row tab-content">
                <div class="col-md-8 tab-pane fade in active" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
                    <!-- Property Grids -->
                    <div class="row" id="property-grid">
                        @if(isset($properties) && count($properties) > 0)
                            @foreach($properties as $property)
                                @if(Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($property->expiring_at),false) >= 1)
                                    <div class="column mix mix_all house {{$property->type_id}} appartment col-md-6 col-sm-6 col-xs-12">
                                        <div class="property_grid">
                                            <div class="img_area">
                                                <div class="sale_btn">{{$property->saleOrRent ? __('messages.sale') : __('messages.rent')}}</div>
                                                @if($property->featured)
                                                    <div class="featured_btn">{{ __('messages.premium') }}</div>
                                                @endif
                                                <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}">
                                                    <img src="{{$property->img}}" style="height: 239px">
                                                </a>
                                                <div class="sale_amount">{{$property->created_at->diffForHumans()}}</div>
                                                <div class="hover_property">
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="property-text">
                                                <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}"><h6 class="property-title">{{$property->title}}</h6></a>
                                                <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{$property->address}}</span>
                                                <div class="quantity">
                                                    <ul>
                                                        <li><span>{{__('messages.area')}}</span>{{$property->area}} {{__('messages.meter')}}<sup>2</sup></li>
                                                        <li><span>{{__('messages.number_of_rooms')}}</span>{{$property->rooms}}</li>
                                                        <li><span>{{__('messages.city')}}</span>{{substr($property->city->city,0,29)}}...</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="bed_area">
                                                <ul>
                                                    <li>{{number_format($property->price)}} TMT @if(!$property->saleOrRent) {{__('messages.mon')}} @endif</li>
                                                    @if(Auth::id())
                                                        @if($property->favorite_user->contains(Auth::id()))
                                                            <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLike()">
                                                                <a href="javascript:void(0);"><i id="property_{{$property->id}}" class="fa fa-star star_i"></i></a>
                                                            </li>
                                                            <li class="flat-icon" id="{{$property->id}}"> 
                                                                <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}"><i class="fa fa-frown-o fa-2x" aria-hidden="true"></i></a>
                                                            </li>
                                                        @else
                                                            <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLike()">
                                                                <a href="javascript:void(0);"><i id="property_{{$property->id}}" class="fa fa-star star_i"></i></a>
                                                            </li>
                                                            <li class="flat-icon" id="{{$property->id}}">
                                                                <a class="repBtn" href="{{route('report.property', ['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}"><i class="fa fa-frown-o fa-2x" aria-hidden="true"></i></a>
                                                            </li>
                                                        @endif
                                                    @else
                                                        @if(isset($arr_cookie))
                                                            @if(in_array($property->id,$arr_cookie))
                                                                <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLike()">
                                                                    <a href="javascript:void(0);"><i id="property_{{$property->id}}" class="fa fa-star star_i"></i></a>
                                                                </li>
                                                                <li class="flat-icon" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}"><i class="fa fa-frown-o fa-2x" aria-hidden="true"></i></a>
                                                                </li>
                                                            @else
                                                                <li class="flat-icon" id="{{$property->id}}" onclick="getLike()">
                                                                    <a href="javascript:void(0);"><i id="property_{{$property->id}}" class="fa fa-star-o star_i"></i></a>
                                                                </li>
                                                                <li class="flat-icon" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}"><i class="fa fa-frown-o fa-2x" aria-hidden="true"></i></a>
                                                                </li>
                                                            @endif
                                                        @else
                                                            <li class="flat-icon" id="{{$property->id}}" onclick="getLike()">
                                                                <a href="javascript:void(0);"><i id="property_{{$property->id}}" class="fa fa-star-o star_i"></i></a>
                                                            </li>
                                                            <li class="flat-icon" id="{{$property->id}}">
                                                                <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}"><i class="fa fa-frown-o fa-2x" aria-hidden="true"></i></a>
                                                            </li>
                                                        @endif
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="verify-msg">
                                <div class="msg-wrapper">
                                    <p>{{__('messages.no_result_search')}}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- End property Grids -->
                    <div class="row">
                        <div class="col-md-12 t_txt_center">
                            <div class="pagination_area"><nav aria-label="Page navigation" id="pagination">{{$properties->links()}}</nav></div>
                        </div>
                    </div>
                </div>
                <!-- Start Sidebar -->
                <div class="col-md-4 tab-pane fade" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
                    <div class="property_sidebar">
                        <form method="GET" action="{{route('property.search')}}" class="price-filter">
                            <h4 class="widget-title t_txt_center">{{__('messages.advanced')}}</h4>
                            <div class="price_range sidebar-widget">
                                <h4 class="widget-title">{{__('messages.price')}}</h4>
                                <span class="price-slider">
                                    <input class="filter_price" type="text" name="price" value="0;5000000"/>
                                </span>
                                <div class="pr_terr1" id="rent_pr_terr">
                                    <span>{{__('messages.price')}}</span>
                                    <div class="btn-group toGGle p-r-10 p-l-10" data-toggle="buttons">
                                        <label class="btn btn-primary cusBorRad1"><input type="radio" name="rent_pr_terr" value="1">{{__('messages.per_month')}}</label>
                                        <label class="btn btn-primary cusBorRad2"><input type="radio" name="rent_pr_terr" value="2">{{__('messages.per_m_sq')}}&sup2; {{__('messages.per_year')}}</label>
                                    </div>
                                </div>
                                <div class="pr_terr1" id="sale_pr_terr">
                                    <span>{{__('messages.price')}}</span>
                                    <div class="btn-group toGGle" data-toggle="buttons">
                                        <label class="btn btn-primary cusBorRad1"><input type="radio" name="sale_pr_terr" value="1">{{__('messages.for_all')}}</label>
                                        <label class="btn btn-primary cusBorRad2"><input type="radio" name="sale_pr_terr" value="2">{{__('messages.per_m_sq')}}&sup2;</label>
                                    </div>
                                </div>
                            </div>
                            <div class="price_range sidebar-widget odd_class"><h4 class="widget-title">{{__('messages.area')}}</h4><span class="price-slider"><input class="area_filter" type="text" name="area" value="0;10000"/></span></div>
                            <select name="sale" class="s_select ob_type">
                                <option class="option" value="0" selected>{{__('messages.rent_it')}}</option>
                                <option class="option" value="1">{{__('messages.buy_it')}}</option>
                            </select>
                            <div class="c_sel_wrap obj_wrap w_100_per m-b-20">
                                <div class="cus_select">
                                    <span class="c_sel_trig">Квартиру</span>
                                    <div class="c_opts obj_pop1 btn-group" data-toggle="buttons">
                                        <section>
                                            <span class="prop_title m-b-5">{{__('messages.residential')}}</span>
                                            <ul class="prop_filter_ls">
                                                @foreach($objects as $object)
                                                    @if(App::isLocale('ru'))
                                                        @if($object->type_id == 1)
                                                            <li>
                                                                <label class="prop_filter_ls_item btn {{$object->id == 1 ? 'active' : ''}}">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}" {{$object->id == 1 ? 'checked' : ''}}>{{$object->name_ru}}</label>
                                                            </li>
                                                        @endif
                                                    @else
                                                        @if($object->type_id == 1)
                                                            <li>
                                                                <label class="prop_filter_ls_item btn {{$object->id == 1 ? 'active' : ''}}">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}" {{$object->id == 1 ? 'checked' : ''}}>{{$object->name_en}}</label>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </section>
                                        <section>
                                            <span class="prop_title m-b-5">{{__('messages.commercial1')}}</span>
                                            <ul class="prop_filter_ls">
                                                @foreach($objects as $object)
                                                    @if(App::isLocale('ru'))
                                                        @if($object->type_id == 2)
                                                            <li class="{{$object->id == 9 ? 'hide' :''}}">
                                                                <label class="prop_filter_ls_item btn {{$object->id == 1 ? 'active' : ''}}">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}" {{$object->id == 1 ? 'checked' : ''}}>{{$object->name_ru}}</label>
                                                            </li>
                                                        @endif
                                                    @else
                                                        @if($object->type_id == 2)
                                                            <li class="{{$object->id == 9 ? 'hide' :''}}">
                                                                <label class="prop_filter_ls_item btn {{$object->id == 1 ? 'active' : ''}}">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}" {{$object->id == 1 ? 'checked' : ''}}>{{$object->name_en}}</label>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="c_sel_wrap w_100_per m-b-20 odd_class">
                                <div class="cus_select">
                                    <span class="c_sel_trig kv_pop1">1, 2 {{__('messages.room_sh1')}}</span>
                                    <div class="c_opts">
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_1" class="cusCheckBox" name="cnt_room[]" value="1" checked>&nbsp;<label for="room_fill_1">1-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_2" class="cusCheckBox" name="cnt_room[]" value="2" checked>&nbsp;<label for="room_fill_2">2-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_3" class="cusCheckBox" name="cnt_room[]" value="3">&nbsp;<label for="room_fill_3">3-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_4" class="cusCheckBox" name="cnt_room[]" value="4">&nbsp;<label for="room_fill_4">4-{{__('messages.roomed')}} {{__('messages.and_more')}}</label></span>
                                    </div>
                                </div>
                            </div>
                            <select name="velayat" class="s_select velayat_select">
                                @foreach($velayats as $velayat)
                                    <option class="option" data-vel="{{$velayat->id}}" value="{{$velayat->id}}">@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                                @endforeach
                            </select>
                            <select name="city1" class="s_select" id="s_city">
                                <option class="cityy_before prim_color" value="null"></option>
                                <option class="option al_city" value="0" selected>{{__('messages.all_etraps')}}</option>
                                @foreach($cities as $city)
                                    <option class="option" id="{{$city->velayat_id}}" value="{{$city->id}}">@if(Lang::locale() == 'ru') {{$city->city_ru}}
                                    @elseif(Lang::locale() == 'en') {{$city->city_en}}
                                    @else {{$city->city_tm}}
                                    @endif</option>
                                @endforeach
                            </select>
                            <div class="c_sel_wrap w_100_per odd_class"><input type="number" name="floor" class="c_sel_trig w_100_per m-b-20" placeholder="{{__('messages.floor')}}" value="{{ isset($selected_floor) ? $selected_floor : ''}}"/></div>
                            <div class="c_sel_wrap w_100_per odd_class"><input type="number" name="tot_floor" class="c_sel_trig w_100_per m-b-20" placeholder="{{__('messages.total_floor')}}" value="{{ isset($selected_tot_floor) ? $selected_tot_floor : '' }}"/></div>
                            <select name="t_rents" class="s_select odd_class">
                                <option value="null" class="option hide" disabled hidden selected>{{__('messages.rent_type')}}</option>
                                @foreach($r_types as $r_type)
                                    <option value="{{$r_type->id}}" class="option">{{$r_type->type}}</option>
                                @endforeach
                            </select>
                            <select name="decor" class="s_select odd_class">
                                <option class="option hide" value="null" disabled hidden selected>{{__('messages.decor')}}</option>
                                @foreach($revamps as $revamp)
                                    <option class="option" value="{{$revamp->id}}">{{$revamp->type}}</option>
                                @endforeach
                            </select>
                            <select class="s_select odd_class" name="bathrooms">
                                <option class="option" value="0" disabled selected>{{__('messages.bathroom')}}</option>
                                <option class="option" value="1">1</option>
                                <option class="option" value="2">2</option>
                                <option class="option" value="3">3</option>
                                <option class="option" value="4">4</option>
                            </select>
                            <div class="c_sel_wrap w_100_per m-b-20 odd_class">
                                <div class="cus_select">
                                    <span class="c_sel_trig">{{__('messages.parking')}}</span>
                                    <div class="c_opts s_parking btn-group" id="s_res_parking">
                                        @foreach($parkings as $parking)
                                            @if($parking->id!==3 && $parking->id!==4)
                                                <label for="parking_{{$parking->id}}" class="btn option" style="text-transform:capitalize"><input type="radio" name="res_parking" value="{{$parking->id}}" id="parking_{{$parking->id}}">{{$parking->parking}}</label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="c_sel_wrap w_100_per m-b-20 odd_class">
                                <div class="cus_select">
                                    <span class="c_sel_trig">{{__('messages.parking')}}</span>
                                    <div class="c_opts s_parking btn-group" id="s_com_parking" data-toggle="buttons">
                                        @foreach($parkings as $parking)
                                            @if($parking->id==3 || $parking->id==4)
                                                <label for="parking_{{$parking->id}}" class="btn option" style="text-transform:capitalize"><input type="radio" name="com_parking" value="{{$parking->id}}" id="parking_{{$parking->id}}">{{$parking->parking}}</label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <select class="s_select odd_class" name="t_build">
                                <option value="null" selected disabled class="hide">{{__('messages.poss_appoint_holder')}}</option>
                                @foreach($build_appoints as $appoint)
                                    <option class="option" value="{{$appoint->id}}">{{$appoint->type}}</option>
                                @endforeach
                            </select>
                            <select name="buss_t_prop" class="s_select odd_class">
                                <option value="null" disabled selected class="hide">{{__('messages.property_type')}}</option>
                                @foreach($buss_t_props as $b_t_p)
                                    <option value="{{$b_t_p->id}}" class="option">{{$b_t_p->type}}</option>
                                @endforeach
                            </select>
                            <select name="prop_status" class="s_select odd_class">
                                <option value="null" disabled selected class="hide it_cap">{{__('messages.status_property')}}</option>
                                @foreach($st_props as $s_tp)
                                    @if($s_tp->id !== 3)
                                        <option value="{{$s_tp->id}}" class="option it_cap">{{$s_tp->type}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select class="s_select odd_class" name="condition">
                                <option class="it_cap hide" value="null" disabled hidden selected>{{__('messages.condition')}}</option>
                                @foreach($conditions as $condition)                                    
                                    <option class="option it_cap" value="{{$condition->id}}">{{$condition->condition}}</option>
                                @endforeach
                            </select>
                            <div class="c_sel_wrap odd_class">
                                @foreach($features as $feature)
                                    <div class="col-md-6 col-sm-6 pretty p-default infras1">
                                        <input type="checkbox" value="{{$feature->id}}" name="features[]"/>
                                        <div class="state p-success">
                                            <label>@if(Config::get('app.locale') == 'ru') {{$feature->feature_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$feature->feature_en}}
                                            @else {{$feature->feature_tm}} @endif</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="c_sel_wrap odd_class">
                                @foreach($infras as $infra)
                                    <div class="col-md-6 pretty p-default infras2">
                                        <input type="checkbox" value="{{$infra->id}}" name="infras[]"/>
                                        <div class="state p-success">
                                            <label class="it_cap">@if(Config::get('app.locale') == 'ru') {{$infra->infrastructure}}
                                            @elseif(Config::get('app.locale') == 'en') {{$infra->infrastructure}}
                                            @else {{$infra->infrastructure}} @endif</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <select class="s_select" name="filter">
                                <option class="option" value="1" selected>{{__('messages.default_order')}}</option>
                                <option class="option" value="3">{{__('messages.price_h')}}</option>
                                <option class="option" value="4">{{__('messages.price_l')}}</option>
                                <option class="option" value="5">{{__('messages.newest_item')}}</option>
                                <option class="option" value="6">{{__('messages.oldest_item')}}</option>
                            </select>
                            <button class="btn btn-default search-btn">{{__('messages.search')}}</button>
                        </form>                        
                    </div>
                    <div class="featured_sidebar sidebar-widget ads_wrap">
                        <h4 class="widget-title">{{__('messages.advertisement')}}</h4>
                        <div class="slide_featured">
                            @foreach($ads as $ad)
                                <div class="item">
                                    <div class="thumb">
                                        <div class="sidebar_img">
                                            <img src="/{{$ad->img}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>                
                </div>
                <!-- End SIdebar -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(".area_filter").slider({from: 0, to: 10000, step: 1, smooth: true, round: 0, dimension: "{{__('messages.meter')}}<sup>2</sup>", skin: "plastic" });
            $('.s_select').each(function(){
                var cls = $(this).attr('class'), id = $(this).attr('id'), named = $(this).attr('name'), chen, selID, tmp1, velID, cBor, copt, defVal;
                var tmp = ''; cBor = '';
                if(id == 's_city') cBor=' city_adj1';
                tmp1='<div class="' + cls + '"><span class="c_sel_trig' + cBor + '">'; defVal='';
                $(this).find('option').each(function(){
                    selID=''; chen=''; velID='';

                    if($(this).is(':selected')){ 
                        if($(this).val()!=='null'){defVal='pr_back_col';} 
                        chen='seled '; 
                        tmp1+=$(this).text() + '</span><div class="c_opts ' + defVal; 
                        if(named=='city1'){ tmp1+=' s_city';} 
                        tmp1+='">';
                        if(named=='t_build'){ tmp1+='<div class="scroll_menu">';}
                    }
                    
                    if($(this).data('vel')){ velID='data-vel='+$(this).data('vel');}
                    if($(this).attr('id')){ selID='data-selid="'+$(this).attr('id')+'"'; if($(this).attr('id')!=$('div.velayat_select .c_opts .seled').data('value')){chen+='hide ';}}
                    copt='c_opt ';
                    if(named=='city1' && $(this).hasClass('cityy_before')){copt=''}
                    tmp+='<span class="'+ copt + chen + $(this).attr('class') + '" '+ velID + selID +' data-value="' + $(this).attr('value') + '">' + $(this).html() + '</span>';
                });
                tmp=tmp1 + tmp; 
                tmp+= named=='t_build' ? '</div></div></div>' : '</div></div>';
                $(this).wrap('<div class="c_sel_wrap w_100_per m-b-20"></div>');
                $(this).hide();
                $(this).after(tmp);
            });         
        

            $('.c_sel_trig').on('click', function () {
                $('div.s_select').not($(this).parents('.s_select')).removeClass('oped');
                $('div.cus_select').not($(this).parents('div.cus_select')).removeClass('oped');
                if (!$(this).parent().parent($(this).parents('.cus_select')).hasClass('obj_wrap') && !$(this).hasClass('kv_pop1') && !$(this).next().hasClass('s_parking')) {
                    $(this).parents('.s_select').toggleClass('oped');
                }else{$(this).parents('div.cus_select').toggleClass('oped')}
                event.stopPropagation();
            });
            $('.c_opt').on('click', function(){
                $(this).parents('.c_sel_wrap').find('select').val($(this).data('value'));
                if($(this).parent().hasClass('s_city')){if($(this).hasClass('al_city')){$('span.cityy_before').addClass('prim_color');}else{$('span.cityy_before').removeClass('prim_color');}} if($(this).data('vel')){ var velid=$(this).data('vel'), tTxt=$('div.s_city .c_opt:first').text(); $('div.s_city').find('span').not(':first').not(':nth-child(2)').addClass('hide').removeClass('seled').parent().find('span').each( function(i, el){if(i===0){$(this).addClass('prim_color');} if(i===1){$(this).addClass('seled');}  if($(this).data('selid')==velid){$(this).removeClass('hide');} }); $('div.s_city').parents('.c_sel_wrap').find('select').val(tTxt).next().find('.c_sel_trig').text(tTxt); }
                $(this).parents('.c_opts').find('.c_opt').removeClass('seled');
                $(this).addClass('seled');
                $(this).parents('.s_select').removeClass('oped');
                $(this).parents('.s_select').find('.c_sel_trig').text($(this).text());
                ifFirst($(this)) ? $(this).parent().addClass('pr_back_col') : $(this).parent().removeClass('pr_back_col');
                if($(this).parent().parent().hasClass('ob_type')){
                    if($('input[name="object"]:checked').val()=='9' && $('div.ob_type .c_opts .seled').data('value')=='0'){ $('div.ob_type .c_opts .c_opt:nth-child(1)').removeClass('seled').next().addClass('seled'); $('.c_sel_wrap div.ob_type .c_sel_trig').text($('div.ob_type .c_opts .c_opt:nth-child(2)').text()).parent().find('.c_opts').removeClass('pr_back_col').parents('.c_sel_wrap').find('select').val($('div.ob_type .c_opts .c_opt:nth-child(2)').data('value')); toastr.error("{{__('messages.invalid_selection')}}");}
                    sObject($('input[name="object"]:checked').val());
                    $(this).data('value') == 0 ? $('.prop_filter_ls:eq(1) li:eq(4)').addClass('hide') : $('.prop_filter_ls:eq(1) li:eq(4)').removeClass('hide');}
            });
            $('.s_parking .btn').on('click', function(){
                $(this).parent().find('label').removeClass('active');
                $(this).addClass('active');
                $(this).parents('.cus_select').removeClass('oped').find('.c_sel_trig').text($(this).text());
                $(this).parents('.c_opts').removeClass('pr_back_col');
                if($(this).parents('.s_parking').find('label:eq(0)').hasClass('active')){ $(this).parents('.c_opts').addClass('pr_back_col');}
            });
            
            $('.prop_filter_ls_item').on('click', function(){$(this).parents('.cus_select').removeClass('oped').find('.c_sel_trig').text($(this).text()); sObject($(this).find('input').val());});
            $('input[id^="room_fill"]').on('change', function(){
                var cVak='';
                $('input[id^="room_fill"]:checked').each(function(){cVak += this.value + ', ';});
                switch ($('input[id^="room_fill"]:checked').length){
                    case 0:
                        $('.kv_pop1').text("{{__('messages.room')}}");
                        break;
                    case 1:
                        $('.kv_pop1').text(cVak.substring(0,1) + '-{{__('messages.roomed')}}');
                        break;
                    case 2:
                        $('.kv_pop1').text(cVak.substring(0, 4) + ' ' + '{{__("messages.room_sh1")}}');
                        break;
                    default:
                        $('.kv_pop1').text(cVak.substring(0, cVak.length - 2) + '   ' + '{{__("messages.room_sh2")}}');
                }
            });
            function sObject(o_tp){
                $('div.c_sel_wrap.odd_class, div.pr_terr1, .price_range.odd_class').addClass('hide');
                $('select.odd_class').parent().addClass('hide');
                $('input[name="features[]"]').prop('checked', false);
                $('input[name="infras[]"]').prop('checked', false);
                $('div.infras1, div.infras2').removeClass('hide');
                switch(o_tp){                            
                    case '1':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.total_floor')}}");
                        $('input[name="floor"], input[name="tot_floor"], .infras1').parent().removeClass('hide');
                        $('.kv_pop1, #s_res_parking').parents('.c_sel_wrap').removeClass('hide');
                        if($('div.ob_type .seled').data('value')=='1'){$('.price_range.odd_class').removeClass('hide'); $('div.infras1:nth-child(6)').nextAll().addClass('hide');}                        
                        break;
                    case '2':
                    case '3':
                    case '4':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.total_floor1')}}");
                        $('input[name="tot_floor"], .infras1').parent().removeClass('hide');
                        $('.price_range.odd_class').removeClass('hide');
                        if($('div.ob_type .seled').data('value')=='0'){$('select[name="decor"]').parent().removeClass('hide');}else{$('div.infras1:nth-child(10)').nextAll().addClass('hide');}
                    break;
                    case '5':
                    case '7':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        $('.price_range.odd_class').removeClass('hide');
                        $('.infras2, input[name="floor"], input[name="tot_floor"], select[name="condition"], select[name="t_build"]').parents('.c_sel_wrap').removeClass('hide');
                        if($('div.ob_type .seled').data('value')=='0'){$('#rent_pr_terr').removeClass('hide'); $('select[name="t_rents"]').parents('.c_sel_wrap').removeClass('hide');}else{$('#sale_pr_terr').removeClass('hide');}
                        if(o_tp=='5'){ $('#s_res_parking').parents('.c_sel_wrap').removeClass('hide');}else{$('#s_com_parking').parents('.c_sel_wrap').removeClass('hide');$('div.infras2:nth-child(5)').nextAll().addClass('hide');}
                    break;
                    case '6':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        $('.price_range.odd_class').removeClass('hide');
                        $('input[name="tot_floor"], #s_com_parking, select[name="condition"], select[name="t_build"]').parents('.c_sel_wrap').removeClass('hide');
                        if($('div.ob_type .seled').data('value')=='0'){$('#rent_pr_terr').removeClass('hide'); $('select[name="t_rents"]').parents('.c_sel_wrap').removeClass('hide');}else{$('#sale_pr_terr').removeClass('hide');}
                    break;
                    case '8':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        $('.price_range.odd_class').removeClass('hide');
                        $('.infras2, input[name="floor"], input[name="tot_floor"], select[name="condition"], select[name="t_build"]').parents('.c_sel_wrap').removeClass('hide');
                        if($('div.ob_type .seled').data('value')=='0'){$('#rent_pr_terr').removeClass('hide'); $('select[name="t_rents"]').parents('.c_sel_wrap').removeClass('hide');}else{$('#sale_pr_terr').removeClass('hide');}
                    break;
                    case '9':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        $('#sale_pr_terr, .price_range.odd_class').removeClass('hide');
                        $('.infras2, input[name="floor"], input[name="tot_floor"], select[name="condition"], select[name="t_build"]').parents('.c_sel_wrap').removeClass('hide');
                    break;
                    case '10':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        $('.price_range.odd_class').removeClass('hide');
                        $('input[name="floor"], input[name="tot_floor"], select[name="condition"], select[name="buss_t_prop"]').parents('.c_sel_wrap').removeClass('hide');
                        if($('div.ob_type .seled').data('value')=='0'){$('#rent_pr_terr').removeClass('hide');}else{$('#sale_pr_terr').removeClass('hide');$('select[name="prop_status"]').parents('.c_sel_wrap').removeClass('hide');}
                    break;
                }
            }            
            function ifFirst(target){ var cInd = target.index(); var selInd = target.parents('.c_opts').find('.c_opt').not('.hide').index(); if(cInd < selInd || cInd == selInd) return true; return false;}
            
            $('.prop_filter_ls_item').first().trigger('click');
        });
    </script>
@endsection