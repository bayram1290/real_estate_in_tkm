<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_ofis propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pofis_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{ __('messages.area') }}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="pofis_area" class="form-control white_form" step="0.01" value="{{$property->area}}" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pofis_in_parts" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.in_parts')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pofis_in_parts" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->in_parts == 1 ? 'active' : ''}}">
                    <input type="radio" name="in_parts" value="1" {{$property->in_parts == 1 ? 'checked=checked' : ''}} />{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2 {{ !is_null($property->in_parts) && ($property->in_parts == 0) ? 'active' : ''}}">
                    <input type="radio" name="in_parts" value="0" {{!is_null($property->in_parts) && ($property->in_parts == 0) ? 'checked=checked' : ''}} />{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1" max="99" class="form-control white_form m_m-b-5" name="floor" id="pofis_floor" data-dcheck="1" step="1" pattern="\d+" value="{{$property->floor > 0 ? $property->floor : ''}}" required />
            </div>
            <span class="kuck_g pull-left m-t-5 m_p-l-15">{{__('messages.from')}}</span>
            <label class="kuck_g pull-left p-r-0 m-l-15 m-t-5 m_m-l-5"><i class="fa fa-certificate pull-left"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g p-l-5 m_p-l-15">
                <input type="number" min="2" max="100" name="tot_floor" class="form-control white_form" data-dcheck="2" step="1" pattern="\d+" value="{{$property->floors_in_home > 0 ? $property->floors_in_home : ''}}" required />
                <div class="hide tool_tab_max" data-tooltip="{{ __('messages.form_feed4') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed4') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_leg_add" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.leg_add')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="leg_add" id="pofis_leg_add" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->legal_address) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    <option value="1" {{$property->legal_address == 1 ? 'selected' :''}}>{{__('messages.provided')}}</option>
                    <option value="0" {{ !is_null($property->legal_address) && ($property->legal_address == 0)  ? 'selected' :''}}>{{__('messages.not_provided')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="10" class="form-control white_form" name="ceil" id="pofis_ceil_height" step="0.01" value="{{$property->ceil_height > 0 ? $property->ceil_height : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="pofis_occ_room" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.occ_room')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pofis_occ_room" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->occupied == 1 ? 'active' : ''}}">
                    <input type="radio" name="occ_room" value="1" {{ $property->occupied == 1 ? 'checked=checked' : ''}} />{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2 {{$property->occupied == 2 ? 'active' : ''}}">
                    <input type="radio" name="occ_room" value="2" {{ $property->occupied == 2 ? 'checked=checked' : ''}} />{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row @if($property->occupied == 2 || is_null($property->occupied)) hide @endif">
            <label for="occ_per_pofis" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.release_date')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g" id="occ_per_pofis">
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
            <label for="pofis_layout" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.layout')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns t_m-b-20" id="pofis_layout" data-toggle="buttons">
                @foreach($office_repairs as $office_repair)
                    <label class="btn btn-primary {{$office_repair->id == 1 ? 'cusBorRad1' :''}} {{$office_repair->id == 4 ? 'cusBorRad2' :''}} {{$property->office_repair_id == $office_repair->id ? 'active' : ''}}">
                        <input type="radio" name="layout" value="{{$office_repair->id}}" {{$property->office_repair_id == $office_repair->id ? 'checked=checked' : ''}} />@if(Lang::locale() == 'ru') {{$office_repair->repair_ru}}
                        @elseif(Lang::locale() == 'en') {{$office_repair->repair_en}}
                        @else {{$office_repair->repair_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_num_wet_points" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_wet_points')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="wet_points" id="pofis_num_wet_points" class="form-control white_form selectpicker">
                    <option disabled {{ is_null( $property->wet_points ) ? 'selected': '' }} class="hide">{{__('messages.no_select')}}</option>
                    <option value="0" {{ ($property->wet_points == 0) &&  !is_null($property->wet_points) ? 'selected' : '' }} >{{  __('messages.no_exist') }}</option>
                    @for($i=1; $i <= 4; $i++)
                        <option value="{{ $i }}" {{$property->wet_points == $i ? 'selected' :''}} > {{ $i }}</option>        
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_elec_pow" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.elec_pow')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="1" max="5000" class="form-control white_form" name="elec_pow" id="pofis_elec_pow" value="{{$property->electric_power > 0 ? $property->electric_power : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.kW')}}</span>
        </div>
        <div class="form-group row">
            <label for="pofis_condition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.condition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="cond" id="pofis_condition" class="form-control white_form selectpicker">
                    @foreach($office_conditions as $office_condition)
                        <option value="{{$office_condition->id}}" {{$property->office_condition_id == $office_condition->id ? 'selected' :''}}>@if(Lang::locale() == 'ru') {{$office_condition->condition_ru }}
                        @elseif(Lang::locale() == 'en') {{$office_condition->condition_en }}
                        @else {{$office_condition->condition_tm }}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_furniture" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.furniture')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pofis_furniture" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->furniture == 1 ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="1" {{$property->furniture == 1 ? 'checked=checked' : ''}} />{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2 {{!is_null($property->furniture) && ($property->furniture == 0) ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="0" {{!is_null($property->furniture) && ($property->furniture == 0) ? 'checked=checked' : ''}} />{{__('messages.no_exist')}}</label>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pofis_entrance" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.entrance')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns1" id="pofis_entrance" data-toggle="buttons">
                @foreach($entrances as $entrance)
                    <label class="btn btn-primary {{$entrance->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}} {{$entrance->id == $property->entrance_id ? 'active': ''}}">
                        <input type="radio" name="entry" value="{{$entrance->id}}" {{$entrance->id == $property->entrance_id ? 'checked=checked': ''}} />@if(Lang::locale() == 'ru') {{$entrance->entrance_ru}}
                            @elseif(Lang::locale() == 'en') {{$entrance->entrance_en}}
                            @else {{$entrance->entrance_tm }}
                            @endif</label>
                @endforeach
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pofis_parking" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pofis_parking" data-toggle="buttons">
                @foreach($parkings as $parking)
                    @if($parking->id != 3 && $parking->id != 4)
                        <label id="sale_office" class="btn btn-primary {{$parking->id == 1 ? 'cusBorRad1' : ''}} {{$parking->id == 5 ? 'cusBorRad2' : ''}} {{$parking->id == $property->parking_id ? 'active' : ''}}">
                            <input type="radio" id="{{$parking->id == 5 ? 'both_park' : ''}}" name="parking" {{$parking->id == $property->parking_id ? 'checked=checked' : ''}} 
                             {{$parking->id == 5 ? 'onchange=showInput()' :'onchange=hideInput()'}} value="{{$parking->id}}">@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                            @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                            @else {{$parking->parking_tm}}
                            @endif</label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="ofis_cost" id="first-sale_office" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num" id="ofis_cost" value="{{$property->parking_spots > 0 ? $property->parking_spots : ''}}"/>
            </div>
        </div>
        <div class="form-group row" id="ex_parking_spots_sale_office" style="display: none">
            <label for="ofis_cost" id="second-sale_office" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num_ex" value="{{$property->parking_spots_ex > 0 ? $property->parking_spots_ex : ''}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_entry_cost" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.entry_cost')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g fly_mob5">
                <input type="number" min="0.5" max="1500" class="form-control white_form m_m-b-5" id="pofis_entry_cost" name="cost" step="0.1" value="{{ $property->parking_price !== 0 ? $property->parking_price : '' }}" {{!is_null($property->parking_price) && $property->parking_price == 0 ? 'disabled=disabled' : '' }} />
                <span class="cSpan1">TMT</span>
            </div>
            <span class="cSpan dCol fly_mob6 m_m-b-5">{{__('messages.for_month')}}<input type="checkbox" 
                id="pofis_entry_free" name="entry_free" class="cusCheckBox m_hide" value="1" {{ !is_null($property->parking_price) && ($property->parking_price == 0) ? 'checked=checked' : ''}}>
                <label for="pofis_entry_free" class="f_wrap m_hide m-l-30 {{ !is_null($property->parking_price) && ($property->parking_price == 0) ? 'active' : ''}}">{{__('messages.free')}}</label>
            </span>
            <span class="col-xs-8 m-t-10 m-b-20 m_show">
                <input type="checkbox" id="pofis_entry_free1" name="entry_free1" class="cusCheckBox" value="1" {{ !is_null($property->parking_price) && ($property->parking_price == 0) ? 'checked=checked' : ''}}>
                <label for="pofis_entry_free1" class="f_wrap m_m-l-0 {{ !is_null($property->parking_price) && ($property->parking_price == 0) ? 'active' : ''}}">{{__('messages.free')}}</label>
            </span>
        </div>
        <br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pofis_t_build" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_build')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <select name="t_build" id="pofis_t_build" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->building_type_id) ? 'selected' : ''}}>{{__('messages.poss_appoint_holder')}}</option>
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
            <label for="pofis_a_build" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.a_build')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" class="form-control white_form" id="pofis_a_build" name="a_build" step="0.01" value="{{ $property->building_area }}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pofis_land" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.land')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="0.01" max="200" class="form-control white_form m_m-b-5" id="pofis_land" name="lArea" step="0.01" value="{{$property->land_area > 0 ? $property->land_area : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.ga')}}
                <span class="anwrap m-l-20 land_opts m_hide">
                    @foreach($land_owning_types as $land_owning_type)
                    <label class="radOn w-auto">
                        <input type="radio" name="land_type" value="{{$land_owning_type->id}}" {{$land_owning_type->id == $property->land_owning_type_id ? 'checked=checked':''}} />
                        <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$land_owning_type->type_ru}}
                            @elseif(Lang::locale() == 'en') {{$land_owning_type->type_en}}
                            @else {{$land_owning_type->type_tm}}
                            @endif</label>
                    @endforeach
                </span>
            </span>
            <div class="col-xs-12 land_opts m_show">
                @foreach($land_owning_types as $land_owning_type)
                    <label class="radOn w-auto">
                        <input type="radio" name="land_type1" value="{{$land_owning_type->id}}" {{$land_owning_type->id == $property->land_owning_type_id ? 'checked':''}} />
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
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="vent_opt4" name="vent_opt" class="cusCheckBox" value="1" {{ $property->ventilation_id ? 'checked=checked' :''}}>
                        <label for="vent_opt4" id="vent_4"><b>{{__('messages.ventilation')}}</b></label>
                    </span>
                    @foreach($ventilation as $vent)
                        <label class="radOn">
                            <input type="radio" name="vent_type" value="{{$vent->id}}" {{$vent->id == $property->ventilation_id ? 'checked=checked' :''}} />
                            <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$vent->ventilation_ru}}
                        @elseif(Lang::locale() == 'en') {{$vent->ventilation_en}}
                        @else {{$vent->ventilation_tm}}
                        @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="cond_opt4" name="cond_opt" class="cusCheckBox" value="1" {{$property->conditioning_id ? 'checked=checked' :''}} />
                        <label for="cond_opt4" id="cond_4"><b>{{__('messages.air_cond')}}</b></label>
                    </span>
                    @foreach($conditioning as $cond)
                        <label class="radOn">
                            <input type="radio" name="cond_type" value="{{$cond->id}}" {{$cond->id == $property->conditioning_id ? 'checked=checked' :''}} />
                            <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$cond->conditioning_ru}}
                        @elseif(Lang::locale() == 'en') {{$cond->conditioning_en}}
                        @else {{$cond->conditioning_tm}}
                        @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="heat_opt4" name="heat_opt" class="cusCheckBox" value="1" {{ $property->heating_id ? 'checked=checked' :''}} />
                        <label for="heat_opt4" id="heat_4"><b>{{__('messages.heating_system')}}</b></label>
                    </span>
                    @foreach($heating as $heat)
                        @if($heat->type == 1)
                            <label class="radOn">
                                <input type="radio" name="heating" value="{{$heat->id}}" {{$heat->id == $property->heating_id ? 'checked=checked' :''}} />
                                <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                            @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                            @else {{$heat->heating_tm}}
                            @endif</label>
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-6 anwrap m_p-l-0">
                    <span class="cusSpan">
                        <input type="checkbox" id="fextin_opt4" name="fextin_opt" class="cusCheckBox" value="1" {{$property->firefighting_id ? 'checked' :''}} />
                        <label for="fextin_opt4" id="fextin_4"><b>{{__('messages.fire_extin')}}</b></label>
                    </span>
                    @foreach($firefighting as $firefight)
                        <label class="radOn">
                            <input type="radio" name="fextin_type" value="{{$firefight->id}}" {{$firefight->id == $property->firefighting_id ? 'checked' :''}} />
                            <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$firefight->firefighting_ru}}
                        @elseif(Lang::locale() == 'en') {{$firefight->firefighting_en}}
                        @else {{$firefight->firefighting_tm}}
                        @endif</label>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
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
        </div>
        <br>
        <hr>
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_14" value="{{$property->img}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_14" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <label for="pofis_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="pofis_price" name="price" step="0.1" value="{{$property->price}}" required />
                <!-- uc = условная единица /  conventional unit -->
                <select class="price_unit_wrap selectpicker" name="price_unit">
                    <option value="1" {{ $property->price_unit_id == 1 ? 'selected' : '' }}>{{__('messages.cu')}}</option>
                    <option value="2" {{ $property->price_unit_id == 2 ? 'selected' : '' }}>TMT</option>
                </select>
                <div class="hide" data-tooltip="{{ __('messages.form_feed5') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis m_m-b-40">{{ __('messages.form_feed5') }}</div>                
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_tax" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.tax')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <select name="tax" id="pofis_tax" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->tax_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach($taxes as $tax)
                        <option value="{{$tax->id}}" {{ $property->tax_id == $tax->id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$tax->tax_ru}}
                            @elseif(Lang::locale() == 'en') {{$tax->tax_en}}
                            @else {{$tax->tax_tm}}
                            @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_bonus_agent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bonus_agent')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 t_p-r-0 dec_btns b_agent m_m-b-0" id="pofis_bonus_agent" data-toggle="buttons">
                <p class="fWidth">{{__('messages.bonus_txt')}}</p><br>
                @foreach($bonus_agents as $bonus_agent)
                    <label class="btn btn-primary {{$bonus_agent->id == 1 ? 'cusBorRad1' : '' }} {{$bonus_agent->id == 3 ? 'cusBorRad2' : '' }} {{ $property->bonus_agent_id == $bonus_agent->id ? 'active' : '' }}">
                        <input type="radio" name="bonus_agent" value="{{$bonus_agent->id}}" {{ $property->bonus_agent_id == $bonus_agent->id ? 'checked=checked' : '' }}>@if(Lang::locale() == 'ru') {{$bonus_agent->bonus_ru}}
                        @elseif(Lang::locale() == 'en') {{$bonus_agent->bonus_en}}
                        @else {{$bonus_agent->bonus_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select14" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select14" class="form-control velayat_select white_form selectpicker m-b-20" required>
                    @foreach($velayats as $velayat)
                        <option value="{{$velayat->id}}" {{ $velayat->id == $property->velayat_id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                    @endforeach
                </select>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed6') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_select_14" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_14" class="form-control white_form selectpicker m-b-20" required>
                    @foreach($cities as $city)
                        <option id="{{$city->velayat_id}}" value="{{$city->id}}" {{ $city->id == $property->city_id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$city->city_ru}}
                        @elseif(Lang::locale() == 'en') {{$city->city_en}}
                        @else {{$city->city_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed7') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pofis_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_14" name="address" placeholder="{{__('messages.street_holder')}}" value="{{$property->address}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="map_14" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_14" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_14" name="lat_14">
            <input type="hidden" id="lng_14" name="lng_14">
            <input type="hidden" id="type_id" value="2" name="type_id">
            <input type="hidden" id="object_id" value="6" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 11)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>