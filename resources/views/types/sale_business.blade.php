<form action="{{route('property.submit')}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_biznes propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pbiz_f_activity" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.f_activity')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <input type="text" class="form-control p_appoit" id="pbiz_f_activity1" onkeypress="return possKeyPress(event, this);"/>
                <div class="mob_poss_btn hide">
                    <button type="button" class="btn-option mob_poss_accept"><i class="fa fa-check"></i></button>
                </div>
                <select name="f_activity" id="pbiz_f_activity" class="form-control white_form selectpicker poss_app" required>
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($business_types as $business_type)
                        <option value="{{$business_type->id}}">@if(Lang::locale() == 'ru') {{$business_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$business_type->type_en}}
                        @else {{$business_type->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="hide t_hide_tooltip" style="top:0" data-tooltip="{{ __('messages.form_feed18') }}" data-tooltip-position="right"></div>
                <div class="multi_opt_err sel_err_invis">{{ __('messages.form_feed18') }}</div>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8 appoint_wrap"></div>
        </div><br>
        <div class="form-group row">
            <label for="pbiz_property_type" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.property_type')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="property_type" id="pbiz_property_type" class="form-control white_form selectpicker" required>
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($business_types_property as $btp)
                        <option value="{{$btp->id}}">@if(Lang::locale() == 'ru') {{$btp->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$btp->type_en}}
                        @else {{$btp->type_tm}}
                        @endif</option>
                    @endforeach
                </select>
                <div class="hide" style="top:0" data-tooltip="{{ __('messages.form_feed18') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed18') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pbiz_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1"  name="tot_area" id="pbiz_area" class="form-control white_form" step="0.01" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pbiz_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1" max="99" class="form-control white_form m_m-b-5" name="floor" id="pbiz_floor" data-dcheck="1" step="1" pattern="\d+" required/>
            </div>
            <span class="kuck_g pull-left m-t-5 m_p-l-15">{{__('messages.from')}}</span>
            <label class="kuck_g pull-left p-r-0 m-l-15 m-t-5 m_m-l-5"><i class="fa fa-certificate pull-left"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g p-l-5 m_p-l-15">                
                <input type="number" min="2" max="100" name="tot_floor" class="form-control white_form" data-dcheck="2" step="1" pattern="\d+" required />
                <div class="hide tool_tab_max" data-tooltip="{{ __('messages.form_feed4') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed4') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pbiz_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="10" class="form-control white_form" name="ceil" id="pbiz_ceil_height" step="0.01" />
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="pbiz_condition" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.condition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="cond" id="pbiz_condition" class="form-control white_form selectpicker">
                    @foreach($office_conditions as $office_condition)
                        <option value="{{$office_condition->id}}">@if(Lang::locale() == 'ru') {{$office_condition->condition_ru }}
                        @elseif(Lang::locale() == 'en') {{$office_condition->condition_en }}
                        @else {{$office_condition->condition_tm }}
                        @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pbiz_furniture" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.furniture')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pbiz_furniture" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1">
                    <input type="radio" name="furniture" value="1" >{{__('messages.exist')}}
                </label>
                <label class="btn btn-primary cusBorRad2">
                    <input type="radio" name="furniture" value="0" >{{__('messages.no_exist')}}
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="pbiz_equip" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.equip')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="pbiz_equip" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1">
                    <input type="radio" name="equip" value="1" >{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2">
                    <input type="radio" name="equip" value="0" >{{__('messages.no_exist')}}</label>
            </div>
        </div><br>
        <hr>
        {{--<div class="upload_media">--}}
            {{--<div class="basic_information">--}}
                {{--<h4 class="inner-title">{{__('messages.photos')}}</h4>--}}
            {{--</div>--}}
            {{--<p>Felis etiam erat curabitur bibendum iaculis quisque placerat egestas. Nullam, lacus dis et consectetuer rhoncus etiam. Non vitae turpis curae; lacus sociosqu. Quisque. Lobortis aliquam penatibus mi. </p>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="browse_submit" id="fileupload19" style="position: relative">--}}
                        {{--<input name="img[]" type="file" id="fileupload-example-19" class="img_upload19" multiple required/>--}}
                        {{--<label class="fileupload-example-label" id="label19" for="fileupload-example-19">{{__('messages.click_for_upload')}}</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="alert alert-warning">Please uplaod the photo of the property, please keep the photo size 760X410 ratio and please upload the PDF or Doc file at the document attachment.</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <div id="drag_19" class="drag-and-drop-zone dm-uploader p-5 text-center">
            <h3 class="mb-5 mt-5 text-muted">{{__('messages.drag_n_drop')}}</h3>

            <div class="btn btn-prima btn-block mb-5">
                <span>{{__('messages.open_file_browser')}}</span>
                <input type="file" title="Click to add Files">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12"></div>
                </div>
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
            <textarea name="description" placeholder="{{__('messages.enter_desc')}}" class="form_description" required></textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pbiz_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="pbiz_price" name="price" step="0.1" required />
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
            <label for="pbiz_tax" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.tax')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 nbuyk_g">
                <select name="tax" id="pbiz_tax" class="form-control white_form selectpicker">
                    <option disabled selected class="hide">{{__('messages.no_select')}}</option>
                    @foreach($taxes as $tax)
                        <option value="{{$tax->id}}">@if(Lang::locale() == 'ru') {{$tax->tax_ru}}
                            @elseif(Lang::locale() == 'en') {{$tax->tax_en}}
                            @else {{$tax->tax_tm}}
                            @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pbiz_mon_profit" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.mon_profit')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" id="pbiz_mon_profit" name="mon_profit" class="form-control white_form" step="0.1" />
                <span class="cSpan1">TMT</span>
            </div>
        </div>
        <div class="form-group row">
            <label for="pbiz_properties" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.properties')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pbiz_properties" data-toggle="buttons">
                @foreach($land_owning_types as $land_owning_type)
                    @if($land_owning_type->id!==3)
                    <label class="btn btn-primary {{$land_owning_type->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}}">
                        <input type="radio" name="land_type" value="{{$land_owning_type->id}}">@if(Lang::locale() == 'ru') {{$land_owning_type->type_ru}}
                            @elseif(Lang::locale() == 'en') {{$land_owning_type->type_en}}
                            @else {{$land_owning_type->type_tm}}
                            @endif</label>
                    @endif    
                @endforeach
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="pbiz_bonus_agent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bonus_agent')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 t_p-r-0 dec_btns m_m-b-0 b_agent" id="pbiz_bonus_agent" data-toggle="buttons">
                <p class="fWidth">{{__('messages.bonus_txt')}}</p><br>
                @foreach($bonus_agents as $bonus_agent)
                    <label class="btn btn-primary {{$bonus_agent->id == 1 ? 'active cusBorRad1' : ''}} {{$bonus_agent->id == 3 ? 'cusBorRad2' : ''}}">
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
            <label for="velayat_select19" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select19" class="form-control velayat_select white_form selectpicker m-b-0" required>
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
            <label for="city_select_19" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_19" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="pbiz_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_19" name="address" placeholder="{{__('messages.street_holder')}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="map_19" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_19" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_19" name="lat_19">
            <input type="hidden" id="lng_19" name="lng_19">
            <input type="hidden" id="type_id" value="2" name="type_id">
            <input type="hidden" id="object_id" value="11" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 14)" class="btn btn-default">{{__('messages.submit')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>