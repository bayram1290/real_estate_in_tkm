<div class="form-group row">
    <label for="velayat_select1" class="col-md-4 form-label1 p-r-0">{{__('messages.velayat')}}<i
                class="fa fa-certificate pull-right"></i></label>
    <div class="col-md-8">
        <select name="velayat" id="velayat_select1" class="form-control velayat_select white_form selectpicker"
                required>
            <option value="null" selected disabled class="hide">{{__('messages.no_select')}}</option>
                @foreach($velayats as $velayat)
                    <option value="{{$velayat->id}}" {{$velayat->id == $property->velayat_id ? 'selected' : ''}}>@if(Lang::locale() == 'ru') {{$velayat->velayat_ru}}
                                @elseif(Lang::locale() == 'en') {{$velayat->velayat_en}}
                                @else {{$velayat->velayat_tm}}
                                @endif</option>
                @endforeach
            <option value="null" selected disabled style="display:none">{{__('messages.no_select')}}</option>
            @foreach($velayats as $velayat)
                <option value="{{$velayat->id}}" {{$velayat->id == $property->velayat_id ? 'selected' : ''}}>{{$velayat->velayat}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="city_select_1" class="col-md-4 form-label1 p-r-0">{{__('messages.district')}}<i
                class="fa fa-certificate pull-right"></i></label>
    <div class="col-md-8">
        <select name="city" id="city_select_1" class="form-control white_form selectpicker" required>
            <option value="null" selected disabled class="hide">{{__('messages.no_select')}}</option>
            @foreach($cities as $city)
                <option id="{{$city->velayat_id}}" value="{{$city->id}}"> {{$city->id == $property->city_id ? 'selected' : ''}}@if(Lang::locale() == 'ru') {{$city->city_ru}}
                @elseif(Lang::locale() == 'en') {{$city->city_en}}
                @else {{$city->city_tm}}
                @endif</option>
            @endforeach
        </select>
        <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed7') }}</div>
    </div>
</div>
<div class="form-group row">
    <label for="kv_address" class="col-md-4 form-label1 p-r-0">{{__('messages.address')}}<i
        class="fa fa-certificate pull-right"></i></label>
    <div class="col-lg-8 col-md-9 col-sm-8">
        <input type="text" class="form-control white_form m-b-0" id="kv_address" value="{{$property->address}}" name="address"
               placeholder="{{__('messages.add_holder')}}" required />
        <div class="sel_err_feed sel_err_invis">{{ __('messages.form_feed8') }}</div>
    </div>
</div>