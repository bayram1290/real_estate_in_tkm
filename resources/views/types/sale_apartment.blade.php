<form action="{{route('property.submit')}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_kv propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pkv_apart_type" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{ __('messages.apartment_type') }}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="apart_type" id="kv_apart_type" class="form-control white_form selectpicker">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @php $count = 1; @endphp
                    @foreach( $apartment_types as $apart_type )
                        @if($count > 2)
                            <option value="{{ $count }}">@if(Lang::locale() == 'ru') {{$apart_type->type_ru}}
                            @elseif(Lang::locale() == 'en') {{$apart_type->type_en}}
                            @else {{$apart_type->type_tm}}
                            @endif</option>
                        @endif
                    @php  $count++; @endphp
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_tot_rooms" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.num_rooms')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select class="form-control white_form selectpicker" name="tot_rooms" id="pkv_tot_rooms" required>
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6 {{__('messages.and_more')}}</option>
                    <option value="7">{{__('messages.free_layout')}}</option>
                    <option value="8">{{__('messages.studio')}}</option>
                </select>
                <div class="hide" style="top:0" data-tooltip="{{ __('messages.form_feed1') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed1') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.tot_area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number"
                       min="1"
                       class="form-control white_form"
                       id="pkv_tot_area"
                       name="tot_area" 
                       step="0.01"
                       required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pkv_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number"
                       min="1"
                       max="99"
                       class="form-control white_form"
                       id="pkv_floor"
                       name="floor"
                       required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed3') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed3') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_tot_floor1" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.total_floor1')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number"
                       min="2"
                       max="100"
                       class="form-control white_form"
                       id="pkv_tot_floor1"
                       name="tot_floor"
                       required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed9') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed9') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_residential" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.residential')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" max="200" class="form-control white_form" id="pkv_residential" name="resid" step="0.01" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pkv_kitchen" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.kitchen')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" max="200" class="form-control white_form" 
                       name="kitchen"
                       id="pkv_kitchen" 
                       step="0.01" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pkv_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="10" class="form-control white_form" name="ceil" id="pkv_ceil_height" step="0.01" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="pkv_decor" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.decor')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pkv_decor" data-toggle="buttons">
                @foreach($revamps as $revamp)
                    <label class="btn btn-primary {{$revamp->id == 1 ? 'cusBorRad1 active' :''}} {{$revamp->id == 4 ? 'cusBorRad2' :''}}">
                        <input type="radio" name="decor" value="{{$revamp->id}}">@if(Lang::locale() == 'ru') {{$revamp->type_ru}}
                               @elseif(Lang::locale() == 'en') {{$revamp->type_en}}
                               @else {{$revamp->type_tm}}
                               @endif</label>
                @endforeach
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="pkv_addition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.addition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="pkv_addition">
                <div class="col-lg-6 col-md-6">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 1 && $feature->id < 4 )
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
                <div class="col-lg-6 col-md-6">
                    <ul class="feat_list">
                        @foreach($features as $feature)
                            @if($feature->id > 3 && $feature->id < 7 )
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
        </div>
        <br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pkv_name" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.name')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 ubuyk_g">
                <input type="text" max="100" name="n_settlement" id="pkv_name" class="form-control white_form">
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1900" max="{{ now()->year }}" class="form-control white_form" id="pkv_const_year" name="const_year">
            </div>
        </div> 
        <div class="form-group row">
            <label for="pkv_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select class="form-control white_form selectpicker" name="t_house" id="pkv_t_house">
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
            <label for="pkv_pass_elevs" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.pass_elevs')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_pass_elevs" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 active"><input type="radio" name="pass_elevs" value="0" checked>{{__('messages.no')}}</label>
                <label class="btn btn-primary">
                    <input type="radio" name="pass_elevs" value="1" >1</label>
                <label class="btn btn-primary">
                    <input type="radio" name="pass_elevs" value="2" >2</label>
                <label class="btn btn-primary">
                    <input type="radio" name="pass_elevs" value="3" >3</label>
                <label class="btn btn-primary cusBorRad2">
                    <input type="radio" name="pass_elevs" value="4" >4</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_freight_elevs" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.freight_elevs')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_freight_elevs" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 active"><input type="radio" name="freight_elevs" value="0" checked>{{__('messages.no')}}</label>
                <label class="btn btn-primary">
                    <input type="radio" name="freight_elevs" value="1">1</label>
                <label class="btn btn-primary">
                    <input type="radio" name="freight_elevs" value="2">2</label>
                <label class="btn btn-primary">
                    <input type="radio" name="freight_elevs" value="3">3
                </label>
                <label class="btn btn-primary cusBorRad2">
                    <input type="radio" name="freight_elevs" value="4" >4</label>
            </div>
        </div>
        <br>               
        <div class="form-group row">
            <label for="pkv_parking" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pkv_parking" data-toggle="buttons">
                @foreach($parkings as $parking)
                    @if($parking->id != 3 && $parking->id != 4)
                        <label id="sale_apartment" class="btn btn-primary {{$parking->id == 1 ? 'cusBorRad1' : ''}} {{$parking->id == 5 ? 'cusBorRad2' : ''}}">
                            <input type="radio" id="{{$parking->id == 5 ? 'both_park' : ''}}" name="parking" {{$parking->id == 5 ? 'onchange=showInput()' :'onchange=hideInput()'}} value="{{$parking->id}}">@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                            @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                            @else {{$parking->parking_tm}}
                            @endif</label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="ofis_cost"
                   id="first-sale_apartment"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num" id="ofis_cost" />
            </div>
        </div>
        <div class="form-group row" id="ex_parking_spots_sale_apartment" style="display: none">
            <label for="ofis_cost"
                   id="second-sale_apartment"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num_ex" />
            </div>
        </div><br>
        <hr>        
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <div id="drag_10" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <textarea name="description"
                      placeholder="{{__('messages.enter_desc')}}"
                      class="form_description"
                      required></textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pkv_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input"  id="pkv_price" name="price" step="0.1" required />
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
            <label for="pkv_sale" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.sale_type')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_sale" data-toggle="buttons">
                @foreach($sale_types as $sale_type)
                    <label class="btn btn-primary {{$sale_type->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}}">
                        <input type="radio" name="sale_type" value="{{ $sale_type->id }}" required>@if(Lang::locale() == 'ru') {{$sale_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$sale_type->type_en}}
                        @else {{$sale_type->type_tm}}
                        @endif
                        @if($sale_type->id==2)
                            <div class="hide tool_tab_max1" style="right:-22px;top:-2px" data-tooltip="{{ __('messages.form_feed19') }}" data-tooltip-position="right"></div>
                            <div class="rad_btn_err1 sel_err_invis">{{ __('messages.form_feed19') }}</div>
                        @endif</label>
                        @if($sale_type->id==2)
                            <span class="diff_tooltip_wrap"><a class="diff_tooltip" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-html="true" title="<div class='text-left'><b>{{ __('messages.free1') }}</b> {{ __('messages.free1_sale_exp') }}</div><br><div class='text-left'><b>{{ __('messages.alternative') }}</b> {{ __('messages.alt_sale_exp') }}</div>">{{ __('messages.what_diff') }}</a></span>
                        @endif
                @endforeach
            </div>
        </div><br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select10" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat"
                        id="velayat_select10"
                        class="form-control velayat_select white_form selectpicker m-b-0"
                        required>
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
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
            <label for="city_select_10" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_10" class="form-control white_form selectpicker m-b-0" required>
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
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
            <label for="pkv_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text"
                       class="form-control white_form m-b-0"
                       id="address_10"
                       name="address"
                       placeholder="{{__('messages.street_holder')}}"
                       required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="map_10" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-5">{{__('messages.map_loc')}}</label>
        </div>
        <div id="map_10" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_10" name="lat_10">
            <input type="hidden" id="lng_10" name="lng_10">
            <input type="hidden" id="type_id" value="1" name="type_id">
            <input type="hidden" id="object_id" value="1" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 8)" class="btn btn-default">{{__('messages.submit')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>