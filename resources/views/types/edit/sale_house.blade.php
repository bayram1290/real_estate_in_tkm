<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_dom propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pdom_n_settlement" class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.name')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 ubuyk_g">
                <input type="text" class="form-control white_form" name="n_settlement" id="pdom_n_settlement" value="{{ $property->village_name }}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pdom_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1900" max="{{ now()->year }}" class="form-control white_form" id="pdom_const_year" name="const_year" value="{{$property->construction_year > 0 ? $property->construction_year : '' }}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pdom_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="t_house" id="pdom_t_house" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->type_property_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach($buildings as $building)
                        <option value="{{$building->id}}" {{$property->type_property_id == $building->id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$building->building_ru}}
                            @elseif(Lang::locale() == 'en') {{$building->building_en}}
                            @else {{$building->building_tm}}
                            @endif</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="dom_tot_rooms" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.num_rooms')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="tot_rooms" id="dom_tot_rooms" class="form-control white_form selectpicker" required>
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
            <label for="pdom_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{ __('messages.tot_area') }}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" name="tot_area" id="pdom_tot_area" class="form-control white_form" step="0.01" value="{{$property->area}}" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div><span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pdom_tot_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1" required>{{__('messages.total_floor1')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="1" max="10" class="form-control white_form" name="tot_floor" id="tot_floor" value="{{ $property->floors_in_home > 0 ? $property->floors_in_home : '' }}" required />
            </div>
        </div>
        <div class="form-group row">
            <label for="pdom_num_beds" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_beds')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <input type="number" min="0" max="20" class="form-control white_form" name="num_beds" id="pdom_num_beds" value="{{ $property->num_beds > 0 ? $property->num_beds : '' }}" />
            </div>
        </div>
        <div class="form-group row">
            <label for="pdom_bath_wrap" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bath')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pdom_bath_wrap" data-toggle="buttons">
                @foreach($bathrooms as $bathroom)
                    <label class="btn btn-primary {{$bathroom->id == 1 ? 'cusBorRad1' : ''}} {{$bathroom->id == 3 ? 'cusBorRad2' : ''}}"> {{ $property->bathroom_id == $bathroom->id ? 'active' : '' }}">
                        <input type="radio" name="bath" value="{{$bathroom->id}}" {{ $property->bathroom_id == $bathroom->id ? 'checked=checked' : '' }}>@if(Lang::locale() == 'ru') {{$bathroom->bathroom_ru}}
                                    @elseif(Lang::locale() == 'en') {{$bathroom->bathroom_en}}
                                    @else {{$bathroom->bathroom_tm}}
                                    @endif</label>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="pdom_heating_system" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.heating_system')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select name="heating" id="pdom_heating_system" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->heating_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach($heating as $heat)
                        @if($heat->type == 2)
                            <option value="{{$heat->id}}" {{$property->heating_id == $heat->id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$heat->heating_ru}}
                                    @elseif(Lang::locale() == 'en') {{$heat->heating_en}}
                                    @else {{$heat->heating_tm}}
                                    @endif</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="pdom_additions" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.addition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="pdom_additions">
                <div class="col-lg-4 col-md-4">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 1 && $feature->id < 4)
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}"
                                        @foreach($property->feature as $feat)
                                            @if($feat->id == $feature->id)
                                                checked = checked
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
                <div class="col-lg-4 col-md-4">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 5 && $feature->id < 8)
                                <li><input type="checkbox" id="pdom_opt{{$feature->id}}" name="features[]" class="cusCheckBox" value="{{$feature->id}}" 
                                    @foreach($property->feature as $feat)
                                        @if($feat->id == $feature->id)
                                            checked
                                        @endif
                                    @endforeach />
                                    <label for="pdom_opt{{$feature->id}}">@if(Lang::locale() == 'ru') {{$feature->feature_ru}}
                                    @elseif(Lang::locale() == 'en') {{$feature->feature_en}}
                                    @else {{$feature->feature_tm}}
                                    @endif</label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="feat_list t_m-b-0">
                        @foreach($features as $feature)
                            @if($feature->id >= 8 && $feature->id < 11)
                                <li><input type="checkbox" id="pdom_opt{{$feature->id}}" name="features[]" class="cusCheckBox" value="{{$feature->id}}" 
                                    @foreach($property->feature as $feat)
                                        @if($feat->id == $feature->id)
                                            checked
                                        @endif
                                    @endforeach />
                                    <label for="pdom_opt{{$feature->id}}">@if(Lang::locale() == 'ru') {{$feature->feature_ru}}
                                    @elseif(Lang::locale() == 'en') {{$feature->feature_en}}
                                    @else {{$feature->feature_tm}}
                                    @endif</label>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><br>
        <div class="form-group row">
        <label for="pdom_lArea" class="col-lg-4 col-md-3 col-sm-4 col-xs-12 form-label1 p-r-0">{{__('messages.land_area')}}<i class="fa fa-certificate s_req"></i></label>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-7 p-r-0 norm_g">
                <input type="number" min="0.01" max="200" class="form-control white_form cusBorRad3" id="pdom_lArea" name="lArea" step="0.01" value="{{$property->land_area > 0 ? $property->land_area : '' }}" required />
                <div class="hide tooltip_r_125" data-tooltip="{{ __('messages.form_feed10') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed10') }}</div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-3 col-xs-5 p-l-0 nkuck_g">
                <select name="land_unit" class="form-control white_form cusBorRad5 selectpicker">
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
        {{--<div class="upload_media">--}}
            {{--<div class="basic_information">--}}
                {{--<h4 class="inner-title">{{__('messages.photos')}}</h4>--}}
            {{--</div>--}}
            {{--<p>Felis etiam erat curabitur bibendum iaculis quisque placerat egestas. Nullam, lacus dis et consectetuer rhoncus etiam. Non vitae turpis curae; lacus sociosqu. Quisque. Lobortis aliquam penatibus mi. </p>--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12">--}}
                    {{--<div class="browse_submit" id="fileupload11" style="position: relative">--}}
                        {{--<input name="img[]" type="file" id="fileupload-example-11" class="img_upload11" multiple required/>--}}
                        {{--<label class="fileupload-example-label" id="label11" for="fileupload-example-11">{{__('messages.click_for_upload')}}</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="alert alert-warning">Please uplaod the photo of the property, please keep the photo size 760X410 ratio and please upload the PDF or Doc file at the document attachment.</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_11" value="{{$property->main}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_11" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <label for="pdom_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="pdom_price" name="price" step="0.1" value="{{$property->price }}" required/>
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
            <label for="pdom_bonus_agent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.bonus_agent')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 t_p-r-0 dec_btns m_m-b-0 b_agent" id="pdom_bonus_agent" data-toggle="buttons">
                <p class="fWidth">{{__('messages.bonus_txt')}}</p><br>
                @foreach($bonus_agents as $bonus_agent)
                    <label class="btn btn-primary {{$bonus_agent->id == 1 ? 'cusBorRad1' : ''}}{{$bonus_agent->id == 3 ? 'cusBorRad2' : ''}} {{ $property->bonus_agent_id == $bonus_agent->id ? 'active' : '' }}">
                        <input type="radio" name="bonus_agent" value="{{$bonus_agent->id}}" {{ $property->bonus_agent_id == $bonus_agent->id ? 'checked=checked' : '' }}>@if(Lang::locale() == 'ru') {{$bonus_agent->bonus_ru}}
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
            <label for="velayat_select11" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select11" class="form-control velayat_select white_form selectpicker m-b-36" required>
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
            <label for="city_select_11" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_11" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="pdom_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_11" name="address" placeholder="{{__('messages.street_holder')}}" value="{{$property->address}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div><br>
        <div class="form-group row">
            <label for="map_11" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_11" class="myMap"></div>
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_11" name="lat_11">
            <input type="hidden" id="lng_11" name="lng_11">
            <input type="hidden" id="type_id" value="1" name="type_id">
            <input type="hidden" id="object_id" value="3" name="object_id">
            <input type="hidden" id="sale_rent" value="1" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 17)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>