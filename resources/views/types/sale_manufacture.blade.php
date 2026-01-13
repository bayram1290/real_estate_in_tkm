<form action="{{route('property.submit')}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_proiz propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pproiz_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{ __('messages.area') }}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="pproiz_area" class="form-control white_form" step="0.01" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pproiz_in_parts" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.in_parts')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pproiz_in_parts" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="in_parts" value="1">{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="in_parts" value="0">{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1" max="99" class="form-control white_form m_m-b-5" name="floor" id="pproiz_floor" data-dcheck="1" step="1" pattern="\d+" required/>
            </div>
            <span class="kuck_g pull-left m-t-5 m_p-l-15">{{__('messages.from')}}</span>
            <label class="kuck_g pull-left p-r-0 m-l-15 m-t-5 m_m-l-5"><i class="fa fa-certificate pull-left"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g p-l-5 m_p-l-15">                
                <input type="number" min="2" max="100" name="tot_floor" class="form-control white_form" data-dcheck="2" step="1" pattern="\d+" required/>
                <div class="hide tool_tab_max" data-tooltip="{{ __('messages.form_feed4') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed4') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_leg_add" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.leg_add')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="leg_add" id="pproiz_leg_add" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    <option value="1">{{__('messages.provided')}}</option>
                    <option value="0">{{__('messages.not_provided')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="500" class="form-control white_form" name="ceil" id="pproiz_ceil_height" step="0.01" />
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="pproiz_col_grid" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.col_grid')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="text" class="form-control white_form" name="grid" id="pproiz_col_grid" placeholder="{{__('messages.col_grid_holder')}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_floor_mat" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.floor_mat')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="floor_mat" id="pproiz_floor_mat" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($floor_materials as $floor_material)
                        <option value="{{$floor_material->id}}">@if(Lang::locale() == 'ru') {{$floor_material->material_ru}}
                        @elseif(Lang::locale() == 'en') {{$floor_material->material_en}}
                        @else {{$floor_material->material_tm}}
                        @endif</option></option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_condition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.condition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="cond" id="pproiz_condition" class="form-control white_form selectpicker">
                    @foreach($office_conditions as $condition)
                        @if($condition->id !==2)
                            <option value="{{$condition->id}}" {{$condition->id == 1 ? 'selected':''}}>@if(Lang::locale() == 'ru') {{$condition->condition_ru }}
                        @elseif(Lang::locale() == 'en') {{$condition->condition_en }}
                        @else {{$condition->condition_tm }}
                        @endif</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_ent_gate" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ent_gate')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="ent_gate" id="pproiz_ent_gate" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($gates as $gate)
                        <option value="{{$gate->id}}">@if(Lang::locale() == 'ru') {{$gate->gate_ru}}
                        @elseif(Lang::locale() == 'en') {{$gate->gate_en}}
                        @else {{$gate->gate_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pproiz_lifts" class="col-lg-4 col-md-3 col-sm-4 form-label1 text-capitalize">{{__('messages.elevs')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="pproiz_lifts">
                <div class="col-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.freight')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="100" class="form-control white_form m_m-b-10" name="freight"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="5" class="form-control white_form m_m-b-40" name="freight_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8">
                <div class="col-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.telpher')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="100" class="form-control white_form m_m-b-10" name="telpher"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="10" class="form-control white_form m_m-b-40" name="telpher_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8">
                <div class="col-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.passenger')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="100" class="form-control white_form m_m-b-10" name="passenger"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="5" class="form-control white_form m_m-b-40" name="passenger_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pproiz_crane" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.crane_equip')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="pproiz_crane">
                <div class="ccol-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.over_crane')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="20" class="form-control white_form m_m-b-10" name="cr_over"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="200" class="form-control white_form m_m-b-40" name="cr_over_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8">
                <div class="ccol-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.beam_crane')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="20" class="form-control white_form m_m-b-10" name="cr_beam"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="100" class="form-control white_form m_m-b-40" name="cr_beam_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8">
                <div class="ccol-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.crane_rail')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="20" class="form-control white_form m_m-b-10" name="cr_rail"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="250" class="form-control white_form m_m-b-40" name="cr_rail_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8">
                <div class="ccol-lg-4 col-md-4 col-sm-6 p-l-0 m-r-10 t_m-r-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.crane_gantry')}}:</span>
                    <div class="pull-right ukuck_g m-r-5 t_unmax_f-right t_m-r-0 t_w-100"><input type="number" min="0" max="20" class="form-control white_form m_m-b-10" name="cr_gantry"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_p-l-0">
                    <span class="kuck_g cusSpan1 pull-left t_w-100">{{__('messages.lift_cap')}}:</span>
                    <div class="kuck_g pull-left m-r-10 t_unmax_f-right t_m-r-0 t_p-l-0 t_w-100 m_w-90"><input type="number" min="0" max="20000" class="form-control white_form m_m-b-40" name="cr_gantry_cap" step="0.01" /></div>
                    <span class="cSpan ton_txt">{{__('messages.ton')}}</span>
                </div>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pproiz_num_wet_points" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_wet_points')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="wet_points" id="pproiz_num_wet_points" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    <option value="0">{{__('messages.no_exist')}}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_elec_pow" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.elec_pow')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="1" max="5000" class="form-control white_form" name="elec_pow" id="pproiz_elec_pow">
            </div><span class="cSpan fly_mob2">{{__('messages.kW')}}</span>
        </div>
        <div class="form-group row">
            <label for="pproiz_parking" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pproiz_parking" data-toggle="buttons">
                @foreach($parkings as $parking)
                    @if($parking->id > 2)
                        <label id="sale_manufacture" class="btn btn-primary {{$parking->id == 3 ? 'cusBorRad1' : ''}} {{$parking->id == 5 ? 'cusBorRad2' : ''}}">
                            <input type="radio" id="{{$parking->id == 5 ? 'both_park' : ''}}" name="parking"
                                   {{$parking->id == 5 ? 'onchange=showInput()' :'onchange=hideInput()'}}
                                   value="{{$parking->id}}">@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                            @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                            @else {{$parking->parking_tm}}
                            @endif</label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_parking_type" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking_type')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pproiz_parking_type" data-toggle="buttons">
                @foreach($parking_types as $parking_type)
                    <label class="btn btn-primary {{$parking_type->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}}">
                        <input type="radio" name="park_type" value="{{$parking_type->id}}">@if(Lang::locale() == 'ru') {{$parking_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$parking_type->type_en}}
                        @else {{$parking_type->type_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="ofis_cost"
                   id="first-sale_manufacture"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number"
                       min="1"
                       max="1000"
                       class="form-control white_form"
                       name="place_num"
                       id="ofis_cost">
            </div>
        </div>
        <div class="form-group row" id="ex_parking_spots_sale_manufacture" style="display: none">
            <label for="ofis_cost"
                   id="second-sale_manufacture"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number"
                       min="1"
                       max="1000"
                       class="form-control white_form"
                       name="place_num_ex">
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_entry_cost" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.entry_cost')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-5 fly_mob5 m_m-r-0">
                <input type="number" min="1" max="5000" class="form-control white_form m_m-b-5" id="pproiz_entry_cost" name="cost" step="0.01" />
                <span class="cSpan1">TMT</span>
            </div>
            <span class="cSpan dCol1 fly_mob6 m_m-b-5 pretCusFont">{{__('messages.for_month')}}
                <div class="pretty p-icon p-curve p-pulse en_free_wrap m_hide m-l-50">
                    <input type="checkbox" name="entry_free" value="1">
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.free')}}</label>
                    </div>
                </div>
            </span>
            <span class="col-xs-8 m-t-10 m-b-20 m_show pretCusFont">
                <div class="pretty p-icon p-curve p-pulse en_free_wrap">
                    <input type="checkbox" name="entry_free1" value="1">
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.free')}}</label>
                    </div>
                </div>
            </span>
        </div><br>
        <div class="form-group row">
            <label for="pproiz_services" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.add_service')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="pproiz_services">
                <ul>
                    @foreach($add_services as $add_service)
                        <li>
                            <div class="pretty p-icon p-curve p-pulse">
                                <input type="checkbox" name="service[]" value="{{$add_service->id}}">
                                <div class="state p-primary-o">
                                    <i class="icon fa fa-check" aria-hidden="true"></i>
                                    <label>@if(Lang::locale() == 'ru') {{$add_service->service_ru}}
                                        @elseif(Lang::locale() == 'en') {{$add_service->service_en}}
                                        @else {{$add_service->service_tm}}
                                    @endif</label>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <br>
        <br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pproiz_t_build" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_build')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="t_build" id="pproiz_t_build" class="form-control white_form selectpicker">
                    <option selected disabled class="hide">{{__('messages.poss_appoint_holder')}}</option>
                    @foreach($building_types as $building_type)
                        <option value="{{$building_type->id}}">@if(Lang::locale() == 'ru') {{$building_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$building_type->type_en}}
                        @else {{$building_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_a_build" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.a_build')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" class="form-control white_form" id="pproiz_a_build" name="a_build" step="0.01" />
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pproiz_land" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.land')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="0.01" max="10000" class="form-control white_form t_m-b-10 m_m-b-5" id="pproiz_land" name="lArea" step="0.01" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.ga')}}<span class="anwrap m-l-20 land_opts m_hide">
                    @foreach($land_owning_types as $land_owning_type)
                        <label class="radOn w-auto"><input type="radio" name="land_type" value="{{$land_owning_type->id}}" {{$land_owning_type->id == 1 ? 'checked':''}}>
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
                        <input type="radio"
                                name="land_type1"
                                value="{{$land_owning_type->id}}">
                        <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$land_owning_type->type_ru}}
                                    @elseif(Lang::locale() == 'en') {{$land_owning_type->type_en}}
                                    @else {{$land_owning_type->type_tm}}
                                    @endif</label>
                @endforeach
            </div>
        </div><br>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h_inBen">
                <div class="col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="vent_7" name="vent_opt" value="1">
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.ventilation')}}</b></label>
                        </div>
                    </div>
                    @foreach($ventilation as $vent)
                        <label class="radOn">
                            <input type="radio" name="vent_type" value="{{$vent->id}}">
                            <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$vent->ventilation_ru}}
                            @elseif(Lang::locale() == 'en') {{$vent->ventilation_en}}
                            @else {{$vent->ventilation_tm}}
                        @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="cond_7" name="cond_opt" value="1">
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.air_cond')}}</b></label>
                        </div>
                    </div>
                    @foreach($conditioning as $cond)
                        <label class="radOn">
                            <input type="radio" name="cond_type" value="{{$cond->id}}">
                            <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$cond->conditioning_ru}}
                            @elseif(Lang::locale() == 'en') {{$cond->conditioning_en}}
                            @else {{$cond->conditioning_tm}}
                        @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="heat_7" name="heat_opt" value="1">
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.heating_system')}}</b></label>
                        </div>
                    </div>
                    @foreach($heating as $heat)
                        @if($heat->type == 1)
                            <label class="radOn">
                                <input type="radio" name="heating" value="{{$heat->id}}">
                                <span class="outer">
                                    <span class="inner"></span>
                                </span>@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                            @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                            @else {{$heat->heating_tm}}
                            @endif</label>
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="fextin_7" name="fextin_opt" value="1">
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.fire_extin')}}</b></label>
                        </div>
                    </div>
                    @foreach($firefighting as $firefight)
                        <label class="radOn">
                            <input type="radio" name="fextin_type" value="{{$firefight->id}}">
                            <span class="outer">
                                <span class="inner"></span>
                            </span>@if(Lang::locale() == 'ru') {{$firefight->firefighting_ru}}
                            @elseif(Lang::locale() == 'en') {{$firefight->firefighting_en}}
                            @else {{$firefight->firefighting_tm}}
                            @endif</label>
                    @endforeach
                </div>
            </div>
        </div><br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.infras')}}</h4>
        </div>
        <div class="form-group row">
            <div class="col-md-12 p-l-0 inf_Ben">
                <div class="col-md-4 col-sm-4 col-xs-12 anwrap t_p-r-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $infra)
                            @if($infra->id == 1 || $infra->id == 7 || $infra->id == 8 )
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$infra->id}}">
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$infra->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$infra->infrastructure_en}}
                                            @else {{$infra->infrastructure_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $infra)
                            @if($infra->id >= 12 && $infra->id < 15)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$infra->id}}">
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$infra->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$infra->infrastructure_en}}
                                            @else {{$infra->infrastructure_tm}}
                                            @endif</label>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach                        
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <ul class="feat_list t_m-b-0">
                        @foreach($infrastructure as $infra)
                            @if($infra->id == 16 || $infra->id == 17 || $infra->id == 21)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="infras[]" value="{{$infra->id}}">
                                        <div class="state p-primary-o">
                                            <i class="icon fa fa-check" aria-hidden="true"></i>
                                            <label>@if(Lang::locale() == 'ru') {{$infra->infrastructure_ru}}
                                            @elseif(Lang::locale() == 'en') {{$infra->infrastructure_en}}
                                            @else {{$infra->infrastructure_tm}}
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
        <div id="drag_17" class="drag-and-drop-zone dm-uploader p-5 text-center">
            <h3 class="mb-5 mt-5 text-muted">{{__('messages.drag_n_drop')}}</h3>

            <div class="btn btn-prima btn-block mb-5">
                <span>{{__('messages.open_file_browser')}}</span>
                <input type="file" title="Click to add Files">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div><br><br>
        <hr>
        <div class="description m-b-40">
            <div class="basic_information">
                <h4 class="inner-title">{{__('messages.description')}}</h4>
            </div>
            <textarea name="description" placeholder="{{__('messages.enter_desc')}}" class="form_description" required>{{old('description')}}</textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pproiz_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="pproiz_price" name="price" step="0.1" required/>
                <!-- uc = условная единица /  conventional unit -->
                <select class="price_unit_wrap selectpicker" name="price_unit">
                    <option value="1">{{__('messages.cu')}}</option>
                    <option value="2" selected>TMT</option>
                </select>
                <div class="hide" data-tooltip="{{ __('messages.form_feed5') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis m_m-b-40">{{ __('messages.form_feed5') }}</div>                
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_tax" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.tax')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <select name="tax" id="pproiz_tax" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($taxes as $tax)
                        <option value="{{$tax->id}}">@if(Lang::locale() == 'ru') {{$tax->tax_ru}}
                            @elseif(Lang::locale() == 'en') {{$tax->tax_en}}
                            @else {{$tax->tax_tm}}
                            @endif</option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pproiz_bonus_agent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bonus_agent')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 t_p-r-0 dec_btns m_m-b-0 b_agent" id="pproiz_bonus_agent" data-toggle="buttons">
                <p class="fWidth">{{__('messages.bonus_txt')}}</p><br>
                @foreach($bonus_agents as $bonus_agent)
                    <label class="btn btn-primary {{$bonus_agent->id == 1 ? 'cusBorRad1 active' : ''}} {{$bonus_agent->id == 3 ? 'cusBorRad2' : ''}}">
                        <input type="radio" name="bonus_agent" value="{{$bonus_agent->id}}" {{$bonus_agent->id == 1 ? 'checked':''}}>@if(Lang::locale() == 'ru') {{$bonus_agent->bonus_ru}}
                        @elseif(Lang::locale() == 'en') {{$bonus_agent->bonus_en}}
                        @else {{$bonus_agent->bonus_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div><br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select17" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select17" class="form-control velayat_select white_form selectpicker m-b-0" required>
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @foreach($velayats as $velayat)
                        <option value="{{$velayat->id}}">@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                    @endforeach
                </select>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed6') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_select_17" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_17" class="form-control white_form selectpicker m-b-0" required>
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @foreach($cities as $city)
                        <option id="{{$city->velayat_id}}" value="{{$city->id}}">@if(Lang::locale() == 'ru') {{$city->city_ru}}
                        @elseif(Lang::locale() == 'en') {{$city->city_en}}
                        @else {{$city->city_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed7') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pproiz_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_17" name="address" placeholder="{{__('messages.street_holder')}}" required/>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="map_17" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_17" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_17" name="lat_17">
            <input type="hidden" id="lng_17" name="lng_17">
            <input type="hidden" id="type_id" value="2" name="type_id">
            <input type="hidden" id="object_id" value="9" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 11)" class="btn btn-default">{{__('messages.submit')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>

    </div>
</form>