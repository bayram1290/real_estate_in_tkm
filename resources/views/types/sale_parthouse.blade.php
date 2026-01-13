<form action="{{route('property.submit')}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_poldom propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="ppdom_n_settlement" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.name')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 ubuyk_g">
                <input type="text" class="form-control white_form" id="ppdom_n_settlement" name="n_settlement">
            </div>
        </div>
        <div class="form-group row">
            <label for="ppdom_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1900" max="{{ now()->year }}" class="form-control white_form" id="ppdom_const_year" name="const_year">
            </div>
        </div>
        <div class="form-group row">
            <label for="ppdom_share_size" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.share_size')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="text" class="form-control white_form" id="ppdom_share_size" name="rent_part" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed11') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed11') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="ppdom_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="t_house" id="ppdom_t_house" class="form-control white_form selectpicker">
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
            <label for="ppdom_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.tot_area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="ppdom_tot_area" class="form-control white_form" step="0.01" required/>
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="ppdom_total_floor1" class="col-lg-4 col-md-3 col-sm-4 form-label1" required>{{__('messages.total_floor1')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="1" max="10" class="form-control white_form" name="tot_floor" id="ppdom_total_floor1">
            </div>
        </div>
        <div class="form-group row">
            <label for="ppdom_num_beds" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_beds')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="0" max="20" class="form-control white_form" name="num_beds" id="ppdom_num_beds">
            </div>
        </div>
        <div class="form-group row">
            <label for="ppdom_bath" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bath')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="ppdom_bath" data-toggle="buttons">
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
            <label for="ppdom_heating" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.heating_system')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="heating" id="ppdom_heating" class="form-control white_form selectpicker">
                    <option value="-1" disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($heating as $heat)
                        <option value="{{$heat->id}}">@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                                    @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                                    @else {{$heat->heating_tm}}
                                    @endif</option>
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="ppdom_addition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.addition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="ppdom_addition">
                <div class="col-lg-4 col-md-4">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 1 && $feature->id < 4)
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
                <div class="col-lg-4 col-md-4">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 4 && $feature->id < 8)
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
                <div class="col-lg-4 col-md-4">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 9 && $feature->id < 11)
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
        </div><br>
        <div class="form-group row">
        <label for="ppdom_land_area" class="col-lg-4 col-md-3 col-sm-4 col-xs-12 form-label1 p-r-0">{{__('messages.land_area')}}<i class="fa fa-certificate s_req"></i></label>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-7 p-r-0 norm_g">
                <input type="number" min="0.01" max="200" class="form-control white_form cusBorRad3" id="ppdom_land_area" name="lArea" step="0.01" required />
                <div class="hide tooltip_r_125" data-tooltip="{{ __('messages.form_feed10') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed10') }}</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-5 p-l-0 nkuck_g">
                <select name="land_unit" class="form-control white_form cusBorRad5 selectpicker">
                    @foreach($land_area_types as $land_area_type)
                        <option value="{{$land_area_type->id}}" {{$land_area_type->id==1 ? 'selected':''}}>@if(Lang::locale() == 'ru') {{$land_area_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$land_area_type->type_en}}
                        @else {{$land_area_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="ppdom_land_status" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.land_status')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="land_status" id="ppdom_land_status" class="form-control white_form selectpicker" required>
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($land_statuses as $land_status)
                        <option value="{{$land_status->id}}">@if(Lang::locale() == 'ru') {{$land_status->status_ru}}
                        @elseif(Lang::locale() == 'en') {{$land_status->status_en}}
                        @else {{$land_status->status_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="hide" style="top:0" data-tooltip="{{ __('messages.form_feed18') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed18') }}</div>
            </div>
        </div><br>
        <hr>
        {{--<div class="upload_media">--}}
            {{--<div class="basic_information">--}}
                {{--<h4 class="inner-title">{{__('messages.photos')}}</h4>--}}
            {{--</div>--}}
            {{--<p>Felis etiam erat curabitur bibendum iaculis quisque placerat egestas. Nullam, lacus dis et consectetuer rhoncus etiam. Non vitae turpis curae; lacus sociosqu. Quisque. Lobortis aliquam penatibus mi. </p>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-13">--}}
                    {{--<div class="browse_submit" id="fileupload13" style="position: relative">--}}
                        {{--<input name="img[]" type="file" id="fileupload-example-13" class="img_upload13" multiple required/>--}}
                        {{--<label class="fileupload-example-label" id="label13" for="fileupload-example-13">{{__('messages.click_for_upload')}}</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="alert alert-warning">Please uplaod the photo of the property, please keep the photo size 760X410 ratio and please upload the PDF or Doc file at the document attachment.</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <div id="drag_13" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <label for="ppdom_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="ppdom_price" name="price" step="0.1" required />
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
            <label for="ppdom_bonus_agent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bonus_agent')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 t_p-r-0 dec_btns m_m-b-0 b_agent" id="ppdom_bonus_agent" data-toggle="buttons">
                <p class="fWidth">{{__('messages.bonus_txt')}}</p><br>
                @foreach($bonus_agents as $bonus_agent)
                    <label class="btn btn-primary {{$bonus_agent->id == 1 ? 'cusBorRad1 active' : ''}}{{$bonus_agent->id == 3 ? 'cusBorRad2' : ''}}">
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
            <label for="velayat_select13" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select13" class="form-control velayat_select white_form selectpicker m-b-0" required>
                    <option id="13" selected disabled class="hide">{{__('messages.no_select')}}</option>
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
            <label for="city_select_13" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_13" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="ppdom_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_13" name="address" placeholder="{{__('messages.street_holder')}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="map_13" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_13" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_13" name="lat_13">
            <input type="hidden" id="lng_13" name="lng_13">
            <input type="hidden" id="type_id" value="1" name="type_id">
            <input type="hidden" id="object_id" value="5" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 10)" class="btn btn-default">{{__('messages.submit')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>

    </div>
</form>