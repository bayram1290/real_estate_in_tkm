<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="ar_kott propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="kott_n_settlement" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{ __('messages.name') }}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 ubuyk_g">
                <input type="text" class="form-control white_form" name="n_settlement" id="kott_n_settlement" value="{{$property->village_name}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" name="const_year" id="kott_const_year" class="form-control white_form" min="1900" max="{{ now()->year }}" value="{{$property->construction_year}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="t_house" id="kott_t_house" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->type_property_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach($buildings as $building)
                        <option value="{{$building->id}}" {{$property->type_property_id == $building->id? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$building->building_ru}}
                        @elseif(Lang::locale() == 'en') {{$building->building_en}}
                        @else {{$building->building_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_tot_rooms" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_rooms')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="tot_rooms" id="kott_tot_rooms" class="form-control white_form selectpicker">
                    @if( is_null( $property->rooms ) )
                        <option selected disabled class="hide">{{__('messages.no_select')}}</option>                    
                    @endif
                    @for($room = 1; $room < 7; $room++)
                        <option value="{{$room}}"
                            @if( $property->rooms == $room )
                                selected
                            @endif
                        >{{$room}}</option>   
                    @endfor
                    <option value="7"
                        @if( $property->rooms == 7 )
                            selected
                        @endif
                    >7 {{__('messages.or_more')}}</option>
                </select>                
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.tot_area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="kott_tot_area" class="form-control white_form" step="0.01" value="{{$property->area}}" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="kott_tot_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.total_floor1')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="1" max="10" class="form-control white_form" name="tot_floor" id="kott_tot_floor" value="{{$property->floors_in_home > 0 ? $property->floors_in_home : ''}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_num_beds" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_beds')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="0" max="20" class="form-control white_form" name="num_beds" id="kott_num_beds" value="{{$property->num_beds > 0 ? $property->num_beds : ''}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_bath" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bath')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="kott_bath" data-toggle="buttons">
                @foreach($bathrooms as $bathroom)
                    <label for="bath" class="btn btn-primary {{$bathroom->id == 1 ? 'cusBorRad1' : ''}} {{$bathroom->id == 3 ? 'cusBorRad2' : ''}} {{$bathroom->id == $property->bathroom_id ? 'active' : ''}}">
                        <input type="radio" name="bath" value="{{$bathroom->id}}" {{$bathroom->id == $property->bathroom_id ? 'checked=checked' : ''}} />@if(Lang::locale() == 'ru') {{$bathroom->bathroom_ru}}
                                    @elseif(Lang::locale() == 'en') {{$bathroom->bathroom_en}}
                                    @else {{$bathroom->bathroom_tm}}
                                    @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_heating" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.heating_system')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="heating" id="kott_heating" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->heating_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach($heating as $heat)
                        @if($heat->type == 2)
                            <option value="{{$heat->id}}" {{$heat->id == $property->heating_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                                    @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                                    @else {{$heat->heating_tm}}
                                    @endif</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_decor" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.decor')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="kott_decor" data-toggle="buttons">
                @foreach($revamps as $revamp)
                    <label class="btn btn-primary {{$revamp->id == 1 ? 'cusBorRad1' :''}} {{$revamp->id == 4 ? 'cusBorRad2' :''}} {{$revamp->id == $property->revamp_id ? 'active' : ''}}">
                        <input type="radio" name="decor" value="{{$revamp->id}}" {{$revamp->id == $property->revamp_id ? 'checked' : ''}}>@if(Lang::locale() == 'ru') {{$revamp->type_ru}}
                               @elseif(Lang::locale() == 'en') {{$revamp->type_en}}
                               @else {{$revamp->type_tm}}
                               @endif</label>
                @endforeach
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="kot_inHouse" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.inHouse')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 add_ins" id="kot_inHouse">
                <div class="col-md-6 col-sm-12 t_p-l-0">
                    <ul class="feat_list dir_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id < 7)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}"
                                        @foreach($property->feature as $feat)
                                            @if($feat->id == $feature->id)
                                                checked
                                            @endif
                                        @endforeach>
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$feature->feature_ru}}
                                            @elseif(Lang::locale() == 'en') {{$feature->feature_en}}
                                            @else {{$feature->feature_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 t_p-l-0">
                    <ul class="feat_list dir_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id > 6 && $feature->id < 16)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}"
                                        @foreach($property->feature as $feat)
                                            @if($feat->id == $feature->id)
                                                checked
                                            @endif
                                        @endforeach>
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$feature->feature_ru}}
                                            @elseif(Lang::locale() == 'en') {{$feature->feature_en}}
                                            @else {{$feature->feature_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <br><br>
        <div class="form-group row">
        <label for="kott_land_area" class="col-lg-4 col-md-3 col-sm-4 col-xs-12 form-label1 p-r-0">{{__('messages.land_area')}}<i class="fa fa-certificate s_req"></i></label>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-7 p-r-0 norm_g">
                <input type="number" min="0.01" max="200" class="form-control white_form cusBorRad3" id="kott_land_area" name="lArea" step="0.01" value="{{$property->land_area}}" required />
                <div class="hide tooltip_r_125" data-tooltip="{{ __('messages.form_feed10') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed10') }}</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-5 p-l-0 nkuck_g">
                <select name="land_unit" class="form-control white_form selectpicker cusBorRad5">
                    @foreach($land_area_types as $land_area_type)
                        <option value="{{$land_area_type->id}}" {{$property->land_area_type_id == $land_area_type->id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$land_area_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$land_area_type->type_en}}
                        @else {{$land_area_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <hr>
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_3" value="{{$property->img}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_3" class="drag-and-drop-zone dm-uploader p-5 text-center">
            <h3 class="mb-5 mt-5 text-muted">{{__('messages.drag_n_drop')}}</h3>

            <div class="btn btn-prima btn-block mb-5">
                <span>{{__('messages.open_file_browser')}}</span>
                <input type="file" title="Click to add Files">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($property->image as $img)
                        <div class="col-md-3" style="margin-bottom: 4%;">
                            <div class="img-up" onmouseover="showBtn(this)" onmouseout="hideBtn(this)">
                                <input id="img_name_' + id + '" type="hidden" value="">
                                <div class="img-wrapper">
                                    <img src="{{asset('/img/property_grid/'. $img->name)}}" alt="">
                                    <button id="check" class="btn btn-success"
                                            onclick="makeMain(this,' + i.substring(5, i.length) + ')"
                                            title="Сделать главной картинкой"><i class="fa fa-check"></i></button>
                                    <button id="times" class="btn btn-danger"
                                            onclick="deleteImg(this,' + i.substring(5, i.length) + ')"
                                            title="Удалить картинку"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="progress" style="width: 100%; height: 20%">
                                    <div id="' + id + '" class="progress-bar" role="progressbar" style="width: 0%;"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div><br><br>
        <hr>
        <div class="description m-b-40">
            <div class="basic_information">
                <h4 class="inner-title">{{__('messages.description')}}</h4>
            </div>
            <textarea name="description" placeholder="{{__('messages.enter_desc')}}" class="form_description" required>{{$property->description->description}}</textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="kott_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price_month')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g fly_mob3 m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" name="price" step="0.1" value="{{$property->price}}" required/>
                <!-- uc = условная единица /  conventional unit -->
                <select class="price_unit_wrap selectpicker" name="price_unit">
                    <option value="1" {{ $property->price_unit_id == 1 ? 'selected' : '' }}>{{__('messages.cu')}}</option>
                    <option value="2" {{ $property->price_unit_id == 2 ? 'selected' : '' }}>TMT</option>
                </select>
                <div class="hide" data-tooltip="{{ __('messages.form_feed5') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed5') }}</div>                
            </div>
            <span class="cSpan">{{__('messages.for_month')}}</span>
        </div>
        <div class="form-group row">
            <div class="col-lg-8 col-md-9 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-4 pretCusFont">
                <div class="pretty p-icon p-curve p-pulse">
                    <input type="checkbox" name="barg_poss" value="1" {{$property->trade_enabled ? 'checked' : ''}}>
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.barg_poss')}}</label>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="kott_comm_payment" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.comm_payment')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns1" id="kott_comm_payment" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->comm_payment_included ? 'active' : ''}}">
                    <input type="radio" name="comm_payment" value="1" {{$property->comm_payment_included ? 'checked=checked' : ''}}>{{__('messages.incl_yes')}}</label>
                <label class="btn btn-primary cusBorRad2 {{(!is_null($property->comm_payment_included) && !$property->comm_payment_included) ? 'active' : ''}}">
                    <input type="radio" name="comm_payment" value="0" {{(!is_null($property->comm_payment_included) && $property->comm_payment_included) ? 'checked=checked' : ''}}>{{__('messages.incl_no')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_rent_period" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.rent_period')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns1" id="kott_rent_period" data-toggle="buttons">
                @foreach($rent_terms as $rent_term)
                    <label class="btn btn-primary {{$rent_term->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}} {{$property->rent_term_id == $rent_term->id ? 'active' :''}}">
                        <input type="radio" name="rent_period" value="{{$rent_term->id}}" {{$property->rent_term_id == $rent_term->id ? 'checked=checked' :''}}>@if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                        @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                        @else {{$rent_term->term_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_prepayment" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.prepayment')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="prepayment" id="kott_prepayment">
                    <option disabled class="hide" {{ is_null($property->prepayment) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @for($i=1; $i <= 12; $i++)
                        <option value="{{$i}}" {{ $property->prepayment == $i ? 'selected' : '' }}>
                            @if( $i < 12 )
                                {{ $i }}
                                @if( $i < 2 )
                                    {{__('messages.month1')}}
                                @elseif( $i < 5 )
                                    {{__('messages.month2')}}
                                @else
                                    {{__('messages.month3')}}
                                @endif
                            @else
                                1 {{__('messages.year')}}
                            @endif
                        </option>
                    @endfor                    
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="kot_own_deposit" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.own_deposit')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" name="own_deposit" id="kot_own_deposit" class="form-control white_form" min="0" step="0.01" value="{{$property->deposit_payment}}" />
                <span class="cSpan1">TMT</span>
            </div>
        </div><br>
        {{-- Don't remove this part, need to discuss about it later --}}
        {{--<br>--}}
        {{--<div class="form-group row">--}}
            {{--<div class="col-md-12"><p>{{__('messages.rental_cost')}}</p></div>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="kott_percent1" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.percent_warn1')}}<i class="fa fa-certificate pull-right"></i></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number" min="0" class="form-control white_form ic_per_wrap" id="kott_percent1" name="percent1"><span class="ic_percent1">% </span>--}}
            {{--</div>--}}
            {{--<span class="cSpan"><span class="ic_percent">% </span>--}}
                {{--<input type="checkbox"--}}
                       {{--id="kott_commis_client1"--}}
                       {{--name="commis_client1"--}}
                       {{--value="1"--}}
                       {{--class="cusCheckBox">--}}
                {{--<label for="kott_commis_client1" class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="kott_percent2" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0 ic_per_lbl">{{__('messages.percent_warn2')}}<i class="fa fa-certificate pull-right"></i><br><p>{{__('messages.percent_warn3')}}</p></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number" min="0" class="form-control white_form ic_per_wrap" id="kott_percent2" name="percent2"><span class="ic_percent1">% </span>--}}
            {{--</div>--}}
            {{--<span class="cSpan"><span class="ic_percent">% </span><input type="checkbox"--}}
                                                                             {{--id="kott_commis_client2"--}}
                                                                             {{--name="commis_client2"--}}
                                                                             {{--class="cusCheckBox"--}}
                                                                             {{--value="1"><label for="kott_commis_client2"--}}
                                                                                              {{--class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select3" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select3" class="form-control velayat_select white_form selectpicker m-b-36" required>
                        @foreach($velayats as $velayat)
                            <option  value="{{$velayat->id}}" {{ $velayat->id == $property->velayat_id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                        @endforeach
                </select>                
            </div>
        </div>
        <div class="form-group row">
            <label for="city_select_3" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_3" class="form-control white_form selectpicker m-b-0" required>                    
                    @foreach($cities as $city)
                        <option id="{{$city->velayat_id}}" value="{{$city->id}}" {{ $city->id == $property->city_id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$city->city_ru}}
                        @elseif(Lang::locale() == 'en') {{$city->city_en}}
                        @else {{$city->city_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="sel_err_feed sel_err_invis m-b-10">{{ __('messages.form_feed7') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="kott_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_7" name="address" placeholder="{{__('messages.street_holder')}}" value="{{$property->address}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="map_2" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_7" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_7" name="lat_7">
            <input type="hidden" id="lng_7" name="lng_7">
            <input type="hidden" id="type_id" value="1" name="type_id">
            <input type="hidden" id="object_id" value="4" name="object_id">
            <input type="hidden" id="sale_rent" value="0" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 2)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>