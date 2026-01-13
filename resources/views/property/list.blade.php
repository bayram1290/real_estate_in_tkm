@extends('layouts.front')

@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="page_location">
                <a href="{{route('index')}}">{{__('messages.home')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span>{{__('messages.list_properties')}}</span>
            </div>
            <h3 class="page_title">{{__('messages.list_properties')}}</h3>
            @if( $prop_count > 0 )
                <div class="col-md-12 p-l-0">
                    <span class="list_properties_count">{{$prop_count}}
                        @if( $prop_count > 1 )
                            {{__('messages.offers_sorted')}}    
                        @else
                            {{__('messages.offer_sorted')}}    
                        @endif
                    </span>
                </div>
            @endif
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
                <div class="col-lg-8 col-md-7 tab-pane fade in active" id="nav-content" role="tabpanel" aria-labelledby="nav-content-tab">
                    <!-- Property Grids -->
                    <div class="row" id="property-grid">
                        @if(isset($properties) && count($properties) > 0)
                            @foreach($properties as $property)
                                @if(Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($property->expiring_at),false) >= 1)
                                    <div class="column mix mix_all house {{$property->type_id}} appartment col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                        <div class="property_grid">
                                            <div class="img_area">
                                                <div class="sale_btn">{{$property->saleOrRent ? __('messages.sale') : __('messages.rent')}}</div>
                                                @if($property->featured)
                                                    <div class="featured_btn">{{ __('messages.premium') }}</div>
                                                @endif
                                                <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}" class="prop_grid_filter" target="_blank">
                                                    <img src="{{$property->img}}">
                                                </a>
                                                <div class="sale_amount">{{$property->created_at->diffForHumans()}}</div>
                                                <div class="hover_property">
                                                    <ul>
                                                        <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
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
                        @else
                            <!-- No property exists notification starts -->
                            <div class="verify-msg">
                                <div class="msg-wrapper">
                                    <p>{{__('messages.no_result_search')}}</p>
                                </div>
                            </div>
                            <!-- No property exists notification ends -->
                        @endif
                    </div>
                    <!-- End property Grids -->

                    <!-- Pagination starts -->
                    <div class="row">
                        <div class="col-md-12 t_txt_center">
                            <div class="pagination_area">
                                <nav aria-label="Page navigation" id="pagination">{{$properties->links()}}</nav>
                                <nav aria-label="Mobile page navigation" id="pagination_mobile">                                    
                                    {{$properties->render("pagination::list-mobile-pagination") }}
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination ends -->

                </div>
                <!-- Start Sidebar -->
                <div class="col-lg-4 col-md-5 tab-pane fade" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
                    <div class="property_sidebar">
                        <form method="GET" action="{{route('property.search')}}" class="price-filter">
                            <h4 class="widget-title t_txt_center m-b-40">{{__('messages.advanced')}}</h4>
                            <div class="pr_unit_switch">
                                <input type="checkbox" name="price_unit" class="pr_unit_switch_box" id="pr_unit_switch" {{ isset( $selected_price_unit ) ? 'checked' : '' }}>
                                <label class="pr_unit_switch_lbl" for="pr_unit_switch">
                                    <span class="pr_unit_switch_inner"></span>
                                    <span class="pr_unit_switch_btn"></span>
                                </label>
                            </div>
                            <div class="price_range sidebar-widget">
                                <h5 class="widget-title">{{__('messages.price')}}</h5>
                                <span class="price-slider">
                                    <input class="filter_price" type="text" name="price" value="0;1000000"/>
                                </span>
                                <div class="pr_terr1" id="rent_pr_terr">
                                    <span>{{__('messages.price')}}</span>
                                    <div class="btn-group toGGle p-r-10 p-l-10" data-toggle="buttons">
                                        <label class="btn btn-primary cus_pill cusBorRad1 {{ (isset($selected_rent_terr) && $selected_rent_terr==1) ? 'active': '' }}{{ !isset($selected_rent_terr) ? 'active': '' }}">
                                            <input type="radio" name="rent_pr_terr" value="1" {{ (isset($selected_rent_terr) && $selected_rent_terr==1) ? 'checked': '' }} {{ !isset($selected_rent_terr) ? 'checked': '' }}>{{__('messages.per_month')}}
                                        </label>
                                        <label class="btn btn-primary cus_pill cusBorRad2 {{ (isset($selected_rent_terr) && $selected_rent_terr==2) ? 'active': '' }}">
                                            <input type="radio" name="rent_pr_terr" value="2" {{ (isset($selected_rent_terr) && $selected_rent_terr==2) ? 'checked': '' }}>{{__('messages.per_m_sq')}}&sup2; {{__('messages.per_year')}}
                                        </label>
                                    </div>
                                </div>
                                <div class="pr_terr1" id="sale_pr_terr">
                                    <span>{{__('messages.price')}}</span>
                                    <div class="btn-group toGGle" data-toggle="buttons">
                                        <label class="btn btn-primary cus_pill cusBorRad1 {{ (isset($selected_sale_terr) && $selected_sale_terr==1) ? 'active': '' }}{{ !isset($selected_sale_terr) ? 'active': '' }}">
                                            <input type="radio" name="sale_pr_terr" value="1" {{ (isset($selected_sale_terr) && $selected_sale_terr==1) ? 'checked': '' }}{{ !isset($selected_sale_terr) ? 'checked': '' }}>{{__('messages.for_all')}}
                                        </label>
                                        <label class="btn btn-primary cus_pill cusBorRad2 {{ (isset($selected_sale_terr) && $selected_sale_terr==2) ? 'active': '' }}">
                                            <input type="radio" name="sale_pr_terr" value="2" {{ (isset($selected_sale_terr) && $selected_sale_terr==2) ? 'checked': '' }}>{{__('messages.per_m_sq')}}&sup2;
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="price_range sidebar-widget">
                                <h5 class="widget-title">{{__('messages.area')}}</h5>
                                <span class="price-slider"><input class="area_filter" type="text" name="area" value="0;10000"/></span>
                            </div>
                            <select name="sale" class="s_select ob_type">
                                <option class="option" value="0" {{ isset($selected_deal) && $selected_deal == 0 ? 'selected' : '' }}>{{__('messages.rent_it')}}</option>
                                <option class="option" value="1" {{ isset($selected_deal) && $selected_deal == 1 ? 'selected' : '' }}>{{__('messages.buy_it')}}</option>
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
                                                                <label class="prop_filter_ls_item btn">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}">{{$object->name_ru}}</label>
                                                            </li>
                                                        @endif
                                                    @else
                                                        @if($object->type_id == 1)
                                                            <li>
                                                                <label class="prop_filter_ls_item btn">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}">{{$object->name_en}}</label>
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
                                                                <label class="prop_filter_ls_item btn">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}">{{$object->name_ru}}</label>
                                                            </li>
                                                        @endif
                                                    @else
                                                        @if($object->type_id == 2)
                                                            <li class="{{$object->id == 9 ? 'hide' :''}}">
                                                                <label class="prop_filter_ls_item btn">
                                                                    <input type="radio" class="hide" name="object" value="{{$object->id}}">{{$object->name_en}}</label>
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
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_1" class="cusCheckBox" name="cnt_room[]" value="1">&nbsp;<label for="room_fill_1">1-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_2" class="cusCheckBox" name="cnt_room[]" value="2">&nbsp;<label for="room_fill_2">2-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt"><input type="checkbox" id="room_fill_3" class="cusCheckBox" name="cnt_room[]" value="3">&nbsp;<label for="room_fill_3">3-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt s_apart"><input type="checkbox" id="room_fill_4" class="cusCheckBox" name="cnt_room[]" value="4">&nbsp;<label for="room_fill_4">4-{{__('messages.roomed')}} {{__('messages.and_more')}}</label></span>

                                        <span class="kv_opt e_apart hide"><input type="checkbox" id="room_fill_41" name="cnt_room[]" class="cusCheckBox" value="4"/>&nbsp;<label for="room_fill_41">4-{{__('messages.roomed')}}</label></span>
                                        <span class="kv_opt e_apart hide"><input type="checkbox" id="room_fill_5" name="cnt_room[]" class="cusCheckBox" value="5"/>&nbsp;<label for="room_fill_5">5-{{__('messages.roomed')}} {{__('messages.and_more')}}</label></span>
                                    </div>
                                </div>
                            </div>
                            <select name="t_premises" class="s_select odd_class">
                                <option selected disabled class="hide">{{__('messages.t_facility')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($trade_rooms as $trade_room)
                                    <option class="option" value="{{$trade_room->id}}" {{(isset($selected_t_premises) && $selected_t_premises==$trade_room->id) ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$trade_room->room_ru}}
                                    @elseif(Lang::locale() == 'en') {{$trade_room->room_en}}
                                    @else {{$trade_room->room_tm}}
                                    @endif</option>
                                @endforeach
                            </select>
                            <select name="velayat" class="s_select velayat_select">
                                @foreach($velayats as $velayat)
                                    <option class="option" data-vel="{{$velayat->id}}" value="{{$velayat->id}}">@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                                @endforeach
                            </select>
                            <select name="city1" class="s_select" id="s_city">
                                <option class="cityy_before prim_color"></option>
                                <option class="option al_city" value="0">{{__('messages.all_etraps')}}</option>
                                @foreach($cities as $city)
                                    <option class="option" id="{{$city->velayat_id}}" value="{{$city->id}}">@if(Lang::locale() == 'ru') {{$city->city_ru}}
                                    @elseif(Lang::locale() == 'en') {{$city->city_en}}
                                    @else {{$city->city_tm}}
                                    @endif</option>
                                @endforeach
                            </select>
                            <select name="home_status" class="s_select odd_class prop_state">
                                <option disabled selected class="hide">{{__('messages.property_state')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                <option value="1" class="option" {{ isset($selected_property_status) && $selected_property_status==1 ? 'selected' : ''}}>{{__('messages.redeemed')}}</option>
                                <option value="2" class="option" {{ isset($selected_property_status) && $selected_property_status==2 ? 'selected' : ''}}>{{__('messages.with_debt')}}</option>
                            </select>
                            <div class="c_sel_wrap w_100_per odd_class m-b-20">
                                <input type="number" name="debt_amount" min="1" step="1" class="inp_debt_filter" placeholder="{{__('messages.debt_amount')}}" value="{{ isset($selected_debt_amount) ? $selected_debt_amount : ''}}"><span class="option m-l-20">TMT</span>
                            </div>
                            <div class="c_sel_wrap w_100_per odd_class m_m-b-20">
                                <input type="number" name="floor" min="0" step="1" class="c_sel_trig w_100_per m-b-20" placeholder="{{__('messages.floor')}}" value="{{ isset($selected_floor) ? $selected_floor : ''}}"/>
                            </div>
                            <div class="c_sel_wrap w_100_per odd_class m_m-b-20">
                                <input type="number" name="tot_floor" min="0" step="1" class="c_sel_trig w_100_per m-b-20" placeholder="{{__('messages.total_floor')}}" value="{{ isset($selected_tot_floor) ? $selected_tot_floor : '' }}"/>
                            </div>
                            <select class="s_select odd_class" name="apart_type">
                                <option selected disabled class="hide">{{__('messages.apartment_type')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach( $apartment_types as $apart_type )
                                    <option value="{{ $apart_type->id }}" class="option" {{ (isset($selected_apart_type) && $selected_apart_type == $apart_type->id) ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$apart_type->type_ru}}
                                            @elseif(Lang::locale() == 'en') {{$apart_type->type_en}}
                                            @else {{$apart_type->type_tm}}
                                            @endif</option>
                                @endforeach
                            </select>
                            <select class="s_select odd_class" name="floor_mat">
                                <option disabled selected class="hide">{{__('messages.floor_mat')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($floor_materials as $floor_material)
                                    <option class="option" value="{{$floor_material->id}}" {{ (isset($selected_floor_mat) && $selected_floor_mat==$floor_material->id) ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$floor_material->material_ru}}
                                    @elseif(Lang::locale() == 'en') {{$floor_material->material_en}}
                                    @else {{$floor_material->material_tm}}
                                    @endif</option></option>
                                @endforeach
                            </select>

                            <select name="decor" class="s_select odd_class">
                                <option class="option hide" disabled selected>{{__('messages.decor')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($revamps as $revamp)
                                    <option class="option" value="{{$revamp->id}}" {{ (isset($selected_decor) && $selected_decor==$revamp->id) ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$revamp->type_ru}}
                                    @elseif(Lang::locale() == 'en') {{$revamp->type_en}}
                                    @else {{$revamp->type_tm}}}
                                    @endif</option>
                                @endforeach
                            </select>
                            <select class="s_select odd_class" name="condition">
                                <option class="it_cap hide" disabled selected>{{__('messages.condition')}}</option>                                
                                <option class="it_cap option">{{__('messages.any')}}</option>
                                @foreach($conditions as $condition)                                    
                                    <option class="option it_cap" value="{{$condition->id}}" {{(isset($selected_condition) && $selected_condition==$condition->id) ? 'selected' : ''}}>@if(Config::get('app.locale') == 'ru') {{$condition->condition_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$condition->condition_en}}
                                            @else {{$condition->condition_tm}} @endif</option>
                                @endforeach
                            </select>
                            <div class="c_sel_wrap w_100_per m-b-20 odd_class">
                                <div class="cus_select">
                                    <span class="c_sel_trig">{{__('messages.parking')}}</span>
                                    <div class="c_opts s_parking btn-group toGGle" id="s_res_parking" data-toggle="buttons">
                                        <label for="parking_0" class="btn option"><input type="radio" name="res_parking" id="parking_0">{{__('messages.any')}}</label>
                                        @foreach($parkings as $parking)
                                            @if( $parking->id !==3 && $parking->id !== 4 )
                                            <label for="parking_{{$parking->id}}" class="btn option {{ $parking->id == 5 ? 'hide' : '' }}">
                                                    <input type="radio" name="res_parking" value="{{$parking->id}}" id="parking_{{$parking->id}}">@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                    @else {{$parking->parking_tm}}
                                                    @endif</label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="c_sel_wrap w_100_per m-b-20 odd_class">
                                <div class="cus_select">
                                    <span class="c_sel_trig">{{__('messages.parking')}}</span>
                                    <div class="c_opts s_parking btn-group toGGle" id="s_com_parking" data-toggle="buttons">
                                        <label for="parking_01" class="btn option"><input type="radio" name="com_parking" id="parking_01">{{__('messages.any')}}</label>
                                        @foreach($parkings as $parking)
                                            @if($parking->id > 2)
                                                <label for="parking_{{$parking->id == 5 ? '51' : $parking->id}}" class="btn option" style="text-transform: capitalize">
                                                    <input type="radio" name="com_parking" value="{{$parking->id}}" id="parking_{{$parking->id == 5 ? '51' : $parking->id}}">@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                    @else {{$parking->parking_tm}}
                                                    @endif</label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <select name="t_build" class="s_select odd_class">
                                <option selected disabled class="hide">{{__('messages.t_build')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($build_appoints as $appoint)
                                    <option class="option" value="{{$appoint->id}}" {{ (isset($selected_t_build) && $selected_t_build==$appoint->id) ? 'selected' : '' }}>@if(Config::get('app.locale') == 'ru') {{$appoint->type_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$appoint->type_en}}
                                            @else {{$appoint->type_tm}} @endif
                                    </option>
                                @endforeach
                            </select> 
                            <select name="day_week" class="s_select odd_class">
                                <option class="option hide" disabled selected>{{__('messages.work_days')}}</option>
                                <option class="it_cap option">{{__('messages.any')}}</option>
                                <option value="1" class="option" {{ (isset($selected_day_week) && $selected_day_week==1) ? 'selected' : '' }}>{{ __('messages.w_days') }}</option>
                                <option value="2" class="option" {{ (isset($selected_day_week) && $selected_day_week==2) ? 'selected' : '' }}>{{ __('messages.w_ends') }}</option>
                                <option value="3" class="option" {{ (isset($selected_day_week) && $selected_day_week==3) ? 'selected' : '' }}>{{ __('messages.daily') }}</option>
                            </select>
                            <select name="t_house" class="s_select odd_class">
                                <option class="option hide" disabled selected>{{__('messages.t_house')}}</option>
                                <option class="option">{{__('messages.any')}}</option>                                
                                @foreach( $buildings as $building )
                                    <option value="{{ $building->id }}" class="option" {{ (isset($selected_t_house) && $selected_t_house==$building->id) ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$building->building_ru}}
                                        @elseif(Lang::locale() == 'en') {{$building->building_en}}
                                        @else {{$building->building_tm}}
                                        @endif</option>
                                @endforeach
                            </select>
                            <select name="t_rents" class="s_select odd_class">
                                <option class="option hide" disabled selected>{{__('messages.rent_type')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($r_types as $r_type)
                                    <option value="{{$r_type->id}}" class="option" {{ (isset($selected_t_rents) && $selected_t_rents==$r_type->id) ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$r_type->type_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$r_type->type_en}}
                                                    @else {{$r_type->type_tm}}
                                                    @endif</option>
                                @endforeach
                            </select>
                            <select name="t_sale" class="s_select odd_class">
                                <option class="option hide" disabled selected>{{__('messages.sale_type')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($sale_types as $sale_type)
                                    <option class="option" value="{{ $sale_type->id }}"  {{ (isset($selected_type_sale) && $selected_type_sale==$sale_type->id) ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$sale_type->type_ru}}
                                        @elseif(Lang::locale() == 'en') {{$sale_type->type_en}}
                                        @else {{$sale_type->type_tm}}
                                        @endif</option>
                                @endforeach
                            </select>
                            <select name="buss_t_prop" class="s_select odd_class">
                                <option disabled selected class="hide">{{__('messages.property_type')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($buss_t_props as $b_t_p)
                                    <option value="{{$b_t_p->id}}" class="option" {{(isset($selected_buss_t_prop) && $selected_buss_t_prop==$b_t_p->id) ? 'selected' : ''}}>@if(Config::get('app.locale') == 'ru') {{$b_t_p->type_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$b_t_p->type_en}}
                                            @else {{$b_t_p->type_tm}} @endif
                                    </option>
                                @endforeach
                            </select>
                            <select name="prop_status" class="s_select odd_class">
                                <option disabled selected class="it_cap hide">{{__('messages.status_property')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                @foreach($st_props as $s_tp)
                                    @if($s_tp->id !== 3)
                                        <option value="{{$s_tp->id}}" class="option it_cap" {{(isset($selected_prop_status) && $selected_prop_status==$s_tp->id) ? 'selected' : ''}}>@if(Config::get('app.locale') == 'ru') {{$s_tp->type_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$s_tp->type_en}}
                                            @else {{$s_tp->type_tm}} @endif</option>
                                    @endif
                                @endforeach
                            </select>                            
                            <select name="prepayment" class="s_select odd_class">
                                <option selected disabled class="hide">{{__('messages.prepayment')}}</option>
                                <option class="option">{{__('messages.any')}}</option>
                                <option class="option" value="1" {{(isset($selected_prepayment) && $selected_prepayment==1) ? 'selected' : ''}}>1 {{__('messages.month1')}}</option>
                                <option class="option" value="2" {{(isset($selected_prepayment) && $selected_prepayment==2) ? 'selected' : ''}}>2 {{__('messages.month2')}}</option>
                                <option class="option" value="3" {{(isset($selected_prepayment) && $selected_prepayment==3) ? 'selected' : ''}}>3 {{__('messages.month2')}}</option>
                                <option class="option" value="4" {{(isset($selected_prepayment) && $selected_prepayment==4) ? 'selected' : ''}}>4 {{__('messages.month2')}}</option>
                                <option class="option" value="5" {{(isset($selected_prepayment) && $selected_prepayment==5) ? 'selected' : ''}}>5 {{__('messages.month3')}}</option>
                                <option class="option" value="6" {{(isset($selected_prepayment) && $selected_prepayment==6) ? 'selected' : ''}}>6 {{__('messages.month3')}}</option>
                                <option class="option" value="7" {{(isset($selected_prepayment) && $selected_prepayment==7) ? 'selected' : ''}}>7 {{__('messages.month3')}}</option>
                                <option class="option" value="8" {{(isset($selected_prepayment) && $selected_prepayment==8) ? 'selected' : ''}}>8 {{__('messages.month3')}}</option>
                                <option class="option" value="9" {{(isset($selected_prepayment) && $selected_prepayment==9) ? 'selected' : ''}}>9 {{__('messages.month3')}}</option>
                                <option class="option" value="10" {{(isset($selected_prepayment) && $selected_prepayment==10) ? 'selected' : ''}}>10 {{__('messages.month3')}}</option>
                                <option class="option" value="11" {{(isset($selected_prepayment) && $selected_prepayment==11) ? 'selected' : ''}}>11 {{__('messages.month3')}}</option>
                                <option class="option" value="12" {{(isset($selected_prepayment) && $selected_prepayment==12) ? 'selected' : ''}}>1 {{__('messages.year')}}</option>
                            </select>                                                                                   
                            <div class="c_sel_wrap odd_class filter_infras">
                                @foreach($features as $feature)
                                    <div class="col-md-6 col-sm-12 col-xs-12 pretty p-default infras1">
                                        <input type="checkbox" value="{{$feature->id}}" name="features[]"/>
                                        <div class="state p-success">
                                            <label>@if(Config::get('app.locale') == 'ru') {{$feature->feature_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$feature->feature_en}}
                                            @else {{$feature->feature_tm}} @endif</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="c_sel_wrap odd_class filter_infras">
                                @foreach($infras as $infra)
                                    <div class="col-md-6 col-sm-12 col-xs-12 pretty p-default infras2">
                                        <input type="checkbox" value="{{$infra->id}}" name="infras[]"/>
                                        <div class="state p-success">
                                            <label class="it_cap">@if(Config::get('app.locale') == 'ru') {{$infra->infrastructure_ru}}
                                            @elseif(Config::get('app.locale') == 'en') {{$infra->infrastructure_en}}
                                            @else {{$infra->infrastructure_tm}} @endif</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <select class="s_select filter_sel" name="filter">
                                <option class="option" value="1" selected>{{__('messages.default')}}</option>
                                <option class="option" value="2">{{__('messages.oldest_item')}}</option>
                                <option class="option" value="3">{{__('messages.price_h')}}</option>
                                <option class="option" value="4">{{__('messages.price_l')}}</option>
                                <option class="option" value="5">{{__('messages.area_large')}}</option>
                                <option class="option" value="6">{{__('messages.area_small')}}</option>
                            </select>
                            <div class="btn_search_wrap">
                                <button type="submit" class="btn btn-default search-btn">{{__('messages.search')}}</button>
                            </div>
                        </form>                        
                    </div>                                    
                </div>
                <!-- End SIdebar -->
                <div class="col-lg-4 col-md-5 fa-pull-right ads_content">
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
            </div>
        </div>
    </section>    
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(".area_filter").slider({from: 0, to: 10000, step: 1, smooth: true, round: 0, dimension: "{{__('messages.meter')}}<sup>2</sup>", skin: "plastic" });

            $('head').append("<style>.pr_unit_switch_inner:after { content: \"{{__('messages.cu')}}\" }</style>");
            
            $('.s_select').each(function(){
                
                var cls = $(this).attr('class'), id = $(this).attr('id'), named = $(this).attr('name'), chen, selID, tmp1, velID, cBor, copt, defVal;
                var tmp = ''; 
                cBor = '';

                if(id == 's_city') cBor=' city_adj1';

                tmp1='<div class="' + cls + '"><span class="c_sel_trig' + cBor + '">'; defVal='';

                $(this).find('option').each(function(){
                    selID = ''; 
                    chen = ''; 
                    velID = '';

                    if( $(this).is(':selected') ){ 
                        if( $(this).val() !== '' && named !== 'filter' ){
                            defVal = 'pr_back_col';
                        } 

                        chen='seled ';

                        tmp1 += $(this).text() + '</span><div class="c_opts ' + defVal;

                        if( named=='city1' ){ 
                            tmp1+=' s_city';
                        } 

                        tmp1+='">';

                        if( named=='t_build' ){ 
                            tmp1+='<div class="scroll_menu">';
                        }
                    }
                    
                    if( $(this).data('vel') ){ 
                        velID = 'data-vel=' + $(this).data('vel');
                    }

                    if( $(this).attr('id') ){ 
                        selID = 'data-selid="' + $(this).attr('id') + '"'; 
                        
                        if( $(this).attr('id') !== $('div.velayat_select .c_opts .seled').data('value') ){
                            chen+='hide ';
                        }
                    }

                    copt='c_opt ';

                    if( named=='city1' && $(this).hasClass('cityy_before') ){
                        copt=''
                    }

                    tmp += '<span class="'+ copt + chen + $(this).attr('class') + '" '+ velID + selID +' data-value="' + $(this).attr('value') + '">' + $(this).html() + '</span>';
                });

                tmp=tmp1 + tmp; 

                tmp+= named=='t_build' ? '</div></div></div>' : '</div></div>';

                $(this).wrap('<div class="c_sel_wrap w_100_per m-b-20"></div>');
                $(this).hide();
                $(this).after(tmp);                
            });         
            
            $('.c_sel_trig').on('click', function () {
                $('div.s_select').not( $(this).parents('.s_select') ).removeClass('oped');

                $('div.cus_select').not( $(this).parents('div.cus_select') ).removeClass('oped');

                if( !$(this).parent().parent( $(this).parents('.cus_select') ).hasClass('obj_wrap') && !$(this).hasClass('kv_pop1') && !$(this).next().hasClass('s_parking') ){
                    
                    $(this).parents('.s_select').toggleClass('oped');
                }else{ 
                    $(this).parents('div.cus_select').toggleClass('oped')
                }

                event.stopPropagation();
            });
            
            $('.c_opt').on('click', function(){

                $(this).parents('.c_sel_wrap').find('select').val( $(this).data('value') );

                if( $(this).parent().hasClass('s_city') ){
                    if( $(this).hasClass('al_city') ){
                        $('span.cityy_before').addClass('prim_color');
                    }else{ 
                        $('span.cityy_before').removeClass('prim_color');
                    }
                }
                
                if( $(this).data('vel') ){
                    
                    var velid = $(this).data('vel'), tTxt = $('div.s_city .c_opt:first').text(); 

                    $('div.s_city').find('span').not(':first, :eq(1)').addClass('hide').removeClass('seled').parent().find('span').each( function(i, el){ 
                        
                        if( i===0 ){  $(this).addClass('prim_color');  } 
                        if( i===1 ){ $(this).addClass('seled'); }  
                        if( $(this).data('selid') == velid ){  $(this).removeClass('hide');  } 
                    });                    
                    $('div.s_city').parents('.c_sel_wrap').find('select').val(0).next().find('.c_sel_trig').text(tTxt); 
                }

                $(this).parents('.c_opts').find('.c_opt').removeClass('seled');
                $(this).addClass('seled');
                $(this).parents('.s_select').removeClass('oped');

                var sel_txt; 
                if( typeof $(this).data('value') === 'undefined' || $(this).data('value').length ){
                    sel_txt = $(this).prev().text().trim();
                }else{
                    sel_txt = $(this).text().trim();
                }

                if( sel_txt.length > 25 ){
                    $(this).parents('.s_select').find('.c_sel_trig').text(sel_txt.substr(0, 25) + '...');
                }else{
                    $(this).parents('.s_select').find('.c_sel_trig').text(sel_txt);
                }
                

                ifFirst( $(this) ) ? $(this).parent().addClass('pr_back_col') : $(this).parent().removeClass('pr_back_col');

                if( $(this).parent().parent().hasClass('ob_type') ){

                    if( $('input[name="object"]:checked').val()=='9' && $('div.ob_type .c_opts .seled').data('value') == '0' ){
                        $('div.ob_type .c_opts .c_opt:nth-child(1)').removeClass('seled').next().addClass('seled'); 
                        $('.c_sel_wrap div.ob_type .c_sel_trig').text( $('div.ob_type .c_opts .c_opt:nth-child(2)').text() ).parent().find('.c_opts').removeClass('pr_back_col').parents('.c_sel_wrap').find('select').val( $('div.ob_type .c_opts .c_opt:nth-child(2)').data('value') ); 

                        toastr.error("{{__('messages.invalid_selection')}}");
                    }
                    
                    sObject($('input[name="object"]:checked').val());

                    $(this).data('value') == 0 ? $('.prop_filter_ls:eq(1) li:eq(3)').addClass('hide') : $('.prop_filter_ls:eq(1) li:eq(3)').removeClass('hide');
                }

                if( $(this).parent().parent().hasClass('prop_state') ){
                    if( $(this).data('value') == 2 ){
                        $('input[name="debt_amount"]').parent().removeClass('hide');
                    }else{
                        $('input[name="debt_amount"]').parent().addClass('hide');
                    }
                }
            });
            
            $('.s_parking .btn').on('click', function(){
                $(this).parent().find('label').removeClass('active');
                $(this).addClass('active');
                $(this).parents('.cus_select').removeClass('oped').find('.c_sel_trig').text($(this).text());
                $(this).parents('.c_opts').removeClass('pr_back_col');

                if( $(this).parents('.s_parking').find('label:eq(0)').hasClass('active') ) {
                    $(this).parents('.c_opts').addClass('pr_back_col');
                }
            });
            
            $('.prop_filter_ls_item').on('click', function() {
                $(this).parents('.cus_select').removeClass('oped').find('.c_sel_trig').text( $(this).text() ); 
                sObject( $(this).find('input').val() );

                if( !$(this).find('input').is(':checked') && ( $(this).find('input').val() == 1 || $(this).find('input').val() == 2 )){
                    $('input[id^="room_fill_"]').prop('checked', false);
                    $('input[id^="room_fill_"]').each(function(i){
                        if( i == 0 || i == 1 ) $(this).prop('checked', true);
                    });
                    $('.kv_pop1').text('1, 2' + ' {{__("messages.room_sh1")}}'); 
                }
            });

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

            $('input#parking_0, input#parking_01').on('change', function(){
                $(this).parents('.cus_select').find('.c_sel_trig').text("{{__('messages.parking')}}");
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
                      
            function sObject(o_tp){
                $('div.c_sel_wrap.odd_class, div.pr_terr1, .s_apart, .e_apart, #s_res_parking label:last-child').addClass('hide');
                $('select.odd_class').parent().addClass('hide');
                $('div.infras1, div.infras2').removeClass('hide');
                $('select[name="apart_type"]').next().find('span:nth-child(n+3)').removeClass('hide');

                $('input[name="features[]"]').prop('checked', false);
                $('input[name="infras[]"]').prop('checked', false);
                
                switch(o_tp){
                    case '1':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.total_floor')}}");
                        $('input[name="floor"], input[name="tot_floor"], .infras1, select[name="decor"], select[name="t_house"], select[name="apart_type"]').parent().removeClass('hide');
                        $('select[name="apart_type"]').next().find('span:eq(3), span:eq(4)').addClass('hide');
                        $('.kv_pop1').parents('.c_sel_wrap').removeClass('hide');
                        $('.s_apart').removeClass('hide');

                        if( $('div.ob_type .seled').data('value') == '1' ){ $('div.infras1:eq(5)').nextAll().addClass('hide');}
                        break;

                    case '2':                    
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.total_floor')}}");
                        $('input[name="floor"], input[name="tot_floor"], .infras1, select[name="decor"], select[name="apart_type"]').parent().removeClass('hide');
                        $('select[name="apart_type"]').next().find('span:nth-child(n+5)').addClass('hide');
                        $('.kv_pop1, #s_res_parking').parents('.c_sel_wrap').removeClass('hide');
                        $('.e_apart, #s_res_parking label:last-child').removeClass('hide');

                        if( $('div.ob_type .seled').data('value') == '1' ){                            
                            $('div.infras1:nth-child(6)').nextAll().addClass('hide');
                            $('select[name="t_sale"], select[name="home_status"]').parent().removeClass('hide');
                        }
                        break;

                    case '3':
                    case '4':
                    case '5':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.total_floor1')}}");

                        $('input[name="tot_floor"], .infras1').parent().removeClass('hide');                        

                        if( $('div.ob_type .seled').data('value')=='0' ) {
                            $('select[name="decor"]').parent().removeClass('hide');
                        } else { 
                            $('div.infras1:eq(9)').nextAll().addClass('hide');
                        }

                        if( o_tp == 5 ){ 
                            $('select[name="t_house"]').parent().removeClass('hide');
                            if( $('div.ob_type .seled').data('value') == 0 ){
                                $('select[name="prepayment"]').parents('.c_sel_wrap').removeClass('hide');
                            }
                        }
                        break;

                    case '6':
                    case '8':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");                        
                        $('.infras2, input[name="floor"], input[name="tot_floor"], select[name="condition"]').parents('.c_sel_wrap').removeClass('hide');

                        if( $('div.ob_type .seled').data('value')=='0' ) {
                            $('#rent_pr_terr').removeClass('hide'); 
                            $('select[name="t_rents"], select[name="prepayment"]').parents('.c_sel_wrap').removeClass('hide');                            
                        } else { 
                            $('#sale_pr_terr').removeClass('hide');
                        }

                        if( o_tp == '6' ){ 
                            $('#s_res_parking').parents('.c_sel_wrap').removeClass('hide');
                            $('#s_res_parking label:last-child').removeClass('hide');                                
                        } else {                                                             
                            $('select[name="t_premises"], select[name="day_week"]').parents('.c_sel_wrap').removeClass('hide');
                        }
                        break;

                    case '7':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");                        
                        $('input[name="tot_floor"], #s_res_parking, select[name="condition"]').parents('.c_sel_wrap').removeClass('hide');
                        $('#s_res_parking label:last-child').removeClass('hide');

                        if( $('div.ob_type .seled').data('value')=='0' ){ 
                            $('#rent_pr_terr').removeClass('hide'); 
                            $('select[name="t_rents"], select[name="prepayment"]').parents('.c_sel_wrap').removeClass('hide');
                        } else { 
                            $('#sale_pr_terr').removeClass('hide');
                        }
                        break;

                    case '9':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");                        
                        $('.infras2, input[name="floor"], input[name="tot_floor"], select[name="condition"], #s_com_parking, select[name="floor_mat"]').parents('.c_sel_wrap').removeClass('hide');
                        $('#sale_pr_terr').removeClass('hide');
                        for( let in_infra = 0, man_arr = [0, 6, 7, 11, 12, 13, 15, 16, 20]; in_infra < 21; in_infra++ ){
                            if( man_arr.indexOf( in_infra ) === -1 ){
                                $('div.infras2:eq(' + in_infra + ')').addClass('hide');
                            }
                        }
                        break;

                    case '10':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        
                        $('#sale_pr_terr').removeClass('hide');
                        $('.infras2, input[name="floor"], input[name="tot_floor"], select[name="condition"], select[name="t_build"],  #s_com_parking').parents('.c_sel_wrap').removeClass('hide');

                        if( $('div.ob_type .seled').data('value')=='0' ){
                            $('select[name="prepayment"], select[name="t_rents"], select[name="prepayment"]').parents('.c_sel_wrap').removeClass('hide');
                        }

                        for( let in_infra = 0, man_arr = [0, 6, 7, 11, 12, 13, 15, 16, 20]; in_infra < 21; in_infra++ ){
                            if( man_arr.indexOf( in_infra ) === -1 ){
                                $('div.infras2:eq(' + in_infra + ')').addClass('hide');
                            }
                        }
                        break;

                    case '11':
                        $('input[name="tot_floor"]').attr('placeholder',"{{__('messages.b_floors')}}");
                        
                        $('input[name="floor"], input[name="tot_floor"], select[name="condition"], select[name="buss_t_prop"]').parents('.c_sel_wrap').removeClass('hide');

                        if( $('div.ob_type .seled').data('value') == '0' ) {
                            $('#rent_pr_terr').removeClass('hide');
                            $('select[name="prepayment"]').parents('.c_sel_wrap').removeClass('hide');
                        } else { 
                            $('#sale_pr_terr').removeClass('hide');
                            $('select[name="prop_status"]').parents('.c_sel_wrap').removeClass('hide');
                        }
                        break;
                }
            }

            function ifFirst(target){ 
                var cInd = target.index(); 
                var selInd = target.parents('.c_opts').find('.c_opt').not('.hide').index();
                var bot_select = target.parents('.s_select');

                if( bot_select.hasClass('filter_sel') ){
                    if( cInd == 5 ) return true;
                } else if( cInd < selInd || cInd == selInd ) return true;
                return false;
            }

            @if( isset($selected_deal) )
                
                $('.prop_filter_ls_item:eq('+ ({{$selected_object}}-1) +')').trigger('click'); //name="object"                
                $('div.velayat_select .c_opts .c_opt:eq('+ (6-{{$selected_velayat}}) +')').trigger('click'); //name="velayat"
                $('div.s_city .c_opt:eq(' + {{$selected_city}} + ')').trigger('click'); //name="city1"
                
                if( {{ $selected_price_unit }} ){ //name="price_unit" if TMT => true or vice versa
                    $('input[name="price_unit"]').prop('checked', true);
                }else{
                    $('input[name="price_unit"]').prop('checked', false);
                }

                @if( isset( $selected_min_price ) or isset( $selected_max_price ) )
                    var min_price = "{{$selected_min_price}}" ? parseFloat("{{$selected_min_price}}") : 0, max_price = "{{$selected_min_price}}" ? parseFloat("{{$selected_max_price}}") : 1000000; 
                    if( min_price < max_price && min_price < 1000000 && max_price <= 1000000 ){
                        $('.filter_price').slider('value', min_price, max_price);
                    }
                @endif

                @if( isset( $selected_price ) ) //name="price", price range widget
                    var sel_price = '{{$selected_price}}'; 
                    sel_price=sel_price.split(';');
                    $('.filter_price').slider('value', sel_price[0], sel_price[1]);
                @endif                                
                
                @if( isset($selected_filter) ) //name="filter", sort the    result
                    $('select[name="filter"]').next().find('.c_opts .c_opt:eq(' + ( {{$selected_filter}} - 1 ) + ' )').trigger('click');
                @endif
                
                @if( isset( $selected_area ) ) //name="area", area range widget
                    var sel_area = '{{ $selected_area }}';
                    sel_area = sel_area.split(';');
                    $('.area_filter').slider('value', sel_area[0], sel_area[1]);
                @endif

                @if( isset($selected_min_area) || isset($selected_max_area) ) //name="area", values from the main page filter
                    var min_ar="{{$selected_min_area ? $selected_min_area:0}}", max_ar="{{$selected_max_area ? $selected_max_area:10000}}";                     
                    $(".area_filter").slider('value', min_ar, max_ar); 

                @endif

                @if( isset($selected_property_status) && $selected_property_status == 2 ) 
                    $('.inp_debt_filter').parent().removeClass('hide');
                @endif

                @if( isset( $selected_rooms ) )
                    var sel_rooms = @json($selected_rooms);
                    var ind=0, len, 
                    cVak='';

                    for( len=sel_rooms.length; ind<len; ++ind ){
                        $('input[id^="room_fill_' + sel_rooms[ind] + '"]').prop('checked', true);
                        cVak+=sel_rooms[ind].toString() + ', '; 
                    }

                    switch(len){                        
                        case 1: 
                            $('.kv_pop1').text(sel_rooms[0] +'-{{__('messages.roomed')}}'); 
                            break;
                        case 2: 
                            $('.kv_pop1').text(sel_rooms[0] + ', ' + sel_rooms[1]  + ' {{__("messages.room_sh1")}}'); 
                            break;
                        default: 
                            $('.kv_pop1').text(cVak.substring(0, cVak.length - 2) + '   ' + '{{__("messages.room_sh2")}}');
                    }
                    if( sel_rooms == 0 ){
                        $('.kv_pop1').text("{{__('messages.room')}}");
                    }
                @endif
                
                @if( isset( $selected_res_parking) )
                    $('#s_res_parking').find('input#parking_' + {{ $selected_res_parking }}).trigger('click');
                @endif
                
                @if( isset( $selected_com_parking) )
                    if( {{ $selected_com_parking }} == 5  ){
                        $('#s_com_parking').find('input#parking_51').trigger('click');
                    }else{
                        $('#s_com_parking').find('input#parking_' + {{ $selected_com_parking }}).trigger('click');
                    }
                @endif

                @if(isset($selected_features)) 
                    var feas = @json($selected_features); 
                    feas.map(function(item){ 
                        $('.infras1:eq(' + (item - 1) + ')').find('input').prop('checked', true);
                    }); 
                @endif

                @if(isset($selected_infras)) 
                    var infas = @json($selected_infras); 
                    infas.map(function(item1){ 
                        $('.infras2:eq(' + (item1 - 1) + ')').find('input').prop('checked', true);
                    }); 
                @endif

            @else
                $('.prop_filter_ls_item').first().trigger('click');
                @if( isset( $selected_velayat ) )
                    $('div.velayat_select .c_opts .c_opt:eq('+ (6-{{$selected_velayat}}) +')').trigger('click');
                @else    
                    $('select[name="velayat"]').next().find('.c_opts .c_opt:eq(0)').trigger('click');
                @endif

                @if( isset( $selected_object ) )
                    $('.prop_filter_ls_item:eq('+ ({{$selected_object}}-1) +')').trigger('click'); //name="object"
                @endif
                
                $('select[name="city1"]').val('0');
                $('input[name="rent_pr_terr"]').first().trigger('click');
                $('input[name="sale_pr_terr"]').first().trigger('click');
                $('input[name="price_unit"]').prop('checked', true);
                
                $('input[id^="room_fill_"]').each(function(i){
                    if( i == 0 || i == 1 ) $(this).prop('checked', true);
                 });
            @endif
        });
    </script>
@endsection