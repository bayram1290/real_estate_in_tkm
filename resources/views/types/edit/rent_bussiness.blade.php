<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="ar_biznes propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="biznes_f_activity" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.f_activity')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <input type="text" class="form-control p_appoit" id="rent_p_appoit" onkeypress="return possKeyPress(event, this);"/>
                <div class="mob_poss_btn hide">
                    <button type="button" class="btn-option mob_poss_accept"><i class="fa fa-check"></i></button>
                </div>
                <select name="f_activity" id="biznes_f_activity" class="form-control white_form selectpicker poss_app" required>
                    @foreach($business_types as $business_type)
                        <option value="{{$business_type->id}}" 
                        @if($property->business_type()->count() > 0)
                            @foreach($property->business_type as $poss_appoint)
                                {{ $poss_appoint->id ==  $business_type->id ? 'selected' : ''}}
                            @endforeach
                        @endif>@if(Lang::locale() == 'ru') {{$business_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$business_type->type_en}}
                        @else {{$business_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="hide t_hide_tooltip" style="top:0" data-tooltip="{{ __('messages.form_feed18') }}" data-tooltip-position="right"></div>
                <div class="multi_opt_err sel_err_invis">{{ __('messages.form_feed18') }}</div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8 appoint_wrap">
                @if($property->business_type()->count() > 0)
                    @php ($ind = 0)
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
                    @php ($i = 0)
                    @foreach($extra_possible_business_types as $extra_bus)
                        <input type="hidden" id="ex_appoint{{$i}}" name="ex_appoint[]" value="{{$extra_bus->type}}">
                        <div class="tag_spec">{{$extra_bus->type}}
                            <a href="javascript:void(0)" class="tag_spec_close" data-tag="ex_appoint{{$i++}}"><i class="fa fa-times-circle"></i></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="biznes_property_type" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.property_type')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="property_type" id="business_type_property_id" class="form-control white_form selectpicker" required>
                    @foreach($business_types_property as $btp)
                        <option value="{{$btp->id}}" {{$btp->id == $property->business_type_property_id ? 'selected' :''}}>@if(Lang::locale() == 'ru') {{$btp->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$btp->type_en}}
                        @else {{$btp->type_tm}}
                        @endif</option>
                    @endforeach
                </select>                
            </div>
        </div>
        <div class="form-group row">
            <label for="biznes_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{ __('messages.area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="biznes_area" class="form-control white_form" step="0.01" value="{{$property->area}}" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="biznes_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1" max="99" class="form-control white_form m_m-b-5" name="floor" id="biznes_floor" data-dcheck="1" step="1"  pattern="\d+" value="{{$property->floor}}" required />
            </div>
            <span class="kuck_g pull-left m-t-5 m_p-l-15">{{__('messages.from')}}</span>
            <label class="kuck_g pull-left p-r-0 m-l-15 m-t-5 m_m-l-5"><i class="fa fa-certificate pull-left"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g p-l-5 m_p-l-15">
                <input type="number" min="2" max="100" name="tot_floor" class="form-control white_form" data-dcheck="2" step="1" pattern="\d+" value="{{$property->floors_in_home}}" required />
                <div class="hide tool_tab_max" data-tooltip="{{ __('messages.form_feed4') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed4') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="biznes_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="10"  class="form-control white_form" name="ceil" id="biznes_ceil_height" step="0.01" value="{{$property->ceil_height > 0 ? $property->ceil_height : ''}}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="biznes_condition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.condition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="cond" id="biznes_condition" class="form-control white_form selectpicker">
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
            <label for="biznes_furniture" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.furniture')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="biznes_furniture" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->furniture == 1 ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="1" {{$property->furniture == 1 ? 'checked=checked' : ''}} />{{__('messages.exist')}}
                </label>
                <label class="btn btn-primary cusBorRad2 {{!is_null($property->furniture) && ($property->furniture == 0) ? 'active' : ''}}">
                    <input type="radio" name="furniture" value="0" {{!is_null($property->furniture) && ($property->furniture == 0) ? 'checked=checked' : ''}} />{{__('messages.no_exist')}}
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="biznes_equip" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.equip')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="biznes_equip" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{$property->equipment == 1 ? 'active' : ''}}">
                    <input type="radio" name="equip" value="1" {{$property->equipment == 1 ? 'checked=checked' : ''}} />{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2 {{!is_null($property->equipment) && ($property->equipment == 0) ? 'active' : ''}}">
                    <input type="radio" name="equip" value="0" {{!is_null($property->equipment) && ($property->equipment == 0) ? 'checked=checked' : ''}} />{{__('messages.no_exist')}}</label>
            </div>
        </div><br>
        <hr>
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_9" value="{{$property->img}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_9" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <label for="biznes_price_per_msq" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price_per_msq')}}<sup>2</sup><i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="biznes_price_per_msq" name="price" step="0.1" value="{{$price_rate}}" required />
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
                    <label class="radOn w-auto text-lowercase">
                        <input type="radio"name="for_period" value="{{$period->id}}" {{$period->id == $property->period_id ? 'checked=checked' : ''}} />
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
            <label for="biznes_rent_type" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.rent_type')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 btn-group toGGle dec_btns1" id="biznes_rent_type" data-toggle="buttons">
                @foreach($rent_types as $rent_type)
                    <label class="btn btn-primary {{ $rent_type->id == 1 ? 'cusBorRad1':'cusBorRad2 pass_txt1'}} {{$rent_type->id == $property->rent_type_id ? 'active' : ''}}" required>
                        <input type="radio" name="rent_type" value="{{$rent_type->id}}" {{$rent_type->id == $property->rent_type_id ? 'checked=checked' : ''}}>@if(Lang::locale() == 'ru') {{$rent_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$rent_type->type_en}}
                        @else {{$rent_type->type_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="biznes_rent_period" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.rent_period')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 btn-group toGGle dec_btns1" id="biznes_rent_period" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 active">
                    <input type="radio" name="rent_period" value="1" {{ $property->rent_term_id == 1 ? 'checked=checked' : '' }}/>{{__('messages.prolonged')}}</label>
                <label class="btn btn-primary cusBorRad2">
                    <input type="radio" name="rent_period" value="2" {{ $property->rent_term_id == 2 ? 'checked=checked' : '' }}>{{__('messages.few_month')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="biznes_min_per_rent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.min_per_rent')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0" max="120" class="form-control white_form" id="biznes_min_per_rent" name="min_rent" value="{{$property->min_term > 0 ? $property->min_term : '' }}" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.month')}}</span>
        </div>
        <div class="form-group row">
            <label for="biznes_sec_deposit" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.sec_deposit')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="0" class="form-control white_form" id="biznes_sec_deposit" name="own_deposit" step="0.1" value="{{$property->deposit_payment > 0 ? $property->deposit_payment : ''}}" />
                <span class="cSpan1">TMT</span>
            </div>
        </div>
        <div class="form-group row">
            <label for="biznes_prepayment" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.prepayment')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="prepayment" id="biznes_prepayment" required>
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
            {{--<label for="biznes_percent1" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.percent_warn1')}}<i class="fa fa-certificate pull-right"></i></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number"--}}
                       {{--min="0"--}}
                       {{--class="form-control white_form ic_per_wrap"--}}
                       {{--id="biznes_percent1"--}}
                       {{--name="percent1"--}}
                       {{--required><span class="ic_percent1">% </span>--}}
            {{--</div>--}}
            {{--<span class="cSpan"><span class="ic_percent">% </span>--}}
                {{--<input type="checkbox"--}}
                       {{--id="biznes_commis_client1"--}}
                       {{--name="commis_client1"--}}
                       {{--class="cusCheckBox"--}}
                       {{--value="1"><label for="biznes_commis_client1"--}}
                                        {{--class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="biznes_percent2" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0 ic_per_lbl">{{__('messages.percent_warn2')}}<i class="fa fa-certificate pull-right"></i><br><p>{{__('messages.percent_warn3')}}</p></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number"--}}
                       {{--min="0"--}}
                       {{--class="form-control white_form ic_per_wrap"--}}
                       {{--id="biznes_percent2"--}}
                       {{--name="percent2"--}}
                       {{--required><span class="ic_percent1">% </span>--}}
            {{--</div>--}}
            {{--<span class="cSpan"><span class="ic_percent">% </span>--}}
                {{--<input type="checkbox"--}}
                       {{--id="biznes_commis_client2"--}}
                       {{--name="commis_client2"--}}
                       {{--class="cusCheckBox"--}}
                       {{--value="1"><label for="biznes_commis_client2"--}}
                                        {{--class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select9" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select9" class="form-control velayat_select white_form selectpicker m-b-36" required>
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
            <label for="city_select_9" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_9" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="biznes_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_9" name="address" placeholder="{{__('messages.street_holder')}}" value="{{$property->address}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="map_9" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_9" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_9" name="lat_9">
            <input type="hidden" id="lng_9" name="lng_9">
            <input type="hidden" id="type_id" value="2" name="type_id">
            <input type="hidden" id="object_id" value="11" name="object_id">
            <input type="hidden" id="sale_rent" value="0" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 7)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>