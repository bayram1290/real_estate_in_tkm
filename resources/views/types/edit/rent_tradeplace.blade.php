<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="ar_torg propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="torg_t_premises" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.t_facility')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kbuyk_g">
                <select name="t_premises" id="torg_t_premises" class="form-control white_form selectpicker" required>                    
                    @foreach($trade_rooms as $trade_room)
                        <option value="{{$trade_room->id}}" {{$trade_room->id == $property->trade_room_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$trade_room->room_ru}}
                        @elseif(Lang::locale() == 'en') {{$trade_room->room_en}}
                        @else {{$trade_room->room_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="torg_area" class="form-control white_form" step="0.01" value="{{$property->area}}" required />
            <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
            <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="torg_in_parts" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.in_parts')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="torg_in_parts" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->in_parts == 1 ? 'active' : ''}}">
                    <input type="radio" name="in_parts" value="1" {{$property->in_parts == 1 ? 'checked=checked' : ''}}>{{__('messages.yes')}}
                </label>
                <label class="btn btn-primary cusBorRad2 {{ !is_null($property->in_parts) && ($property->in_parts == 0) ? 'active' : ''}}">
                    <input type="radio" name="in_parts" value="0" {{!is_null($property->in_parts) && ($property->in_parts == 0) ? 'checked=checked' : ''}}>{{__('messages.no')}}
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number"
                       min="1"
                       max="99"
                       class="form-control white_form m_m-b-5"
                       name="floor"
                       id="torg_floor"
                       data-dcheck="1"
                       step="1" 
                       pattern="\d+"
                       value="{{$property->floor > 0 ? $property->floor : '' }}"
                       required/>
            </div>
            <span class="kuck_g pull-left m-t-5 m_p-l-15">{{__('messages.from')}}</span>
            <label class="kuck_g pull-left p-r-0 m-l-15 m-t-5 m_m-l-5"><i class="fa fa-certificate pull-left"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g p-l-5 m_p-l-15">
                <input type="number"
                       min="2"
                       max="100"
                       name="tot_floor"
                       class="form-control white_form"
                       data-dcheck="2"
                       step="1" 
                       pattern="\d+"
                       value="{{$property->floors_in_home > 0 ? $property->floors_in_home : ''}}"
                       required />
                <div class="hide tool_tab_max" data-tooltip="{{ __('messages.form_feed4') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed4') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number"
                       min="0.3"
                       max="10"
                       class="form-control white_form"
                       name="ceil"
                       id="torg_ceil_height" 
                       step="0.01"
                       value="{{$property->ceil_height > 0 ? $property->ceil_height : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="torg_shop_window" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.shop_window')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="torg_shop_window" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->shop_window == 1 ? 'active' : ''}}">
                    <input type="radio" name="s_window" value="1" {{$property->shop_window == 1 ? 'checked=checked' : ''}}>{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2 {{!is_null($property->shop_window) && ($property->shop_window == 0) ? 'active' : ''}}">
                    <input type="radio" name="s_window" value="0" {{!is_null($property->shop_window) && ($property->shop_window == 0) ? 'checked=checked' : ''}}>{{__('messages.no_exist')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_leg_add" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.leg_add')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="leg_add" id="torg_leg_add" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->legal_address) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    <option value="1" {{$property->legal_address == 1 ? 'selected' :''}}>{{__('messages.provided')}}</option>
                    <option value="0" {{ !is_null($property->legal_address) && ($property->legal_address == 0)  ? 'selected' :''}}>{{__('messages.not_provided')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_elec_pow" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.elec_pow')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number"
                       min="1"
                       max="5000"
                       class="form-control white_form"
                       name="elec_pow"
                       id="torg_elec_pow"
                       value="{{$property->electric_power > 0 ? $property->electric_power : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.kW')}}</span>
        </div>
        <div class="form-group row">
            <label for="torg_occ_room" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.occ_room')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="torg_occ_room" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->occupied == 1 ? 'active' : ''}}">
                    <input type="radio" name="occ_room" value="1" {{ $property->occupied == 1 ? 'checked=checked' : ''}} />{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2 {{$property->occupied == 2 ? 'active' : ''}}">
                    <input type="radio" name="occ_room" value="2" {{ $property->occupied == 2 ? 'checked=checked' : ''}} />{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row @if($property->occupied == 2 || is_null($property->occupied)) hide @endif">
            <label for="occ_per_ofis" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.release_date')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g" id="occ_per_ofis">
                <div class="col-md-6 p-l-0">
                    <select name="occ_period_month" class="form-control white_form selectpicker">
                        @php 
                            $sel_mon = isset( $property->occup_month_id ) ? $property->occup_month_id : Carbon\Carbon::now()->month;
                        @endphp
                        @for( $mon = 1; $mon <= 12; $mon++ )
                            <option value="{{$mon}}"
                            @if( $mon == $sel_mon )
                                selected
                            @endif>@if(Lang::locale() == 'ru') {{$months_ru[$mon-1]}}
                            @elseif(Lang::locale() == 'en') {{$months_en[$mon-1]}}
                            @else {{$months_tm[$mon-1]}}
                            @endif</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="occ_period_year" class="form-control white_form selectpicker">
                        @php $sel_year = isset( $property->occup_year ) ? $property->occup_year : Carbon\Carbon::now()->year; @endphp
                        @for( $c_year = Carbon\Carbon::now()->year, $i_year = $c_year; $i_year < $c_year + 5; $i_year++)
                            <option value="{{$i_year}}" {{$i_year == $sel_year ? 'selected':''}}>{{$i_year}}</option>
                        @endfor
                    </select>
                </div>                
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_poss_appoint" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.poss_appoint')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <input type="text" class="form-control p_appoit" id="torg_poss_appoint1" onkeypress="return possKeyPress(event, this);"/>
                <div class="mob_poss_btn hide">
                    <button type="button" class="btn-option mob_poss_accept"><i class="fa fa-check"></i></button>
                </div>
                <select name="f_activity" id="torg_poss_appoint" class="form-control white_form selectpicker poss_app">
                    <option disabled selected class="hide"></option>
                    @foreach($business_types as $bus_type)
                        <option value="{{$bus_type->id}}">@if(Lang::locale() == 'ru') {{$bus_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$bus_type->type_en}}
                        @else {{$bus_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8 appoint_wrap">
                @if($property->business_type()->count() > 0)
                    @php ($ind = 0) @endphp
                    @foreach($property->business_type as $bus_type)
                        <input type="hidden" id="appoint{{$ind}}" name="appoint[]" value="{{$bus_type->id}}">
                        <div class="tag_spec">@if(Lang::locale() == 'ru') {{$bus_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$bus_type->type_en}}
                        @else {{$bus_type->type_tm}}
                        @endif<a href="javascript:void(0)" class="tag_spec_close" data-tag="appoint{{$ind++}}"><i class="fa fa-times-circle"></i></a>
                        </div>
                    @endforeach
                @endif
                @if($extra_possible_business_types->count() > 0)
                    @php ($i = 0) @endphp
                    @foreach($extra_possible_business_types as $extra_appoint)
                        <input type="hidden" id="ex_appoint{{$i}}" name="ex_appoint[]" value="{{$extra_appoint->type}}">
                        <div class="tag_spec">{{$extra_appoint->type}}
                            <a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint{{$i++}}"><i class="fa fa-times-circle"></i></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="torg_condition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.condition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="cond" id="torg_condition" class="form-control white_form selectpicker">
                    @foreach($office_conditions as $condition)
                        <option value="{{$condition->id}}" {{$property->office_condition_id == $condition->id ? 'selected' :''}}>@if(Lang::locale() == 'ru') {{$condition->condition_ru }}
                        @elseif(Lang::locale() == 'en') {{$condition->condition_en }}
                        @else {{$condition->condition_tm }}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_furniture" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.furniture')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="torg_furniture" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->furniture == 1 ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="1" {{$property->furniture == 1 ? 'checked=checked' : ''}} />{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2 {{!is_null($property->furniture) && ($property->furniture == 0) ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="0" {{!is_null($property->furniture) && ($property->furniture == 0) ? 'checked=checked' : ''}} />{{__('messages.no_exist')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_b_enter" class="col-lg-4 col-md-3 col-sm-4 form-label1 text-capitalize">{{__('messages.b_enter')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="building_entry" id="torg_b_enter" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null( $property->building_entrance_id) ? 'selected': '' }}>{{__('messages.no_select')}}</option>
                    @foreach($building_entrances as $building_entrance)
                        <option value="{{$building_entrance->id}}" {{$building_entrance->id == $property->building_entrance_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$building_entrance->entrance_ru}}
                            @elseif(Lang::locale() == 'en') {{$building_entrance->entrance_en}}
                            @else {{$building_entrance->entrance_tm }}
                            @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
        </div>
        <div class="form-group row">
            <label for="t_build" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_build')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="t_build" id="t_build" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->building_type_id) ? 'selected' : ''}}>{{__('messages.no_select')}}</option>
                    @foreach($building_types as $building_type)
                        <option value="{{$building_type->id}}" {{ $property->building_type_id == $building_type->id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$building_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$building_type->type_en}}
                        @else {{$building_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_a_build" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.a_build')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" class="form-control white_form" id="torg_a_build" name="a_build" step="0.01" value="{{$property->building_area}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="torg_land" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.land')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="0.01" max="200" class="form-control white_form m_m-b-5" name="lArea" id="torg_land" step="0.01"  value="{{$property->land_area > 0 ? $property->land_area : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.ga')}}<span class="anwrap m-l-20 land_opts m_hide">
                @foreach($land_owning_types as $land_owning_type)
                        <label class="radOn w-auto">
                            <input type="radio" name="land_type" value="{{$land_owning_type->id}}" {{$land_owning_type->id == $property->land_owning_type_id ? 'checked=checked':''}} />
                            <span class="outer">
                                <span class="inner"></span>
                            </span>@if(Lang::locale() == 'ru') {{$land_owning_type->type_ru}}
                            @elseif(Lang::locale() == 'en') {{$land_owning_type->type_en}}
                            @else {{$land_owning_type->type_tm}}
                            @endif</label>
                    @endforeach
                </span>
            </span>
            <div class="col-xs-12 land_opts m_show">
                @foreach($land_owning_types as $land_owning_type)
                    <label class="radOn w-auto">
                        <input type="radio" name="land_type1" value="{{$land_owning_type->id}}" {{$land_owning_type->id == $property->land_owning_type_id ? 'checked':''}}>
                        <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$land_owning_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$land_owning_type->type_en}}
                        @else {{$land_owning_type->type_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <br><br>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h_inBen">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="vent_opt2" name="vent_opt" class="cusCheckBox" {{ $property->ventilation_id ? 'checked=checked' :''}} value="1">
                        <label for="vent_opt2" id="vent_2"><b>{{__('messages.ventilation')}}</b></label>
                    </span>
                    @foreach($ventilation as $vent)
                        <label class="radOn">
                            <input type="radio" name="vent_type" value="{{$vent->id}}" {{$vent->id == $property->ventilation_id ? 'checked=checked' :''}}>
                            <span class="outer">
                                <span class="inner"></span>
                            </span>@if(Lang::locale() == 'ru') {{$vent->ventilation_ru}}
                            @elseif(Lang::locale() == 'en') {{$vent->ventilation_en}}
                            @else {{$vent->ventilation_tm}}
                            @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="cond_opt2" name="cond_opt" class="cusCheckBox" value="1"{{$property->conditioning_id ? 'checked=checked' :''}} />
                        <label for="cond_opt2" id="cond_2"><b>{{__('messages.air_cond')}}</b></label>
                    </span>
                    @foreach($conditioning as $cond)
                        <label class="radOn">
                            <input type="radio" name="cond_type" value="{{$cond->id}}" {{$cond->id == $property->conditioning_id ? 'checked=checked' :''}} />
                            <span class="outer">
                                <span class="inner"></span>
                            </span>@if(Lang::locale() == 'ru') {{$cond->conditioning_ru}}
                            @elseif(Lang::locale() == 'en') {{$cond->conditioning_en}}
                            @else {{$cond->conditioning_tm}}
                            @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="heat_opt2" name="heat_opt" class="cusCheckBox" value="1" {{ $property->heating_id ? 'checked=checked' :''}} />
                        <label for="heat_opt2" id="heat_2"><b>{{__('messages.heating_system')}}</b></label>
                    </span>
                    @foreach($heating as $heat)
                        @if($heat->type == 1)
                            <label class="radOn">
                                <input type="radio" name="heating" value="{{$heat->id}}" {{$heat->id == $property->heating_id ? 'checked=checked' :''}} />
                                <span class="outer">
                                    <span class="inner"></span>
                                </span>@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                                @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                                @else {{$heat->heating_tm}}
                                @endif</label>
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="fextin_opt2" name="fextin_opt" class="cusCheckBox" value="1" {{$property->firefighting_id ? 'checked' :''}} />
                        <label for="fextin_opt2" id="fextin_2"><b>{{__('messages.fire_extin')}}</b></label>
                    </span>
                    @foreach($firefighting as $firefight)
                        <label class="radOn">
                            <input type="radio" name="fextin_type" value="{{$firefight->id}}" {{$firefight->id == $property->firefighting_id ? 'checked' :''}} />
                            <span class="outer">
                                <span class="inner"></span>
                            </span>@if(Lang::locale() == 'ru') {{$firefight->firefighting_ru}}
                            @elseif(Lang::locale() == 'en') {{$firefight->firefighting_en}}
                            @else {{$firefight->firefighting_tm}}
                            @endif</label>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="torg_open_hours" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.open_hours')}}</label>
            <div id="torg_open_hours" class="wrap_24">
                <span class="kuck_g cusSpan1 pull-left fly_mob6 m_p-l-15 m_m-r-0">{{__('messages.from1')}}</span>
                <div class="col-lg-8 col-md-9 col-sm-8 kuck_g m-r-5 fly_mob5 m_m-r-0 m_p-l-0">
                    <input type="time" class="form-control white_form m_m-b-10" name="from_hour" value="{{$property->from_hour}}" {{ $property->from_dusk_till_dawn ? 'disabled' : '' }} />
                </div>
                <span class="kuck_g cusSpan1 pull-left fly_mob6 m_p-l-15 m_m-r-0">{{__('messages.to')}}</span>
                <div class="col-lg-8 col-md-9 col-sm-8 kuck_g m-r-5 fly_mob5 m_m-r-0 m_p-l-0">
                    <input type="time" name="to_hour" class="form-control white_form m_m-b-10" value="{{$property->to_hour}}" {{ $property->from_dusk_till_dawn ? 'disabled' : '' }} />
                </div>
            </div>
            <div class="pretty p-icon p-curve p-pulse m-t-5 m_m-b-10 24_wrap">
                <input type="checkbox" name="open_24_hour" value="1" {{ $property->from_dusk_till_dawn ? 'checked' : '' }}>
                <div class="state p-primary-o m_m-l-20_p">
                    <i class="icon fa fa-check" aria-hidden="true"></i>
                    <label>{{__('messages.24_hour')}}</label>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="torg_day_week" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.day_week')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="torg_day_week" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{ $property->day_week_id == 1 ? 'active' : '' }}">
                    <input type="radio" name="day_week" value="1" {{ $property->day_week_id == 1 ? 'checked' : '' }} />{{__('messages.w_days')}}</label>
                <label class="btn btn-primary {{ $property->day_week_id == 2 ? 'active' : '' }}">
                    <input type="radio" name="day_week" value="2" {{ $property->day_week_id == 2 ? 'checked' : '' }} />{{__('messages.w_ends')}}</label>
                <label class="btn btn-primary cusBorRad2 {{ $property->day_week_id == 3 ? 'active' : '' }}" >
                    <input type="radio" name="day_week" value="3" {{ $property->day_week_id == 3 ? 'checked' : '' }} />{{__('messages.daily')}}</label>
            </div>
        </div><br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.infras')}}</h4>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <div class="col-md-3 col-sm-6 col-xs-12 anwrap t_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $item)
                            @if($item->id < 6)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$item->id}}"
                                        @foreach($property->infrastructure as $infr)
                                            @if($infr->id == $item->id)
                                                checked
                                            @endif
                                        @endforeach>
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$item->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$item->infrastructure_en}}
                                            @else {{$item->infrastructure_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 anwrap m_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $item)
                            @if($item->id >= 6 && $item->id < 11)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$item->id}}"
                                        @foreach($property->infrastructure as $infr)
                                            @if($infr->id == $item->id)
                                                checked
                                            @endif
                                        @endforeach>
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$item->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$item->infrastructure_en}}
                                            @else {{$item->infrastructure_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 anwrap t_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $item)
                            @if($item->id >= 11 && $item->id < 16)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$item->id}}"
                                        @foreach($property->infrastructure as $infr)
                                            @if($infr->id == $item->id)
                                                checked
                                            @endif
                                        @endforeach>
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$item->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$item->infrastructure_en}}
                                            @else {{$item->infrastructure_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 anwrap m_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $item)
                            @if($item->id >= 16 && $item->id < 22)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$item->id}}"
                                        @foreach($property->infrastructure as $infr)
                                            @if($infr->id == $item->id)
                                                checked
                                            @endif
                                        @endforeach>
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$item->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$item->infrastructure_en}}
                                            @else {{$item->infrastructure_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><br>
        <hr>
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_7" value="{{$property->img}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_7" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <label for="torg_price_per_msq" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price_per_msq')}}<sup>2</sup><i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="torg_price_per_msq" name="price" step="0.1" value="{{$price_rate}}" required />
                <!-- uc = условная единица /  conventional unit -->
                <select class="price_unit_wrap selectpicker" name="price_unit">
                    <option value="1" {{ $property->price_unit_id == 1 ? 'selected' : '' }}>{{__('messages.cu')}}</option>
                    <option value="2" {{ $property->price_unit_id == 2 ? 'selected' : '' }}>TMT</option>
                </select>                
                <div class="hide tool_tab_max" data-tooltip="{{ __('messages.form_feed13') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed13') }}</div>
            </div>
            <span class="anwrap m-l-20 pr_per">
                @foreach($periods as $period)
                    <label class="radOn w-auto m_m-r-20"><input type="radio" name="for_period" value="{{$period->id}}" {{$period->id == $property->period_id ? 'checked' : ''}} />
                        <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$period->period_ru}}
                        @elseif(Lang::locale() == 'en') {{$period->period_en}}
                        @else {{$period->period_tm}}
                        @endif</label>
                @endforeach
            </span>
        </div>
        <div class="form-group row">
            <label class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.price_incl')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <ul>
                    <li class="m-b-10">
                        <div class="pretty p-icon p-curve p-pulse">
                            <input type="checkbox" name="comm_payment" value="1" {{$property->comm_payment_included ? 'checked=checked' : ''}}>
                            <div class="state p-primary-o">
                                <i class="icon fa fa-check" aria-hidden="true"></i>
                                <label class="text-lowercase">{{__('messages.comm_payment')}}</label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="pretty p-icon p-curve p-pulse">
                            <input type="checkbox" name="expl_payment" value="1" {{$property->explat_payment_included ? 'checked=checked' : ''}}>
                            <div class="state p-primary-o">
                                <i class="icon fa fa-check" aria-hidden="true"></i>
                                <label class="text-lowercase">{{__('messages.oper_costs')}}</label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="torg_rent_type" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.rent_type')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 btn-group toGGle dec_btns1 m_m-b-50" id="torg_rent_type" data-toggle="buttons">
                @foreach($rent_types as $rent_type)
                    <label class="btn btn-primary {{$rent_type->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}} {{$rent_type->id == $property->rent_type_id ? 'active' : ''}}">
                        <input type="radio" name="rent_type" value="{{$rent_type->id}}" {{$rent_type->id == $property->rent_type_id ? 'checked' : ''}}>@if(Lang::locale() == 'ru') {{$rent_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$rent_type->type_en}}
                        @else {{$rent_type->type_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_rent_period" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.rent_period')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 btn-group toGGle dec_btns1" id="torg_rent_period" data-toggle="buttons">
                @foreach($rent_terms as $rent_term)
                    <label class="btn btn-primary {{$rent_term->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}} {{$rent_term->id == $property->rent_term_id ? 'active' : ''}}">
                        <input type="radio" name="rent_period" value="{{$rent_term->id}}" {{$rent_term->id == $property->rent_term_id ? 'checked' : ''}}>@if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                        @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                        @else {{$rent_term->term_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_min_per_rent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.min_per_rent')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0" max="120" class="form-control white_form" id="torg_min_per_rent" name="min_rent" value="{{$property->min_term > 0 ? $property->min_term : '' }}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.month')}}</span>
        </div>
        <div class="form-group row">
            <label for="torg_sec_deposit" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.sec_deposit')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="0" class="form-control white_form"  id="torg_sec_deposit" name="own_deposit" step="0.01" value="{{$property->deposit_payment > 0 ? $property->deposit_payment : ''}}" />
                <span class="cSpan1">TMT</span>
            </div>
        </div>
        <div class="form-group row">
            <label for="torg_prepayment" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.prepayment')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="prepayment" id="torg_prepayment" required>
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
        </div><br>
        {{-- Don't remove this part, need to discuss about it later --}}
        {{--<br><br>--}}
        {{--<div class="form-group row">--}}
            {{--<div class="col-md-12"><p>{{__('messages.rental_cost')}}</p></div>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="torg_percent1" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.percent_warn1')}}<i class="fa fa-certificate pull-right"></i></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number"--}}
                       {{--min="0"--}}
                       {{--class="form-control white_form ic_per_wrap"--}}
                       {{--id="torg_percent1"--}}
                       {{--name="percent1"--}}
                       {{--required><span class="ic_percent1">% </span>--}}
            {{--</div>--}}
            {{--<span class="cSpan"><span class="ic_percent">% </span>--}}
                {{--<input type="checkbox"--}}
                       {{--id="torg_commis_client1"--}}
                       {{--name="commis_client1"--}}
                       {{--class="cusCheckBox"--}}
                       {{--value="1"><label for="torg_commis_client1"--}}
                                        {{--class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="torg_percent2" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0 ic_per_lbl">{{__('messages.percent_warn2')}}<i class="fa fa-certificate pull-right"></i><br><p>{{__('messages.percent_warn3')}}</p></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number"--}}
                       {{--min="0"--}}
                       {{--class="form-control white_form ic_per_wrap"--}}
                       {{--id="torg_percent2"--}}
                       {{--name="percent2"--}}
                       {{--required><span class="ic_percent1">% </span>--}}
            {{--</div><span class="cSpan"><span class="ic_percent">% </span><input type="checkbox"--}}
                                                                             {{--id="torg_commis_client2"--}}
                                                                             {{--name="commis_client2"--}}
                                                                             {{--class="cusCheckBox"--}}
                                                                             {{--value="1"><label for="torg_commis_client2"--}}
                                                                                              {{--class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select7" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select7" class="form-control white_form velayat_select selectpicker m-b-36" required>
                    @foreach($velayats as $velayat)
                        <option value="{{$velayat->id}}" {{ $velayat->id == $property->velayat_id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_select_7" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_7" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="torg_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text"
                       class="form-control white_form m-b-0"
                       id="address_6"
                       name="address"
                       placeholder="{{__('messages.street_holder')}}"
                       value="{{$property->address}}"
                       required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="map_6" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_6" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_6" name="lat_6">
            <input type="hidden" id="lng_6" name="lng_6">
            <input type="hidden" id="type_id" value="2" name="type_id">
            <input type="hidden" id="object_id" value="8" name="object_id">
            <input type="hidden" id="sale_rent" value="0" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 6)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>