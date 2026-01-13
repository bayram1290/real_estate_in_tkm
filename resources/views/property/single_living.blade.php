@extends('layouts.front')

@section('content')    
    <!-- Banner Section Start -->
    <section id="banner" class="p-b-30 xm_p-t-100">
        <div class="single_banner_wrap hidden-sm hidden-xs">
            <div class="page_location">
                <a href="{{route('list')}}">{{__('messages.properties')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <a href="{{route('property.type',['id' => 1])}}">{{__('messages.living1')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                @if(Lang::locale() == 'ru') {{$property->object_names->name_ru}}
                @elseif(Lang::locale() == 'en') {{$property->object_names->name_en}}
                @else {{$property->object_names->name_tm}}
                @endif
            </div>
            <span class="single_banner_created_txt">
                <i class="fa fa-bullhorn m-r-5" aria-hidden="true"></i>
                @php $created_day = new Carbon\Carbon($property->created_at); $now = Carbon\Carbon::now(); $diff = $created_day->diff($now)->days; @endphp
                @if( $diff > 7 ) {{$property->created_at->format('d/m/Y') }}
                @else {{$property->created_at->diffForHumans()}} @endif
            </span>
            <span class="single_banner_created_txt">
                <i class="fa fa-eye m-r-5" aria-hidden="true"></i>
                {{number_format($property->views, 0, '.', " ")}}
                @if( (int)$property->views < 2 ) {{__('messages.view')}},
                @else {{__('messages.views')}},@endif {{$property->current_day_views . ' ' . __('messages.for_today')}}
            </span>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Single Property Start -->
    <section id="single_property">
        <main class="sinlge_container">
            <!-- Left side, main property info start -->
            <div class="single_property_wrap">
                <div class="single_block m-b-20 p-t-50 t_p-0 xs_noborder">
                    <div class="m_property hidden-sm hidden-xs">
                        <h2 class="property-title m-b-20">{{$property->title}}</h2>
                        <div class="prop_add prop_add_flex">
                            <div><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></div>
                            <div>@if(app()->isLocale('ru'))
                                    @if( $property->velayat_id == 6 ) {{__('messages.city_short')}} {{$property->velayat->velayat_ru}},
                                    @else  {{$property->velayat->velayat_ru}} {{__('messages.velayat_short')}},@endif
                                    {{$property->city->city_ru}}, {{$property->address}}
                                    <a href="#map_content" class="btn-sm agent_property_link m-l-10">На карте</a>
                                @elseif(app()->isLocale('en'))
                                    {{$property->velayat->velayat_en}}
                                    @if( $property->velayat_id == 6 ) {{__('messages.city_short')}},
                                    @else {{__('messages.velayat_short')}},@endif
                                     {{$property->city->city_en}}, {{$property->address}}
                                    &nbsp;&nbsp;&nbsp;<a href="#map_content" class="btn-sm agent_property_link m-l-10">On map</a>
                                @elseif(app()->isLocale('tm'))
                                    {{$property->velayat->velayat_tm}}, {{$property->city->city_tm}}, {{$property->address}}
                                    &nbsp;&nbsp;&nbsp;<a href="#map_content" class="btn-sm agent_property_link m-l-10">Kartada</a>
                                @endif</div>
                        </div>
                        <ul class="list-inline m-b-30">
                            @if(Auth::id())
                                @if($property->favorite_user->contains(Auth::id()))
                                    <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLiked()">
                                        <a class="btn btn-success1" href="javascript:void(0);">
                                            <i id="property_{{$property->id}}" class="fa fa-star"></i>
                                            <span class="m-l-5">{{__('messages.in_fav')}}</span>
                                        </a>
                                    </li>
                                    <li class="flat-icon" id="{{$property->id}}">
                                        <a href="{{route('report.property',['id' => $property->id])}}" class="btn btn-success1" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                            <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                                            <span class="m-l-5">{{__('messages.btn_complain_txt')}}</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="flat-icon" id="{{$property->id}}" onclick="getLiked()">
                                        <a class="btn btn-success1" href="javascript:void(0);">
                                            <i id="property_{{$property->id}}" class="fa fa-star-o"></i>
                                            <span class="m-l-5">{{__('messages.to_fav')}}</span>
                                        </a>
                                    </li>
                                    <li class="flat-icon" id="{{$property->id}}">
                                        <a href="{{route('report.property',['id' => $property->id])}}" class="btn btn-success1" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                            <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                                            <span class="m-l-5">{{__('messages.btn_complain_txt')}}</span>
                                        </a>
                                    </li>
                                @endif
                            @else
                                @if(isset($arr_cookie))
                                    @if(in_array($property->id,$arr_cookie))
                                        <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLiked()">
                                            <a class="btn btn-success1" href="javascript:void(0);">
                                                <i id="property_{{$property->id}}" class="fa fa-star"></i>
                                                <span class="m-l-5">{{__('messages.in_fav')}}</span>
                                            </a>
                                        </li>
                                        <li class="flat-icon" id="{{$property->id}}">
                                            <a href="{{route('report.property',['id' => $property->id])}}" class="btn btn-success1" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                                                <span class="m-l-5">{{__('messages.btn_complain_txt')}}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="flat-icon" id="{{$property->id}}" onclick="getLiked()">
                                            <a class="btn btn-success1" href="javascript:void(0);">
                                                <i id="property_{{$property->id}}" class="fa fa-star-o"></i>
                                                <span class="m-l-5">{{__('messages.to_fav')}}</span>
                                            </a>
                                        </li>
                                        <li class="flat-icon" id="{{$property->id}}">
                                            <a href="{{route('report.property',['id' => $property->id])}}" class="btn btn-success1" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                                                <span class="m-l-5">{{__('messages.btn_complain_txt')}}</span>
                                            </a>
                                        </li>
                                    @endif
                                @else
                                    <li class="flat-icon" id="{{$property->id}}" onclick="getLiked()">
                                        <a class="btn btn-success1" href="javascript:void(0);">
                                            <i id="property_{{$property->id}}" class="fa fa-star-o"></i>
                                            <span class="m-l-5">{{__('messages.to_fav')}}</span>
                                        </a>
                                    </li>
                                    <li class="flat-icon" id="{{$property->id}}">
                                        <a href="{{route('report.property',['id' => $property->id])}}" class="btn btn-success1" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                            <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                                            <span class="m-l-5">{{__('messages.btn_complain_txt')}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                    
                    <!-- Wrapper for desktop slides start -->
                    <div class="property_slider m-b-20 t_m-b-0 hidden-xs">
                        <!-- jQuery 1.8 or later, 33 KB -->
                        <script src="{{asset('js/jquery.1.11.1.min.js')}}"></script>

                        <!-- Fotorama from CDNJS, 19 KB -->
                        <link href="{{asset('css/fotorama.min.css')}}" rel="stylesheet">
                        <script src="{{asset('js/fotorama.min.js')}}"></script>
                        
                        @if(!is_null($property->image) && count($property->image) > 0 )
                            <div class="fotorama" id="propertyPhotos" data-allowfullscreen="true" data-nav="thumbs" data-transition="dissolve" data-loop="true" data-arrows="true" data-width="100%" data-height="402" data-fit="contain" data-thumbmargin="5" data-keyboard="true">
                                @foreach($property->image as $image)
                                    <img src="{{asset('/img/property_grid/' . $image->name)}}">
                                @endforeach                                
                            </div>                            
                        @else
                            <div class="fotorama" id="propertyPhotos" data-width="100%" data-height="402" data-fit="contain">
                                <img src="{{asset('/img/property_grid/tm_default_image.jpg')}}">
                            </div>
                        @endif
                        
                        <script>
                            var fotorama = $('.fotorama').on('fotorama:load', function(){
                                if(!$('.fotorama-count_wrap').length) $(this).find('.fotorama__stage').append('<div class="fotorama-count_wrap"><i class="fotorama-icon"></i><span class="fotorama-cnt">{{count($property->image)}}</span></div>');
                            })
                            .on('fotorama:fullscreenenter', function(e, fotorama, extra) {
                                var price_unit;
                                @if($property->price_unit_id == 1)
                                    price_unit = 'TMT';
                                @else
                                    price_unit = "{{__('messages.cu')}}";
                                @endif
                                $(this).find('.fotorama__fullscreen-icon').addClass('hide');
                                $('<div class="fotorama-header"><div class="fotorama-title">{{$property->title}}, <span class="fotorama-header-price">{{number_format($property->price, 0, '.', " ")}} ' + price_unit +'</span></div><button class="fotorama-contact-btn">{{__("messages.show_phone")}}</button><div class="fotorama-contact-phone hide">{{$property->user->phone}}</div><div id="fotorama-fullscreen-close" class="fa fa-times-circle" tabindex="0" role="button"></div></div>').insertBefore($(this));
                                
                                $(document).on("click", "#fotorama-fullscreen-close", function (){ fotorama.cancelFullScreen();});
                                $(document).on("click", '.fotorama-contact-btn', function(){
                                    $(this).addClass('hide');
                                    $('.fotorama-contact-phone').removeClass('hide');
                                 });
                            })
                            .on('fotorama:fullscreenexit', function(e, fotorama, extra) {
                                $(this).find('.fotorama__fullscreen-icon').removeClass('hide');
                                $('.fotorama-header').remove();
                            })
                            .fotorama({
                                spinner: {
                                    lines: 13,
                                    color: 'rgba(0, 0, 0, .75)'
                                },
                                shadows: true,
                            });
                            
                            $(document).on('click', '#carousel-mobile .item', function(){                                
                                fotorama.data('fotorama').requestFullScreen();
                            });                            
                        </script>  
                    </div>
                    <!-- Wrapper for desktop slides end -->

                    <!-- Wrapper for mobile slides start -->
                    <div class="property-slider t_m-b-0 visible-xs">
                        <div id="carousel-mobile" class="carousel slide fixed_slider" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                @if(!is_null($property->image) && count( $property->image ) > 0 )
                                    @php $iter = 0; @endphp
                                    @foreach( $property->image as $m_image )
                                        <div class="item {{$iter++==0 ? 'active' : ''}}" style="background-image: url({{asset('/img/property_grid/' . $m_image->name)}})"></div>
                                    @endforeach
                                @else
                                    <div class="item active" style="background-image: url( {{asset('/img/property_grid/tm_default_image.jpg')}} )"></div>
                                @endif
                            </div>
                            <!-- Controls -->
                            @if(!is_null($property->image) && count( $property->image ) > 1 )
                                <a class="left carousel-control" href="#carousel-mobile" role="button" data-slide="prev">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </a>
                                <a class="right carousel-control" href="#carousel-mobile" role="button" data-slide="next">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>                        
                    </div>
                    <!-- Wrapper for mobile slides end -->
                    <div class="row m-b-15 m-r-0 m-l-0 hidden-sm hidden-xs">
                        <div class="area_sep">
                            <span class="area_title">{{__('messages.overall')}}</span>
                            <h5 class="property-title">{{$property->area}}&nbsp;{{__('messages.meter')}}<sup>2</sup></h5>
                        </div>
                        @if( isset( $property->living ) && $property->living !== 0 )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.residential')}}</span>
                                <h5 class="property-title">{{$property->living}}&nbsp;{{__('messages.meter')}}<sup>2</sup></h5>
                            </div>
                        @endif
                        @if(isset( $property->living ) && (int)$property->kitchen_area !== 0)
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.kitchen')}}</span>
                                <h5 class="property-title">{{$property->kitchen_area}}&nbsp;{{__('messages.meter')}}<sup>2</sup></h5>
                            </div>
                        @endif
                        @if( isset( $property->floor ) && (int)$property->object_names_id < 3 && $property->floor !== 0 )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.floor')}}</span>
                                <h5 class="property-title">
                                    {{$property->floor}}
                                    <span class="tt_none">{{__('messages.from')}}</span>
                                    {{$property->floors_in_home}}
                                </h5>
                            </div>
                        @endif
                        @if((double)$property->land_area > 0 )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.land')}}</span>
                                <h5 class="property-title">{{$property->land_area}} 
                                    @if(App::isLocale('ru'))
                                        {{$property->land_area_type->type_ru}} 
                                    @elseif(App::isLocale('en'))
                                        {{$property->land_area_type->type_en}} 
                                    @else
                                        {{$property->land_area_type->type_tm}} 
                                    @endif
                                </h5>
                            </div>
                        @endif                        
                        @if(isset($property->floors_in_home) && $property->floors_in_home !== 0 && (int)$property->object_names_id > 2)
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.total_floor1')}}</span>
                                <h5 class="property-title">{{$property->floors_in_home}}</h5>
                            </div>
                        @endif
                        @if(isset($property->construction_year) && (int)$property->construction_year !== 0)
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.built')}}</span>
                                <h5 class="property-title">{{$property->construction_year}}</h5>
                            </div>
                        @endif
                        @if(isset($property->type_property_id) && $property->type_property_id !== 0 && (int)$property->object_names_id > 2)
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.t_house')}}</span>
                                <h5 class="property-title">@if(app()->isLocale('ru')) {{$property->building->building_ru}}
                                    @elseif(app()->isLocale('en')) {{$property->building->building_en}}
                                    @elseif(app()->isLocale('tm')) {{$property->building->building_tm}}
                                    @endif
                                </h5>
                            </div>

                        @endif                                    
                    </div>
                    <span class="hidden-sm hidden-xs">
                        <p class="prop_info_description">{{$property->description->description}}</p>
                    </span>
                </div>

                <div class="single_block m-b-20 visible-sm visible-xs t_p-b-15">
                    <div class="price_container">
                        <div class="t-price_row">
                            <div>
                                <h2>@if( (int)$property->saleOrRent == 1 )
                                        {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}
                                    @else
                                        {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/<span class="bar_mon_font">{{__('messages.mon_short')}}</span>                                    
                                    @endif
                                    @if( isset( $property->trade_enabled ) )
                                        <span class="t-neg_txt">{{__('messages.negt')}}</span>
                                    @endif
                                    @if( isset($property->price_rate) )
                                        <span class="t-price_rate"><bdi class="lato_regular text-uppercase">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}</bdi>/{{__('messages.meter')}}<sup class="sq_sup_font-b">2</sup></span>    
                                    @endif                                
                                </h2>
                                @if( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 2 )
                                    <h3 class="property_debt_h3">{{__('messages.debt')}}: {{number_format($property->house_purchase_debt_amount , 0, '.', " ")}} TMT</h3>
                                @endif
                            </div>
                            <div>
                                @if(Auth::id())
                                    @if($property->favorite_user->contains(Auth::id()))
                                        <a class="btn prim_txt_color" href="javascript:void(0);" id="{{$property->id}}" onclick="decreaseLiked()">
                                            <i id="property_{{$property->id}}" class="fa fa-star fa-lg"></i>                                        
                                        </a>
                                    @else
                                        <a class="btn prim_txt_color" href="javascript:void(0);" id="{{$property->id}}" onclick="getLiked()">
                                            <i id="property_{{$property->id}}" class="fa fa-star-o fa-lg"></i>                                        
                                        </a>
                                    @endif
                                @else
                                    @if(isset($arr_cookie))
                                        @if(in_array($property->id,$arr_cookie))
                                            <a class="btn prim_txt_color" href="javascript:void(0);" id="{{$property->id}}" onclick="decreaseLiked()">
                                                <i id="property_{{$property->id}}" class="fa fa-star fa-lg"></i>                                                
                                            </a>
                                        @else
                                            <a class="btn prim_txt_color" href="javascript:void(0);" id="{{$property->id}}" onclick="getLiked()">
                                                <i id="property_{{$property->id}}" class="fa fa-star-o fa-lg"></i>                                            
                                            </a>
                                        @endif
                                    @else
                                        <a class="btn prim_txt_color" href="javascript:void(0);" id="{{$property->id}}" onclick="getLiked()">
                                            <i id="property_{{$property->id}}" class="fa fa-star-o fa-lg"></i>                                            
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        
                        <div class="prop_prim_feats">
                            @if( (int)$property->object_names_id < 3 )
                                <span>
                                    <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                    @if( (int)$property->rooms == 8 )
                                        {{__('messages.studio')}}
                                    @elseif( (int)$property->rooms == 7 )
                                        {{__('messages.free_layout')}}
                                    @else
                                        {{$property->rooms}}-{{__('messages.room_sh1')}}
                                    @endif
                                    @if(Lang::locale() == 'ru') {{$property->object_names->name_ru}}
                                    @elseif(Lang::locale() == 'en') {{$property->object_names->name_en}}
                                    @else {{$property->object_names->name_tm}}
                                    @endif 
                                    <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                                </span>
                                <span>
                                    <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                    {{$property->area}} {{__('messages.meter')}}<sup>2</sup>
                                    <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                                </span>
                                @if( isset( $property->floor ) && isset( $property->floors_in_home ) )
                                    <span>
                                        <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                        {{$property->floor}}/{{$property->floors_in_home}} {{__('messages.floors_1')}}
                                    </span>
                                @endif
                            @else   
                                @if( (int)$property->object_names_id == 5 )                                    
                                    <span><i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>{{$property->rent_part . ' ' . __('messages.house') }}</span>
                                @else
                                    <span class="text-capitalize">
                                        <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                        @if(Lang::locale() == 'ru') {{$property->object_names->name_ru}}
                                        @elseif(Lang::locale() == 'en') {{$property->object_names->name_en}}
                                        @else {{$property->object_names->name_tm}}
                                        @endif    
                                    </span>
                                @endif
                                
                                <span>
                                    <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                                    <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                    {{$property->area}} {{__('messages.meter')}}<sup>2</sup>
                                </span>
                                @if( isset( $property->floors_in_home ) )
                                    <span>
                                        <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                                        <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                        {{$property->floors_in_home}}
                                        @if( (int)$property->floors_in_home < 2 )
                                            {{__('messages.floors_1')}}
                                        @elseif( (int)$property->floors_in_home < 5 )
                                            {{__('messages.floors_2')}}
                                        @else
                                            {{__('messages.floors_3')}}
                                        @endif
                                    </span>                                    
                                @endif
                                @if( isset( $property->num_beds ) && (int)$property->num_beds > 0 )
                                    <span>
                                        <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                        <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                                        {{$property->num_beds . ' ' . __('messages.beds')}}
                                    </span>
                                @endif
                            @endif
                        </div>
                        @if( isset( $property->rent_term_id ) || isset( $property->deposit_payment ) || isset( $property->without_collateral ) || isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) )
                            <div class="scroll_bar_incls">                                    
                                @if( isset( $property->rent_term_id ) )
                                    <div class="scroll_bar_incl_item">
                                        @if( (int)$property->rent_term_id == 1 )
                                            {{__('messages.long_term_rent')}}@if( isset( $property->deposit_payment ) || isset( $property->without_collateral ) || isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ), @endif
                                        @else
                                            {{__('messages.short_term_rent')}}@if( isset( $property->deposit_payment ) || isset( $property->without_collateral ) || isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ), @endif
                                        @endif
                                    </div>
                                @endif
                                @if( isset( $property->deposit_payment ) )
                                    <div class="scroll_bar_incl_item">
                                        {{__('messages.deposit')}} <bdi class="lato_regular text-uppercase">{{number_format($property->deposit_payment , 0, '.', " ")}} TMT</bdi>@if( isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ),@endif</div>
                                @elseif( isset( $property->without_collateral ) )
                                    <div class="scroll_bar_incl_item">
                                        {{__('messages.undeposit')}}@if( isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 )),@endif</div>
                                @endif
                                @if( isset( $property->prepayment ) )
                                    <div class="scroll_bar_incl_item">
                                        {{__('messages.pay_for') }} <bdi class="lato_regular">{{$property->prepayment}}</bdi>
                                        @if( (int)$property->prepayment == 1 )
                                            {{__('messages.month1')}},
                                        @elseif( (int)$property->prepayment < 5 )
                                            {{__('messages.month2')}},
                                        @else
                                            {{__('messages.month3')}},
                                        @endif
                                        {{__('messages.by_year')}}@if( isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 )),@endif
                                    </div>
                                @endif
                                @if( isset( $property->sale_type_id ) )
                                    <div class="scroll_bar_incl_item">
                                        @if( (int)$property->sale_type_id == 1 )
                                            {{__('messages.free_sale')}}@if( (isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1)),@endif
                                        @else
                                            {{__('messages.alter_sale')}}@if( (isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1)),@endif
                                        @endif
                                    </div>
                                @endif
                                @if( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 )<span class="scroll_bar_incl_item"> {{__('messages.redeemed_prop')}}</span>@endif
                            </div>
                        @endif

                        @if( isset($property->comm_payment_included) )
                            <div class="scroll_bar_price_rate">
                                {{__('messages.rent_apart_comm_included')}}                                
                            </div>
                        @endif                        
                    </div>
                    <hr class="sHr1 t_m-b-10 t_m-t-10">
                    <div class="t-created_text">
                        <div>                            
                            @if( $diff > 7 )
                                {{$property->created_at->format('d/m/Y') }}
                            @else
                                {{$property->created_at->diffForHumans()}}    
                            @endif
                        </div>
                        <div>
                            <i class="fa fa-eye m-r-5 prim_txt_color" aria-hidden="true"></i>
                            {{number_format($property->views, 0, '.', " ")}}
                            @if( (int)$property->views < 2 )
                                {{__('messages.view')}}
                            @else
                                {{__('messages.views')}}
                            @endif                            
                        </div>
                    </div>
                </div>

                <!-- Property map location for mobile/tablet version start -->
                <div class="single_block visible-sm visible-xs m-b-20 t_p-b-0 t_p-t-15">
                    <div style="opacity: 0"></div>
                    <input type="hidden" id="lat" value="{{$property->lat}}">
                    <input type="hidden" id="lng" value="{{$property->lng}}">
                    <div class="single_map">
                        <h4 class="inner-title">{{__('messages.locations')}}</h4>
                        <div class="prop_add single_map_address">
                            <div>
                                <!-- This icon made by Freepik from https://www.flaticon.com, licensed by Creative Commons 3.0 - http://creativecommons.org/licenses/by/3.0/  -->
                                <?php echo '<?xml version="1.0" encoding="iso-8859-1"?>'; ?>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" style="" class="single_google_map_icon" xml:space="preserve">
                                    <path style="fill:#CCCCCC;" d="M451.809,239.542v217.654l-68.402-12.661l-30.156-36.174l-127.06-141.254l107.876-76.649 c54.037,71.326,55.741,53.938,55.741,53.938s26.692-39.85,60.936-5.607L451.809,239.542z"/>
                                    <path style="fill:#518EF8;" d="M190.707,223.105l224.311,288.696c-1.306,0.128-2.626,0.199-3.96,0.199H44.336L190.707,223.105z"/>
                                    <path style="fill:#28B446;" d="M334.068,190.458L0.447,471.248V101.389c0-22.512,18.254-40.752,40.752-40.752h243.289 c-10.447,17.956,28.289,29.481,28.289,51.752C312.777,134.803,323.494,172.417,334.068,190.458z"/>
                                    <path style="fill:#F2F2F2;" d="M451.809,457.196v14.052c0,21.164-16.139,38.566-36.791,40.553L227.313,326.567l45.436-46.046 l104.867,103.476l5.791,5.72L451.809,457.196z"/>
                                    <path style="fill:#FFD837;" d="M322.514,230.088l-49.765,50.432l-45.436,46.046L44.336,512h-3.137 c-22.498,0-40.752-18.254-40.752-40.752l284.254-288.058c5.323,9.113,41.93-0.114,49.368,7.267l13.67,17.572 C354.41,215.142,316.78,222.537,322.514,230.088z"/>
                                    <path style="fill:#FFFFFF;" d="M106.904,227.775c-35.808,0-64.939-29.131-64.939-64.939s29.131-64.939,64.939-64.939 c17.334,0,33.637,6.758,45.91,19.03l-15.057,15.054c-8.248-8.25-19.206-12.793-30.853-12.793c-24.068,0-43.647,19.58-43.647,43.647 s19.58,43.647,43.647,43.647c20.396,0,37.571-14.062,42.334-33.002h-42.334v-21.291h64.939v10.646 C171.842,198.644,142.712,227.775,106.904,227.775z"/>
                                    <path style="fill:#F14336;" d="M284.488,60.638C305.566,24.386,344.842,0,389.809,0c67.238,0,121.744,54.506,121.744,121.744 c0,16.863-3.435,32.916-9.624,47.522c-6.203,14.606-15.174,27.75-26.245,38.764c-9.226,9.808-17.501,20.17-24.939,30.759 c-48.729,69.424-60.936,148.685-60.936,148.685s-13.257-86.06-67.295-157.386c-5.734-7.551-11.923-14.947-18.594-22.058h0.014 c-7.438-7.381-13.91-15.727-19.233-24.84c-10.575-18.041-16.636-39.034-16.636-61.447C268.065,99.473,274.041,78.593,284.488,60.638 z"/>
                                    <path style="fill:#7E2D25;" d="M389.81,56.947c35.781,0,64.781,29.017,64.781,64.798s-29,64.781-64.781,64.781 s-64.798-29-64.798-64.781S354.03,56.947,389.81,56.947z"/>                               
                                </svg>
                            </div>
                            <div>
                                @if(app()->isLocale('ru'))                                
                                    @if( $property->velayat_id == 6 )
                                        {{__('messages.city_short')}} {{$property->velayat->velayat_ru}},
                                    @else
                                        {{$property->velayat->velayat_ru}} {{__('messages.velayat_short')}},
                                    @endif
                                        {{$property->city->city_ru}}, {{$property->address}}                                
                                @elseif(app()->isLocale('en'))
                                    {{$property->velayat->velayat_en}}
                                    @if( $property->velayat_id == 6 )
                                        {{__('messages.city_short')}},
                                    @else
                                        {{__('messages.velayat_short')}},
                                    @endif
                                        {{$property->city->city_en}}, {{$property->address}}                                
                                @elseif(app()->isLocale('tm'))
                                    {{$property->velayat->velayat_tm}}, {{$property->city->city_tm}}, {{$property->address}}
                                @endif
                            </div>
                        </div>                    
                        <div id="map_mobile" class="map-canvas"></div>
                    </div>
                </div>
                <!-- Property map location for mobile/tablet version end -->

                <!-- Property terms info start -->
                <div class="single_block m-b-20 hidden-sm hidden-xs">
                    <h4 class="inner-title">{{__('messages.terms')}}</h4>
                    <div class="sin_com_terms">
                        <div class="sin_com_term_group sin_com_term_group_cw-65">
                            <div class="sin_com_term_group_item">
                                <div class="sin_com_term_item_name">
                                    @if( (int)$property->saleOrRent == 0 )
                                        {{__('messages.rent_price')}}    
                                    @else
                                        {{__('messages.price')}}
                                    @endif
                                </div>
                                <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} @if( (int)$property->saleOrRent == 0 )
                                        {{ $property->price_unit->unit === 'TMT' ? 'TMT'.__('messages.mon') : __('messages.cu') . __('messages.mon')}}
                                    @else
                                        {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}
                                    @endif
                                    @if( isset($property->trade_enabled) )
                                        <span class="barg_txt">
                                            ({{__('messages.barg_poss')}})
                                        </span>
                                    @endif</div>
                            </div>
                            @if( (int)$property->saleOrRent == 1 )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                    <div class="sin_com_term_item_val">{{number_format($property->price_rate, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/{{ __('messages.meter')}}<sup>2</sup></div>
                                </div>
                            @endif
                            @if( isset($property->sale_type_id) )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.sale_type')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( (int)$property->sale_type_id == 1 )
                                            {{__('messages.free_sale')}}
                                        @else
                                            {{__('messages.alter_sale')}}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if( ( (int)$property->object_names_id < 3 && (int)$property->saleOrRent == 0 ) || isset( $property->comm_payment_included ) )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.comm_payment')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( ((int)$property->object_names_id < 3 && (int)$property->saleOrRent == 0) || (int)$property->comm_payment_included == 1 ) 
                                            {{__('messages.incl_yes')}}
                                        @elseif( !is_null($property->comm_payment_included) )
                                            {{__('messages.incl_no')}}
                                        @endif
                                    </div>
                                </div>    
                            @endif
                            @if( isset($property->rent_term_id) )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.rent_period')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @foreach($rent_terms as $rent_term)
                                            @if( $property->rent_term_id == $rent_term->id )
                                                @if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                                                @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                                                @else {{$rent_term->term_tm}}
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            @if( isset($property->deposit_payment) || isset($property->without_collateral) )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.own_deposit')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->without_collateral) )
                                            {{__('messages.undeposit')}}
                                        @else
                                            {{number_format($property->deposit_payment, 0, '.', " ")}} TMT
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if( isset($property->prepayment) )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.prepayment')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( (int)$property->prepayment < 12 )
                                            {{$property->prepayment}}
                                            @if( (int)$property->prepayment < 2 )
                                                {{__('messages.month1')}}
                                            @elseif( (int)$property->prepayment < 5 )
                                                {{__('messages.month2')}}
                                            @else
                                                {{__('messages.month3')}}
                                            @endif
                                        @else
                                            1 {{__('messages.year')}}
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if( isset($property->house_purchase_status) && (int)$property->house_purchase_status == 1 )
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.home_pur_debt')}}</div>
                                    <div class="sin_com_term_item_val">{{__('messages.redeemed')}}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if( isset($property->house_purchase_status) && (int)$property->house_purchase_status == 2 )
                        <hr class="sHr1">
                        <div class="sin_com_terms">
                            <div class="sin_com_term_group sin_com_term_group_cw-65">
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.home_pur_debt')}}</div>
                                    <div class="sin_com_term_item_val">{{__('messages.with_debt')}}</div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.amount')}}</div>
                                    <div class="sin_com_term_item_val">{{number_format($property->house_purchase_debt_amount, 0, '.', " ")}} TMT</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>                
                <!-- Property terms info end -->

                <!-- General property info start -->
                <div class="single_block m-b-20 change_order_wrap">
                    
                    <!-- Property description for mobile version start -->
                    <div class="mobile_description" id="change_order_1">
                        <h4 class="inner-title">{{__('messages.description')}}</h4>
                        <div class="prop_info_description squeeze_block">{{$property->description->description}}</div>                    
                        <p class="read_more_faint">
                            <button class="btn-transparent" id="read_more">{{__('messages.read_more')}}</button>
                        </p>
                    </div>
                    <!-- Property description for mobile version end -->

                    <hr class="sHr1 visible-sm visible-xs" id="change_order_2">
                    <h4 class="inner-title" id="change_order_3">{{__('messages.gen_info')}}</h4>
                    <!-- Property additional info start -->
                    @if(!is_null($property->feature) && count($property->feature) > 0)
                        <div class="single_feature m-0" id="change_order_8">
                            <div class="info-list">
                                <h5 class="inner-title1">
                                @if( (int)$property->object_names_id < 3 )
                                    {{__('messages.in_apartment_exist')}}
                                @else
                                    {{__('messages.in_house_exist')}} 
                                @endif</h5>
                                

                                <ul>
                                    @foreach($property->feature as $feature)
                                        <li>
                                            <span>
                                                <img class="icon" src="{{$feature->img}}"/>
                                            </span>
                                            <small>
                                                @if(App::isLocale('ru'))
                                                    {{$feature->feature_ru}}
                                                @elseif(App::isLocale('en'))
                                                    {{$feature->feature_en}}
                                                @else
                                                    {{$feature->feature_tm}}
                                                @endif
                                            </small>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <!-- Property additional info end -->

                    <!-- Property apartment user permission start -->
                    @if( isset($property->children_allowed) || isset($property->animals_allowed) || isset($property->for_family) || isset($property->for_single) )
                        <hr class="sHr1" id="change_order_5">
                        <div class="sin_com_terms" id="change_order_6">
                            <div class="sin_com_term_group">
                                @if( isset($property->children_allowed) )
                                    <div class="sin_com_term_group_item add_resid">
                                        <div class="sin_com_term_item_name"><i class="fa fa-child icon-i1"></i>{{__('messages.with_child')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( (int)$property->children_allowed == 1 )
                                                {{__('messages.yes')}}
                                            @else
                                                {{__('messages.no')}}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if( isset($property->animals_allowed) )
                                    <div class="sin_com_term_group_item add_resid">
                                        <div class="sin_com_term_item_name"><i class="fa fa-paw icon-i1"></i>{{__('messages.with_animal')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( (int)$property->animals_allowed == 1 )
                                                {{__('messages.yes')}}
                                            @else
                                                {{__('messages.no')}}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                            </div>
                            <div class="sin_com_term_group">
                                @if( isset($property->for_family) )
                                    <div class="sin_com_term_group_item add_resid">
                                        <div class="sin_com_term_item_name"><i class="fa fa-users icon-i1"></i>{{__('messages.for_family')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( (int)$property->for_family == 1 )
                                                {{__('messages.yes')}}
                                            @else
                                                {{__('messages.no')}}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if( isset($property->for_single) )
                                    <div class="sin_com_term_group_item add_resid">
                                        <div class="sin_com_term_item_name"><i class="fa fa-user icon-i1"></i>{{__('messages.for_single')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( (int)$property->for_single == 1 )
                                                {{__('messages.yes')}}
                                            @else
                                                {{__('messages.no')}}
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif                                        
                    <!-- Property apartment user permission end -->
                    
                    <!-- Property technical info start -->
                    <hr class="sHr1" id="change_order_7">
                    <article id="change_order_4">
                        <ul>
                            @if( (int)$property->object_names_id < 3 )
                                <div class="visible-sm visible-xs">                                   
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.overall')}}</span>
                                        <span>{{$property->area}}&nbsp;{{__('messages.meter')}}<sup>2</sup></span>
                                    </li>
                                    @if( isset( $property->living ) && (double)$property->living > 0.00 )
                                        <li class="single_gen_item">
                                            <span class="single_gen_item_name">{{__('messages.residential')}}</span>
                                            <span>
                                                {{$property->living}}&nbsp;{{__('messages.meter')}}<sup>2</sup>
                                            </span>
                                        </li>
                                    @endif
                                    
                                    @if(isset( $property->kitchen_area ) && (double)$property->kitchen_area > 0.00)
                                        <li class="single_gen_item">
                                            <span class="single_gen_item_name">{{__('messages.kitchen')}}</span>
                                            <span>
                                                {{$property->kitchen_area}}&nbsp;{{__('messages.meter')}}<sup>2</sup>
                                            </span>
                                        </li>
                                    @endif
                                    <hr class="sHr1 hidden-xs">
                                </div>
                            @endif
                            @if( isset($property->house_patent) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.patent')}}</span>
                                    <span>
                                        @if( $property->house_patent == '1' )
                                            {{__('messages.exist')}}   
                                        @else
                                            {{__('messages.no_exist')}}   
                                        @endif
                                    </span>
                                </li>
                            @endif
                            @if( isset($property->village_name) && $property->object_names_id > 2 )
                                <li class="single_gen_item hidden-xs">
                                    <span class="single_gen_item_name">{{__('messages.n_settlement')}}</span>
                                    <span>
                                        {{$property->village_name}}
                                    </span>
                                </li>
                                <li class="single_gen_item m_show_flex">
                                    <span class="single_gen_item_name">{{__('messages.name')}}</span>
                                    <span>
                                        {{$property->village_name}}
                                    </span>
                                </li>
                            @endif
                            @if( isset($property->land_status_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.land_status')}}</span>
                                    <span>
                                        @if( (int)$property->land_status_id == 4 )
                                            {{__('messages.ind_housing')}}
                                        @elseif( (int)$property->land_status_id == 6 )
                                            {{__('messages.nonprof_part')}}
                                        @else
                                            @foreach($land_statuses as $land_status)
                                                @if( $property->land_status_id == $land_status->id )
                                                    @if(Lang::locale() == 'ru') {{$land_status->status_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$land_status->status_en}}
                                                    @else {{$land_status->status_tm}}
                                                    @endif    
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->land_area) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.land_area')}}</span>
                                    <span>{{$property->land_area}} @if(App::isLocale('ru'))
                                            {{ $property->land_area_type->type_ru }}
                                        @elseif(App::isLocale('en'))
                                            {{ $property->land_area_type->type_en }}
                                        @else
                                            {{ $property->land_area_type->type_tm }}
                                        @endif                                      
                                    </span>
                                </li>
                            @endif                            
                            @if( isset($property->apartment_type_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.type_of_properties')}}</span>
                                    <span>
                                        @if(App::isLocale('ru'))
                                            {{$property->apartment_type->type_ru}}
                                        @elseif(App::isLocale('en'))
                                            {{$property->apartment_type->type_en}}
                                        @else
                                            {{$property->apartment_type->type_tm}}
                                        @endif
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->rooms) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.num_rooms')}}</span>
                                    <span class="first_cap">
                                        @if( (int)$property->object_names_id < 3 )
                                            @if( (int)$property->rooms < 6 )
                                                {{$property->rooms}}
                                            @elseif( (int)$property->rooms == 6 )
                                                {{$property->rooms}} {{__('messages.and_more')}}
                                            @elseif( (int)$property->rooms == 7 )
                                                {{__('messages.free_layout')}}
                                            @elseif( (int)$property->rooms == 8 )
                                                {{__('messages.studio')}}
                                            @endif    
                                        @else
                                            @if( (int)$property->rooms == 7 )
                                                {{$property->rooms . ' ' . '+'}}
                                            @else
                                                {{$property->rooms}}   
                                            @endif
                                        @endif
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->floor) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.floor')}}</span>
                                    <span>
                                        {{$property->floor}}
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->floors_in_home) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.total_floor1')}}</span>
                                    <span>
                                        {{$property->floors_in_home}}
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->type_property_id) && (int)$property->object_names_id > 2)
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.t_house')}}</span>
                                    <span>
                                        @if(App::isLocale('ru'))
                                            {{$property->building->building_ru}}
                                        @elseif(App::isLocale('en'))
                                            {{$property->building->building_en}}
                                        @else
                                            {{$property->building->building_tm}}
                                        @endif
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->rent_part) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">
                                        @if( (int)$property->saleOrRent == 1 )
                                            {{__('messages.sale_part')}}
                                        @else
                                            {{__('messages.rent_part')}}
                                        @endif
                                    </span>
                                    <span>{{$property->rent_part}}</span>
                                </li>    
                            @endif
                            @if( isset($property->ceil_height) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.ceil_height')}}</span>
                                    <span>
                                        {{$property->ceil_height}} {{__('messages.meter')}}
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->num_beds) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.beds')}}</span>
                                    <span>{{$property->num_beds}}</span>
                                </li>
                            @endif
                            @if( isset($property->number_baths) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.num_bath')}}</span>
                                    <span>
                                        {{$property->number_baths}}
                                    </span>
                                </li>    
                            @endif
                            @if( isset($property->room_layout_type) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.room_layout_1')}}</span>
                                    <span>                                        
                                        @if(App::isLocale('ru'))
                                            {{$property->room_layout->room_layout_ru}}
                                        @elseif(App::isLocale('en'))
                                            {{$property->room_layout->room_layout_en}}                                            
                                        @else
                                            {{$property->room_layout->room_layout_tm}}                                            
                                        @endif
                                    </span>
                                </li>
                            @endif
                            <hr class="visible-xs sHr1">
                            @if( isset($property->revamp_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.decor')}}</span>
                                    <span>
                                        @if(App::isLocale('ru'))
                                            {{$property->revamp->type_ru}}
                                        @elseif(App::isLocale('en'))
                                            {{$property->revamp->type_en}}
                                        @else
                                            {{$property->revamp->type_tm}}
                                        @endif
                                    </span>
                                </li>
                            @endif
                            @if( isset($property->bathroom_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.bath')}}</span>
                                    <span>
                                        @if( (int)$property->bathroom_id == 3 )
                                            {{__('messages.on_stret_and_home')}}
                                        @else
                                            @if(App::isLocale('ru')) {{$property->bathroom->bathroom_ru}}
                                            @elseif(App::isLocale('en')) {{$property->bathroom->bathroom_en}}
                                            @else {{$property->bathroom->bathroom_tm}} @endif
                                        @endif
                                    </span>
                                </li>
                            @endif
                            @if( isset($property->heating_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.heating_system')}}</span>
                                    <span>
                                        @if(App::isLocale('ru'))
                                            {{$property->heating->heating_ru}}
                                        @elseif(App::isLocale('en'))
                                            {{$property->heating->heating_en}}
                                        @else
                                            {{$property->heating->heating_tm}}
                                        @endif
                                    </span>
                                </li>    
                            @endif
                        </ul>
                    </article>
                    <!-- Property technical info end -->
                </div>  
                <!-- General property info end -->

                <!-- Property terms info for mobile version start -->
                <div class="single_block m-b-20 visible-sm visible-xs">
                    <h4 class="inner-title">{{__('messages.terms')}}</h4>
                    <div class="article">
                        <ul>
                            <li class="single_gen_item">
                                <span class="single_gen_item_name">@if( (int)$property->saleOrRent == 0 )
                                        {{__('messages.rent_price')}}    
                                    @else
                                        {{__('messages.price')}}
                                    @endif</span>
                                <span>{{number_format($property->price, 0, '.', " ")}} @if( (int)$property->saleOrRent == 0 )
                                        {{ $property->price_unit->unit === 'TMT' ? 'TMT'.__('messages.mon') : __('messages.cu') . __('messages.mon')}}
                                    @else
                                        {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}
                                    @endif
                                    @if( isset($property->trade_enabled) )
                                    <span class="hide_xxxs barg_txt">({{__('messages.barg_poss')}})</span><br class="show_xxxs">
                                    <span class="t-neg_txt show_xxxs">({{__('messages.barg_poss')}})</span>
                                    @endif</span>
                            </li>
                            @if( (int)$property->saleOrRent == 1 )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.rate')}}</span>
                                    <span>{{number_format($property->price_rate, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/{{ __('messages.meter')}}<sup>2</sup></span>
                                </li>
                            @endif
                            @if( isset($property->sale_type_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.sale_type')}}</span>
                                    <span>@if( (int)$property->sale_type_id == 1 )
                                            {{__('messages.free_sale')}}
                                        @else
                                            {{__('messages.alter_sale')}}
                                        @endif</span>
                                </li>
                            @endif
                            @if( ( (int)$property->object_names_id < 3 && (int)$property->saleOrRent == 0 ) || isset( $property->comm_payment_included ) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.comm_payment')}}</span>
                                    <span>@if( ((int)$property->object_names_id < 3 && (int)$property->saleOrRent == 0) || (int)$property->comm_payment_included == 1 ) 
                                        {{__('messages.incl_yes')}}
                                    @elseif( !is_null($property->comm_payment_included) )
                                        {{__('messages.incl_no')}}
                                    @endif</span>
                                </li>
                            @endif
                            @if( isset($property->rent_term_id) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.rent_period')}}</span>
                                    <span>@if(Lang::locale() == 'ru') {{$property->rent_term->term_ru}}
                                            @elseif(Lang::locale() == 'en') {{$property->rent_term->term_en}}
                                            @else {{$property->rent_term->term_tm}}
                                            @endif</span>
                                </li>
                            @endif
                            @if( isset($property->deposit_payment) || isset($property->without_collateral) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.own_deposit')}}</span>
                                    <span>@if( isset($property->without_collateral) )
                                            {{__('messages.undeposit')}}
                                        @else
                                            {{number_format($property->deposit_payment, 0, '.', " ")}} TMT
                                        @endif
                                    </span>
                                </li>
                            @endif
                            @if( isset($property->prepayment) )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.prepayment')}}</span>
                                    <span>@if( (int)$property->prepayment < 12 )
                                            {{$property->prepayment}}
                                            @if( (int)$property->prepayment < 2 )
                                                {{__('messages.month1')}}
                                            @elseif( (int)$property->prepayment < 5 )
                                                {{__('messages.month2')}}
                                            @else
                                                {{__('messages.month3')}}
                                            @endif
                                        @else
                                            1 {{__('messages.year')}}
                                        @endif</span>
                                </li>
                            @endif
                            @if( isset($property->house_purchase_status) && (int)$property->house_purchase_status == 1 )
                                <hr class="sHr1">
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.home_pur_debt')}}</span>
                                    <span>{{__('messages.redeemed')}}</span>
                                </li>
                            @endif
                            @if( isset($property->house_purchase_status) && (int)$property->house_purchase_status == 2 )
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.home_pur_debt')}}</span>
                                    <span>{{__('messages.with_debt')}}</span>
                                </li>
                                <li class="single_gen_item">
                                    <span class="single_gen_item_name">{{__('messages.amount')}}</span>
                                    <span>{{number_format($property->house_purchase_debt_amount, 0, '.', " ")}} TMT</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- Property terms info for mobile version end -->
                
                @if( (int)$property->object_names_id < 3 )
                <!-- Building info start for ONLY apartments-->
                    <div class="single_block m-b-20">
                        <h4 class="inner-title">{{__('messages.a_building')}}</h4>
                        <article>
                            <ul>
                                @if( isset($property->village_name) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.name')}}</span>
                                        <span>{{$property->village_name}}</span>
                                    </li>    
                                @endif                            
                                @if( isset($property->construction_year) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.const_year')}}</span>
                                        <span>{{$property->construction_year}}</span>
                                    </li>    
                                @endif                              
                                @if( isset($property->type_property_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.t_house_1')}}</span>
                                        <span>@if(App::isLocale('ru')) {{$property->building->building_ru}}
                                            @elseif(App::isLocale('en')) {{$property->building->building_en}}
                                            @else {{$property->building->building_tm}}
                                            @endif</span>
                                    </li>
                                @endif
                                @if( isset($property->floors_in_home) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.storey')}}</span>
                                        <span>{{$property->floors_in_home}}</span>
                                    </li>    
                                @endif
                                @if( isset($property->passenger_elevator) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.pass_elev')}}</span>
                                        <span>@if( (int)$property->passenger_elevator == 0 ) {{__('messages.no')}}
                                            @else {{$property->passenger_elevator}}
                                            @endif</span>
                                    </li>
                                @endif
                                @if( isset($property->service_elevator) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.freight_elev')}}</span>
                                        <span>@if( (int)$property->service_elevator == 0 ) {{__('messages.no')}}
                                            @else {{$property->service_elevator}} @endif</span>
                                    </li>
                                @endif
                                @if( isset( $property->parking_id ) )
                                    @if( (int)$property->parking_id == 5 )
                                        @foreach( $parkings as $parking )
                                            @if( $parking->id == 3 )
                                                @break
                                            @endif
                                            <hr class="sHr1 hidden-xs">
                                            <li class="single_gen_item">
                                                <span class="single_gen_item_name">{{__('messages.parking')}}</span>
                                                <span>
                                                    @if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                    @else {{$parking->parking_tm}}
                                                    @endif
                                                </span>
                                            </li>
                                            @if( isset( $property->parking_spots ) && $parking->id == 1 )
                                                <li class="single_gen_item">
                                                    <span class="single_gen_item_name">{{__('messages.place_num')}}</span>
                                                    <span>{{$property->parking_spots}}</span>
                                                </li>
                                            @endif
                                            @if( isset( $property->parking_spots ) && $parking->id == 2 )
                                                <li class="single_gen_item">
                                                    <span class="single_gen_item_name">{{__('messages.place_num')}}</span>
                                                    <span>{{$property->parking_spots_ex}}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <hr class="sHr1 hidden-xs">
                                        <li class="single_gen_item">
                                            <span class="single_gen_item_name">{{__('messages.parking')}}</span>
                                            <span>
                                                @foreach( $parkings as $parking )
                                                    @if( $parking->id == 3 )
                                                        @break
                                                    @endif
                                                    @if( $parking->id == $property->parking_id )                                                        
                                                        @if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                        @else {{$parking->parking_tm}}
                                                        @endif
                                                    @endif
                                                @endforeach                                                
                                            </span>
                                        </li>
                                        @if( isset( $property->parking_spots ) )
                                            <li class="single_gen_item">
                                                <span class="single_gen_item_name">{{__('messages.place_num')}}</span>
                                                <span>{{$property->parking_spots}}</span>
                                            </li>
                                        @endif
                                    @endif
                                @endif
                                @if( isset($property->pool_in_building) )
                                    <hr class="sHr1 hidden-xs">
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.pool')}}</span>
                                        <span>
                                            @if( $property->pool_in_building == '1' )
                                                {{__('messages.outdoor_pool')}}
                                            @else
                                                {{__('messages.indoor_pool')}}
                                            @endif
                                        </span>
                                    </li>    
                                @endif
                            </ul>
                        </article>
                    </div>
                <!-- Building info end -->
                @endif
                
                <!-- Property map location for desktop start -->
                <div class="single_block hidden-sm hidden-xs">
                    <div id="map_content" style="opacity: 0"></div>
                    <input type="hidden" id="lat" value="{{$property->lat}}">
                    <input type="hidden" id="lng" value="{{$property->lng}}">
                    <div class="single_map">
                        <h4 class="inner-title">{{__('messages.locations')}}</h4>
                        <div class="prop_add single_map_address">
                            <div>
                                <!-- This icon made by Freepik from https://www.flaticon.com, licensed by Creative Commons 3.0 - http://creativecommons.org/licenses/by/3.0/ -->
                                @php print '<?xml version="1.0" encoding="iso-8859-1"?>'; @endphp
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 512 512" style="" class="single_google_map_icon" xml:space="preserve">
                                    <path style="fill:#CCCCCC;" d="M451.809,239.542v217.654l-68.402-12.661l-30.156-36.174l-127.06-141.254l107.876-76.649 c54.037,71.326,55.741,53.938,55.741,53.938s26.692-39.85,60.936-5.607L451.809,239.542z"/>
                                    <path style="fill:#518EF8;" d="M190.707,223.105l224.311,288.696c-1.306,0.128-2.626,0.199-3.96,0.199H44.336L190.707,223.105z"/>
                                    <path style="fill:#28B446;" d="M334.068,190.458L0.447,471.248V101.389c0-22.512,18.254-40.752,40.752-40.752h243.289 c-10.447,17.956,28.289,29.481,28.289,51.752C312.777,134.803,323.494,172.417,334.068,190.458z"/>
                                    <path style="fill:#F2F2F2;" d="M451.809,457.196v14.052c0,21.164-16.139,38.566-36.791,40.553L227.313,326.567l45.436-46.046 l104.867,103.476l5.791,5.72L451.809,457.196z"/>
                                    <path style="fill:#FFD837;" d="M322.514,230.088l-49.765,50.432l-45.436,46.046L44.336,512h-3.137 c-22.498,0-40.752-18.254-40.752-40.752l284.254-288.058c5.323,9.113,41.93-0.114,49.368,7.267l13.67,17.572 C354.41,215.142,316.78,222.537,322.514,230.088z"/>
                                    <path style="fill:#FFFFFF;" d="M106.904,227.775c-35.808,0-64.939-29.131-64.939-64.939s29.131-64.939,64.939-64.939 c17.334,0,33.637,6.758,45.91,19.03l-15.057,15.054c-8.248-8.25-19.206-12.793-30.853-12.793c-24.068,0-43.647,19.58-43.647,43.647 s19.58,43.647,43.647,43.647c20.396,0,37.571-14.062,42.334-33.002h-42.334v-21.291h64.939v10.646 C171.842,198.644,142.712,227.775,106.904,227.775z"/>
                                    <path style="fill:#F14336;" d="M284.488,60.638C305.566,24.386,344.842,0,389.809,0c67.238,0,121.744,54.506,121.744,121.744 c0,16.863-3.435,32.916-9.624,47.522c-6.203,14.606-15.174,27.75-26.245,38.764c-9.226,9.808-17.501,20.17-24.939,30.759 c-48.729,69.424-60.936,148.685-60.936,148.685s-13.257-86.06-67.295-157.386c-5.734-7.551-11.923-14.947-18.594-22.058h0.014 c-7.438-7.381-13.91-15.727-19.233-24.84c-10.575-18.041-16.636-39.034-16.636-61.447C268.065,99.473,274.041,78.593,284.488,60.638 z"/>
                                    <path style="fill:#7E2D25;" d="M389.81,56.947c35.781,0,64.781,29.017,64.781,64.798s-29,64.781-64.781,64.781 s-64.798-29-64.798-64.781S354.03,56.947,389.81,56.947z"/>                               
                                </svg>
                            </div>
                            <div>
                                @if(app()->isLocale('ru'))                                
                                    @if( $property->velayat_id == 6 )
                                        {{__('messages.city_short')}} {{$property->velayat->velayat_ru}},
                                    @else
                                        {{$property->velayat->velayat_ru}} {{__('messages.velayat_short')}},
                                    @endif
                                        {{$property->city->city_ru}}, {{$property->address}}                                
                                @elseif(app()->isLocale('en'))
                                    {{$property->velayat->velayat_en}}
                                    @if( $property->velayat_id == 6 )
                                        {{__('messages.city_short')}},
                                    @else
                                        {{__('messages.velayat_short')}},
                                    @endif
                                        {{$property->city->city_en}}, {{$property->address}}                                
                                @elseif(app()->isLocale('tm'))
                                    {{$property->velayat->velayat_tm}}, {{$property->city->city_tm}}, {{$property->address}}
                                @endif
                            </div>
                        </div>
                        <hr class="sHr1">
                        <div id="map_desktop" class="map-canvas"></div>
                    </div>
                </div>
                <!-- Property map location end -->

                <!-- Bottom user or agent info block for mobile version start -->
                <div class="single_block m-b-20 visible-sm visible-xs">
                    @if($property->user->agent)
                        <!-- If user is agent start -->
                        <div class="agent_wrap">
                            <div class="agent_item">
                                <a href="javascript:void(0)" target="_blank">
                                    <img src="{{asset('\img\news\news-8.png')}}" alt="Agent avatar image">
                                </a>
                                <div class="agent_detail_content">
                                    <h2 class="agent_title">KW Realty</h2>
                                    @if( $property_counter > 1 )
                                        <a href="" class="agent_property_link1">
                                            @if(Lang::locale() == 'ru') {{__('messages.more_prop1')}} {{$property_counter}} {{__('messages.more_prop2')}} 
                                            @elseif(Lang::locale() == 'en') {{$property_counter}} {{__('messages.more_prop1')}} {{__('messages.more_prop2')}} 
                                            @else {{__('messages.more_prop1')}} {{$property_counter}} {{__('messages.more_prop1')}} 
                                            @endif
                                        </a>    
                                    @endif
                                </div>
                            </div>
                            <div class="agent_item">
                                <div class="credibility_wrap1">
                                    <span class="pro_txt" data-toggle="tooltip" data-placement="top" title="{{__('messages.pro_user')}}">PRO</span>
                                    <div class="trusted_agent">
                                        <div>
                                            <div class="trust_popup_comp">
                                                <div class="trust_popup_cont">
                                                    <div class="trust_popup_icon"></div>
                                                    <h3 class="trust_checked_txt">{{__('messages.verified')}}<span> Realestate</span></h3>
                                                    <ul class="verified_items">
                                                        <li><i class="fa fa-shield"></i><span>{{__('messages.verified_item1')}}</span></li>
                                                        <li><i class="fa fa-calendar-check-o"></i><span>{{__('messages.verified_item2')}}</span></li>
                                                        <li><i class="fa fa-handshake-o"></i><span>{{__('messages.verified_item3')}}</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="m-t-10">
                                    <div class="agent_type">{{__('messages.estate_agency')}}</div>
                                    <div class="agent_type">
                                        @if(Lang::locale() == 'ru') {{__('messages.in_market1')}} <bdi class="lato_regular">1995</bdi> {{__('messages.in_market2')}} 
                                        @elseif(Lang::locale() == 'en') {{__('messages.in_market1')}} <bdi class="lato_regular">1995</bdi> {{__('messages.in_market2')}} 
                                        @else <bdi class="lato_regular">1995</bdi> {{__('messages.in_market1')}} {{__('messages.in_market2')}} 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- If user is agent end -->
                    @else
                        <!-- If user is ordinary user start -->
                        <div class="agent_user_wrap">
                            <div class="agent_user_cont m-b-0">
                                <img src="/{{$property->profile->avatar}}">
                                <span class="agent_full_name">{{$property->profile->first_name}} {{$property->profile->last_name}}
                                        @if( $property_counter > 1 )
                                        <span class="agent_review_cnt">(Нет отзывов)</span>
                                    @endif
                                </span>
                                <a href="{{route('single.user.properties', ['user_id' => $property->user_id ])}}" class="agent_property_link">
                                    @if(Lang::locale() == 'ru') {{__('messages.more_prop1')}} <bdi class="lato_regular">{{$property_counter}}</bdi> {{__('messages.more_prop2')}} 
                                    @elseif(Lang::locale() == 'en') <bdi class="lato_regular">{{$property_counter}}</bdi> {{__('messages.more_prop1')}} {{__('messages.more_prop2')}} 
                                    @else {{__('messages.more_prop1')}} <bdi class="lato_regular">{{$property_counter}}</bdi> {{__('messages.more_prop1')}} 
                                    @endif
                                </a>                                
                            </div>                            
                        </div>
                        <!-- If user is ordinary user end -->
                    @endif            
                </div>
                <!-- Bottom user or agent info block for mobile version end -->

                <!-- Complain button for mobile version start -->
                <div class="text-center visible-sm visible-xs m-b-20">
                    <a href="{{route('report.property',['id' => $property->id])}}" class="btn btn-danger1 cus_btn" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt1')}}">
                        <i class="fa fa-exclamation-circle fa-lg m-r-10" aria-hidden="true"></i>{{__('messages.btn_complain_txt1')}}
                    </a>
                </div>
                <!-- Complain button for mobile version end -->

                <!-- User contact info block(floating block) for mobile version start -->
                <div class="t-scrolled_btn_wrap">
                    <a href="javascript:void(0)" id="t-show_phone" class="btn btn-success2 m-r-20 cus_btn">
                        <i class="fa fa-phone fa-lg m-r-10"></i>{{__('messages.make_call')}}
                    </a>
                    <a href="javascript:void(0)" id="t-show_message" class="btn btn-success2 cus_btn">
                        <i class="fa fa-envelope fa-lg m-r-10"></i>{{__('messages.compose_message')}}
                    </a>
                </div>
                <!-- User contact info block(floating block) for mobile version end -->
                
            </div>
            <!-- Left side, main property info end -->

            <!-- Right side, property cost info start -->
            <div class="scroll_bar_wrap hidden-sm hidden-xs">
                <div class="scroll_bar_container">
                    <div class="single_block m-b-20 p-t-30">
                        <div class="price_container">
                            <h2>@if( (int)$property->saleOrRent == 1 )
                                    {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}
                                @else
                                    {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/<span class="bar_mon_font">{{__('messages.mon_short')}}</span>
                                @endif
                                @if( $property->price_unit->unit !== 'TMT' )
                                    <span>
                                        <a id="cu_explanation" href="javascript:void(0);" data-toggle="tooltip" data-toggle="tooltip" data-placement="top" data-html="true" title="<div class='text-left'><b>{{ __('messages.cu') }}: </b>{{ __('messages.cu_mean') }}</div>">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                @endif
                            </h2>
                            @if( isset($property->price_rate) || isset($property->comm_payment_included) )
                                
                                @if( (int)$property->saleOrRent == 1 )
                                    <div class="scroll_bar_price_rate">
                                        <bdi class="lato_regular">{{number_format($property->price_rate , 0, '.', " ")}}</bdi> {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/{{__('messages.meter')}}<sup class="sq_sup_font-b">2</sup>
                                    </div>
                                @else
                                    <div class="scroll_bar_price_rate1">
                                        @if( isset($property->comm_payment_included) )
                                            @if( (int)$property->comm_payment_included == 1 )
                                                {{__('messages.rent_apart_comm_included')}}@if( isset( $property->trade_enabled ) ), {{__('messages.negt')}} @endif
                                            @else
                                                {{__('messages.rent_apart_comm_not_included')}}@if( isset( $property->trade_enabled ) ), {{__('messages.negt')}} @endif
                                            @endif
                                        @endif
                                    </div>
                                @endif
                                
                            @endif
                            @if( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 2 )
                                <br>
                                <h3 class="property_debt_h3">{{__('messages.debt')}}: {{number_format($property->house_purchase_debt_amount , 0, '.', " ")}} TMT</h3>
                            @endif
                            @if( isset( $property->rent_term_id ) || isset( $property->deposit_payment ) || isset( $property->without_collateral ) || isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) )
                                
                                <div class="scroll_bar_incls">                                    
                                    @if( isset( $property->rent_term_id ) )
                                        <div class="scroll_bar_incl_item">
                                            @if( (int)$property->rent_term_id == 1 )
                                                {{__('messages.long_term_rent')}}@if( isset( $property->deposit_payment ) || isset( $property->without_collateral ) || isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ), @endif
                                            @else
                                                {{__('messages.short_term_rent')}}@if( isset( $property->deposit_payment ) || isset( $property->without_collateral ) || isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ), @endif
                                            @endif
                                        </div>
                                    @endif
                                    @if( isset( $property->deposit_payment ) )
                                        <div class="scroll_bar_incl_item">
                                            {{__('messages.deposit')}} <bdi class="lato_regular text-uppercase">{{number_format($property->deposit_payment , 0, '.', " ")}} TMT</bdi>@if( isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ),@endif</div>
                                    @elseif( isset( $property->without_collateral ) )
                                        <div class="scroll_bar_incl_item">
                                            {{__('messages.undeposit')}}@if( isset( $property->prepayment ) || isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ),@endif</div>
                                    @endif
                                    @if( isset( $property->prepayment ) )
                                        <div class="scroll_bar_incl_item">
                                            {{__('messages.pay_for') }} <bdi class="lato_regular">{{$property->prepayment}}</bdi>
                                            @if( (int)$property->prepayment == 1 )
                                                {{__('messages.month1')}},
                                            @elseif( (int)$property->prepayment < 5 )
                                                {{__('messages.month2')}},
                                            @else
                                                {{__('messages.month3')}},
                                            @endif
                                            {{__('messages.by_year')}}@if( isset( $property->sale_type_id ) || ( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ) ),@endif
                                        </div>
                                    @endif
                                    @if( isset( $property->sale_type_id ) )
                                        <div class="scroll_bar_incl_item">
                                            @if( (int)$property->sale_type_id == 1 )
                                                {{__('messages.free_sale')}}@if( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ),@endif
                                            @else
                                                {{__('messages.alter_sale')}}@if( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 ),@endif
                                            @endif
                                        </div>
                                    @endif
                                    @if( isset( $property->house_purchase_status ) && (int)$property->house_purchase_status == 1 )<span class="scroll_bar_incl_item"> {{__('messages.redeemed_prop')}}</span>@endif
                                </div>
                            @endif
                        </div>
                        <hr class="sHr1">
                        @if($property->user->agent)
                            <div class="credibility_wrap">
                                <div class="trusted_agent">
                                    <div>
                                        <div class="trust_popup_comp">
                                            <div class="trust_popup_cont">
                                                <div class="trust_popup_icon"></div>
                                                <h3 class="trust_checked_txt">{{__('messages.verified')}}<span> Realestate</span></h3>
                                                <ul class="verified_items">
                                                    <li><i class="fa fa-shield"></i><span>{{__('messages.verified_item1')}}</span></li>
                                                    <li><i class="fa fa-calendar-check-o"></i><span>{{__('messages.verified_item2')}}</span></li>
                                                    <li><i class="fa fa-handshake-o"></i><span>{{__('messages.verified_item3')}}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="pro_txt" data-toggle="tooltip" data-placement="top" title="{{__('messages.pro_user')}}">PRO</span>
                            </div>                        
                            <div class="agent_details">                            
                                <a href="javascript:void(0)" class="agent_avatar_cont" target="_blank">
                                    <img src="{{asset('\img\news\news-8.png')}}" alt="Agent avatar image">
                                </a>
                                <div class="agent_detail_content">
                                    <h2 class="agent_title">KW Realty</h2>
                                    <div class="agent_type">{{__('messages.estate_agency')}}</div>
                                    <div class="agent_type">
                                        @if(Lang::locale() == 'ru') {{__('messages.in_market1')}} 1995 {{__('messages.in_market2')}} 
                                        @elseif(Lang::locale() == 'en') {{__('messages.in_market1')}} 1995 {{__('messages.in_market2')}} 
                                        @else 1995 {{__('messages.in_market1')}} {{__('messages.in_market2')}} 
                                        @endif
                                    </div>
                                    @if( $property_counter > 1 )
                                        <a href="" class="agent_property_link">
                                            @if(Lang::locale() == 'ru') {{__('messages.more_prop1')}} {{$property_counter}} {{__('messages.more_prop2')}} 
                                            @elseif(Lang::locale() == 'en') {{$property_counter}} {{__('messages.more_prop1')}} {{__('messages.more_prop2')}} 
                                            @else {{__('messages.more_prop1')}} {{$property_counter}} {{__('messages.more_prop1')}} 
                                            @endif
                                        </a>    
                                    @endif
                                </div>
                                <div class="contact_prop_owner m-t-10">
                                    <a href="javascript:void(0)" id="show_phone" class="btn btn-success2 m-b-10"><i class="fa fa-phone fa-lg m-r-10"></i>{{__('messages.show_phone')}}</a>
                                    <a href="javascript:void(0)" class="btn btn-success1" id="show_message"><i class="fa fa-envelope fa-lg m-r-10"></i>{{__('messages.write_msg')}}</a>
                                </div>                                
                            </div>
                        @else
                            <div class="agent_user_wrap">
                                <div class="agent_user_cont">
                                    <img src="/{{$property->profile->avatar}}">
                                    <span class="agent_full_name">{{$property->profile->first_name}} {{$property->profile->last_name}}</span>
                                    @if( $property_counter > 1 )
                                        <a href="{{route('single.user.properties', ['user_id' => $property->user_id ])}}" class="agent_property_link">
                                            @if(Lang::locale() == 'ru') {{__('messages.more_prop1')}} {{$property_counter}} {{__('messages.more_prop2')}} 
                                            @elseif(Lang::locale() == 'en') {{$property_counter}} {{__('messages.more_prop1')}} {{__('messages.more_prop2')}} 
                                            @else {{__('messages.more_prop1')}} {{$property_counter}} {{__('messages.more_prop1')}} 
                                            @endif
                                        </a>    
                                    @endif
                                    <div class="agent_review_cnt">Нет отзывов</div>
                                </div>
                                <div class="contact_prop_owner">
                                    <a href="javascript:void(0)" id="show_phone" class="btn btn-success2 m-b-10"><i class="fa fa-phone fa-lg m-r-10"></i>{{__('messages.show_phone')}}</a>
                                    <a href="javascript:void(0)" class="btn btn-success1" id="show_message1"><i class="fa fa-envelope fa-lg m-r-10"></i>{{__('messages.write_msg')}}</a>
                                </div>                                
                            </div>
                        @endif
                        <div class="prop_owner_send_msg hide">
                            <hr class="sHr3">
                            <a href="javascript:void(0)" class="btn" id="close_message"><i class="fa fa-window-close"></i></a>
                            <label for="property_owner_message">{{__('messages.write_msg')}}</label>
                            <form action="{{route('single.mail.owner', ['id' => $property->id])}}" id="property_owner_message" method="POST" class="submit_form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="text" class="form-control white_form1" name="full_name" placeholder="{{__('messages.full_name')}}" pattern="/^([a-zA-Z]+\s)*[a-zA-Z]+$/" aria-placeholder="true" required 
                                    @if( Auth::check() && Auth::user()->admin !== 1 )
                                        value = "{{ Auth::user()->profile->first_name . ' ' . Auth::user()->profile->last_name }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control white_form1" name="email" placeholder="{{__('messages.your_email')}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" aria-placeholder="true" required 
                                    @if( Auth::check() && Auth::user()->admin !== 1 )
                                        value="{{ Auth::user()->email }}"
                                    @endif>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control white_form1" name="phone" id="phone" placeholder="{{__('messages.your_phone')}}" aria-placeholder="true" required 
                                    @if( Auth::check() && Auth::user()->admin !== 1 )
                                        value="{{ Auth::user()->phone }}"    
                                    @endif>
                                </div>
                                <input type="hidden" name="subject" value="{{ __('messages.write_msg_owner_subject') . ' ' . $property->title}}">
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control white_form1" aria-placeholder="false" required >{{__('messages.agent_send_msg')}}</textarea>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success1">{{__('messages.send')}}</button>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- Right side, property cost info end -->
        </main>

        <!-- Show telephone number for mobile version start -->
        <div class="show_contact_wrap">
            <div class="show_contact_overlay"></div>
            <div id="t-contact_phone" class="white_back hide">
                <div class="show_contact_cont">
                    <div class="agent_user_cont m-b-20" itemprop="name">
                        <img src="/{{$property->profile->avatar}}">
                        <div class="agent_full_name" >{{$property->profile->first_name}} {{$property->profile->last_name}}</div>
                    </div>
                    <div itemprop="telephone">                        
                        <a href="tel:+{{$property->user->phone}}" class="t-phone_contact">+{{$property->user->phone}}</a>
                    </div>
                    <div class="show_contact_close">
                        <a href="javascript:void(0)" class="show_contact_close_btn" id="t-contact_phone_close">{{__('messages.close')}}</a>
                    </div>
                </div>
            </div>
            <div id="t-contact_message" class="hide">
                <div class="t-contact_message_cont">
                    <label for="t-property_owner_message" class="t-owner_msg_lbl">{{__('messages.write_msg')}}</label>
                    <form action="{{route('single.mail.owner', ['id' => $property->id])}}" id="t-property_owner_message" method="POST">
                        {{csrf_field()}}
                        <div class="t-s_owner_msg_cont">
                            <div>
                                <input type="text" name="full_name" placeholder="{{__('messages.full_name')}}" pattern="/^([a-zA-Z]+\s)*[a-zA-Z]+$/" aria-placeholder="true" required
                                @if( Auth::check() && Auth::user()->admin !== 1 )
                                    value = "{{ Auth::user()->profile->first_name . ' ' . Auth::user()->profile->last_name }}"
                                @endif>
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="{{__('messages.your_email')}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" aria-placeholder="true" required 
                                @if( Auth::check() && Auth::user()->admin !== 1 )
                                    value="{{ Auth::user()->email }}"
                                @endif>
                            </div>
                            <div>
                                <input type="tel" name="phone" name="phone" id="phone" placeholder="{{__('messages.your_phone')}}" aria-placeholder="true" required
                                @if( Auth::check() && Auth::user()->admin !== 1 )
                                    value="{{ Auth::user()->phone }}"    
                                @endif>
                            </div>
                            <input type="hidden" name="subject" value="{{ __('messages.write_msg_owner_subject') . ' ' . $property->title}}">
                            <div>
                                <textarea name="message" id="message" aria-placeholder="false" required>{{__('messages.agent_send_msg')}}</textarea>
                            </div>
                            <div>
                                <button type="submit" class="t-message_contact">{{__('messages.send')}}</button>
                            </div>
                            <div class="show_contact_close">
                                <a href="javascript:void(0)" class="show_contact_close_btn" id="t-contact_message_close">{{__('messages.close')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <!-- Show telephone number for mobile version end -->

        @if( !is_null($related_properties) && count($related_properties) > 0 )
            <!-- Related property start -->
            <div class="related_wrap">
                <div class="related_back">
                    <div class="related_head">
                        <h2 class="property-title m-b-20">
                            @if( $related_property_flag === 3 )
                                {{__('messages.related_property_text_opt1')}}
                            @elseif( $related_property_flag === 2 )
                                {{__('messages.related_property_text_opt2')}}
                            @elseif( $related_property_flag === 1 )
                                {{__('messages.related_property_text_opt3')}}
                            @endif
                        </h2>                    
                    </div>
                    <div class="single_rel_carousel">
                        @foreach( $related_properties as $rel_property )
                            <div class="item">
                                <div class="property_grid">
                                    <div class="img_area">
                                        <div class="sale_btn">{{$rel_property->saleOrRent ? __('messages.sale') : __('messages.rent')}}</div>
                                        @if($rel_property->featured)
                                            <div class="featured_btn">{{ __('messages.premium') }}</div>
                                        @endif
                                        <a href="{{route('single.living', ['id' => $rel_property->id])}}" class="prop_grid_filter" target="_blank">
                                            <img src="{{$rel_property->img}}">
                                        </a>
                                        <div class="sale_amount">{{$rel_property->created_at->diffForHumans()}}</div>
                                        <div class="hover_property">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                                                <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="property_grid_mid">
                                        <a href="{{route($rel_property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $rel_property->id])}}"  target="_blank">
                                            <h5 class="property_grid_title">@if(Lang::locale() == 'ru') {{$p_deals_ru[$rel_property->saleOrRent]}}
                                                @elseif(Lang::locale() == 'en') {{$p_deals_en[$rel_property->saleOrRent]}}
                                                @else {{$p_deals_tm[$rel_property->saleOrRent]}}
                                                @endif
                                                @if(Lang::locale() == 'ru') {{$p_objects_ru[$rel_property->object_names_id-1]}}
                                                @elseif(Lang::locale() == 'en') {{$p_objects_en[$rel_property->object_names_id-1]}}
                                                @else {{$p_objects_tm[$rel_property->object_names_id-1]}}
                                                @endif
                                            </h5>
                                        </a>
                                        <div class="property_grid_feats">
                                            @php $obj = (int)$rel_property->object_names_id; @endphp
                                            @if( $rel_property->type_id == 1 )
                                                <!-- Residential property info start -->
                                                @if( $obj < 3 )
                                                    <span class="property_grid_feat">
                                                        @if( (int)$rel_property->rooms < 7 )
                                                            {{$rel_property->rooms}}-{{__('messages.room_sh1')}}
                                                        @elseif( (int)$rel_property->rooms == 7 )
                                                            {{__('messages.free_layout')}}
                                                        @elseif( (int)$rel_property->rooms == 8 )
                                                            {{__('messages.studio')}}
                                                        @endif
                                                    </span>
                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                    <span class="property_grid_feat">{{$rel_property->area . ' ' . __('messages.meter')}}<sup>2</sup></span>
                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                    <span class="property_grid_feat">{{$rel_property->floor . '/' . $rel_property->floors_in_home . ' ' . __('messages.floors_1')}}</span>
                                                @elseif( $obj === 5 )
                                                    <span class="property_grid_feat">{{$rel_property->rent_part . ' ' . __('messages.part')}}</span>
                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                    <span class="property_grid_feat">{{$rel_property->area . ' ' . __('messages.meter')}}<sup>2</sup></span>
                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                    <span class="property_grid_feat">{{$rel_property->land_area}} @if(Lang::locale() == 'ru') {{$rel_property->land_area_type->type_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$rel_property->land_area_type->type_en}}
                                                        @else {{$rel_property->land_area_type->type_tm}}
                                                        @endif</span>
                                                @else
                                                    @if(isset($rel_property->rooms) || isset($rel_property->floors_in_home))
                                                        <span class="property_grid_feat">
                                                            @if( isset($rel_property->rooms) )
                                                                {{$rel_property->rooms . ' ' . __('messages.room_sh1') }}
                                                            @else
                                                                {{$rel_property->floors_in_home . ' ' . __('messages.floors_1')}} 
                                                            @endif
                                                        </span>
                                                        <span class="property_grid_delimeter">&nbsp;</span>
                                                    @endif
                                                    <span class="property_grid_feat">{{$rel_property->area . ' ' . __('messages.meter')}}<sup>2</sup></span>
                                                    <span class="property_grid_delimeter">&nbsp;</span>
                                                    <span class="property_grid_feat">{{$rel_property->land_area}} @if(Lang::locale() == 'ru') {{$rel_property->land_area_type->type_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$rel_property->land_area_type->type_en}}
                                                        @else {{$rel_property->land_area_type->type_tm}}
                                                        @endif</span>
                                                @endif
                                                <!-- Residential property info end -->                                                        
                                            @else
                                                <!-- Commercaial property info start -->
                                                <span class="property_grid_feat">@if( $obj == 7 ) {{$rel_property->building_area . ' ' . __('messages.meter')}}<sup>2</sup>
                                                    @else {{$rel_property->area . ' ' . __('messages.meter')}}<sup>2</sup>
                                                    @endif</span>
                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                <span class="property_grid_feat">@if( $obj == 7 ) {{$rel_property->floors_in_home . ' ' . __('messages.floors_1')}}
                                                    @else {{$rel_property->floor . '/' . $rel_property->floors_in_home . ' ' . __('messages.floors_1')}}
                                                    @endif</span>
                                                    @switch($obj)
                                                        @case(6)
                                                            @if(isset($rel_property->office_condition_id) || isset($rel_property->building_type_id) || (isset($rel_property->rent_term_id) && (int)$rel_property->saleOrRent == 0) || (isset($rel_property->furniture) && (int)$rel_property->saleOrRent == 1) )
                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                <span class="property_grid_feat l_feat">
                                                                    @if(isset($rel_property->office_condition_id))
                                                                        @if(Lang::locale() == 'ru') {{$rel_property->office_condition->condition_ru}}
                                                                        @elseif(Lang::locale() == 'en') {{$rel_property->office_condition->condition_en}}
                                                                        @else {{$rel_property->office_condition->condition_tm}}
                                                                        @endif
                                                                    @elseif(isset($rel_property->building_type_id))
                                                                        @if(App::isLocale('ru')) {{$rel_property->building_type->type_ru}}
                                                                        @elseif(App::isLocale('en')) {{$rel_property->building_type->type_en}}
                                                                        @else {{$rel_property->building_type->type_tm}}
                                                                        @endif
                                                                    @elseif( isset($rel_property->rent_term_id) && (int)$rel_property->saleOrRent == 0 )
                                                                        @if( (int)$rel_property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}
                                                                        @else {{__('messages.short_term_rent')}}
                                                                        @endif
                                                                    @elseif(isset($rel_property->furniture) && (int)$rel_property->saleOrRent == 1)
                                                                        @if( (int)$rel_property->furniture == 1 ) {{__('messages.furnished')}}
                                                                        @else {{__('messages.unfurnished')}}
                                                                        @endif
                                                                    @endif
                                                                </span>                                                                                                                                            
                                                            @endif                                                                    
                                                        @break
                                                        @case(7)
                                                            @if(isset($rel_property->building_type_id) || isset($rel_property->land_area) || isset($rel_property->office_condition_id))
                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                <span class="property_grid_feat l_feat">
                                                                    @if( isset($rel_property->building_type_id) ) {{__('messages.type')}}:@if(App::isLocale('ru')) {{$rel_property->building_type->type_ru}}
                                                                        @elseif(App::isLocale('en')) {{$rel_property->building_type->type_en}}
                                                                        @else {{$rel_property->building_type->type_tm}} @endif
                                                                    @elseif(isset($rel_property->land_area)) {{$rel_property->land_area . ' ' . __('messages.ga')}}
                                                                    @elseif(isset($rel_property->office_condition_id)) @if(Lang::locale() == 'ru') {{$rel_property->office_condition->condition_ru}}
                                                                        @elseif(Lang::locale() == 'en') {{$rel_property->office_condition->condition_en}}
                                                                        @else {{$rel_property->office_condition->condition_tm}}
                                                                        @endif                                                                    
                                                                    @endif
                                                                </span>
                                                            @endif                                                                    
                                                        @break
                                                        @case(8)
                                                            @if(isset($rel_property->trade_room_id))
                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                <span class="property_grid_feat l_feat">
                                                                    @if(Lang::locale() == 'ru') {{$rel_property->trade_room->room_ru}}
                                                                    @elseif(Lang::locale() == 'en') {{$rel_property->trade_room->room_en}}
                                                                    @else {{$rel_property->trade_room->room_tm}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @break
                                                        @case(9)
                                                        @case(10)
                                                            @if((isset($rel_property->building_type_id) && (int)$rel_property->saleOrRent == 0) || (isset($rel_property->column_grid) && (int)$rel_property->saleOrRent == 1) || isset($rel_property->land_area) || (isset($rel_property->rent_term_id) && (int)$rel_property->saleOrRent == 0))
                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                <span class="property_grid_feat l_feat">
                                                                    @if( isset($rel_property->building_type_id) && (int)$rel_property->saleOrRent == 0 ) {{__('messages.type')}}:@if(App::isLocale('ru')) {{$rel_property->building_type->type_ru}}
                                                                        @elseif(App::isLocale('en')) {{$rel_property->building_type->type_en}}
                                                                        @else {{$rel_property->building_type->type_tm}} @endif
                                                                    @elseif(isset($rel_property->column_grid) && (int)$rel_property->saleOrRent == 1 )
                                                                        {{$rel_property->column_grid . ' ' . mb_strtolower(__('messages.col_grid'), 'UTF-8')}}
                                                                    @elseif(isset($rel_property->land_area)) 
                                                                        {{$rel_property->land_area . ' ' . __('messages.ga')}}
                                                                    @elseif( isset($rel_property->rent_term_id) && (int)$rel_property->saleOrRent == 0 )
                                                                        @if( (int)$rel_property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}
                                                                        @else {{__('messages.short_term_rent')}}
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        @break
                                                        @case(11)
                                                            @if(isset($rel_property->business_type_property_id) || isset($rel_property->office_condition_id) || (isset($rel_property->rent_term_id) && (int)$rel_property->saleOrRent == 0))
                                                                <span class="property_grid_delimeter">&nbsp;</span>
                                                                <span class="property_grid_feat l_feat">
                                                                    @if(isset($rel_property->business_type_property_id))
                                                                        {{__('messages.type')}}:@if(Lang::locale() == 'ru') {{$rel_property->business_type_property->type_ru}}
                                                                        @elseif(Lang::locale() == 'en') {{$rel_property->business_type_property->type_en}}
                                                                        @else {{$rel_property->business_type_property->type_tm}}
                                                                        @endif
                                                                    @elseif(isset($rel_property->office_condition_id))
                                                                        @if(Lang::locale() == 'ru') {{$rel_property->office_condition->condition_ru}}
                                                                        @elseif(Lang::locale() == 'en') {{$rel_property->office_condition->condition_en}}
                                                                        @else {{$rel_property->office_condition->condition_tm}}
                                                                        @endif
                                                                    @elseif( isset($rel_property->rent_term_id) && (int)$rel_property->saleOrRent == 0 )
                                                                        @if( (int)$rel_property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}
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
                                        <span class="property_grid_addr"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$rel_property->address}}</span>
                                        <bdi class="property_grid_vel">
                                            @if(Lang::locale() == 'ru') {{$rel_property->city->city_ru}}/
                                            @elseif(Lang::locale() == 'en') {{$rel_property->city->city_en}}/
                                            @else {{$rel_property->city->city_tm}}/
                                            @endif
                                            @if(Lang::locale() == 'ru')
                                                @if( $rel_property->city->id == 6 )
                                                    {{$rel_property->velayat->velayat_ru}}
                                                @else
                                                    {{mb_substr($rel_property->velayat->velayat_ru, 0, (mb_strlen($rel_property->velayat->velayat_ru, 'UTF-8') - 4), 'UTF-8')}}
                                                @endif
                                            @elseif(Lang::locale() == 'en') {{$rel_property->velayat->velayat_en}}
                                            @else {{$rel_property->velayat->velayat_tm}}
                                            @endif
                                        </bdi>                                                
                                    </div>
                                    <div class="property_grid_foot" >
                                        <div class="property_grid_foot_price">
                                            <div 
                                                @if( (int)$rel_property->saleOrRent == 0 )
                                                    class="sing_val"
                                                @endif>{{number_format($rel_property->price, 0, '.', " ")}} {{ $rel_property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} @if(!$rel_property->saleOrRent) {{__('messages.mon')}} @endif</div>
                                            @if( isset( $rel_property->price_rate ) && (int)$rel_property->saleOrRent == 1 )
                                                <div>{{number_format($rel_property->price_rate, 0, '.', " ")}} {{ $rel_property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/{{ __('messages.meter')}}<sup>2</sup></div>                                                        
                                            @endif
                                        </div>                                        
                                    </div>
                                </div>
                            </div>                        
                        @endforeach                    
                    </div>
                </div>
            </div>
            <!-- Related property end -->
        @endif
    </section>
    {{-- @if(!is_null($property->image) && count($property->image) > 0 )
        <section style=" position: absolute; z-index: 1000; top: 0; right: 0; left: 0; bottom: 0; float: none; margin: 0; width: 100%; height: 100%; overflow: hidden; background-color: #000;padding: 0;">
            <div style="height: 50px;z-index: 0;width: 100%;position: relative;padding: 0 24px;top: 0;left: 0;">
                <div style="position: absolute;left: 20px;font-family: 'Lato', sans-serif;font-size: 16px;font-weight: 700;line-height: 1.38;text-align: left;color: #fff;opacity: 0.92;margin-top: 12px;">
                    {{$property->title}} - 
                @if((int)$property->saleOrRent == 1) {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}
                @else {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/<span class="bar_mon_font">{{__('messages.mon_short')}}</span>
                @endif</div>
            </div>
            <div style=" position: relative; z-index: 0; width: 100%; height: calc( 100% - 70px ); background-color: blue; "></div>
        </section>
    @endif --}}
    <!-- Single Property End -->
@endsection
@section('scripts')
    <!-- use for map style -->
    <script>       
        function initMap(){
            var mapOptions = {
                zoom: 13,
                center: new google.maps.LatLng({{ $property->lat }}, {{ $property->lng }}),
                styles: [{"featureType":"water","elementType":"all","stylers":[{"hue":"#76aee3"},{"saturation":38},{"lightness":-11},{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"hue":"#8dc749"},{"saturation":-47},{"lightness":-17},{"visibility":"on"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"hue":"#c6e3a4"},{"saturation":17},{"lightness":-2},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"hue":"#cccccc"},{"saturation":-100},{"lightness":13},{"visibility":"on"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"hue":"#5f5855"},{"saturation":6},{"lightness":-31},{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[]}] };
            
            var mapElement_desktop = document.getElementById('map_desktop');
            var mapElement_mobile = document.getElementById('map_mobile');

            var map = new google.maps.Map(mapElement_desktop, mapOptions);
            var map_mobile = new google.maps.Map(mapElement_mobile, mapOptions);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng({{ $property->lat }}, {{ $property->lng }}),
                map: map,
                icon: '{{ asset($settings->map_icon) }}',
                title: '{{ $settings->map_tag }}'
            });

            var marker_mobile = new google.maps.Marker({
                position: new google.maps.LatLng({{ $property->lat }}, {{ $property->lng }}),
                map: map_mobile,
                icon: '{{ asset($settings->map_icon) }}',
                title: '{{ $settings->map_tag }}'
            });
        }
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-XXXXX-Y', 'auto');
            ga('send', 'pageview');
    </script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADAvRonq8GcS5dNWMPgDMf17hgiaTHs7E&callback=initMap" async defer></script>
    <script>
        function getLiked(){
            const ind = event.target;
            const pElm = ind.parentElement.parentElement;        
            const id = pElm.id;
            let c_elm = document.getElementById('property_' + id);
            favLinks();
            pElm.setAttribute( "onClick", "decreaseLiked()" );
            c_elm.className = "fa fa-star";
            c_elm.nextElementSibling.innerHTML = "{{__('messages.in_fav')}}";
            postFav(id);
        }

        function decreaseLiked(){
            const ind = event.target;
            const pElm = ind.parentElement.parentElement;
            const id = pElm.id;
            let c_elm = document.getElementById('property_' + id);
            favLinks();
            pElm.setAttribute( "onClick", "getLiked()" );
            c_elm.className = "fa fa-star-o";
            c_elm.nextElementSibling.innerHTML = "{{__('messages.to_fav')}}";
            postDec(id);
        }

        $(document).ready(function(){
            $('.cl_phone a').click(function(){
                $(this).addClass('hide').next().removeClass('hide');
            });

            $('.single_rel_carousel').owlCarousel({
                loop:true,
                margin:30,
                nav:true,
                dots: false,
                autoplayHoverPause:false,
                smartSpeed: 300,
                autoplay: false,
                navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
                responsive:{
                    0: { items: 1, nav: false, dots: true, loop: false},
                    768: { items: 2, margin: 20 },
                    992: { items: 2 },
                    1200: { items: 3 }
                }
            });

            $('a#cu_explanation').tooltip();

            /* In desktop version, show the contact phone */
            $('#show_phone').on('click', function(){
                let tel_no='{{$property->user->phone}}';
                if( tel_no.charAt(0) !== '+' ){ tel_no = '+' + tel_no; }
                $(this).addClass('show_tel');
                $(this).text(tel_no);
            });

            /* In desktop version, show the contact form */
            $('#show_message, #show_message1').on('click', function(){
                $(this).addClass('hide');
                $('.prop_owner_send_msg').removeClass('hide');
            });

            /* In desktop version, close the contact form */
            $('#close_message').on('click', function(){
                $(this).parent().addClass('hide');
                $('#show_message, #show_message1').removeClass('hide');
            });

            /* In mobile version, show the contact phone */
            $('#t-show_phone').on('click', function(){
                $('.show_contact_wrap').css({'visibility':'visible','opacity':'1',WebkitTransition:'opacity 0.3s linear 0s',MozTransition:'opacity 0.3s linear 0s',msTransition:'opacity 0.3s linear 0s',OTransition:'opacity 0.3s linear 0s',transition:'opacity 0.3s linear 0s'});
                $('.show_contact_wrap, #t-contact_phone').removeClass('hide');
            });
            
            /* In mobile version, close the contact phone */
            $('#t-contact_phone_close').on('click', function(){
                $('.show_contact_wrap, #t-contact_phone').addClass('hide');
                $('.show_contact_wrap').removeAttr('style');
            });


            /* In mobile version, show the contact form */
            $('#t-show_message').on('click', function(){
                $('.show_contact_wrap').css({'visibility':'visible','opacity':'1',WebkitTransition:'opacity 0.3s linear 0s',MozTransition:'opacity 0.3s linear 0s',msTransition:'opacity 0.3s linear 0s',OTransition:'opacity 0.3s linear 0s',transition:'opacity 0.3s linear 0s'});
                $('.show_contact_wrap, #t-contact_message').removeClass('hide');
            });

            /* In mobile version, close the contact form */
            $('#t-contact_message_close').on('click', function(){
                $('.show_contact_wrap, #t-contact_message').addClass('hide');
                $('.show_contact_wrap').removeAttr('style');
            });
            
            /* In desktop version, toggle the agent credentials on mouse enter/leave */
            $('.trusted_agent').mouseenter(function(){
                $(this).find('div').first().addClass('trust_popup_container');
            }).mouseleave(function(){
                $(this).find('div').first().removeClass('trust_popup_container');
            });

            /* In mobile version, collapse in/out the description text */
            $('#read_more').on('click', function(){
                let $tog_elem = $('.squeeze_block');
                $tog_elem.toggleClass('squeeze_open');
                $(this).toggleClass('read_opened');
                    
                if( $tog_elem.hasClass('squeeze_open') ){  $(this).text("{{__('messages.collapse')}}"); 
                } else { $(this).text("{{__('messages.read_more')}}"); }
            });

            /* adjust the last feature space of commercial property */
            $('.l_feat').each(function(){
                var par_area, tot_area = 0;                
                par_area = $(this).parent().outerWidth();
                $(this).parent().find('span:not(:last)').each(function(){
                    tot_area += $(this).outerWidth();
                });
                $(this).css({'width' : par_area - 5 -tot_area + 'px' });
            });            
        });
    </script>
@endsection