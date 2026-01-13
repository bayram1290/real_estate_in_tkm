@extends('layouts.front')

@section('content')
    <section id="slider-fixed">
        <div class="fix-banner">
            <div class="carousel-caption m_top-285">
                <div class="container">
                    <div class="slider-search-2">
                        <h1>{{__('messages.find_your_home')}}</h1>
                        <div class="m_filter_wrap">
                            <form action="{{route('property.search.main')}}" id="form" method="get">
                                <select name="sale" id="sale" class="fare_select ob_type m-t-20">
                                    <option class="option" value="0" selected>{{__('messages.rent_it')}}</option>
                                    <option class="option" value="1">{{__('messages.buy_it')}}</option>
                                </select>
                                <div class="c_sel_wrap obj_wrap">
                                    <div class="cus_select">
                                        <span class="c_sel_trig">Квартиру</span>
                                        <div class="c_opts obj_pop btn-group" data-toggle="buttons">
                                            <section>
                                                <span class="prop_title">{{__('messages.residential')}}</span>
                                                <ul class="prop_filter_ls m_m-b-50">
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
                                                                    <label class="prop_filter_ls_item btn {{$object->id == 1 ? 'active' : ''}} {{$object->id == 3 ? 'hide' :''}}">
                                                                        <input type="radio" class="hide" name="object" value="{{$object->id}}" {{$object->id == 1 ? 'checked' : ''}}>{{$object->name_en}}</label>
                                                                </li>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </section>
                                            <section>
                                                <span class="prop_title">{{__('messages.commercial1')}}</span>
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
                                                                <li class="{{$object->id == 9 ? 'hide' :''}} {{$object->id == 11 ? 'm_m-b-0' :''}} ">
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
                                <select name="velayatt" class="velayat_select fare_select">
                                    @foreach($velayats as $velayat)
                                        <option class="option" data-vel="{{$velayat->id}}" value="{{$velayat->id}}" {{$velayat->id == 6 ? 'selected':''}}>@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                        @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                        @else {{$velayat->velayat_tm}}
                                        @endif</option>
                                    @endforeach
                                </select>
                                <select name="cityy" class="fare_select" id="cityy">
                                    <option class="cityy_before prim_color" value="null"></option>
                                    <option class="option al_city" value="0" selected>{{__('messages.all_etraps')}}</option>
                                    @foreach($cities as $city)
                                        <option class="option" id="{{$city->velayat_id}}" value="{{$city->id}}">@if(Lang::locale() == 'ru') {{$city->city_ru}}
                                        @elseif(Lang::locale() == 'en') {{$city->city_en}}
                                        @else {{$city->city_tm}}
                                        @endif</option>
                                    @endforeach
                                </select>
                                <br class="cBr">
                                <div class="c_sel_wrap">
                                    <input type="number" step="0.1" name="min_price" min="0" class="c_sel_trig duzelt cusBorRad3" placeholder="{{__('messages.from2')}}"/>
                                </div>                                
                                <div class="c_sel_wrap">                                    
                                    <input type="number" step="0.1" name="max_price" min="1" class="c_sel_trig duzelt1" placeholder="{{__('messages.till')}}"/>                                    
                                </div>
                                <select name="price_unit" class="fare_select filter_price_unit">
                                    <option value="2" class="option" selected>TMT</option>
                                    <option value="1" class="option">{{__('messages.cu')}}</option>
                                </select>
                                <div class="c_sel_wrap odd_cls">
                                    <div class="cus_select">
                                        <span class="c_sel_trig kv_pop cusBorRad4">1, 2 {{__('messages.room_sh1')}}</span>
                                        <div class="c_opts">
                                            <span class="kv_opt">
                                                <input type="checkbox" id="room_fil_1" name="cnt_room[]" class="cusCheckBox" value="1" checked/>&nbsp;<label for="room_fil_1">1-{{__('messages.roomed')}}</label>
                                            </span>
                                            <span class="kv_opt">
                                                <input type="checkbox" id="room_fil_2" name="cnt_room[]" class="cusCheckBox" value="2" checked/>&nbsp;<label for="room_fil_2">2-{{__('messages.roomed')}}</label>
                                            </span>
                                            <span class="kv_opt">
                                                <input type="checkbox" id="room_fil_3" name="cnt_room[]" class="cusCheckBox" value="3"/>&nbsp;<label for="room_fil_3">3-{{__('messages.roomed')}}</label>
                                            </span>
                                            <span class="kv_opt s_apart">
                                                <input type="checkbox" id="room_fil_4" name="cnt_room[]" class="cusCheckBox" value="4"/>&nbsp;<label for="room_fil_4">4-{{__('messages.roomed')}} {{__('messages.and_more')}}</label>
                                            </span>
                                            <span class="kv_opt e_apart hide">
                                                <input type="checkbox" id="room_fil_41" name="cnt_room[]" class="cusCheckBox" value="4"/>&nbsp;<label for="room_fil_41">4-{{__('messages.roomed')}}</label>
                                            </span>
                                            <span class="kv_opt e_apart hide">
                                                <input type="checkbox" id="room_fil_5" name="cnt_room[]" class="cusCheckBox" value="5"/>&nbsp;<label for="room_fil_5">5-{{__('messages.roomed')}} {{__('messages.and_more')}}</label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <select name="price_terr" class="pr_terr fare_select min_reset odd_cls">
                                    <option class="option" value="1" selected>{{__('messages.for_all')}}</option>
                                    <option class="option" value="2">{{__('messages.per_m_sq')}}&sup2;</option>
                                </select>
                                <select name="price_terr_rent" class="pr_terr fare_select min_reset odd_cls">
                                    <option class="option" value="1" selected>{{__('messages.per_month')}}</option>
                                    <option class="option" value="2">{{__('messages.per_m_sq')}}&sup2; {{__('messages.per_year')}}</option>
                                </select>
                                <div class="c_sel_wrap odd_cls hide">
                                    <div class="cus_select">
                                        <span class="c_sel_trig area_pop"><span>{{__('messages.area')}}</span><span class="cusCur1">{{__('messages.meter')}}<sup>2</sup></span></span>
                                        <div class="c_opts">
                                            <input type="number" name="min_ar_fil" step="0.01" min="1" class="area_input" placeholder="{{__('messages.from2')}}"/>
                                            <input type="number" name="max_ar_fil" step="0.01" min="2" class="area_input" placeholder="{{__('messages.till')}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="c_sel_wrap search_wrap">
                                    <input type="submit" name="search" value="{{__('messages.search')}}" class="btn btn-default">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider Part End -->

    <!-- Offer Part Start -->
    <section id="offer-style-3">
        <div class="container">
            <div class="row">
                @foreach($ads as $ad)
                    <div class="col-md-6 col-sm-12" style="margin-bottom: 20px">
                        <img src="{{$ad->img}}" alt="" height="250px">
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a class="btn btn-success" href="{{asset('img/catalog.pdf')}}" download="Henkel catalog">Посмотреть каталог</a>
            </div>
        </div>
    </section>
    <!-- Offer Part End -->

    <!-- Property Tab -->
    @if( count( $properties ) > 0 )
        <section id="property-tab">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-row">
                            <h3 class="section_title_blue" style="text-transform: none">{{__('messages.recent')}} {{__('messages.property')}}</h3>
                            <div class="sub-title"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="gallery-section">
                            <div class="auto-container">
                                <!--Filter-->
                                <div class="filters">
                                    <ul class="filter-tabs filter-btns clearfix anim-3-all">
                                        <li class="active filter" data-role="button" data-filter="all">{{__('messages.all')}}</li>
                                        @if(isset($types_ru))
                                            @foreach($types_ru as $type)
                                                <li class="filter" data-role="button" data-filter=".{{$type->id}}">{{$type->name_ru}}</li>
                                            @endforeach
                                        @elseif(isset($types_en))
                                            @foreach($types_en as $type)
                                                <li class="filter" data-role="button" data-filter=".{{$type->id}}">{{$type->name_en}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!--Filter List-->

                                <!-- Tab Content -->
                                <div class="row filter-list clearfix">
                                    @foreach($properties as $property)
                                        @if(Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($property->expiring_at),false) >= 1)
                                            <div class="column mix mix_all house {{$property->type_id}} appartment col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="property_grid">
                                                    <div class="img_area">
                                                        <div class="sale_btn">{{$property->saleOrRent ? __('messages.sale') : __('messages.rent')}}</div>
                                                        @if($property->featured)
                                                            <div class="featured_btn">{{ __('messages.premium') }}</div>
                                                        @endif
                                                        <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}" target="_blank">
                                                            <img src="{{$property->img}}">
                                                        </a>
                                                        <div class="sale_amount">{{$property->created_at->diffForHumans()}}</div>
                                                        <div class="hover_property">
                                                            <ul>
                                                                <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                                </li>
                                                                <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="property_grid_mid">
                                                        <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}"  target="_blank">
                                                            <h5 class="property_grid_title">@if(Lang::locale() == 'ru') {{$p_deals_ru[$property->saleOrRent]}}
                                                                @elseif(Lang::locale() == 'en') {{$p_deals_en[$property->saleOrRent]}}
                                                                @else {{$p_deals_tm[$property->saleOrRent]}}
                                                                @endif
                                                                @if(Lang::locale() == 'ru') {{$p_objects_ru[$property->object_names_id-1]}}
                                                                @elseif(Lang::locale() == 'en') {{$p_objects_en[$property->object_names_id-1]}}
                                                                @else {{$p_objects_tm[$property->object_names_id-1]}}
                                                                @endif
                                                            </h5>
                                                        </a>
                                                        <div class="property_grid_feats">
                                                            @php $obj = (int)$property->object_names_id; @endphp
                                                            @if( $property->type_id == 1 )
                                                                <!-- Residential property info start -->
                                                                @if( $obj < 3 )
                                                                    <span class="property_grid_feat">
                                                                        @if( (int)$property->rooms < 7 )
                                                                            {{$property->rooms}}-{{__('messages.room_sh1')}}
                                                                        @elseif( (int)$property->rooms == 7 )
                                                                            {{__('messages.free_layout')}}
                                                                        @elseif( (int)$property->rooms == 8 )
                                                                            {{__('messages.studio')}}
                                                                        @endif
                                                                    </span>
                                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                                    <span class="property_grid_feat">{{$property->area . ' ' . __('messages.meter')}}<sup>2</sup></span>
                                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                                    <span class="property_grid_feat">{{$property->floor . '/' . $property->floors_in_home . ' ' . __('messages.floors_1')}}</span>
                                                                @elseif( $obj === 5 )
                                                                    <span class="property_grid_feat">{{$property->rent_part . ' ' . __('messages.part')}}</span>
                                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                                    <span class="property_grid_feat">{{$property->area . ' ' . __('messages.meter')}}<sup>2</sup></span>
                                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                                    <span class="property_grid_feat">{{$property->land_area}} @if(Lang::locale() == 'ru') {{$property->land_area_type->type_ru}}
                                                                        @elseif(Lang::locale() == 'en') {{$property->land_area_type->type_en}}
                                                                        @else {{$property->land_area_type->type_tm}}
                                                                        @endif</span>
                                                                @else
                                                                    @if(isset($property->rooms) || isset($property->floors_in_home))
                                                                        <span class="property_grid_feat">
                                                                            @if( isset($property->rooms) )
                                                                                {{$property->rooms . ' ' . __('messages.room_sh1') }}
                                                                            @else
                                                                                {{$property->floors_in_home . ' ' . __('messages.floors_1')}} 
                                                                            @endif
                                                                        </span>
                                                                        <span class="property_grid_delimeter">&nbsp;</span>
                                                                    @endif
                                                                    <span class="property_grid_feat">{{$property->area . ' ' . __('messages.meter')}}<sup>2</sup></span>
                                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                                    <span class="property_grid_feat">{{$property->land_area}} @if(Lang::locale() == 'ru') {{$property->land_area_type->type_ru}}
                                                                        @elseif(Lang::locale() == 'en') {{$property->land_area_type->type_en}}
                                                                        @else {{$property->land_area_type->type_tm}}
                                                                        @endif</span>
                                                                @endif
                                                                <!-- Residential property info end -->                                                        
                                                            @else
                                                                <!-- Commercaial property info start -->
                                                                <span class="property_grid_feat">@if( $obj == 7 ) {{$property->building_area . ' ' . __('messages.meter')}}<sup>2</sup>
                                                                    @else {{$property->area . ' ' . __('messages.meter')}}<sup>2</sup>
                                                                    @endif</span>
                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                <span class="property_grid_feat">@if( $obj == 7 ) {{$property->floors_in_home . ' ' . __('messages.floors_1')}}
                                                                    @else {{$property->floor . '/' . $property->floors_in_home . ' ' . __('messages.floors_1')}}
                                                                    @endif</span>
                                                                    @switch($obj)
                                                                        @case(6)
                                                                            @if(isset($property->office_condition_id) || isset($property->building_type_id) || (isset($property->rent_term_id) && (int)$property->saleOrRent == 0) || (isset($property->furniture) && (int)$property->saleOrRent == 1) )
                                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                                <span class="property_grid_feat l_feat">
                                                                                    @if(isset($property->office_condition_id))
                                                                                        @if(Lang::locale() == 'ru') {{$property->office_condition->condition_ru}}
                                                                                        @elseif(Lang::locale() == 'en') {{$property->office_condition->condition_en}}
                                                                                        @else {{$property->office_condition->condition_tm}}
                                                                                        @endif
                                                                                    @elseif(isset($property->building_type_id))
                                                                                        @if(App::isLocale('ru')) {{$property->building_type->type_ru}}
                                                                                        @elseif(App::isLocale('en')) {{$property->building_type->type_en}}
                                                                                        @else {{$property->building_type->type_tm}}
                                                                                        @endif
                                                                                    @elseif( isset($property->rent_term_id) && (int)$property->saleOrRent == 0 )
                                                                                        @if( (int)$property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}
                                                                                        @else {{__('messages.short_term_rent')}}
                                                                                        @endif
                                                                                    @elseif(isset($property->furniture) && (int)$property->saleOrRent == 1)
                                                                                        @if( (int)$property->furniture == 1 ) {{__('messages.furnished')}}
                                                                                        @else {{__('messages.unfurnished')}}
                                                                                        @endif
                                                                                    @endif
                                                                                </span>                                                                                                                                            
                                                                            @endif                                                                    
                                                                        @break
                                                                        @case(7)
                                                                            @if(isset($property->building_type_id) || isset($property->land_area) || isset($property->office_condition_id))
                                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                                <span class="property_grid_feat l_feat">
                                                                                    @if( isset($property->building_type_id) ) {{__('messages.type')}}:@if(App::isLocale('ru')) {{$property->building_type->type_ru}}
                                                                                        @elseif(App::isLocale('en')) {{$property->building_type->type_en}}
                                                                                        @else {{$property->building_type->type_tm}} @endif
                                                                                    @elseif(isset($property->land_area)) {{$property->land_area . ' ' . __('messages.ga')}}
                                                                                    @elseif(isset($property->office_condition_id)) @if(Lang::locale() == 'ru') {{$property->office_condition->condition_ru}}
                                                                                        @elseif(Lang::locale() == 'en') {{$property->office_condition->condition_en}}
                                                                                        @else {{$property->office_condition->condition_tm}}
                                                                                        @endif                                                                    
                                                                                    @endif
                                                                                </span>
                                                                            @endif                                                                    
                                                                        @break
                                                                        @case(8)
                                                                            @if(isset($property->trade_room_id))
                                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                                <span class="property_grid_feat l_feat">
                                                                                    @if(Lang::locale() == 'ru') {{$property->trade_room->room_ru}}
                                                                                    @elseif(Lang::locale() == 'en') {{$property->trade_room->room_en}}
                                                                                    @else {{$property->trade_room->room_tm}}
                                                                                    @endif
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                        @case(9)
                                                                        @case(10)
                                                                            @if((isset($property->building_type_id) && (int)$property->saleOrRent == 0) || (isset($property->column_grid) && (int)$property->saleOrRent == 1) || isset($property->land_area) || (isset($property->rent_term_id) && (int)$property->saleOrRent == 0))
                                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                                <span class="property_grid_feat l_feat">
                                                                                    @if( isset($property->building_type_id) && (int)$property->saleOrRent == 0 ) {{__('messages.type')}}:@if(App::isLocale('ru')) {{$property->building_type->type_ru}}
                                                                                        @elseif(App::isLocale('en')) {{$property->building_type->type_en}}
                                                                                        @else {{$property->building_type->type_tm}} @endif
                                                                                    @elseif(isset($property->column_grid) && (int)$property->saleOrRent == 1 )
                                                                                        {{$property->column_grid . ' ' . mb_strtolower(__('messages.col_grid'), 'UTF-8')}}
                                                                                    @elseif(isset($property->land_area)) 
                                                                                        {{$property->land_area . ' ' . __('messages.ga')}}
                                                                                    @elseif( isset($property->rent_term_id) && (int)$property->saleOrRent == 0 )
                                                                                        @if( (int)$property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}
                                                                                        @else {{__('messages.short_term_rent')}}
                                                                                        @endif
                                                                                    @endif
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                        @case(11)
                                                                            @if(isset($property->business_type_property_id) || isset($property->office_condition_id) || (isset($property->rent_term_id) && (int)$property->saleOrRent == 0))
                                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                                <span class="property_grid_feat l_feat">
                                                                                    @if(isset($property->business_type_property_id))
                                                                                        {{__('messages.type')}}:@if(Lang::locale() == 'ru') {{$property->business_type_property->type_ru}}
                                                                                        @elseif(Lang::locale() == 'en') {{$property->business_type_property->type_en}}
                                                                                        @else {{$property->business_type_property->type_tm}}
                                                                                        @endif
                                                                                    @elseif(isset($property->office_condition_id))
                                                                                        @if(Lang::locale() == 'ru') {{$property->office_condition->condition_ru}}
                                                                                        @elseif(Lang::locale() == 'en') {{$property->office_condition->condition_en}}
                                                                                        @else {{$property->office_condition->condition_tm}}
                                                                                        @endif
                                                                                    @elseif( isset($property->rent_term_id) && (int)$property->saleOrRent == 0 )
                                                                                        @if( (int)$property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}
                                                                                        @else {{__('messages.short_term_rent')}}
                                                                                        @endif
                                                                                    @endif
                                                                                </span>
                                                                            @endif
                                                                        @break
                                                                    @endswitch
                                                                </span>
                                                                <!-- Commercaial property info end --> 
                                                            @endif
                                                        </div>
                                                        <span class="property_grid_addr"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$property->address}}</span>
                                                        <bdi class="property_grid_vel">
                                                            @if(Lang::locale() == 'ru') {{$property->city->city_ru}}/
                                                            @elseif(Lang::locale() == 'en') {{$property->city->city_en}}/
                                                            @else {{$property->city->city_tm}}/
                                                            @endif
                                                            @if(Lang::locale() == 'ru')
                                                                @if( $property->city->id == 6 )
                                                                    {{$property->velayat->velayat_ru}}
                                                                @else
                                                                    {{mb_substr($property->velayat->velayat_ru, 0, (mb_strlen($property->velayat->velayat_ru, 'UTF-8') - 4), 'UTF-8')}}
                                                                @endif
                                                            @elseif(Lang::locale() == 'en') {{$property->velayat->velayat_en}}
                                                            @else {{$property->velayat->velayat_tm}}
                                                            @endif
                                                        </bdi>                                                
                                                    </div>
                                                    <div class="property_grid_foot" >
                                                        <div class="property_grid_foot_price">
                                                            <div 
                                                                @if( (int)$property->saleOrRent == 0 )
                                                                    class="sing_val"
                                                                @endif>{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} @if(!$property->saleOrRent) {{__('messages.mon')}} @endif</div>
                                                            @if( isset( $property->price_rate ) && (int)$property->saleOrRent == 1 )
                                                                <div> 1 {{ __('messages.meter')}}<sup>2</sup> = {{number_format($property->price_rate, 2, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}</div>
                                                            @endif
                                                        </div>
                                                        @if(Auth::id())
                                                            @if($property->favorite_user->contains(Auth::id()))
                                                                <div class="property_grid_foot_comp" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                                        <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="property_grid_foot_like" id="{{$property->id}}" onclick="decreaseLike()">
                                                                    <a href="javascript:void(0);">
                                                                        <i id="property_{{$property->id}}" class="star_i fa fa-star"></i>
                                                                    </a>
                                                                </div>                                                        
                                                            @else
                                                                <div class="property_grid_foot_comp" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                                        <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="property_grid_foot_like" id="{{$property->id}}" onclick="getLike()">
                                                                    <a href="javascript:void(0);">
                                                                        <i id="property_{{$property->id}}" class="star_i fa fa-star-o"></i>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @if(isset($arr_cookie))
                                                                @if(in_array($property->id,$arr_cookie))
                                                                    <div class="property_grid_foot_like" id="{{$property->id}}">
                                                                        <a class="property_grid_foot_comp" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                                            <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="property_grid_foot_like" id="{{$property->id}}" onclick="decreaseLike()">
                                                                        <a href="javascript:void(0);">
                                                                            <i id="property_{{$property->id}}" class="star_i fa fa-star"></i>
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <div class="property_grid_foot_comp" id="{{$property->id}}">
                                                                        <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                                            <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <div class="property_grid_foot_like" id="{{$property->id}}" onclick="getLike()">
                                                                        <a href="javascript:void(0);">
                                                                            <i id="property_{{$property->id}}" class="star_i fa fa-star-o"></i>
                                                                        </a>
                                                                    </div>                                                            
                                                                @endif
                                                            @else
                                                                <div class="property_grid_foot_comp" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                                        <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="property_grid_foot_like" id="{{$property->id}}" onclick="getLike()">
                                                                    <a href="javascript:void(0);">
                                                                        <i id="property_{{$property->id}}" class="star_i fa fa-star-o"></i>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                @foreach($ads as $ad)
                                    <div class="col-md-6 col-sm-12">
                                        <img src="{{$ad ->img}}" height="250px">
                                    </div>
                                @endforeach
                                <!-- End tab content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Property Tab -->

    <!-- Popular Category -->
    <section id="popular-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-row">
                        <h3 class="section_title_blue">{{__('messages.popular')}} {{__('messages.locations')}}</h3>
                        <div class="sub-title"></div>
                    </div>
                </div>
            </div>
            <div class="row">                
                @foreach($velayats as $velayat)
                    <div class="col-md-6 col-sm-6">
                        <div class="category-grid wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">
                            <div class="location-img ctg-grid loc-2" style="background-image: url(img/city/{{$velayat->img}})"></div>
                            <div class="overlay">
                                <div class="category-text">
                                    <a href="{{route('property.velayat',['id' => $velayat->id])}}">
                                        <h3 class="overlay-title">@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                        @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                        @else {{$velayat->velayat_tm}}
                                        @endif
                                        {{$velayat->id === 6 ? '' : __('messages.vel')}}</h3>
                                    </a>
                                    <span class="text-capitalize">
                                        {{\App\Property::where('velayat_id', $velayat->id)->where('accepted', 1)->where('expiring_at', '>', Carbon\Carbon::now())->get()->count()}} {{__('messages.property')}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </div>
    </section>
    <!-- Popular Category End -->

    <!-- Service Section Start -->
    <section id="service_part3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-row">
                        <h3 class="section_title_blue">{{__('messages.looking_for')}}</h3>
                        <div class="sub-title">                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($types_ru))
                    @foreach($types_ru as $type)
                        
                        <div class="col-md-6 col-sm-6">
                            <div class="service_area wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                                <div class="service_icon"><i class="glyph-icon {{$type->id === 1 ? 'flaticon-home' : 'flaticon-buildings'}} "></i></div>
                                <a href="{{route('property.type',['id' => $type->id])}}">
                                    <h4 class="service_title">{{__('messages.'.strtolower($type->name_en))}}</h4>
                                </a>
                                <p>{{$type->id === 1 ? __('messages.do_search_resid') : __('messages.do_search_comm') }}</p>
                            </div>
                        </div>

                    @endforeach
                @elseif(isset($types_en))
                    @foreach($types_en as $type)
                        
                        <div class="col-md-6 col-sm-6">
                            <div class="service_area wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
                                <div class="service_icon"><i class="glyph-icon {{$type->id === 1 ? 'flaticon-home' : 'flaticon-buildings'}}"></i></div>
                                <a href="{{route('property.type',['id' => $type->id])}}">
                                    <h4 class="service_title">{{__('messages.'.strtolower($type->name_en))}}</h4></a>
                                <p>{{$type->id === 1 ? __('messages.do_search_resid') : __('messages.do_search_comm') }}</p>
                            </div>
                        </div>

                        
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- info Banner -->
    <section id="property-submit">
        <div class="container">
            <div class="row">
                <div class="banner-element">
                    <span>{{__('messages.sell_property')}}</span>
                    <h2 class="banner-title">{{__('messages.we_help')}}</h2>
                    @auth
                        @if( !Auth::user()->admin )
                            <a class="btn btn-default" href="{{route('property.submit.page')}}">{{__('messages.submit_property')}}</a>
                        @endif
                    @else
                        <a class="btn btn-default" href="{{route('property.submit.page')}}">{{__('messages.submit_property')}}</a>
                    @endauth
                    
                </div>
            </div>
        </div>
    </section>
    <!-- info Banner End -->

    <!-- Recent News Section Start -->
    <section id="recent_news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-row">
                        <h3 class="section_title_blue">{{__('messages.useful_articles')}}</h3>
                        <div class="sub-title"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="news_area wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
                        <div class="news_img">
                            <a href="http://homester.com.ua/remont/textile/kak-oformit-okno-na-balkon/"><img src="img/news/news-1.jpg" alt=""></a>
                            <div class="news_eye" onclick="location.href='http://homester.com.ua/remont/textile/kak-oformit-okno-na-balkon/';"><i class="fa fa-eye" aria-hidden="true"></i></div>
                        </div>
                        <div class="news_text">
                            <a href="http://homester.com.ua/remont/textile/kak-oformit-okno-na-balkon/" target="blank">
                                <h5 class="post-title">Как оформить окно с балконной дверью</h5>
                            </a>
                            <div class="post-info">
                                <i class="fa fa-calendar" title="Опубликовано" aria-hidden="true">&nbsp;&nbsp;11/05/2018</i><i class="fa fa-eye" title="Просмотров" aria-hidden="true">&nbsp;&nbsp;7</i>
                            </div>
                            <div class="blog-content">
                                <p>{{str_limit('Балкон — одна из неотъемлемых составляющих каждой квартиры. Соответственно, балконная дверь и смежное с ней окно — тоже. Вдохновляясь примерами интерьеров на сайтах зарубежных дизайнеров и анализируя их работу, именно с этим элементом современного жилища возникают трудности. Потому что, вглядываясь в фото красивых интерьеров, создается такое впечатление, что в них таких окон и балконных дверей априори нет и быть не может. Но это не совсем так. Абсолютно любой уголок дома можно и нужно делать красивым.', 140)}}</p>
                            </div>
                            <a class="btn-read" href="http://homester.com.ua/remont/textile/kak-oformit-okno-na-balkon/" target="_blank">{{__('messages.read_more')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="news_area wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                        <div class="news_img">
                            <a href="http://homester.com.ua/experts/soveti/vibrat-zaluzi/"><img src="img/news/news-2.jpg" alt=""></a>
                            <div class="news_eye" onclick="location.href='http://homester.com.ua/experts/soveti/vibrat-zaluzi/';"><i class="fa fa-eye" aria-hidden="true"></i></div>
                        </div>
                        <div class="news_text">
                            <a href="http://homester.com.ua/experts/soveti/vibrat-zaluzi/" target="blank">
                                <h5 class="post-title">Защита от солнца. Какие жалюзи лучше?</h5>
                            </a>
                            <div class="post-info">
                                <i class="fa fa-calendar" title="Опубликовано" aria-hidden="true">&nbsp;&nbsp;11/05/2018</i><i class="fa fa-eye" title="Просмотров" aria-hidden="true">&nbsp;&nbsp;7</i>
                            </div>
                            <div class="blog-content">
                                <p>{{str_limit('У меня спальня расположена как раз на солнечной стороне, летом за день очень сильно нагревается — это первая проблема, иногда там в обед укладываю спать ребенка — это вторая проблема (солнце упирается в него и малыш встает совсем мокрый). Сейчас предлагают большой выбор жалюзей, но разобраться во всем этом не могу. Может, кто-то подскажет, что лучше выбрать.', 140)}}</p>
                            </div>
                            <a class="btn-read" href="http://homester.com.ua/experts/soveti/vibrat-zaluzi/" target="blank">{{__('messages.read_more')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="news_area wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1000ms">
                        <div class="news_img">
                            <a href="http://homester.com.ua/design/rooms/idei-dlya-spalni/prikrovatnya-zona/"><img src="img/news/news-3.jpg" alt=""></a>
                            <div class="news_eye" onclick="location.href='http://homester.com.ua/design/rooms/idei-dlya-spalni/prikrovatnya-zona/';"><i class="fa fa-eye" aria-hidden="true"></i></div>
                        </div>
                        <div class="news_text">
                            <a href="http://homester.com.ua/design/rooms/idei-dlya-spalni/prikrovatnya-zona/" target="blank">
                                <h5 class="post-title">Как оформить прикроватную зону: основные составляющие</h5>
                            </a>
                            <div class="post-info">
                                <i class="fa fa-calendar" title="Опубликовано" aria-hidden="true">&nbsp;&nbsp;11/05/2018</i><i class="fa fa-eye" title="Просмотров" aria-hidden="true">&nbsp;&nbsp;7</i>
                            </div>
                            <div class="blog-content">
                                <p>{{str_limit('Зона спальни в каждом доме — это один из самых интересных участков для оформления. Это место достаточно уединенное, даже интимное. Здесь должно быть спокойно и уютно одновременно. В этой статье мы обсудим, как правильно оформить прикроватную зону.',140)}}</p>
                            </div>
                            <a class="btn-read" href="http://homester.com.ua/design/rooms/idei-dlya-spalni/prikrovatnya-zona/" target="blank">{{__('messages.read_more')}}</a>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </section>
    <!-- Recent News Section End -->

    @if( !Auth::check() )
        <!-- Register Section Start -->
        <section id="register-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="reg_banner">
                            <h4 class="reg_banner_title">{{__('messages.agent_looking_house')}}</h4>
                            <span>{{__('messages.please_click')}}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="register_btn">
                            <a href="/register" class="btn btn-primary">{{__('messages.register')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Register Section End -->
    @endif
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#slider-fixed').css('background-image', 'url("/img/slider/fixed-slider.jpg")');
        });
    </script>

    <script>
        (function ($, undefined) {
            "use strict";
            // When ready.
            $(function(){               
                $('.fare_select').each(function(){
                    var cls = $(this).attr('class'), id = $(this).attr('id'), named = $(this).attr('name'), chen, selID, tmp1, velID, cBor, copt, tmp;

                    tmp = '';
                    cBor = '';

                    if( $(this).attr('id') == 'sale' ) cBor=' cusBorRad3';
                    else if( $(this).attr('id') == 'cityy' ) cBor=' city_adj';

                    tmp1='<div class="' + cls + '"><span class="c_sel_trig' + cBor + '">';

                    $(this).find('option').each(function(){
                        
                        selID=''; chen=''; velID='';

                        if($(this).is(':selected')){
                            chen='seled '; 
                            tmp1 += $(this).text() + '</span><div class="c_opts pr_back_col'; 
                            
                            if( named=='cityy' ){ 
                                tmp1 += ' ' + named;
                            } 
                            
                            tmp1 += '">';
                        }
                        
                        if( $(this).data('vel') ){ 
                            
                            velID = 'data-vel=' + $(this).data('vel');
                        }

                        if( $(this).attr('id') ){
                            
                            selID = 'data-selid="' + $(this).attr('id') + '"'; 
                            
                            if( $(this).attr('id') != $('div.velayat_select .c_opts .seled').data('value') ){
                                chen+='hide ';
                            }
                        }

                        copt = 'c_opt ';

                        if( named=='cityy' && $(this).hasClass('cityy_before') ){
                            copt=''
                        }

                        tmp += '<span class="'+ copt + chen + $(this).attr('class') + '" '+ velID + selID +' data-value="' + $(this).attr('value') + '">' + $(this).html() + '</span>';
                    });

                    tmp = tmp1 + tmp;
                    tmp += '</div></div>';
                    tmp1 = $(this).hasClass('odd_cls') ? ' odd_cls hide' : '';

                    $(this).wrap('<div class="c_sel_wrap' + tmp1 + '"></div>');
                    $(this).hide();
                    $(this).after(tmp);
                });
                
                $('.c_opt:first-of-type').hover(function(){ 
                    $(this).parents('.c_opts').addClass('opt_hov'); 
                }, function(){ 
                    $(this).parents('.c_opts').removeClass('opt_hov');
                });
                
                $('.c_sel_trig').on('click', function () {
                    
                    $('div.fare_select').not($(this).parents('.fare_select')).removeClass('oped');
                    $('div.cus_select').not($(this).parents('div.cus_select')).removeClass('oped');

                    if( !$(this).parent().parent($(this).parents('.cus_select')).hasClass('obj_wrap') && !$(this).hasClass('kv_pop') && !$(this).hasClass('area_pop') ){
                        
                        $(this).parents('.fare_select').toggleClass('oped');

                    } else {

                        $(this).parents('div.cus_select').toggleClass('oped'); 
                    }

                    event.stopPropagation();

                });

                $('.c_opt').on('click', function(){

                    $(this).parents('.c_sel_wrap').find('select').val($(this).data('value'));

                    if( $(this).parent().hasClass('cityy') ){
                        $(this).hasClass('al_city') ? $('span.cityy_before').addClass('prim_color') : $('span.cityy_before').removeClass('prim_color');
                    }

                    if( $(this).data('vel') ){
                        
                        var velid=$(this).data('vel'), tTxt=$('div.cityy .c_opt:first').text();

                        $('div.cityy').find('span').not(':first').not(':nth-child(2)').addClass('hide').removeClass('seled').parent().find('span').each(function(i, el){ 
                            
                            if( i === 0 ){  $(this).addClass('prim_color'); }
                            if( i === 1 ){ $(this).addClass('seled'); }                            
                            if( $(this).data('selid') == velid ){ $(this).removeClass('hide'); }

                        });

                        $('div.cityy').parents('.c_sel_wrap').find('select[name="cityy"]').val(0).next().find('.c_sel_trig').text(tTxt);
                    }
                    
                    $(this).parents('.c_opts').find('.c_opt').removeClass('seled');
                    $(this).addClass('seled');
                    $(this).parents('.fare_select').removeClass('oped');
                    $(this).parents('.fare_select').find('.c_sel_trig').text($(this).text());

                    $(this).is(':first-child') ? $(this).parents('.c_opts').addClass('pr_back_col') : $(this).parents('.c_opts').removeClass('pr_back_col');

                    if( $(this).parent().parent().hasClass('ob_type') ){
                        
                        if( ( $('input[name="object"]:checked').val()=='11' || $('input[name="object"]:checked').val()=='3' ) && $('div.ob_type .c_opts .seled').data('value')=='0' ){ 
                            $('div.ob_type .c_opts .c_opt:nth-child(1)').removeClass('seled').next().addClass('seled'); 
                            $('.c_sel_wrap div.ob_type .c_sel_trig').text( $('div.ob_type .c_opts .c_opt:nth-child(2)').text() ).parent().find('.c_opts').removeClass('pr_back_col').parents('.c_sel_wrap').find('select').val( $('div.ob_type .c_opts .c_opt:nth-child(2)').data('value') );
                            toastr.error("{{__('messages.invalid_selection')}}");
                            return;
                        }

                        swObject( $('input[name="object"]:checked').val() );
                        $(this).data('value') == 0 ? $('.prop_filter_ls:eq(1) li:eq(3)').addClass('hide') : $('.prop_filter_ls:eq(1) li:eq(3)').removeClass('hide');
                    }
                });

                $('input[name="min_ar_fil"]').on('change keyup paste', function(){
                    
                    $(this).val($(this).val().replace(/,/g, ''));
                    
                    if(!$(this).val()){
                        
                        if( !$('input[name="max_ar_fil"]').val() ){ 
                            $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text("{{__('messages.area')}}"); 
                        }else{ 
                            $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text("{{__('messages.till')}}" + ' ' + $('input[name="max_ar_fil"]').val()); 
                        }

                    }else{

                        var tmep1;

                        if( $('input[name="max_ar_fil"]').val() ){ 
                            
                            tmep1 = $(this).val() + ' - ' + $('input[name="max_ar_fil"]').val();

                        }else{ 
                            
                            tmep1 = "{{__('messages.from2')}}" + ' ' + $(this).val();
                        }

                        $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text(tmep1);

                    }
                });

                $('input[name="max_ar_fil"]').on('change keyup paste', function(){
                    
                    $(this).val($(this).val().replace(/,/g, ''));

                    if( !$(this).val() ){
                        
                        if( !$('input[name="min_ar_fil"]').val() ){ 
                            
                            $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text("{{__('messages.area')}}");

                        }else{ 
                            
                            $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text("{{__('messages.from2')}}" + ' ' + $('input[name="min_ar_fil"]').val());
                        }

                    }else{

                        var tmep;

                        if( !$('input[name="min_ar_fil"]').val() ){ 
                            
                            tmep = "{{__('messages.till')}}" + ' ' + $(this).val();

                        }else{ 
                            
                            tmep = $('input[name="min_ar_fil"]').val() + ' - ' + $(this).val();
                        }

                        $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text(tmep);

                    }

                });

                $('input[name="max_ar_fil"]').on('blur', function(){

                    if( $(this).val() && $('input[name="min_ar_fil"]').val() && !$(this).parents('cus_select').hasClass('oped') ){
                        if( parseFloat($(this).val()) < parseFloat($('input[name="min_ar_fil"]').val().replace(',', '')) ){
                            
                            $(this).val($('input[name="min_ar_fil"]').val());
                            $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text( $('input[name="min_ar_fil"]').val() + ' - ' + $(this).val() );

                        }
                    }

                });

                $('input[name="min_ar_fil"]').on('blur', function(){
                    if( $(this).val() && $('input[name="max_ar_fil"]').val() && !$(this).parents('cus_select').hasClass('oped') ){
                        if( parseFloat( $(this).val() ) > parseFloat( $('input[name="max_ar_fil"]').val() ) ){
                            
                            $(this).val( $('input[name="max_ar_fil"]').val() );
                            $(this).parents('.c_sel_wrap').find('.area_pop span:eq(0)').text( $(this).val() + ' - ' + $('input[name="max_ar_fil"]').val() );

                        }
                    }
                });

                $('.prop_filter_ls_item').on('click', function(){ 
                    
                    if( $(this).text().trim().length > 13 ){

                        $(this).parents('.cus_select').removeClass('oped').find('.c_sel_trig').text( $(this).text().trim().substr(0, 13) + '..' ); 

                    }else{

                        $(this).parents('.cus_select').removeClass('oped').find('.c_sel_trig').text( $(this).text().trim() );
                    }

                    swObject($(this).find('input').val()); 
                });

                $('input[id^="room_fil"]').on('change', function(){
                    
                    var cVak = '';

                    $('input[id^="room_fil"]:checked').each(function(){
                        
                        cVak += this.value + ', ';

                    });

                    switch ($('input[id^="room_fil"]:checked').length){
                        case 0:
                            $('.kv_pop').text("{{__('messages.room')}}");
                            break;
                            
                        case 1:
                            $('.kv_pop').text(cVak.substring(0,1)+'-{{__('messages.roomed')}}');
                            break;

                        case 2:
                            $('.kv_pop').text(cVak.substring(0, 4) + ' ' + '{{__("messages.room_sh1")}}');
                            break;

                        default:
                            $('.kv_pop').text(cVak.substring(0, cVak.length - 2) + '   ' + '{{__("messages.room_sh2")}}');
                    }
                });
                /* adjust the last feature space of commercial property */
                $('.l_feat').each(function(){
                    var par_area, tot_area = 0;
                    par_area = $(this).parent().outerWidth();                
                    $(this).parent().find('span:not(:last)').each(function(){
                        tot_area += $(this).outerWidth();
                    });
                    $(this).css({'width' : (par_area-tot_area-5) + 'px' }); 
                });
            });

            function swObject( ob_tp ){

                $('div.c_sel_wrap.odd_cls, .s_apart, .e_apart').addClass('hide');
                $('.kv_pop, .duzelt1, .area_pop').removeClass('cusBorRad4');
                $('input[name="min_price"], input[name="max_price"]').parent().removeClass('t_w-p-50');
                $('.carousel-caption').removeClass('m_top-310').removeClass('m_top-285').removeClass('m_top-260');
                $('.kv_pop').next('.c_opts').removeClass('m_top-270');
                
                switch( ob_tp ){
                    case '1':
                        $('.odd_cls:eq(0), .s_apart').removeClass('hide');
                        $('.kv_pop').addClass('cusBorRad4');
                        $('.carousel-caption').addClass('m_top-285');
                        break;

                    case '2':
                        $('.odd_cls:eq(0), .e_apart').removeClass('hide');
                        $('.kv_pop').addClass('cusBorRad4');
                        $('.carousel-caption').addClass('m_top-285');
                        $('.kv_pop').next('.c_opts').addClass('m_top-270');
                        break;

                    case '3':
                    case '4':
                    case '5':
                    case '11':
                        $('.duzelt1').addClass('cusBorRad4');
                        $('.carousel-caption').addClass('m_top-260');
                        break;

                    case '6':
                    case '7':
                    case '8':
                    case '9':
                    case '10':

                        $('.carousel-caption').addClass('m_top-310');

                        if( $('select#sale').val() == 0 ){ 
                            
                            $('.odd_cls:eq(1)').nextAll().removeClass('hide');

                        }else{ 

                            $('.odd_cls:odd').removeClass('hide');
                        }

                        $('.area_pop').addClass('cusBorRad4');
                }

                if( ob_tp == '3' || ob_tp == '4' || ob_tp == '5' || ob_tp == '11' ){
                    $('input[name="min_price"], input[name="max_price"]').parent().addClass('t_w-p-50');
                }

            }
        })(jQuery);        
    </script>
@endsection