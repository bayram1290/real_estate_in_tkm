<form action="{{route('property.resubmit', ['id' => $property->id])}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="prod_kv propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pkv_apart_type" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{ __('messages.apartment_type') }}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="apart_type" id="pkv_apart_type" class="form-control white_form selectpicker">
                    <option disabled class="hide" {{ is_null($property->apartment_type_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
                    @foreach( $apartment_types as $apart_type )
                        @if( $apart_type->id > 2 )
                            <option value="{{$apart_type->id}}" {{$property->apartment_type_id == $apart_type->id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$apart_type->type_ru}}
                            @elseif(Lang::locale() == 'en') {{$apart_type->type_en}}
                            @else {{$apart_type->type_tm}}
                            @endif</option>
                        @endif
                    @endforeach
                </select>
            </div>
            
        </div>
        <div class="form-group row">
            <label for="pkv_tot_rooms" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.num_rooms')}}
                <i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select class="form-control white_form selectpicker" name="tot_rooms" id="pkv_tot_rooms" required>
                    @for($i=1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ $i == $property->rooms ? 'selected' : '' }}>
                            @if( $i < 6 ) {{ $i }}
                            @elseif( $i == 6 ) {{ $i }} {{__('messages.and_more')}}
                            @elseif( $i == 7 ) {{__('messages.free_layout')}}
                            @else {{__('messages.studio')}}
                            @endif
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.tot_area')}}<i
                        class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" class="form-control white_form" id="pkv_tot_area" name="tot_area"
                       step="0.01" value="{{$property->area}}" required/>
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pkv_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i
                        class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1" max="99" class="form-control white_form" id="pkv_floor" name="floor"
                       value="{{ $property->floor > 0 ? $property->floor : '' }}" required/>
                <div class="hide" data-tooltip="{{ __('messages.form_feed3') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed3') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_tot_floor1"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.total_floor1')}}<i
                        class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="2" max="100" class="form-control white_form" id="pkv_tot_floor1" name="tot_floor"
                       value="{{ $property->floors_in_home > 0 ? $property->floors_in_home : '' }}" required/>
                <div class="hide" data-tooltip="{{ __('messages.form_feed9') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed9') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_residential"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.residential')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" max="200" class="form-control white_form" id="pkv_residential" name="resid"
                       step="0.01" value="{{ $property->living > 0 ? $property->living : '' }}"/>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pkv_kitchen" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.kitchen')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" max="200" class="form-control white_form" name="kitchen" id="pkv_kitchen" step="0.01"
                       value="{{ $property->kitchen_area > 0 ? $property->kitchen_area : '' }}"/>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="pkv_ceil_height" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="10" class="form-control white_form" name="ceil" id="pkv_ceil_height" step="0.01" value="{{$property->ceil_height > 0 ? $property->ceil_height : ''}}"/>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="pkv_decor" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.decor')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pkv_decor" data-toggle="buttons">
                @foreach($revamps as $revamp)
                    <label class="btn btn-primary {{$revamp->id == 1 ? 'cusBorRad1' :''}} {{$revamp->id == 4 ? 'cusBorRad2' :''}} {{$revamp->id == $property->revamp_id ? 'active' : ''}}">
                        <input type="radio" name="decor"
                               value="{{$revamp->id}}" {{$revamp->id == $property->revamp_id ? 'checked=checked':''}}>@if(Lang::locale() == 'ru') {{$revamp->type_ru}}
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
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}"
                                        @foreach($property->feature as $feat)
                                            @if($feat->id == $feature->id)
                                                checked
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
                <div class="col-lg-6 col-md-6">
                    <ul class="feat_list">
                        @foreach($features as $feature)
                            @if($feature->id > 3 && $feature->id < 7 )
                                <li>
                                    <div class="pretty p-icon p-curve p-pulse">
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}"
                                        @foreach($property->feature as $feat)
                                            @if($feat->id == $feature->id)
                                                checked
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
                <input type="text" max="100" name="n_settlement" id="pkv_name" class="form-control white_form" value="{{ $property->village_name }}"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_const_year"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1900" max="{{ now()->year }}" class="form-control white_form" id="pkv_const_year" name="const_year"
                       value="{{$property->construction_year > 0 ? $property->construction_year : '' }}"/>
            </div>
        </div>        
        <div class="form-group row">
            <label for="pkv_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select class="form-control white_form selectpicker" name="t_house" id="pkv_t_house">
                    <option disabled
                            class="hide" {{ is_null($property->type_property_id) ? 'selected' : '' }}>{{__('messages.no_select')}}</option>
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
            <label for="pkv_pass_elevs"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.pass_elevs')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_pass_elevs"
                 data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{ $property->passenger_elevator == 0 ? 'active' : '' }}">
                    <input type="radio" name="pass_elevs"
                           value="0" {{ $property->passenger_elevator == 0 ? 'checked=checked' : '' }} />{{__('messages.no')}}
                </label>
                <label class="btn btn-primary {{ $property->passenger_elevator == 1 ? 'active' : '' }}">
                    <input type="radio" name="pass_elevs"
                           value="1" {{ $property->passenger_elevator == 1 ? 'checked=checked' : '' }} />1</label>
                <label class="btn btn-primary {{ $property->passenger_elevator == 2 ? 'active' : '' }}">
                    <input type="radio" name="pass_elevs"
                           value="2" {{ $property->passenger_elevator == 2 ? 'checked=checked' : '' }} />2</label>
                <label class="btn btn-primary {{ $property->passenger_elevator == 3 ? 'active' : '' }}">
                    <input type="radio" name="pass_elevs"
                           value="3" {{ $property->passenger_elevator == 3 ? 'checked=checked' : '' }} />3</label>
                <label class="btn btn-primary cusBorRad2 {{ $property->passenger_elevator == 4 ? 'active' : '' }}">
                    <input type="radio" name="pass_elevs"
                           value="4" {{ $property->passenger_elevator == 4 ? 'checked=checked' : '' }} />4</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="pkv_freight_elevs"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.freight_elevs')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_freight_elevs"
                 data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1 {{ $property->service_elevator == 0 ? 'active' : '' }}">
                    <input type="radio" name="freight_elevs"
                           value="0" {{ $property->service_elevator == 0 ? 'checked=checked' : '' }} />{{__('messages.no')}}
                </label>
                <label class="btn btn-primary {{ $property->service_elevator == 1 ? 'active' : '' }}">
                    <input type="radio" name="freight_elevs"
                           value="1" {{ $property->service_elevator == 1 ? 'checked=checked' : '' }} />1</label>
                <label class="btn btn-primary {{ $property->service_elevator == 2 ? 'active' : '' }}">
                    <input type="radio" name="freight_elevs"
                           value="2" {{ $property->service_elevator == 2 ? 'checked=checked' : '' }} />2</label>
                <label class="btn btn-primary {{ $property->service_elevator == 3 ? 'active' : '' }}">
                    <input type="radio" name="freight_elevs"
                           value="3" {{ $property->service_elevator == 3 ? 'checked=checked' : '' }} />3</label>
                <label class="btn btn-primary cusBorRad2 {{ $property->service_elevator == 4 ? 'active' : '' }}">
                    <input type="radio" name="freight_elevs"
                           value="4" {{ $property->service_elevator == 4 ? 'checked=checked' : '' }} />4</label>
            </div>
        </div>
        <br>        
        <div class="form-group row">
            <label for="pkv_parking" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="pkv_parking" data-toggle="buttons">
                @foreach($parkings as $parking)
                    @if($parking->id != 3 && $parking->id != 4)
                        <label id="sale_apartment"
                               class="btn btn-primary {{$parking->id == 1 ? 'cusBorRad1' : ''}} {{$parking->id == 5 ? 'cusBorRad2' : ''}} {{$parking->id == $property->parking_id ? 'active' : ''}}">
                            <input type="radio" id="{{$parking->id == 5 ? 'both_park' : ''}}" name="parking"
                                   {{$parking->id == $property->parking_id ? 'checked=checked' : ''}}
                                   {{$parking->id == 5 ? 'onchange=showInput()' : 'onchange=hideInput()' }} value="{{$parking->id}}"/>@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                            @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                            @else {{$parking->parking_tm}}
                            @endif</label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="ofis_cost" id="first-sale_apartment"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num" id="ofis_cost"
                       value="{{$property->parking_spots > 0 ? $property->parking_spots : ''}}"/>
            </div>
        </div>
        <div class="form-group row" id="ex_parking_spots_sale_apartment" style="display: none">
            <label for="ofis_cost" id="second-sale_apartment"
                   class="col-lg-4 col-md-3 col-sm-4 form-label1 dCol_txt">{{__('messages.place_num')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" min="1" max="1000" class="form-control white_form" name="place_num_ex"
                       value="{{$property->parking_spots_ex > 0 ? $property->parking_spots_ex : '' }}"/>
            </div>
        </div><br>
        <hr>        
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <input type="hidden" name="mainImg" id="mainImg_10" value="{{$property->img}}">
        @foreach($property->image as $img)
            <input type="hidden" id="{{$img->name}}"
                   value="{{$img->name}}" name="img[]">
        @endforeach
        <div id="drag_10" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
            <textarea name="description" placeholder="{{__('messages.enter_desc')}}" class="form_description"
                      required>{{ $property->description->description }}</textarea>
            <div class="alert alert-warning">{{__('messages.need_description')}}</div>
        </div>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
        </div>
        <div class="form-group row">
            <label for="pkv_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.price')}}<i
                        class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1" class="form-control price_input" id="pkv_price" name="price" step="0.1"
                       value="{{$property->price}}" required/>
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
            <label for="pkv_sale" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.sale_type')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_sale" data-toggle="buttons">
                @foreach($sale_types as $sale_type)
                    <label class="btn btn-primary {{ $sale_type->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}} {{ $property->sale_type_id == $sale_type->id ? 'active' : '' }}">
                        <input type="radio" name="sale_type" value="{{ $property->sale_type_id }}" {{ $property->sale_type_id == $sale_type->id ? 'checked' : '' }} required>@if(Lang::locale() == 'ru') {{$sale_type->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$sale_type->type_en}}
                        @else {{$sale_type->type_tm}}
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
                <select name="velayat" id="velayat_select10" class="form-control velayat_select white_form selectpicker m-b-36" required>
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
            <label for="city_select_10" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_10" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="pkv_address" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_10" name="address" placeholder="{{__('messages.street_holder')}}" value="{{$property->address}}" required/>
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
                <button name="submit" onclick="return empty(event, 8)" class="btn btn-default">{{__('messages.save_changes')}}</button>
                <p><b clas="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>