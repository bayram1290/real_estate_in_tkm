@extends('layouts.front')

@section('content')
    <!-- Banner Section Start -->
    <section id="banner" class="p-b-30 xm_p-t-100">
        <div class="single_banner_wrap hidden-sm hidden-xs">
            <div class="page_location">
                <a href="{{route('list')}}">{{__('messages.properties')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <a href="{{route('property.type',['id' => 2])}}">{{__('messages.commercial1')}}</a>
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
                    
                    <!-- Property main specifications start -->
                    <div class="row m-b-15 m-r-0 m-l-0 hidden-sm hidden-xs">
                        <div class="area_sep">
                            <span class="area_title">{{__('messages.area')}}</span>
                            <h5 class="property-title">
                                @if( isset($property->area) )
                                    {{number_format($property->area, 1, '.', " ")}}
                                @else
                                    {{number_format($property->building_area, 1, '.', " ")}}
                                @endif{{__('messages.meter')}}<sup>2</sup>
                            </h5>
                        </div>
                        @if( !isset($property->floor) && isset($property->floors_in_home) )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.storey')}}</span>
                                <h5 class="property-title">
                                    {{$property->floors_in_home}}
                                    @if( (int)$property->floors_in_home < 2 )
                                        {{__('messages.floors_1')}}
                                    @elseif( (int)$property->floors_in_home < 5 )
                                        {{__('messages.floors_2')}}
                                    @else
                                        {{__('messages.floors_3')}}
                                    @endif
                                </h5>
                            </div>
                        @endif
                        @if( isset( $property->building_class ) )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.build_class')}}</span>
                                <h5 class="property-title">{{$property->building_class}}</h5>
                            </div>
                        @endif
                        @if( isset( $property->construction_year) && $property->object_names_id !== 10 )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.const_year')}}</span>
                                <h5 class="property-title">{{$property->construction_year}}</h5>
                            </div>
                        @endif
                        @if( isset( $property->floor ) && $property->floor !== 0 )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.floor')}}</span>
                                <h5 class="property-title">
                                    {{$property->floor}}
                                    <span class="tt_none">{{__('messages.from')}}</span>
                                    {{$property->floors_in_home}}
                                </h5>
                            </div>
                        @endif
                        @if( ( $property->object_names_id == 10 || $property->object_names_id == 9 ) && isset( $property->ceil_height ) )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.ceil_sh')}}</span>
                                <h5 class="property-title">{{$property->ceil_height}} {{__('messages.meter')}}</h5>
                            </div>
                        @endif
                        @if(isset($property->occupied))
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.occup')}}</span>
                                <h5 class="property-title">
                                    @if( $property->occupied == 2 )
                                        {{__('messages.vacant')}}
                                    @else
                                        {{__('messages.occupied')}} {{__('messages.till')}} @if(Lang::locale() == 'ru') {{$months_ru[$property->occup_month_id-1]}}
                                        @elseif(Lang::locale() == 'en') {{$months_en[$property->occup_month_id-1]}}
                                        @else {{$months_tm[$property->occup_month_id-1]}}
                                        @endif {{$property->occup_year}}
                                    @endif
                                </h5>
                            </div>
                        @endif
                        @if( isset($property->business_type_property_id) )
                            <div class="area_sep">
                                <span class="area_title">{{__('messages.property_type')}}</span>
                                <h5 class="property-title">
                                    @foreach($business_types_property as $btp)
                                        @if( $btp->id == $property->business_type_property_id )
                                            @if(Lang::locale() == 'ru') {{$btp->type_ru}}
                                            @elseif(Lang::locale() == 'en') {{$btp->type_en}}
                                            @else {{$btp->type_tm}}
                                            @endif
                                        @endif
                                    @endforeach
                                </h5>
                            </div>
                        @endif
                    </div>
                    <!-- Property main specifications end -->

                    <!-- Possible appointments and field activity start  -->
                    @if( (!is_null($property->business_type()) && $property->business_type()->count() > 0) || (!is_null($extra_possible_business_types) && $extra_possible_business_types->count() > 0))
                        <ul class="hidden-sm hidden-xs m-b-10">
                            <li class="fa-pull-left option"><b>
                                @if( (int)$property->object_names_id == 11 )
                                    {{__('messages.f_activity')}}:
                                @else
                                    {{__('messages.poss_appoint')}}:
                                @endif</b>&nbsp;</li>
                            <li>
                                <div class="f_act_wrap option">
                                    @php $bis_index = 1; @endphp
                                    @foreach( $property->business_type as $bis_type )
                                        <div class="f_act_item {{ $bis_index++ == 1 ? 'first_cap': ''}}">@if(Lang::locale() == 'ru')&nbsp;{{$bis_type->type_ru}}, 
                                        @elseif(Lang::locale() == 'en')&nbsp;{{$bis_type->type_en}}, 
                                        @else&nbsp;{{$bis_type->type_tm}}, 
                                        @endif</div>
                                    @endforeach
                                    @foreach( $extra_possible_business_types as $extra_biz_type )
                                        <div class="f_act_item {{ $bis_index++ == 1 ? 'first_cap': ''}}">&nbsp;{{$extra_biz_type->type}}@if( !$loop->last ), @endif</div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>                        
                    @endif
                    <!-- Possible appointments and field activity end -->
                    
                    <!-- Property description start -->
                    <span class="hidden-sm hidden-xs">
                        <p class="prop_info_description">{{$property->description->description}}</p>
                    </span>                    
                    <!-- Property description end -->                    
                </div>

                 <!-- General and price info block for mobile -->   
                <div class="single_block m-b-20 visible-sm visible-xs t_p-b-15">
                    <div class="price_container">
                        <div class="t-price_row">
                            <div>
                                <h2>@if( (int)$property->saleOrRent == 1 )
                                        {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}
                                    @else
                                        {{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}/<span class="bar_mon_font">{{__('messages.mon_short')}}</span>                                    
                                    @endif                                    
                                    @if( isset($property->price_rate) )
                                        <span class="t-price_rate"><bdi class="lato_regular text-uppercase">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}</bdi> {{__('messages.per_m_sq')}}<sup class="sq_sup_font-b">2</sup>@if( (int)$property->saleOrRent == 0 ) {{__('messages.per_year')}}@endif</span>    
                                    @endif                                
                                </h2>                                
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
                            <span>                                
                                <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                <bdi class="t-f_c">{{ strtok($property->title, '-') }}</bdi>
                                <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                            </span>
                            <span>                                
                                <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                @if( $property->object_names_id == 7 ) {{$property->building_area}}
                                @else {{$property->area}}
                                @endif {{__('messages.meter')}}<sup>2</sup>
                                <i class="fa fa-certificate separator_icon" aria-hidden="true"></i>
                            </span>
                            @if( isset($property->floor) && isset( $property->floors_in_home ) )
                                <span>
                                    <i class="fa fa-caret-right separator_icon1" aria-hidden="true"></i>
                                    {{$property->floor}}/{{$property->floors_in_home}} {{__('messages.floors_1')}}                                    
                                </span>
                            @elseif( isset( $property->floors_in_home ) )
                                <span>
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
                        </div>                        
                        @if( isset( $property->rent_term_id ) || isset( $property->deposit_payment ) || isset( $property->prepayment ) || isset( $property->rent_type_id ) || isset( $property->tax_id ) )
                            <div class="scroll_bar_incls">
                                <!-- Rent part -->
                                @if( isset( $property->rent_term_id ) )
                                    <div class="scroll_bar_incl_item">
                                        @if( (int)$property->rent_term_id == 1 ) {{__('messages.long_term_rent')}}@if(isset($property->deposit_payment) || isset($property->prepayment) || isset($property->rent_type_id)), @endif
                                        @else {{__('messages.short_term_rent')}} @if(isset($property->deposit_payment) || isset($property->prepayment) || isset($property->rent_type_id)), @endif
                                        @endif
                                    </div>
                                @endif
                                @if( isset($property->deposit_payment) )
                                    <div class="scroll_bar_incl_item">
                                        {{__('messages.sec_deposit_short')}} <bdi class="lato_regular"> {{$property->deposit_payment}}</bdi><bdi class="text-uppercase"> TMT</bdi>@if(isset($property->prepayment) || isset($property->rent_type_id)), @endif</div>
                                @endif
                                @if( isset( $property->prepayment ) )
                                    <div class="scroll_bar_incl_item">{{__('messages.pay_for') }} <bdi class="lato_regular">{{$property->prepayment}}</bdi>
                                        @if( (int)$property->prepayment == 1 ) {{__('messages.month1')}},
                                        @elseif( (int)$property->prepayment < 5 ) {{__('messages.month2')}},
                                        @else {{__('messages.month3')}}, @endif
                                        {{__('messages.by_year')}}@if(isset($property->rent_type_id)),@endif</div>
                                @endif
                                @if( isset($property->rent_type_id) )
                                    <div class="scroll_bar_incl_item">
                                        @if((int)$property->rent_type_id===1)
                                            {{__('messages.direct_rent')}}
                                        @else @if(Lang::locale() == 'ru') {{$property->rent_type->type_ru}}
                                            @elseif(Lang::locale() == 'en') {{$property->rent_type->type_en}}
                                            @else {{$property->rent_type->type_tm}}
                                            @endif
                                        @endif</div>
                                @endif
                                <!-- Sale part -->
                                @if( isset($property->tax_id) )
                                    <div class="scroll_bar_incl_item" style="text-transform: none">@if( (int)$property->tax_id === 3 )
                                            {{__('messages.tax_sts')}}<button type="button" id="tax_sts_exp" data-toggle="tooltip" data-placement="top" title="{{__('messages.tax_sts_mean')}}"><i class="fa fa-lg fa-info-circle" aria-hidden="true"></i></button>
                                        @else
                                            @if(Lang::locale() == 'ru') {{$property->tax->tax_ru}}
                                            @elseif(Lang::locale() == 'en') {{$property->tax->tax_en}}
                                            @else {{$property->tax->tax_tm}} @endif    
                                        @endif</div>
                                @endif
                            </div>    
                        @endif
                        @if( isset( $property->comm_payment_included ) || isset( $property->explat_payment_included ) )
                            <div class="scroll_bar_price_rate3"><bdi class="text-capitalize">{{__('messages.including')}}</bdi>
                                @if( isset( $property->comm_payment_included ) ) {{__('messages.comm_payment')}} @if( isset( $property->explat_payment_included ) ) {{__('messages.and')}}@endif @endif
                                @if( isset( $property->explat_payment_included ) ) {{__('messages.oper_costs')}}@endif
                            </div>    
                        @endif
                        @if( isset($property->building_type_id) && (int)$property->object_names_id === 7 )
                            <div class="scroll_bar_price_rate3" style="text-transform: none;margin-top: -5px">{{__('messages.poss_appoint')}}: 
                                @if(App::isLocale('ru')) {{$property->building_type->type_ru}}
                                @elseif(App::isLocale('en')) {{$property->building_type->type_en}}
                                @else {{$property->building_type->type_tm}} @endif</div>
                        @endif
                        @if(isset($property->occupied))
                            <div class="scroll_bar_price_rate3">@if( $property->occupied == 2 ) <bdi class="t-f_c">{{__('messages.occup')}}</bdi> {{__('messages.is_vacant')}}
                                @else <bdi class="t-f_c">{{__('messages.occ_room')}}</bdi> {{__('messages.till')}} @if(Lang::locale() == 'ru') {{$months_ru[$property->occup_month_id-1]}}. 
                                    @elseif(Lang::locale() == 'en') {{$months_en[$property->occup_month_id-1]}}. 
                                    @else {{$months_tm[$property->occup_month_id-1]}}. 
                                    @endif <bdi class="lato_regular"> {{$property->occup_year}}</bdi> {{__('messages.year_short')}}
                                @endif</div>    
                        @endif
                        @if( (int)$property->object_names_id == 11 )
                            @php $t_flag = isset($property->monthly_profit) && (double)$property->monthly_profit > 1.00 ? true : false; @endphp 
                            @if( isset( $property->land_owning_type_id ) )
                                <div class="scroll_bar_price_rate4 @if($t_flag) it_cap @endif">
                                    {{__('messages.properties')}}
                                    @if(App::isLocale('ru')) {{$property->land_owning_type->type_ru}}@if( isset($property->monthly_profit) ), @endif
                                    @elseif(App::isLocale('en')) is {{$property->land_owning_type->type_en}}@if( isset($property->monthly_profit) ), @endif
                                    @else {{$property->land_owning_type->type_tm}}@if( isset($property->monthly_profit) ), @endif
                                    @endif
                                </div>
                            @endif
                            @if( isset($property->monthly_profit) && (double)$property->monthly_profit > 1.00 )
                                <div class="scroll_bar_price_rate4 @if( !isset( $property->land_owning_type_id) ) it_cap @endif">
                                    {{__('messages.mon_profit')}}<bdi class="lato_regular text-uppercase"> {{number_format($property->monthly_profit, 0, '.', " ")}} TMT</bdi>
                                </div>
                            @endif
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
                                @php echo '<?xml version="1.0" encoding="iso-8859-1"?>'; @endphp
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
                    @if( (int)$property->saleOrRent == 1 )
                        <!-- Terms for buying commercial property start  -->
                        <div class="sin_com_terms">
                            <div class="sin_com_term_group sin_com_term_group_cw">
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.price')}}</div>
                                    <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}</div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                    <div class="sin_com_term_item_val">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup class="sq_sup_font">2</sup></div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.tax')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset( $property->tax_id) )
                                            @foreach($taxes as $tax)
                                                @if( $property->tax_id == $tax->id )
                                                    @if(Lang::locale() == 'ru') {{$tax->tax_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$tax->tax_en}}
                                                    @else {{$tax->tax_tm}}
                                                    @endif                                                    
                                                @endif
                                            @endforeach
                                        @else
                                        - 
                                        @endif
                                    </div>
                                </div>
                                @if( isset($property->monthly_profit) && (double)$property->monthly_profit > 1.00 )
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.mon_profit')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->monthly_profit, 0, '.', " ")}} TMT</div>
                                    </div>    
                                @endif
                                @if( isset( $property->parking_price ) && isset( $property->parking_id ) )
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.park_cost')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( (int)$property->parking_price > 0.00 )
                                                {{number_format($property->parking_price, 1, '.', " ")}} TMT {{__('messages.for_month')}}                                              
                                            @else
                                                {{__('messages.free')}}
                                            @endif
                                        </div>
                                    </div>                                    
                                @endif
                            </div>
                        </div>
                        <!-- Terms for buying commercial property end  -->
                    @else
                        <!-- Terms for renting commercial property start  -->
                        <div class="sin_com_terms">
                            <div class="sin_com_term_group">
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.price')}}</div>
                                    <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}{{__('messages.mon')}}</div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                    <div class="sin_com_term_item_val">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup class="sq_sup_font">2</sup>/{{__('messages.year')}}</div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.comm_payment')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->comm_payment_included) )
                                            @if( (int)$property->comm_payment_included == 1 )
                                                {{__('messages.incl_yes')}}
                                            @else    
                                                {{__('messages.incl_no')}}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.oper_costs')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->explat_payment_included) )
                                            @if( (int)$property->explat_payment_included == 1 )
                                                {{__('messages.incl_yes')}}
                                            @else    
                                                {{__('messages.incl_no')}}
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.sec_deposit')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->deposit_payment) )
                                            {{number_format($property->deposit_payment, 0, '.', " ")}} TMT
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="sin_com_term_group">                            
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.prepayment')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->prepayment) )
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
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.rent_type')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->rent_type_id) )
                                            @if( (int)$property->rent_type_id == 1 )
                                                {{__('messages.direct_rent')}}
                                            @else
                                                @foreach( $rent_types as $rent_type )
                                                    @if( $rent_type->id == $property->rent_type_id )
                                                        @if(Lang::locale() == 'ru') {{$rent_type->type_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$rent_type->type_en}}
                                                        @else {{$rent_type->type_en}}
                                                        @endif                                                
                                                    @endif
                                                @endforeach
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.rent_period')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset( $property->period_id ) )
                                            @foreach($rent_terms as $rent_term)
                                                @if( $rent_term->id == $property->rent_term_id )
                                                    @if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                                                    @else {{$rent_term->term_tm}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div class="sin_com_term_group_item">
                                    <div class="sin_com_term_item_name">{{__('messages.min_per_rent')}}</div>
                                    <div class="sin_com_term_item_val">
                                        @if( isset($property->min_term) )
                                            {{$property->min_term}} {{__('messages.mon_short')}}    
                                        @else
                                          -  
                                        @endif
                                    </div>
                                </div>
                                @if( isset( $property->parking_id ) )
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.park_cost')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->parking_price) )
                                                @if( (int)$property->parking_price > 0.00 )
                                                    {{number_format($property->parking_price, 1, '.', " ")}} TMT {{__('messages.for_month')}}                                              
                                                @else
                                                    {{__('messages.free')}}
                                                @endif
                                            @else
                                               - 
                                            @endif
                                        </div>
                                    </div>    
                                @endif
                            </div>
                        </div>                        
                        <!-- Terms for renting commercial property end  -->
                    @endif
                </div>
                <!-- Property terms info end -->
                @if( (int)$property->object_names_id !== 7 )
                    <!-- Property general info start -->
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
                        <article id="change_order_4">
                            <ul>
                                <div class="visible-sm visible-xs">
                                    @if( isset($property->business_type_property_id) && (int)$property->object_names_id == 11 )
                                        <li class="single_gen_item">
                                            <span class="single_gen_item_name">{{__('messages.property_type')}}</span>
                                            <span>@foreach($business_types_property as $btp)
                                                    @if( $btp->id == $property->business_type_property_id )
                                                        @if(Lang::locale() == 'ru') {{$btp->type_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$btp->type_en}}
                                                        @else {{$btp->type_tm}}
                                                        @endif
                                                    @endif
                                                @endforeach</span>
                                        </li>
                                    @endif
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.area')}}</span>
                                        <span>{{number_format($property->area, 1, '.', " ")}} {{__('messages.meter')}}<sup>2</sup></span>
                                    </li>
                                    @if( isset($property->floor) || isset($property->floors_in_home) )
                                        <li class="single_gen_item" style="margin-bottom: 16px">
                                            <span class="single_gen_item_name text-capitalize">{{__('messages.floors_1')}}</span>
                                            <span>@if( isset($property->floor) && isset($property->floors_in_home) ) {{$property->floor}} / {{$property->floors_in_home}}
                                                @elseif( isset( $property->floors_in_home ) ) {{$property->floors_in_home}} @endif
                                            </span>
                                        </li>
                                    @endif
                                </div>
                                @if( isset($property->trade_room_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.t_facility')}}</span>
                                        <span>
                                            @foreach($trade_rooms as $trade_room)
                                                @if( $trade_room->id == $property->trade_room_id )
                                                    @if(Lang::locale() == 'ru') {{$trade_room->room_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$trade_room->room_en}}
                                                    @else {{$trade_room->room_tm}}
                                                    @endif
                                                @endif                                                
                                            @endforeach
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->in_parts) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">
                                            @if( (int)$property->saleOrRent == 0 )
                                                {{__('messages.rent_parts')}}
                                            @else
                                                {{__('messages.buy_parts')}}
                                            @endif
                                        </span>
                                        <span>
                                            @if( (int)$property->in_parts == 1 )
                                                {{__('messages.allowed')}}
                                            @else
                                                {{__('messages.no')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->legal_address) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.leg_add')}}</span>
                                        <span>
                                            @if( !is_null($property->legal_address) && ($property->legal_address == 0) )
                                                {{__('messages.not_provided')}}
                                            @else
                                                {{__('messages.provided')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->ceil_height) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.ceil_height')}}</span>
                                        <span>
                                            @if( (int)$property->ceil_height > 0)
                                                {{$property->ceil_height}} {{__('messages.meter')}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset( $property->column_grid ) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.col_grid')}}</span>
                                        <span class="let_space_2">
                                            {{ $property->column_grid }}
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->shop_window) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.shop_window')}}</span>
                                        <span>
                                            @if( !is_null($property->shop_window) && ( (int)$property->shop_window == 0) )
                                                {{__('messages.no_exist')}}
                                            @else
                                                {{__('messages.exist')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                
                                @if( isset($property->gates_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.ent_gate')}}</span>
                                        <span>
                                            @foreach($gates as $gate)
                                                @if( $property->gates_id == $gate->id )
                                                    @if(Lang::locale() == 'ru') {{$gate->gate_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$gate->gate_en}}
                                                    @else {{$gate->gate_tm}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif
                                @if( isset( $property->floor_material_id ) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.floor_mat')}}</span>
                                        <span>
                                            @foreach($floor_materials as $floor_material)
                                                @if( $property->floor_material_id == $floor_material->id )
                                                    @if(Lang::locale() == 'ru') {{$floor_material->material_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$floor_material->material_en}}
                                                    @else {{$floor_material->material_tm}}
                                                    @endif
                                                @endif                                                
                                            @endforeach
                                        </span>
                                    </li>
                                @endif                                
                                @if( isset( $property->equipment ) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.equip')}}</span>
                                        <span>
                                            @if( !is_null($property->equipment) && ($property->equipment == 0) )
                                                {{__('messages.no_exist')}} 
                                            @else
                                                {{__('messages.exist')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif                                
                                @if( isset($property->electric_power) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.elec_pow')}}</span>
                                        <span>
                                            {{$property->electric_power}} {{__('messages.kW')}}
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->wet_points) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.num_wet_point')}}</span>
                                        <span>
                                            @if( ($property->wet_points == 0) &&  !is_null($property->wet_points) )
                                                {{  __('messages.no_exist') }}
                                            @else
                                                {{$property->wet_points}}
                                            @endif
                                        </span>
                                    </li>
                                @endif                                
                                @if( isset($property->building_entrance_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.b_enter')}}</span>
                                        <span>
                                            @foreach($building_entrances as $building_entrance)
                                                @if( $building_entrance->id == $property->building_entrance_id )
                                                    @if(Lang::locale() == 'ru') {{$building_entrance->entrance_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$building_entrance->entrance_en}}
                                                    @else {{$building_entrance->entrance_tm }}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->office_repair_id) || isset($property->office_condition_id) || isset($property->furniture) || isset($property->entrance_id))
                                    <hr class="sHr1 visible-sm visible-xs">
                                @endif
                                @if( isset($property->office_repair_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.layout')}}</span>
                                        <span>
                                            @foreach( $office_repairs as $office_repair )
                                                @if( $property->office_repair_id == $office_repair->id )
                                                    @if(Lang::locale() == 'ru') {{$office_repair->repair_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$office_repair->repair_en}}
                                                    @else {{$office_repair->repair_tm}}
                                                    @endif
                                                @endif
                                            @endforeach                                        
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->office_condition_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.condition')}}</span>
                                        <span>@if(Lang::locale() == 'ru') {{$property->office_condition->condition_ru }}
                                            @elseif(Lang::locale() == 'en') {{$property->office_condition->condition_en }}
                                            @else {{$property->office_condition->condition_tm }}
                                            @endif</span>
                                    </li>
                                @endif
                                @if( isset($property->furniture) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.furniture')}}</span>
                                        <span>
                                            @if( (int)$property->furniture == 1 )
                                                {{__('messages.exist')}}
                                            @else
                                                {{__('messages.no_exist')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->entrance_id) )
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.entrance')}}</span>
                                        <span>
                                            @foreach( $entrances as $entrance )
                                                @if( $entrance->id == $property->entrance_id )
                                                    @if(Lang::locale() == 'ru') {{$entrance->entrance_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$entrance->entrance_en}}
                                                    @else {{$entrance->entrance_tm }}
                                                    @endif
                                                @endif
                                            @endforeach                                        
                                        </span>
                                    </li>
                                @endif
                                

                                @if( isset($property->occupied) )
                                    <hr class="sHr1">
                                    <li class="single_gen_item">
                                        <span class="single_gen_item_name">{{__('messages.building_prop')}}</span>
                                        <span class="first_cap">@if( (int)$property->occupied == 2 ){{__('messages.vacant')}}
                                            @else{{__('messages.occupied')}} {{__('messages.till')}} @if(Lang::locale() == 'ru') {{$months_ru[$property->occup_month_id-1]}}
                                            @elseif(Lang::locale() == 'en') {{$months_en[$property->occup_month_id-1]}}
                                            @else {{$months_tm[$property->occup_month_id-1]}}
                                            @endif {{$property->occup_year}}
                                        @endif</span>
                                    </li>
                                @endif

                                @if( isset( $property->parking_id ) )                                
                                    @if( (int)$property->parking_id == 5 )
                                        @foreach( $parkings as $parking )
                                            @if( ((int)$property->object_names_id < 8 && $parking->id < 3) || ((int)$property->object_names_id > 8 && $parking->id < 5 && $parking->id > 2) )
                                                <hr class="sHr1">
                                                <li class="single_gen_item">
                                                    <span class="single_gen_item_name">{{__('messages.parking')}}</span>
                                                    <span>
                                                        @if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                        @else {{$parking->parking_tm}}
                                                        @endif
                                                    </span>
                                                </li>
                                                @if( ( $parking->id == 1 || $parking->id == 3 ) && isset( $property->parking_spots ) )
                                                    <li class="single_gen_item">
                                                        <span class="single_gen_item_name">{{__('messages.place_num')}}</span>
                                                        <span>{{$property->parking_spots}}</span>
                                                    </li>
                                                @endif
                                                @if( ($parking->id == 2 || $parking->id == 4) && isset( $property->parking_spots_ex ) )
                                                    <li class="single_gen_item">
                                                        <span class="single_gen_item_name">{{__('messages.place_num')}}</span>
                                                        <span>{{$property->parking_spots_ex}}</span>
                                                    </li>
                                                @endif
                                            @endif                                            
                                        @endforeach
                                    @else
                                        <hr class="sHr1">
                                        <li class="single_gen_item">
                                            <span class="single_gen_item_name">{{__('messages.parking')}}</span>
                                            <span>
                                                @foreach( $parkings as $parking )
                                                    @if( $parking->id == $property->parking_id )
                                                        @if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                        @else {{$parking->parking_tm}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </span>
                                        </li>
                                        @if( isset( $property->parking_type_id ) )
                                            <li class="single_gen_item">
                                                <span class="single_gen_item_name">{{__('messages.parking_type')}}</span>
                                                <span>
                                                    @foreach($parking_types as $parking_type)
                                                        @if( $property->parking_type_id == $parking_type->id )
                                                            @if(Lang::locale() == 'ru') {{$parking_type->type_ru}}
                                                            @elseif(Lang::locale() == 'en') {{$parking_type->type_en}}
                                                            @else {{$parking_type->type_tm}}
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </li>
                                        @endif
                                        @if( isset( $property->parking_spots ) )                                        
                                            <li class="single_gen_item">
                                                <span class="single_gen_item_name">{{__('messages.place_num')}}</span>
                                                <span>{{$property->parking_spots}}</span>
                                            </li>
                                        @endif                                        
                                    @endif
                                @endif
                            </ul>
                        </article>
                        <!-- Property general info end -->
                        
                        <!-- Possible appointments and field activity for mobile version start  -->
                        @if( (!is_null($property->business_type()) && $property->business_type()->count() > 0) || (!is_null($extra_possible_business_types) && $extra_possible_business_types->count() > 0))
                            <hr class="sHr1 visible-sm visible-xs" id="change_order_5">
                            <h4 class="inner-title visible-sm visible-xs" id="change_order_6">@if( (int)$property->object_names_id == 11 ) {{__('messages.f_activity')}}
                                @else {{__('messages.poss_appoint')}}@endif
                            </h4>
                            <ul class="visible-sm visible-xs" id="change_order_7">
                                @php $bis_index = 1; @endphp
                                @foreach( $property->business_type as $bis_type )
                                    <li class="first_cap f_act_item">@if(Lang::locale() == 'ru'){{$bis_type->type_ru}}
                                    @elseif(Lang::locale() == 'en'){{$bis_type->type_en}}
                                    @else{{$bis_type->type_tm}}
                                    @endif</li>
                                @endforeach
                                @foreach( $extra_possible_business_types as $extra_biz_type )
                                    <li class="first_cap f_act_item">{{$extra_biz_type->type}}@if( !$loop->last ) @endif</li>
                                @endforeach
                            </ul>                            
                        @endif
                        <!-- Possible appointments and field activity for mobile version end -->

                        @if(!is_null($property->add_service) && count($property->add_service) > 0 )
                            <!-- Manufacture property additional services start -->
                            <hr class="sHr1" id="change_order_8">
                            <h4 class="inner-title m-b-20" id="change_order_9">{{__('messages.add_service')}}</h4>
                            <div class="single_feature m-0" id="change_order_10">
                                <div class="info-list">
                                    <ul>
                                        @foreach($property->add_service as $service)
                                            <li><span class="icon @if((int)$service->id == 1) safe_custody
                                                    @elseif((int)$service->id == 2) custom_office
                                                    @else transport_service
                                                @endif"></span>
                                                <small>@if(Lang::locale() == 'ru') {{$service->service_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$service->service_en}}
                                                        @else {{$service->service_tm}}
                                                        @endif</small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Manufacture property additional services start -->
                        @endif
                        
                        @if(!is_null($property->infrastructure) && count($property->infrastructure) > 0 )
                            <!-- Property infrastructure start -->
                            <hr class="sHr1" id="change_order_11">
                            <h4 class="inner-title m-b-20" id="change_order_11">{{__('messages.infras')}}</h4>
                            <div class="single_feature m-0" id="change_order_12">
                                <div class="info-list">
                                    <ul>
                                        @foreach( $property->infrastructure as $infrastructure )
                                            <li>
                                                <span>
                                                    <img src="{{ $infrastructure->img }}" class="icon">
                                                </span>
                                                <small>
                                                    @if(App::isLocale('ru'))
                                                        {{$infrastructure->infrastructure_ru}}
                                                    @elseif(App::isLocale('en'))
                                                        {{$infrastructure->infrastructure_en}}
                                                    @else
                                                        {{$infrastructure->infrastructure_tm}}
                                                    @endif
                                                </small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Property infrastructure end -->
                        @endif                        
                    </div>
                    <!-- Property general info end -->
                @endif

                @if( ( (int)$property->object_names_id == 9 || (int)$property->object_names_id == 10 && (int)$property->saleOrRent == 1 ) && ( isset($property->warehouse_service_elev) || isset($property->warehouse_service_elev_cc) || isset( $property->warehouse_telfer_elev ) || isset( $property->warehouse_telfer_elev_cc ) || isset( $property->warehouse_passenger_elev ) || isset( $property->warehouse_passenger_elev_cc ) || isset( $property->warehouse_bridge_crane ) || isset( $property->warehouse_bridge_crane_cc ) || isset( $property->warehouse_balk_crane ) || isset( $property->warehouse_balk_crane_cc ) || isset( $property->warehouse_rail_crane ) || isset( $property->warehouse_rail_crane_cc ) || isset( $property->warehouse_goat_crane ) || isset( $property->warehouse_goat_crane_cc ) ) )
                    <div class="single_block m-b-20">
                        <h4 class="inner-title">{{__('messages.elevs_crane')}}</h4>
                        @php $hor_flag = 0;  @endphp
                        @if( isset($property->warehouse_service_elev) || isset($property->warehouse_service_elev_cc) || isset( $property->warehouse_telfer_elev ) || isset( $property->warehouse_telfer_elev_cc ) || isset( $property->warehouse_passenger_elev ) || isset( $property->warehouse_passenger_elev_cc ) )
                            @php $hor_flag=1;  @endphp
                            <ul class="build_list_wrap">
                                @php $last_mar = (isset( $property->warehouse_telfer_elev ) || isset( $property->warehouse_telfer_elev_cc ) || isset( $property->warehouse_passenger_elev ) || isset( $property->warehouse_passenger_elev_cc )) ? 'm-b-25' : 'm-b-12'; @endphp
                                
                                @if( isset($property->warehouse_service_elev) || isset($property->warehouse_service_elev_cc) )                                    
                                    <li class="build_list_li md-m-b-8 {{$last_mar}}">
                                        <span>{{__('messages.freight')}} {{__('messages.elevs')}}</span>
                                        <span>@if( (int)$property->warehouse_service_elev > 0 )
                                            {{$property->warehouse_service_elev}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_service_elev_cc > 0.00 )
                                                @if( (double)$property->warehouse_service_elev_cc < 1.00 )
                                                    {{ ( $property->warehouse_service_elev_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_service_elev_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @php $last_mar = (isset( $property->warehouse_passenger_elev ) || isset( $property->warehouse_passenger_elev_cc )) ? 'm-b-25' : 'm-b-12'; @endphp
                                @if( isset( $property->warehouse_telfer_elev ) || isset( $property->warehouse_telfer_elev_cc ) )
                                    <li class="build_list_li md-m-b-8 {{$last_mar}}">
                                        <span>{{__('messages.telpher')}}</span>
                                        <span>@if( (int)$property->warehouse_telfer_elev > 0 )
                                            {{$property->warehouse_telfer_elev}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_telfer_elev_cc > 0.00 )
                                                @if( (double)$property->warehouse_telfer_elev_cc < 1.00 )
                                                    {{ ( $property->warehouse_telfer_elev_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_telfer_elev_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -    
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @php $last_mar = 'm-b-12' @endphp
                                @if( isset( $property->warehouse_passenger_elev ) || isset( $property->warehouse_passenger_elev_cc ) )
                                    <li class="build_list_li md-m-b-8 {{$last_mar}}">
                                        <span>{{__('messages.passenger')}} {{__('messages.elevs')}}</span>
                                        <span>@if( (int)$property->warehouse_passenger_elev > 0 )
                                            {{$property->warehouse_passenger_elev}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_passenger_elev_cc > 0.00 )
                                                @if( (double)$property->warehouse_passenger_elev_cc < 1.00 )
                                                    {{ ( $property->warehouse_passenger_elev_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_passenger_elev_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                            </ul>    
                        @endif
                        @if( isset( $property->warehouse_bridge_crane ) || isset( $property->warehouse_bridge_crane_cc ) || isset( $property->warehouse_balk_crane ) || isset( $property->warehouse_balk_crane_cc ) || isset( $property->warehouse_rail_crane ) || isset( $property->warehouse_rail_crane_cc ) || isset( $property->warehouse_goat_crane ) || isset( $property->warehouse_goat_crane_cc ) ) 
                            @if( $hor_flag == 1 ) <hr class="sHr1"> @endif                                
                            <ul class="build_list_wrap">
                                @php $last_mar = ( isset( $property->warehouse_balk_crane ) || isset( $property->warehouse_balk_crane_cc ) || isset( $property->warehouse_rail_crane ) || isset( $property->warehouse_rail_crane_cc ) || isset( $property->warehouse_goat_crane ) || isset( $property->warehouse_goat_crane_cc ) ) ? 'm-b-25'  : 'm-b-12';  @endphp
                                @if( isset( $property->warehouse_bridge_crane ) || isset( $property->warehouse_bridge_crane_cc ) )
                                    <li class="build_list_li md-m-b-8 {{$last_mar}}">
                                        <span>{{__('messages.over_crane')}}</span>
                                        <span>@if( (int)$property->warehouse_bridge_crane > 0 )
                                            {{$property->warehouse_bridge_crane}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_bridge_crane_cc > 0.00 )
                                                @if( (double)$property->warehouse_bridge_crane_cc < 1.00 )
                                                    {{ ( $property->warehouse_bridge_crane_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_bridge_crane_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @php $last_mar = (isset( $property->warehouse_rail_crane ) || isset( $property->warehouse_rail_crane_cc ) || isset( $property->warehouse_goat_crane ) || isset( $property->warehouse_goat_crane_cc ) ) ? 'm-b-25'  : 'm-b-12';  @endphp
                                @if( isset( $property->warehouse_balk_crane ) || isset( $property->warehouse_balk_crane_cc ) )
                                    <li class="build_list_li md-m-b-8 {{$last_mar}}">
                                        <span>{{__('messages.beam_crane')}}</span>
                                        <span>@if( (int)$property->warehouse_balk_crane > 0 )
                                            {{$property->warehouse_balk_crane}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_balk_crane_cc > 0.00 )
                                                @if( (double)$property->warehouse_balk_crane_cc < 1.00 )
                                                    {{ ( $property->warehouse_balk_crane_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_balk_crane_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @php $last_mar = (isset( $property->warehouse_goat_crane ) || isset( $property->warehouse_goat_crane_cc ) ) ? 'm-b-25'  : 'm-b-12';  @endphp
                                @if( isset( $property->warehouse_rail_crane ) || isset( $property->warehouse_rail_crane_cc ) )
                                    <li class="build_list_li md-m-b-8 {{$last_mar}}">
                                        <span>{{__('messages.crane_rail')}}</span>
                                        <span>@if( (int)$property->warehouse_rail_crane > 0 )
                                            {{$property->warehouse_rail_crane}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_rail_crane_cc > 0.00 )
                                                @if( (double)$property->warehouse_rail_crane_cc < 1.00 )
                                                    {{ ( $property->warehouse_rail_crane_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_rail_crane_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @php $last_mar = 'm-b-0';  @endphp
                                @if( isset( $property->warehouse_goat_crane ) || isset( $property->warehouse_goat_crane_cc ) )
                                    <li class="build_list_li md-m-b-8-im {{$last_mar}}">
                                        <span>{{__('messages.crane_gantry')}}</span>
                                        <span>@if( (int)$property->warehouse_goat_crane > 0 )
                                            {{$property->warehouse_goat_crane}}
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                    <li class="build_list_li {{$last_mar}}">
                                        <span>{{__('messages.lift_cap')}}</span>
                                        <span>
                                            @if( (double)$property->warehouse_goat_crane_cc > 0.00 )
                                                @if( (double)$property->warehouse_goat_crane_cc < 1.00 )
                                                    {{ ( $property->warehouse_goat_crane_cc * 1000) }} {{__('messages.kg')}}
                                                @else
                                                    {{$property->warehouse_goat_crane_cc}}  {{__('messages.ton1')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                @endif               

                @if( (int)$property->object_names_id !== 11)
                    <div class="single_block m-b-20">
                        
                        @if( (int)$property->object_names_id == 7)
                        <!-- Property description for mobile version start -->
                            <div class="mobile_description">
                                <h4 class="inner-title">{{__('messages.description')}}</h4>
                                <div class="prop_info_description squeeze_block">{{$property->description->description}}</div>                    
                                <p class="read_more_faint">
                                    <button class="btn-transparent" id="read_more">{{__('messages.read_more')}}</button>
                                </p>
                            </div>
                            <hr class="sHr1 visible-sm visible-xs">
                            <!-- Property description for mobile version end -->
                            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
                            <ul class="build_list_wrap">
                                @if( isset( $property->village_name ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.name')}}</span>
                                        <span>{{$property->village_name}}</span>
                                    </li>
                                @endif
                                @if( isset( $property->construction_year ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.const_year')}}</span>
                                        <span>{{$property->construction_year}}</span>
                                    </li>
                                @endif
                                @if( isset($property->building_area) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.tot_area')}}</span>
                                        <span>{{number_format($property->building_area, 1, '.', " ")}} {{__('messages.meter')}}<sup>2</sup></span>
                                    </li>
                                @endif
                                @if( isset($property->ceil_height) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.ceil_height')}}</span>
                                        <span>{{$property->ceil_height}} {{__('messages.meter')}}</span>
                                    </li>
                                @endif
                                @if( isset( $property->building_type_id ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.poss_appoint')}}</span>
                                        <span>
                                            @foreach( $building_types as $building_type )
                                                @if( $building_type->id == $property->building_type_id )
                                                    @if(Lang::locale() == 'ru') {{$building_type->type_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$building_type->type_en}}
                                                    @else {{$building_type->type_tm}}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif                            
                                @if( isset($property->office_condition_id) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.condition')}}</span>
                                        <span>@if(Lang::locale() == 'ru') {{$property->office_condition->condition_ru }}
                                            @elseif(Lang::locale() == 'en') {{$property->office_condition->condition_en }}
                                            @else {{$property->office_condition->condition_tm }}
                                            @endif</span>
                                    </li>
                                @endif
                                @if( isset($property->furniture) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.furniture')}}</span>
                                        <span>
                                            @if( (int)$property->furniture == 1 )
                                                {{__('messages.exist')}}
                                            @else
                                                {{__('messages.no_exist')}}
                                            @endif
                                            
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->line_house) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.line_houses')}}</span>
                                        <span>
                                            @if((int)$property->line_house == 1)
                                                {{__('messages.first')}}
                                            @elseif((int)$property->line_house == 2)
                                                {{__('messages.second')}}
                                            @elseif((int)$property->line_house == 3)
                                                {{__('messages.other')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset($property->building_entrance_id) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.b_enter')}}</span>
                                        <span>
                                            @foreach($building_entrances as $building_entrance)
                                                @if( $building_entrance->id == $property->building_entrance_id )
                                                    @if(Lang::locale() == 'ru') {{$building_entrance->entrance_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$building_entrance->entrance_en}}
                                                    @else {{$building_entrance->entrance_tm }}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif                                
                            </ul>
                            @if( isset( $property->land_area ) || isset( $property->land_owning_type_id ))
                                <hr class="sHr1">
                                <ul class="build_list_wrap">
                                    @if( isset( $property->land_area ) )
                                        <li class="build_list_li">
                                            <span class="first_cap">{{__('messages.land_area')}}</span>
                                            <span>{{$property->land_area}} {{__('messages.ga')}}</span>
                                        </li>
                                    @endif
                                    @if( isset( $property->land_owning_type_id ) )
                                        <li class="build_list_li">
                                            <span class="first_cap">{{__('messages.land_status')}}</span>
                                            <span class="first_cap">
                                                @foreach($land_owning_types as $land_owning_type)
                                                    @if( $land_owning_type->id == $property->land_owning_type_id )
                                                        @if(Lang::locale() == 'ru') {{$land_owning_type->type_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$land_owning_type->type_en}}
                                                        @else {{$land_owning_type->type_tm}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </span>
                                        </li>
                                    @endif                                
                                </ul>
                            @endif
                            @if( isset( $property->elevator ) || isset( $property->trivalator ) || isset( $property->escalator ) )
                                <hr class="sHr1">
                                <ul class="build_list_wrap">
                                    @if( isset( $property->elevator ) )
                                        <li class="build_list_li">
                                            <span class="first_cap">{{__('messages.elevs')}}</span>
                                            <span>{{$property->elevator}}</span>
                                        </li>
                                    @endif
                                    @if( isset( $property->trivalator ) )
                                        <li class="build_list_li">
                                            <span class="first_cap">{{__('messages.travs')}}</span>
                                            <span>{{$property->trivalator}}</span>
                                        </li>
                                    @endif
                                    @if( isset( $property->escalator ) )
                                        <li class="build_list_li">
                                            <span class="first_cap">{{__('messages.escals')}}</span>
                                            <span>{{$property->escalator}}</span>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                            @if( isset( $property->parking_id ) )
                                @if( (int)$property->parking_id == 5 )
                                    @foreach( $parkings as $parking )
                                        @if( $parking->id < 3 )
                                            <hr class="sHr1">
                                            <ul class="build_list_wrap">
                                                <li class="build_list_li">
                                                    <span>{{__('messages.parking')}}</span>
                                                    <span>@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                                                    @else {{$parking->parking_tm}}
                                                    @endif</span>
                                                </li>
                                                <li class="build_list_li">
                                                    <span>{{__('messages.place_num')}}</span>
                                                    <span>
                                                        @if( $parking->id == 1 )
                                                            {{$property->parking_spots}}
                                                        @else
                                                            {{$property->parking_spots_ex}}
                                                        @endif
                                                    </span>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach
                                @else
                                    <hr class="sHr1">
                                    <ul class="build_list_wrap">
                                        <li class="build_list_li">
                                            <span>{{__('messages.parking')}}</span>
                                            <span>
                                                @foreach( $parkings as $parking )
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
                                            <li class="build_list_li">
                                                <span>{{__('messages.place_num')}}</span>
                                                <span>{{$property->parking_spots}}</span>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            @endif
                        @else
                            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
                            <ul class="build_list_wrap">
                                @if( isset( $property->construction_year ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.const_year')}}</span>
                                        <span>
                                            {{$property->construction_year}}
                                        </span>
                                    </li>
                                @endif
                                @if( isset( $property->building_type_id ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.t_build')}}</span>
                                        <span>@if(App::isLocale('ru')) {{$property->building_type->type_ru}}
                                            @elseif(App::isLocale('en')) {{$property->building_type->type_en}}
                                            @else {{$property->building_type->type_tm}}
                                            @endif</span>
                                    </li>
                                @endif
                                @if( isset($property->building_area) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.tot_area')}}</span>
                                        <span>{{number_format($property->building_area, 1, '.', " ")}} {{__('messages.meter')}}<sup>2</sup>
                                        </span>
                                    </li>                                
                                @endif
                                @if( isset($property->land_area) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.land_area')}}</span>
                                        <span>
                                            {{$property->land_area}} {{__('messages.ga')}}
                                        </span>
                                    </li>                                
                                @endif
                                @if( isset($property->land_owning_type_id) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.land_status')}}</span>
                                        <span class="first_cap">
                                            @if(App::isLocale('ru'))
                                                {{$property->land_owning_type->type_ru}}
                                            @elseif(App::isLocale('en'))
                                                {{$property->land_owning_type->type_en}}
                                            @else
                                                {{$property->land_owning_type->type_tm}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset( $property->day_week_id ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.work_days')}}</span>
                                        <span>
                                            @if( $property->day_week_id == 1 )
                                                {{__('messages.w_days')}}
                                            @elseif( $property->day_week_id == 2 )
                                                {{__('messages.w_ends')}}
                                            @elseif( $property->day_week_id == 3 )
                                                {{__('messages.daily')}}
                                            @endif
                                        </span>
                                    </li>
                                @endif
                                @if( isset( $property->from_dusk_till_dawn ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.open_hours')}}</span>
                                        <span>{{__('messages.24_hour')}}</span>
                                    </li>
                                @elseif( isset( $property->from_hour ) && isset( $property->to_hour) )    
                                    <li class="build_list_li">
                                        <span>{{__('messages.open_hours')}}</span>
                                        <span class="it_cap">{{__('messages.from1')}} {{$property->from_hour}} {{__('messages.to')}} {{$property->to_hour}}</span>
                                    </li>
                                @endif
                                @if( isset( $property->building_category ) )
                                    <li class="build_list_li">
                                        <span>{{__('messages.building_categ')}}</span>
                                        <span>@if( $property->building_category == 1 ) {{__('messages.active')}}
                                        @elseif( $property->building_category == 2 ) {{__('messages.project')}}
                                        @elseif( $property->building_category == 3 ) {{__('messages.un_const')}}
                                        @endif</span>
                                    </li>
                                @endif
                            </ul>
                        @endif
                        @if( isset($property->ventilation_id) || isset($property->conditioning_id) || isset($property->heating_id) || isset($property->firefighting_id) )
                            <hr class="sHr1">
                            @if( isset($property->ventilation_id) && (int)$property->ventilation_id !== 3 )
                                <div class="line_row_icon line_row_vent first_cap">
                                    @foreach( $ventilations as $ventilation )
                                        @if( $ventilation->id == $property->ventilation_id )
                                            @if(Lang::locale() == 'ru') {{$ventilation->ventilation_ru}}
                                            @elseif(Lang::locale() == 'en') {{$ventilation->ventilation_en}}
                                            @else {{$ventilation->ventilation_tm}} 
                                            @endif {{__('messages.ventilation')}}
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            @if( isset($property->conditioning_id) && (int)$property->conditioning_id !== 3 )
                                <div class="line_row_icon line_row_cond first_cap">
                                    @foreach( $conditionings as $onditioning )
                                        @if( $onditioning->id == $property->conditioning_id )
                                            @if(Lang::locale() == 'ru') {{$onditioning->conditioning_ru}}
                                            @elseif(Lang::locale() == 'en') {{$onditioning->conditioning_en}}
                                            @else {{$onditioning->conditioning_tm}}
                                            @endif {{__('messages.conditioner')}}
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if( isset($property->heating_id) && (int)$property->heating_id !== 3)
                                <div class="line_row_icon line_row_heating first_cap">
                                    @foreach( $heatings as $heating )
                                        @if( $heating->id == $property->heating_id )
                                            @if(Lang::locale() == 'ru') {{$heating->heating_ru}}
                                            @elseif(Lang::locale() == 'en') {{$heating->heating_en}}
                                            @else {{$heating->heating_tm}}
                                            @endif  {{__('messages.heating_system')}}
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                            @if( isset($property->firefighting_id) && (int)$property->firefighting_id !== 6 )
                                <div class="line_row_icon line_row_firefighting first_cap">
                                    @foreach( $firefightings as $firefight )
                                        @if( $firefight->id == $property->firefighting_id )
                                            @if(Lang::locale() == 'ru') {{$firefight->firefighting_ru}}
                                            @elseif(Lang::locale() == 'en') {{$firefight->firefighting_en}}
                                            @else {{$firefight->firefighting_tm}}
                                            @endif
                                            @if( (int)$property->firefighting_id !== 5)
                                                {{__('messages.firefighting_sys')}}
                                            @endif 
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endif
                    </div>
                @endif

                @if( (int)$property->object_names_id === 7 )
                    <!-- Property terms info about building for mobile version start -->
                    <div class="single_block m-b-20 visible-sm visible-xs">
                        <h4 class="inner-title">{{__('messages.terms')}}</h4>
                        @if( (int)$property->saleOrRent == 1 )
                            <!-- Terms for buying commercial property start  -->
                            <div class="sin_com_terms">
                                <div class="sin_com_term_group">
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.price')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}</div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup class="sq_sup_font">2</sup></div>
                                    </div>
                                    @if( isset($property->monthly_profit) && (double)$property->monthly_profit > 1.00 )
                                        <div class="sin_com_term_group_item">
                                            <div class="sin_com_term_item_name">{{__('messages.mon_profit')}}</div>
                                            <div class="sin_com_term_item_val">{{number_format($property->monthly_profit, 0, '.', " ")}} TMT</div>
                                        </div>    
                                    @endif
                                </div>
                                <div class="sin_com_term_group">
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.tax')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset( $property->tax_id ) )
                                                @if( (int)$property->tax_id === 3 ) {{__('messages.tax_sts')}}
                                                @else 
                                                    @if(Lang::locale() == 'ru') {{$property->tax->tax_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$property->tax->tax_en}}
                                                    @else {{$property->tax->tax_tm}} @endif   
                                                @endif
                                            @else
                                                -    
                                            @endif
                                            
                                        </div>
                                    </div>
                                    @if( isset( $property->parking_price ) && isset( $property->parking_id ) )
                                        <div class="sin_com_term_group_item">
                                            <div class="sin_com_term_item_name">{{__('messages.park_cost')}}</div>
                                            <div class="sin_com_term_item_val">
                                                @if( (int)$property->parking_price > 0.00 )
                                                    {{number_format($property->parking_price, 1, '.', " ")}} TMT&nbsp;&nbsp;{{__('messages.for_month')}}                                              
                                                @else
                                                    {{__('messages.free')}}
                                                @endif
                                            </div>
                                        </div>                                    
                                    @endif
                                </div>
                            </div>
                            <!-- Terms for buying commercial property end  -->
                        @else
                            <!-- Terms for renting commercial property start  -->
                            <div class="sin_com_terms">
                                <div class="sin_com_term_group">
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.price')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}{{__('messages.mon')}}</div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup class="sq_sup_font">2</sup>/{{__('messages.year')}}</div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.comm_payment')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->comm_payment_included) )
                                                @if( (int)$property->comm_payment_included == 1 )
                                                    {{__('messages.incl_yes')}}
                                                @else    
                                                    {{__('messages.incl_no')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.oper_costs')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->explat_payment_included) )
                                                @if( (int)$property->explat_payment_included == 1 )
                                                    {{__('messages.incl_yes')}}
                                                @else    
                                                    {{__('messages.incl_no')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.sec_deposit')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->deposit_payment) )
                                                {{number_format($property->deposit_payment, 0, '.', " ")}} TMT
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="sin_com_term_group">                            
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.prepayment')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->prepayment) )
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
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rent_type')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->rent_type_id) )
                                                @if( (int)$property->rent_type_id == 1 )
                                                    {{__('messages.direct_rent')}}
                                                @else
                                                    @foreach( $rent_types as $rent_type )
                                                        @if( $rent_type->id == $property->rent_type_id )
                                                            @if(Lang::locale() == 'ru') {{$rent_type->type_ru}}
                                                            @elseif(Lang::locale() == 'en') {{$rent_type->type_en}}
                                                            @else {{$rent_type->type_en}}
                                                            @endif                                                
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rent_period')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset( $property->period_id ) )
                                                @foreach($rent_terms as $rent_term)
                                                    @if( $rent_term->id == $property->rent_term_id )
                                                        @if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                                                        @else {{$rent_term->term_tm}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.min_per_rent')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->min_term) )
                                                {{$property->min_term}} {{__('messages.mon_short')}}    
                                            @else
                                                -  
                                            @endif
                                        </div>
                                    </div>
                                    @if( isset( $property->parking_id ) )
                                        <div class="sin_com_term_group_item">
                                            <div class="sin_com_term_item_name">{{__('messages.park_cost')}}</div>
                                            <div class="sin_com_term_item_val">
                                                @if( isset($property->parking_price) )
                                                    @if( (int)$property->parking_price > 0.00 )
                                                        {{number_format($property->parking_price, 1, '.', " ")}} TMT&nbsp;&nbsp;{{__('messages.for_month')}}                                              
                                                    @else
                                                        {{__('messages.free')}}
                                                    @endif
                                                @else
                                                    - 
                                                @endif
                                            </div>
                                        </div>    
                                    @endif
                                </div>
                            </div>                        
                            <!-- Terms for renting commercial property end  -->
                        @endif
                    </div>
                    <!-- Property terms info about building for mobile version end -->
                @endif
                
                @if( (int)$property->object_names_id !== 7 )
                    <!-- Property terms info for mobile version start -->
                    <div class="single_block m-b-20 visible-sm visible-xs">
                        <h4 class="inner-title">{{__('messages.terms')}}</h4>
                        @if( (int)$property->saleOrRent == 1 )
                            <!-- Terms for buying commercial property start  -->
                            <div class="sin_com_terms">
                                <div class="sin_com_term_group">
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.price')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}</div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup class="sq_sup_font">2</sup></div>
                                    </div>
                                    @if( isset($property->monthly_profit) && (double)$property->monthly_profit > 1.00 )
                                        <div class="sin_com_term_group_item">
                                            <div class="sin_com_term_item_name">{{__('messages.mon_profit')}}</div>
                                            <div class="sin_com_term_item_val">{{number_format($property->monthly_profit, 0, '.', " ")}} TMT</div>
                                        </div>    
                                    @endif
                                </div>
                                <div class="sin_com_term_group">
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.tax')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset( $property->tax_id) )
                                                @if( (int)$property->tax_id === 3 )
                                                    <bdi class="text-uppercase">{{__('messages.tax_sts')}}</bdi>
                                                @else
                                                    @if(Lang::locale() == 'ru') {{$property->tax->tax_ru}}
                                                    @elseif(Lang::locale() == 'en') {{$property->tax->tax_en}}
                                                    @else {{$property->tax->tax_tm}} @endif    
                                                @endif
                                            @else
                                                -    
                                            @endif                                            
                                        </div>
                                    </div>
                                    @if( isset( $property->parking_price ) && isset( $property->parking_id ) )
                                        <div class="sin_com_term_group_item">
                                            <div class="sin_com_term_item_name">{{__('messages.park_cost')}}</div>
                                            <div class="sin_com_term_item_val">@if( (int)$property->parking_price > 0.00 ) {{number_format($property->parking_price, 1, '.', " ")}} TMT {{__('messages.for_month')}}
                                                @else {{__('messages.free')}} @endif
                                            </div>
                                        </div>                                    
                                    @endif
                                </div>
                            </div>
                            <!-- Terms for buying commercial property end  -->
                        @else
                            <!-- Terms for renting commercial property start  -->
                            <div class="sin_com_terms">
                                <div class="sin_com_term_group">
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.price')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}}{{__('messages.mon')}}</div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rate')}}</div>
                                        <div class="sin_com_term_item_val">{{number_format($property->price_rate , 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup class="sq_sup_font">2</sup>/{{__('messages.year')}}</div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.comm_payment')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->comm_payment_included) )
                                                @if( (int)$property->comm_payment_included == 1 )
                                                    {{__('messages.incl_yes')}}
                                                @else    
                                                    {{__('messages.incl_no')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.oper_costs')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->explat_payment_included) )
                                                @if( (int)$property->explat_payment_included == 1 )
                                                    {{__('messages.incl_yes')}}
                                                @else    
                                                    {{__('messages.incl_no')}}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.sec_deposit')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->deposit_payment) )
                                                {{number_format($property->deposit_payment, 0, '.', " ")}} TMT
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="sin_com_term_group">                            
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.prepayment')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->prepayment) )
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
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rent_type')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->rent_type_id) )
                                                @if( (int)$property->rent_type_id == 1 )
                                                    {{__('messages.direct_rent')}}
                                                @else
                                                    @foreach( $rent_types as $rent_type )
                                                        @if( $rent_type->id == $property->rent_type_id )
                                                            @if(Lang::locale() == 'ru') {{$rent_type->type_ru}}
                                                            @elseif(Lang::locale() == 'en') {{$rent_type->type_en}}
                                                            @else {{$rent_type->type_en}}
                                                            @endif                                                
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.rent_period')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset( $property->period_id ) )
                                                @foreach($rent_terms as $rent_term)
                                                    @if( $rent_term->id == $property->rent_term_id )
                                                        @if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                                                        @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                                                        @else {{$rent_term->term_tm}}
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                    <div class="sin_com_term_group_item">
                                        <div class="sin_com_term_item_name">{{__('messages.min_per_rent')}}</div>
                                        <div class="sin_com_term_item_val">
                                            @if( isset($property->min_term) )
                                                {{$property->min_term}} {{__('messages.mon_short')}}    
                                            @else
                                                -  
                                            @endif
                                        </div>
                                    </div>
                                    @if( isset( $property->parking_id ) )
                                        <div class="sin_com_term_group_item">
                                            <div class="sin_com_term_item_name">{{__('messages.park_cost')}}</div>
                                            <div class="sin_com_term_item_val">
                                                @if( isset($property->parking_price) )
                                                    @if( (int)$property->parking_price > 0.00 )
                                                        {{number_format($property->parking_price, 1, '.', " ")}} TMT&nbsp;&nbsp;{{__('messages.for_month')}}                                              
                                                    @else
                                                        {{__('messages.free')}}
                                                    @endif
                                                @else
                                                    - 
                                                @endif
                                            </div>
                                        </div>    
                                    @endif
                                </div>
                            </div>                        
                            <!-- Terms for renting commercial property end  -->
                        @endif
                    </div>
                    <!-- Property terms info for mobile version end -->
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
                <!-- Property map location for desktop end -->

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
                            @if( isset($property->price_rate) )
                                <div class="scroll_bar_price_rate2">
                                    <bdi class="lato_regular">{{number_format($property->price_rate , 0, '.', " ")}}</bdi> {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{__('messages.per_m_sq')}}<sup>2</sup> @if( (int)$property->saleOrRent == 0 ) {{__('messages.per_year')}}@endif
                                </div>
                            @endif
                            @if( isset($property->deposit_payment) )
                                <div class="scroll_bar_price_rate3">
                                     <bdi class="lato_regular">{{number_format($property->deposit_payment, 0, '.', " ")}}</bdi> TMT {{__('messages.sec_deposit_short')}}
                                </div>
                            @endif
                            @if( isset( $property->comm_payment_included ) || isset( $property->explat_payment_included ) || isset( $property->rent_term_id ) || isset( $property->prepayment )  || isset( $property->tax_id ) )
                                <div class="scroll_bar_incls">

                                    {{-- rent part --}}
                                    @if( isset( $property->comm_payment_included ) || isset( $property->explat_payment_included ) )
                                        <div class="scroll_bar_incl_item md-none">{{__('messages.incl_yes') . ':'}}</div>
                                    @endif
                                    @if( isset( $property->comm_payment_included ) ) 
                                        <div class="scroll_bar_incl_item">
                                            {{ __('messages.comm_payment') }}@if( isset( $property->explat_payment_included ) ) {{__('messages.and')}} @else ; @endif
                                        </div>
                                    @endif
                                    @if( isset( $property->explat_payment_included ) ) 
                                        <div class="scroll_bar_incl_item">{{ __('messages.oper_costs') }};</div>
                                    @endif
                                    @if( isset( $property->rent_term_id ) )
                                        <div class="scroll_bar_incl_item">
                                            @if( (int)$property->rent_term_id == 1 )
                                                {{__('messages.long_term_rent')}}@if( isset( $property->prepayment ) ), @endif
                                            @else
                                                {{__('messages.short_term_rent')}}@if( isset( $property->prepayment ) ), @endif
                                            @endif
                                        </div>
                                    @endif
                                    
                                    @if( isset( $property->prepayment ) )
                                        <div class="scroll_bar_incl_item">{{__('messages.pay_for') }} <bdi class="lato_regular">{{$property->prepayment}}</bdi>
                                            @if( (int)$property->prepayment == 1 ) {{__('messages.month1')}},
                                            @elseif( (int)$property->prepayment < 5 ) {{__('messages.month2')}},
                                            @else {{__('messages.month3')}}, @endif
                                            {{__('messages.by_year')}}
                                        </div>
                                    @endif

                                    {{-- sale part --}}
                                    @if( isset( $property->tax_id ) )
                                        <div class="scroll_bar_incl_item">
                                            @if( (int)$property->tax_id === 3 )
                                                <bdi class="text-uppercase">{{__('messages.tax_sts')}}</bdi>
                                            @else
                                                @if(Lang::locale() == 'ru') {{$property->tax->tax_ru}}
                                                @elseif(Lang::locale() == 'en') {{$property->tax->tax_en}}
                                                @else {{$property->tax->tax_tm}} @endif    
                                            @endif
                                        </div>
                                    @endif
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

        @if(!is_null($related_properties) && count($related_properties) > 0)
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
                $(this).addClass('hide').next().removeClass('hide')
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
                if( tel_no.charAt(0) !== '+' ){
                    tel_no = '+' + tel_no;
                }

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
                    
                if( $tog_elem.hasClass('squeeze_open') ){ $(this).text("{{__('messages.collapse')}}"); }
                else { $(this).text("{{__('messages.read_more')}}"); }
            });

            $('button#tax_sts_exp').tooltip();
        });
        
    </script>
    <script src="/js/mask.js"></script>
@endsection