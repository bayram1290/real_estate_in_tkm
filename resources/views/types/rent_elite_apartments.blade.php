<form action="{{route('property.submit')}}" method="post" class="submit_form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="ar_elite_kv propObj {{$hide ? 'hide' : ''}}">
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
        </div>
        <div class="form-group row">
            <label for="kv_elite_patent" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{ __('messages.patent') }}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="kv_elite_patent" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="patent" value="1">{{__('messages.exist')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="patent" value="2">{{__('messages.no_exist')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_apart_type" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{ __('messages.apartment_type') }}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select name="apart_type" id="kv_elite_apart_type" class="form-control white_form selectpicker">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @php $count = 1; @endphp
                    @foreach( $apartment_types as $apart_type )
                        @if($count < 3)
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
            <label for="kv_elite_tot_rooms" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.num_rooms')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="tot_rooms" id="kv_elite_tot_rooms" required>
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5+</option>
                </select>                
                <div class="hide" style="top:0" data-tooltip="{{ __('messages.form_feed1') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed1') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_tot_area" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.tot_area')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" class="form-control white_form" id="kv_elite_tot_area" name="tot_area" step="0.01" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed2') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed2') }}</div>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="kv_elite_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="1" max="99" class="form-control white_form" name="floor" id="kv_elite_floor" required/>
                <div class="hide" data-tooltip="{{ __('messages.form_feed3') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed3') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_tot_floor" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.total_floor')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" min="2" max="100" class="form-control white_form" name="tot_floor" id="kv_elite_tot_floor" required />
                <div class="hide" data-tooltip="{{ __('messages.form_feed9') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed9') }}</div>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_resid" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.residential')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" max="200" class="form-control white_form" name="resid" id="kv_elite_resid" step="0.01" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="kv_elite_kitchen" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.kitchen')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g fly_mob1">
                <input type="number" min="1" max="200" class="form-control white_form" name="kitchen" id="kv_elite_kitchen" step="0.01" />
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}<sup>2</sup></span>
        </div>
        <div class="form-group row">
            <label for="kv_elite_ceil" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.ceil_height')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g fly_mob1">
                <input type="number" min="0.3" max="10" class="form-control white_form" name="ceil" id="kv_elite_ceil" step="0.01"/>
            </div>
            <span class="cSpan fly_mob2">{{__('messages.meter')}}</span>
        </div>
        <div class="form-group row">
            <label for="kv_elite_decor" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.decor')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="kv_elite_decor" data-toggle="buttons">
                @foreach($revamps as $revamp)
                    <label class="btn btn-primary {{$revamp->id == 1 ? 'cusBorRad1' :''}} {{$revamp->id == 4 ? 'cusBorRad2' :''}} {{$revamp->id == 1 ? 'active' : ''}}">
                        <input type="radio" name="decor"value="{{$revamp->id}}" {{$revamp->id == 1 ? 'checked="checked"' : ''}}>@if(Lang::locale() == 'ru') {{$revamp->type_ru}}
                        @elseif(Lang::locale() == 'en') {{$revamp->type_en}}
                        @else {{$revamp->type_tm}}
                        @endif</label>
                @endforeach
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="kv_elite_num_baths" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.num_baths')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="num_baths" id="kv_elite_num_baths">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>                    
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select>                                
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_room_layout" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.room_layout')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select class="form-control white_form selectpicker" name="room_layout" id="kv_elite_room_layout">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @foreach ($room_layouts as $r_layout)
                        <option value="{{ $r_layout->id }}">@if(Lang::locale() == 'ru') {{$r_layout->room_layout_ru}}
                            @elseif(Lang::locale() == 'en') {{$r_layout->room_layout_en}}
                            @else {{$r_layout->room_layout_tm}}
                            @endif</option>
                    @endforeach
                </select>                                
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_with_animal" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.with_animal')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="kv_elite_with_animal" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="with_animal" value="1">{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="with_animal" value="0">{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_with_child" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.with_child')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="kv_elite_with_child" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="with_child" value="1">{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="with_child" value="0">{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_for_family" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.for_family')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="kv_elite_for_family" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="for_family" value="1">{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="for_family" value="0">{{__('messages.no')}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_for_single" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.for_single')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8" id="kv_elite_for_single" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="for_single" value="1">{{__('messages.yes')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="for_single" value="0">{{__('messages.no')}}</label>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="kv_elite_additions" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.addition')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8" id="kv_elite_additions">
                <div class="col-md-4 col-sm-6">
                    <ul class="feat_list">
                        <li class="list_header">{{__('messages.general')}}</li>
                        @foreach($features as $feature)
                            @if($feature->type === 1)
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
                <div class="col-md-4 col-sm-6">
                    <ul class="feat_list">
                        <li class="list_header">{{__('messages.technical')}}</li>
                        @foreach($features as $feature)
                            @if($feature->type === 2)
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
                <div class="col-md-4 col-sm-6">
                    <ul class="feat_list">
                        <li class="list_header">{{__('messages.comfort')}}</li>
                        @foreach($features as $feature)
                            @if($feature->type === 3)
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
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.a_building')}}</h4>
        </div>
        <div class="form-group row">
            <label for="kv_elite_const_year" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.const_year')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 kuck_g">
                <input type="number" class="form-control white_form" id="kv_elite_const_year" name="const_year" min="1900" max="{{ now()->year }}">
            </div>
        </div>        
        <div class="form-group row">
            <label for="kv_elite_t_house" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.t_house')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <select class="form-control white_form selectpicker" name="t_house" id="kv_elite_t_house">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    @foreach($buildings as $building)
                        @if( $building->id > 1 && $building->id < 4)
                        <option value="{{$building->id}}">@if(Lang::locale() == 'ru') {{$building->building_ru}}
                            @elseif(Lang::locale() == 'en') {{$building->building_en}}
                            @else {{$building->building_tm}}
                            @endif</option>    
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        {{-- <a id="drag"></a> --}}
        <div class="form-group row">
            <label for="kv_elite_parking" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.parking')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="kv_elite_parking" data-toggle="buttons">
                @foreach($parkings as $parking)
                    @if($parking->id != 3 && $parking->id != 4)
                        <label for="parking" class="btn btn-primary {{$parking->id == 1 ? 'cusBorRad1' : ''}} {{$parking->id == 5 ? 'cusBorRad2' : ''}}">
                            <input type="radio" name="parking" id="{{$parking->id == 5 ? 'both_park' : ''}}" value="{{$parking->id}}">@if(Lang::locale() == 'ru') {{$parking->parking_ru}}
                            @elseif(Lang::locale() == 'en') {{$parking->parking_en}}
                            @else {{$parking->parking_tm}}
                            @endif
                        </label>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="kv_elite_pool" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.pool')}}</label>
            <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns" id="kv_elite_pool" data-toggle="buttons">
                <label class="btn btn-primary cusBorRad1"><input type="radio" name="pool" value="1">{{__('messages.outdoor')}}</label>
                <label class="btn btn-primary cusBorRad2"><input type="radio" name="pool" value="2">{{__('messages.indoor')}}</label>
            </div>
        </div><br>
        <hr>
        <div class="basic_information m-b-20">
            <h4 class="inner-title">{{__('messages.photos')}}</h4>
        </div>
        <div id="drag_20" class="drag-and-drop-zone dm-uploader p-5 text-center">
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
        <div id="kv_elite_description" class="description m-b-40">
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
            <label for="kv_elite_price" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.rent_price')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g m-r-20 m_m-r-0">
                <input type="number" min="1.0" class="form-control price_input" id="kv_elite_price" name="price" step="0.1" required />
                <!-- uc = условная единица /  conventional unit -->
                <select class="price_unit_wrap selectpicker" name="price_unit">
                    <option value="1">{{__('messages.cu')}}</option>
                    <option value="2" selected>TMT</option>
                </select>
                <div class="hide" data-tooltip="{{ __('messages.form_feed5') }}" data-tooltip-position="right"></div>
                <div class="sel_err_feed1 sel_err_invis">{{ __('messages.form_feed5') }}</div>
            </div>
            <span class="cSpan ex_pr">{{__('messages.ex_price')}}</span>
        </div>
        <input type="hidden" name="comm_payment" value="1">
        <div class="form-group row">
            <label for="kv_elite_own_deposit" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.own_deposit')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 buyk_g">
                <input type="number" name="own_deposit" id="kv_elite_own_deposit" class="form-control white_form t_m-b-10" step="0.1" min="1.0">
                <span class="cSpan1">TMT</span>
            </div>
            <div class="col-lg-offset-4 col-md-offset-3 col-sm-offset-4 col-lg-8 col-md-9 col-sm-8">
                <div class="pretty p-icon p-curve p-pulse undeposit">
                    <input type="checkbox" name="undeposit" value="1">
                    <div class="state p-primary-o">
                        <i class="icon fa fa-check" aria-hidden="true"></i>
                        <label>{{__('messages.undeposit')}}</label>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="kv_elite_prepayment" class="col-lg-4 col-md-3 col-sm-4 form-label1">{{__('messages.prepayment')}}</label>
            <div class="col-lg-8 col-md-9 col-sm-8 norm_g">
                <select class="form-control white_form selectpicker" name="prepayment" id="kv_elite_prepayment">
                    <option selected disabled class="hide">{{__('messages.no_select')}}</option>
                    <option value="1">1 {{__('messages.month1')}}</option>
                    <option value="2">2 {{__('messages.month2')}}</option>
                    <option value="3">3 {{__('messages.month2')}}</option>
                    <option value="4">4 {{__('messages.month2')}}</option>
                    <option value="5">5 {{__('messages.month3')}}</option>
                    <option value="6">6 {{__('messages.month3')}}</option>
                    <option value="7">7 {{__('messages.month3')}}</option>
                    <option value="8">8 {{__('messages.month3')}}</option>
                    <option value="9">9 {{__('messages.month3')}}</option>
                    <option value="10">10 {{__('messages.month3')}}</option>
                    <option value="11">11 {{__('messages.month3')}}</option>
                    <option value="12">1 {{__('messages.year')}}</option>
                </select>
            </div>
        </div><br>
        <hr>
        <div class="basic_information">
            <h4 class="inner-title">{{__('messages.address')}}</h4>
        </div>
        <div class="form-group row">
            <label for="velayat_select20" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.velayat')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="velayat" id="velayat_select20" class="form-control velayat_select white_form selectpicker m-b-0" required>
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
            <label for="city_select_20" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.district')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <select name="city" id="city_select_20" class="form-control white_form selectpicker m-b-0" required>
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
            <label for="address_20" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.address')}}<i class="fa fa-certificate pull-right"></i></label>
            <div class="col-lg-8 col-md-9 col-sm-8">
                <input type="text" class="form-control white_form m-b-0" id="address_20" name="address" placeholder="{{__('messages.street_holder')}}" required />
                <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="map_20" class="col-lg-4 col-md-3 col-sm-4 form-label1 m-b-10">{{__('messages.map_loc')}}</label>            
        </div>
        <div id="map_20" class="myMap"></div>        
        <br>
        <div class="property_owner">
            <input type="hidden" id="lat_20" name="lat_20">
            <input type="hidden" id="lng_20" name="lng_20">
            <input type="hidden" id="type_id" value="1" name="type_id">
            <input type="hidden" id="object_id" value="2" name="object_id">
            <input type="hidden" id="sale_rent" value="0" name="sale_rent">
            <div class="browse_submit">
                <button name="submit" onclick="return empty(event, 15)" class="btn btn-default">{{__('messages.submit')}}</button>
                <p><b class="text-uppercase">{{__('messages.note')}}</b> : {{__('messages.submit_review_note')}} *</p>
            </div>
        </div>
    </div>
</form>