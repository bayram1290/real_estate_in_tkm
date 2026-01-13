<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_zdan propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pzdan_name" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.name')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 ubuyk_g">
                <input type="text" name="n_settlement" id="pzdan_name" max="80" class="form-control white_form" value="{{$property->village_name}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" name="const_year" id="pzdan_const_year" min="1900" max="{{ now()->year }}" class="form-control white_form" value="{{$property->construction_year > 0 ? $property->construction_year : ''}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_a_build" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.a_build')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="a_build" id="pzdan_a_build" class="form-control white_form" step="0.01" value="{{ $property->building_area }}" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed15') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed15') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pzdan_b_floors" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.b_floors')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="0" max="50" name="tot_floor" id="pzdan_b_floors" class="form-control white_form" value="{{$property->floors_in_home > 0 ? $property->floors_in_home : ''}}" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed16') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed16') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="50" class="form-control white_form" name="ceil" id="pzdan_ceil_height" step="0.01" value="{{$property->ceil_height > 0 ? $property->ceil_height : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="pzdan_poss_appoint" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.poss_appoint')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g t_m-b-20">
                <select name="t_build" id="pzdan_poss_appoint" class="form-control white_form selectpicker" required>
                    @foreach($building_types as $building_type)
                        <option value="{{$building_type->id}}" {{$building_type->id == $property->building_type_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$building_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$building_type->type_en}}
                        @else {{$building_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_condition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.condition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="cond" id="pzdan_condition" class="form-control white_form selectpicker">
                    @foreach($office_conditions as $office_condition)
                        <option value="{{$office_condition->id}}" {{$office_condition->id == $property->office_condition_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$office_condition->condition_ru }}
                        @elseif(Lang::locale() == 'en') {{$office_condition->condition_en }}
                        @else {{$office_condition->condition_tm }}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_furniture" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.furniture')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pzdan_furniture" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->furniture == 1 ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="1" {{$property->furniture == 1 ? 'checked=checked' : ''}}>{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2 {{!is_null($property->furniture) && ($property->furniture == 0) ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="0" {{!is_null($property->furniture) && ($property->furniture == 0) ? 'checked=checked' : ''}}>{{__('messages.no_exist')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_land" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.land')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="0.01" max="200" class="form-control white_form m_m-b-5" id="pzdan_land" name="lArea" step="0.01" value="{{$property->land_area > 0 ? $property->land_area : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.ga')}}<span class="anwrap m-l-20 land_opts m_hide">
                    @foreach($land_owning_types as $land_owning_type)
                        <label class="radOn w-auto">
                            <input type="radio" name="land_type" value="{{$land_owning_type->id}}" {{$land_owning_type->id == $property->land_owning_type_id ? 'checked':''}}>
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
        <div class="form-group row">
            <label for="pzdan_line_houses" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.line_houses')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="line_houses" id="pzdan_line_houses" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->line_house) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    <option value="1" {{ $property->line_house == 1 ? 'selected' : '' }}>{{__('messages.first')}}</option>
                    <option value="2" {{ $property->line_house == 2 ? 'selected' : '' }}>{{__('messages.second')}}</option>
                    <option value="3" {{ $property->line_house == 3 ? 'selected' : '' }}>{{__('messages.other')}}</option>
                </select>
            </div>
        </div>
        <br><br>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 h_inBen">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="vent_5" name="vent_opt" value="1" {{ $property->ventilation_id ? 'checked' :''}}>
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.ventilation')}}</b></label>
                        </div>
                    </div>
                    @foreach($ventilation as $vent)
                        <label class="radOn">
                            <input type="radio" name="vent_type" value="{{$vent->id}}" {{$vent->id == $property->ventilation_id ? 'checked' :''}}>
                            <span class="outer">
                                <span class="inner"></span>
                            </span>@if(Lang::locale() == 'ru') {{$vent->ventilation_ru}}
                        @elseif(Lang::locale() == 'en') {{$vent->ventilation_en}}
                        @else {{$vent->ventilation_tm}}
                        @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="cond_5" name="cond_opt" value="1" {{$property->conditioning_id ? 'checked' :''}}>
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.air_cond')}}</b></label>
                        </div>
                    </div>
                    @foreach($conditioning as $cond)
                        <label class="radOn"><input type="radio" name="cond_type" value="{{$cond->id}}" {{$cond->id == $property->conditioning_id ? 'checked' :''}} />
                            <span class="outer"><span class="inner"></span></span>@if(Lang::locale() == 'ru') {{$cond->conditioning_ru}}
                        @elseif(Lang::locale() == 'en') {{$cond->conditioning_en}}
                        @else {{$cond->conditioning_tm}}
                        @endif</label>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="heat_5" name="heat_opt" value="1" {{ $property->heating_id ? 'checked' :''}}>
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.heating_system')}}</b></label>
                        </div>
                    </div>
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
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-6 anwrap m_p-l-0 pretCusFont">
                    <div class="pretty p-icon p-curve p-pulse m-l-10 m-b-15">
                        <input type="checkbox" id="fextin_5" name="fextin_opt" value="1" {{$property->firefighting_id ? 'checked' :''}}>
                        <div class="state p-primary-o">
                            <i class="icon fa fa-check" aria-hidden="true"></i>
                            <label><b class="option">{{__('messages.fire_extin')}}</b></label>
                        </div>
                    </div>                    
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
        <br><br>
        <div class="form-group row">
            <label for="pzdan" class="col-lg-4 col-md-3 col-sm-4 form-label1 text-capitalize cBr">{{__('messages.elevs')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 t_p-l-0" id="pzdan">
                <div class="col-lg-4 col-md-4 col-sm-12 p-l-0 t_p-l-15">
                    <span class="cusSpan1 col-lg-6 col-md-6 col-sm-6 col-xs-12 m_txt_up_bl p-0 t_m-r-0">{{__('messages.elevs')}}:</span>
                    <div class="ukuck_g pull-left col-lg-6 col-md-6 col-sm-6 col-xs-12 t_w_unmax p-0 t_p-l-15 m_p-l-0">
                        <input type="number" min="0" max="20" class="form-control white_form" name="elevs" value="{{$property->elevator > 0 ? $property->elevator : ''}}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-l-0 t_p-l-15">
                    <span class="cusSpan1 col-lg-6 col-md-6 col-sm-6 col-xs-12 m_txt_up_bl p-0 t_m-r-0">{{__('messages.travs')}}:</span>
                    <div class="ukuck_g pull-left col-lg-6 col-md-6 col-sm-6 col-xs-12 t_w_unmax p-0 t_p-l-15 m_p-l-0">
                        <input type="number" min="0" max="20" class="form-control white_form" name="travs" value="{{$property->trivalator > 0 ? $property->trivalator : ''}}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-l-0 t_p-l-15">
                    <span class="cusSpan1 col-lg-6 col-md-6 col-sm-6 col-xs-12 m_txt_up_bl p-0 t_m-r-0">{{__('messages.escals')}}:</span>
                    <div class="ukuck_g pull-left col-lg-6 col-md-6 col-sm-6 col-xs-12 t_w_unmax p-0 t_p-l-15 m_p-l-0" >
                        <input type="number" min="0" max="20" class="form-control white_form" name="escals" value="{{$property->escalator  > 0 ? $property->escalator : ''}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_b_enter" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.b_enter')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="building_entry" id="pzdan_b_enter" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->building_entrance_id) ? 'selected' : ''}} >{{__('messages.no_select')}}</option>
                    @foreach($building_entrances as $building_entrance)
                        <option value="{{$building_entrance->id}}" {{$building_entrance->id == $property->building_entrance_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$building_entrance->entrance_ru}}
                            @elseif(Lang::locale() == 'en') {{$building_entrance->entrance_en}}
                            @else {{$building_entrance->entrance_tm }}
                            @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_parking" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pzdan_parking" data-toggle="buttons">
                @foreach($parkings as $parking)
                    @if($parking->id != 3 && $parking->id != 4)
                        <label id="sale_building" class="btn btn-primary {{$parking->id == 1 ? 'cusBorRad1' : ''}} {{$parking->id == 5 ? 'cusBorRad2' : ''}} {{$parking->id == $property->parking_id ? 'active' : ''}}">
                            <input type="radio" id="{{$parking->id == 5 ? 'both_park' : ''}}" name="parking" {{$parking->id == 5 ? 'onchange=showInput()' :'onchange=hideInput()'}}
                            value="{{$parking->id}}" {{$parking->id == $property->parking_id ? 'checked=checked' : ''}} />@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                        @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                        @else {{$parking->parking_tm}}
                        @endif</label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_cost" id="first-sale_building" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num" id="pzdan_cost" value="{{$property->parking_spots > 0 ? $property->parking_spots : ''}}" />
            </div>
        </div>
        <div class="form-group row" id="ex_parking_spots_sale_building" style="display: none">
            <label for="pzdan_ex_cost" id="second-sale_building" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num_ex" id="pzdan_ex_cost" value="{{$property->parking_spots_ex > 0 ? $property->parking_spots_ex : ''}}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pzdan_entry_cost" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.entry_cost')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g fly_mob5">
                <input type="number" min="1" max="1500" class="form-control white_form m_m-b-5" id="pzdan_entry_cost" name="cost" step="0.1" value="{{ $property->parking_price !== 0 ? $property->parking_price : '' }}" 
                {{!is_null($property->parking_price) && $property->parking_price == 0 ? 'disabled=disabled' : '' }} />
                <span class="cSpan1">TMT</span>
            </div>

            <span class="cSpan dCol fly_mob6 m_m-b-5 pretCusFont">{{__('messages.for_month')}}
                <div class="pretty p-icon p-curve p-pulse en_free_wrap m_hide m-l-50">
                    <input type="checkbox" name="entry_free" value="1" {{ !is_null($property->parking_price)) ? 'checked' : ''}}>
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.free')}}</label>
                    </div>
                </div>
            </span>
            <span class="col-xs-8 m-t-10 m-b-20 m_show pretCusFont">
                <div class="pretty p-icon p-curve p-pulse en_free_wrap">
                    <input type="checkbox" name="entry_free1" value="1" {{ !is_null($property->parking_price) ? 'checked' : ''}}>
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.free')}}</label>
                    </div>
                </div>
            </span>
        </div><br><hr>        
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_15" value="{{$property->img}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_15" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <div class="basic_information"><h4 class="inner-title">{{__('messages.description')}}</h4></div>
            <textarea name="description" placeholder="{{__('messages.enter_desc')}}" class="form_description" required>{{$property->description->description}}</textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pzdan_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="pzdan_price" name="price" step="0.1" value="{{$property->price}}" required />
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
            <label for="pzdan_tax" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.tax')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <select name="tax" id="pzdan_tax" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->tax_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach($taxes as $tax)
                        <option value="{{$tax->id}}" {{ $property->tax_id == $tax->id ? 'selected' : '' }}>@if(Lang::locale() == 'ru') {{$tax->tax_ru}}
                        @elseif(Lang::locale() == 'en') {{$tax->tax_en}}
                        @else {{$tax->tax_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pzdan_bonus_agent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bonus_agent')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 t_p-r-0 dec_btns m_m-b-0 b_agent" id="pzdan_bonus_agent" data-toggle="buttons">
                <p class="fWidth">{{__('messages.bonus_txt')}}</p><br>
                @foreach($bonus_agents as $bonus_agent)
                    <label class="btn btn-primary {{$bonus_agent->id == 1 ? 'cusBorRad1' : ''}} {{$bonus_agent->id == 3 ? 'cusBorRad2' : ''}} {{ $property->bonus_agent_id == $bonus_agent->id ? 'active' : '' }}">
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
            <label for="velayat_select15" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select15" class="form-control velayat_select white_form selectpicker m-b-36" required>
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
            <label for="city_select_15" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_15" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="pzdan_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_15"  name="address" placeholder="{{__('messages.street_holder')}}" value="{{$property->address}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="map_15" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_15" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_15" name="lat_15">
            <input type="hidden" id="lng_15" name="lng_15">
            <input type="hidden" id="type_id" value="2" name="type_id">
            <input type="hidden" id="object_id" value="7" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 12)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>