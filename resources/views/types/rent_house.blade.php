<form action="{{route('property.submit')}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="ar_dom propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="dom_n_settlement" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.name')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 ubuyk_g">
                <input type="text" name="n_settlement" id="dom_n_settlement" class="form-control white_form">
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" name="const_year" id="dom_const_year" class="form-control white_form" min="1900" max="{{ now()->year }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="t_house" id="dom_t_house" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($buildings as $building)
                        <option value="{{$building->id}}">@if(Lang::locale() == 'ru') {{$building->building_ru}}
                        @elseif(Lang::locale() == 'en') {{$building->building_en}}
                        @else {{$building->building_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_tot_rooms" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_rooms')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="tot_rooms" id="dom_tot_rooms" class="form-control white_form selectpicker">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @for($i=1; $i <= 6; $i++)
                        <option value="{{$i}}">{{$i}}</option>    
                    @endfor
                    <option value="7">7 {{__('messages.or_more')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.tot_area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" class="form-control white_form" id="dom_tot_area" name="tot_area" step="0.01" required/>
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="dom_floor_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.total_floor1')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="1" max="10" class="form-control white_form" name="tot_floor" id="dom_floor_house">
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_num_beds" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_beds')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g" id="num_beds">
                <input type="number" min="0" max="20" class="form-control white_form" id="dom_num_beds" name="num_beds">
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_bath" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bath')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="dom_bath" data-toggle="buttons">
                @foreach($bathrooms as $bathroom)
                    <label class="btn btn-primary {{$bathroom->id == 1 ? 'cusBorRad1' : ''}} {{$bathroom->id == 3 ? 'cusBorRad2' : ''}}">
                        <input type="radio" name="bath" value="{{$bathroom->id}}">@if(Lang::locale() == 'ru') {{$bathroom->bathroom_ru}}
                                    @elseif(Lang::locale() == 'en') {{$bathroom->bathroom_en}}
                                    @else {{$bathroom->bathroom_tm}}
                                    @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_heating" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.heating_system')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="heating" id="dom_heating" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($heating as $heat)
                        @if($heat->type == 2)
                            <option value="{{$heat->id}}">@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                                    @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                                    @else {{$heat->heating_tm}}
                                    @endif</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_decor" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.decor')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="dom_decor" data-toggle="buttons">
                @foreach($revamps as $revamp)
                    <label class="btn btn-primary {{$revamp->id == 1 ? 'cusBorRad1' :''}} {{$revamp->id == 4 ? 'cusBorRad2' :''}} {{$revamp->id == 1 ? 'active' : ''}}">
                        <input type="radio" name="decor" value="{{$revamp->id}}" {{$revamp->id == 1 ? 'checked=checked':''}}>@if(Lang::locale() == 'ru') {{$revamp->type_ru}}
                               @elseif(Lang::locale() == 'en') {{$revamp->type_en}}
                               @else {{$revamp->type_tm}}
                               @endif</label>
                @endforeach
            </div>
        </div><br>
        <div class="form-group row">
            <label for="dom_inHouse" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.inHouse')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 add_ins" id="dom_inHouse">
                <div class="col-md-4 col-sm-12 t_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->type == 1)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}">
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
                <div class="col-md-4 col-sm-12 t_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->type == 2)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}">
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
                <div class="col-md-4 col-sm-12 t_p-l-0">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->type == 3)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}">
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
        </div><br><br>
        <div class="form-group row">
            <label for="dom_land_area" class="col-lg-4 col-md-3 col-sm-4 col-xs-12 form-label1 p-r-0">{{__('messages.land_area')}}<i class="fa fa-certificate s_req"></i></label>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-7 p-r-0 norm_g">
                <input type="number" min="0.01" max="200" class="form-control cusBorRad3 white_form" step="0.01" id="dom_land_area" name="lArea" required>
                <div class="hide tooltip_r_125" data-tooltip="{{ __('messages.form_feed10') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed10') }}</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-5 p-l-0 nkuck_g">
                <select name="land_unit" class="form-control selectpicker cusBorRad5 white_form">
                    @foreach($land_area_types as $land_area_type)
                        <option value="{{$land_area_type->id}}" {{$land_area_type->id==1 ? 'selected':''}}>@if(Lang::locale() == 'ru') {{$land_area_type->type_ru}}
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
        <div id="drag_2" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
        </div>
        <br><br>
        <hr>
        <div class="description m-b-40">
            <div class="basic_information">
                <h4 class="inner-title">{{__('messages.description')}}</h4>
            </div>
            <textarea name="description" placeholder="{{__('messages.enter_desc')}}" class="form_description" required></textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="dom_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price_month')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g fly_mob3 m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="dom_price" name="price" step="0.1" required/>
                <!-- uc = условная единица /  conventional unit -->
                <select class="price_unit_wrap selectpicker" name="price_unit">
                    <option value="1">{{__('messages.cu')}}</option>
                    <option value="2" selected>TMT</option>
                </select>
                <div class="hide" data-tooltip="{{ __('messages.form_feed5') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed5') }}</div>                
            </div><span class="cSpan fly_mob4">{{__('messages.for_month')}}</span>
        </div>
        <div class="form-group row">
            <div class="col-lg-8 col-md-9 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-4 pretCusFont">
                <div class="pretty p-icon p-curve p-pulse">
                    <input type="checkbox" name="barg_poss" value="1">
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.barg_poss')}}</label>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="dom_comm_payment" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.comm_payment')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns1" id="dom_comm_payment" data-toggle="buttons">
                <label for="comm_payment" class="btn btn-primary cusBorRad1 active">
                    <input type="radio" name="comm_payment" value="1" checked> {{__('messages.incl_yes')}}
                </label>
                <label class="btn btn-primary cusBorRad2">
                    <input type="radio" name="comm_payment" value="0"> {{__('messages.incl_no')}}
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_rent_period" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.rent_period')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns1" id="dom_rent_period" data-toggle="buttons">
                @foreach($rent_terms as $rent_term)
                    <label class="btn btn-primary {{$rent_term->id == 1 ? 'cusBorRad1 active' : 'cusBorRad2'}}">
                        <input type="radio" name="rent_period" value="{{$rent_term->id}}" {{$rent_term->id == 1 ? 'checked' : ''}}>@if(Lang::locale() == 'ru') {{$rent_term->term_ru}}
                        @elseif(Lang::locale() == 'en') {{$rent_term->term_en}}
                        @else {{$rent_term->term_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_prepayment" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.prepayment')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="prepayment" id="dom_prepayment">
                    <option selected disabled style="display:none">{{__('messages.no_select')}}</option>
                    <option value="1" >1 {{__('messages.month1')}}</option>
                    <option value="2" >2 {{__('messages.month2')}}</option>
                    <option value="3" >3 {{__('messages.month2')}}</option>
                    <option value="4" >4 {{__('messages.month2')}}</option>
                    <option value="5" >5 {{__('messages.month3')}}</option>
                    <option value="6" >6 {{__('messages.month3')}}</option>
                    <option value="7" >7 {{__('messages.month3')}}</option>
                    <option value="8" >8 {{__('messages.month3')}}</option>
                    <option value="9" >9 {{__('messages.month3')}}</option>
                    <option value="10" >10 {{__('messages.month3')}}</option>
                    <option value="11" >11 {{__('messages.month3')}}</option>
                    <option value="12" >1 {{__('messages.year')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_own_deposit" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.own_deposit')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" name="own_deposit" id="dom_own_deposit" class="form-control white_form" min="0" step="0.1" />
                <span class="cSpan1">TMT</span>
            </div>
        </div><br>
        {{-- Don't remove this part, need to discuss about it later --}}
        {{--<br>--}}
        {{--<div class="form-group row">--}}
            {{--<div class="col-md-12"><p>{{__('messages.rental_cost')}}</p></div>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="dom_percent1" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.percent_warn1')}}<i class="fa fa-certificate pull-right"></i></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number" min="0" class="form-control white_form ic_per_wrap" id="dom_percent1" name="percent1" required><span class="ic_percent1">% </span>--}}
            {{--</div><span class="cSpan"><span class="ic_percent">% </span><input type="checkbox" id="dom_commis_client1" name="no_commis1" class="cusCheckBox" value="1"><label for="dom_commis_client1" class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        {{--<div class="form-group row">--}}
            {{--<label for="dom_percent2" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0 ic_per_lbl">{{__('messages.percent_warn2')}}<i class="fa fa-certificate pull-right"></i><br><p>{{__('messages.percent_warn3')}}</p></label>--}}
            {{--<div class="col-lg-8 col-md-9 col-sm-8 kuck_g">--}}
                {{--<input type="number" min="0" class="form-control white_form ic_per_wrap" id="dom_percent2" name="percent2" required><span class="ic_percent1">% </span>--}}
            {{--</div><span class="cSpan"><span class="ic_percent">% </span><input type="checkbox" id="dom_commis_client2" name="no_commis2" class="cusCheckBox" value="1"><label for="dom_commis_client2" class="commis_wrap">{{__('messages.no_commis')}}</label></span>--}}
        {{--</div>--}}
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select2" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select2" class="form-control velayat_select white_form selectpicker m-b-0" required>
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @foreach($velayats as $velayat)
                        <option  value="{{$velayat->id}}">@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                    @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                    @else {{$velayat->velayat_tm}}
                                    @endif</option>
                    @endforeach
                </select>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed6') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_select_2" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_2" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="dom_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_2" name="address" placeholder="{{__('messages.street_holder')}}" required>
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="map_2" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_2" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_2" name="lat_2">
            <input type="hidden" id="lng_2" name="lng_2">
            <input type="hidden" id="type_id" value="1" name="type_id">
            <input type="hidden" id="object_id" value="3" name="object_id">
            <input type="hidden" id="sale_rent" value="0" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 2)" class="btn btn-default">{{__('messages.submit')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>