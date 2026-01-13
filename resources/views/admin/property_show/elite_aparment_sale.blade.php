<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
</div>
@if(!is_null($property->apartment_type_id))
<div class="notice">
    <div class="notice-title">{{__('messages.apartment_type') }}</div>
    <div class="notice-text">
        @foreach( $apartment_types as $apart_type )
            @if($property->apartment_type_id == $apart_type->id)
                {{$apart_type->type_ru}}        
            @endif
        @endforeach
    </div>
</div>    
@endif
<div class="notice">
    <div class="notice-title">{{__('messages.num_rooms')}}</div>
    <div class="notice-text">@if((int)$property->rooms == 7)
            {{__('messages.free_sale')}}            
        @elseif((int)$property->rooms == 8)
            {{__('messages.studio')}}
        @else
            {{$property->rooms . ' ' . __('messages.roomed')}}
        @endif</div>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.tot_area')}}</div>
    <div class="notice-text">{{$property->area . ' ' . __('messages.meter')}}<sup>2</sup></div>
</div>
<div class="notice">
    <div class="notice-title">{{ __('messages.storey') }}</div>
    <div class="notice-text">{{$property->floor . ' / ' . $property->floors_in_home}}</div>
</div>
@if(!is_null($property->living))
<div class="notice">
    <div class="notice-title">{{ __('messages.residential') }}</div>
    <div class="notice-text">{{$property->living . ' ' . __('messages.meter')}}<sup>2</sup></div>
</div>
@endif
@if(!is_null($property->kitchen_area))
<div class="notice">
    <div class="notice-title">{{ __('messages.kitchen') }}</div>
    <div class="notice-text">{{$property->kitchen_area . ' ' . __('messages.meter')}}<sup>2</sup></div>
</div>
@endif
@if(!is_null($property->ceil_height))
<div class="notice">
    <div class="notice-title">{{ __('messages.ceil_height') }}</div>
    <div class="notice-text">{{$property->ceil_height . ' ' . __('messages.meter')}}</div>
</div>
@endif
@if(!is_null($property->revamp_id))
<div class="notice">
    <div class="notice-title">{{ __('messages.decor') }}</div>
    <div class="notice-text">
        @foreach($revamps as $revamp)
            @if($property->revamp_id == $revamp->id)
                {{$revamp->type_ru}}        
            @endif
        @endforeach
    </div>
</div>
@endif
@if(!is_null($property->number_baths))
<div class="notice">
    <div class="notice-title">{{ __('messages.num_baths') }}</div>
    <div class="notice-text">{{$property->number_baths}}</div>
</div>
@endif
@if(!is_null($property->room_layout_type))
<div class="notice">
    <div class="notice-title">{{ __('messages.room_layout') }}</div>
    <div class="notice-text">
        @foreach($room_layouts as $r_layout)
            @if($property->room_layout_type == $r_layout->id)
                {{$r_layout->room_layout_ru}}        
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
@if(count($property->feature) > 0)
<div class="notice">
    <div class="notice-title">{{__('messages.addition')}}</div>
    <div class="notice-text">        
        @foreach($property->feature as $feature)
            <i class="fa fa-check"></i>
            {{$feature->feature_ru}}<br>
        @endforeach
    </div>
</div>    
@endif
@if(!is_null($property->village_name) || !is_null($property->construction_year) || !is_null($property->type_property_id) || (!is_null($property->passenger_elevator) && (int)$property->passenger_elevator != 0) || (!is_null($property->service_elevator) && (int)$property->service_elevator != 0) || !is_null($property->parking_id) || !is_null($property->pool_in_building))
    <br>
    <div class="basic_information m-b-20">
        <h4 class="inner-title">{{__('messages.a_building')}}</h4>
    </div>
    @if(!is_null($property->village_name))
    <div class="notice">
        <div class="notice-title">{{__('messages.name')}}</div>
        <div class="notice-text">{{$property->village_name}}</div>
    </div>
    @endif
    @if(!is_null($property->construction_year))
    <div class="notice">
        <div class="notice-title">{{__('messages.const_year')}}</div>
        <div class="notice-text">{{$property->construction_year . " г."}}</div>
    </div>
    @endif
    @if(!is_null($property->type_property_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.t_house')}}</div>
        <div class="notice-text">
            @foreach($buildings as $building)
                @if($property->type_property_id == $building->id)
                    {{$building->building_ru}}
                @endif
            @endforeach
        </div>
    </div>
    @endif
    @if(!is_null($property->passenger_elevator) && (int)$property->passenger_elevator != 0)
    <div class="notice">
        <div class="notice-title">{{__('messages.pass_elevs')}}</div>
        <div class="notice-text">{{$property->passenger_elevator}}</div>
    </div>
    @endif
    @if(!is_null($property->service_elevator) && (int)$property->service_elevator != 0)
    <div class="notice">
        <div class="notice-title">{{__('messages.freight_elevs')}}</div>
        <div class="notice-text">{{$property->service_elevator}}</div>
    </div>
    @endif
    @if(!is_null($property->parking_id))
        @foreach($parkings as $parking)
            @if($parking->id < 3)
                @if((int)$property->parking_id == 5)
                    <div class="notice">
                        <div class="notice-title">{{$parking->parking_ru . ' ' . __('messages.parking')}}</div>
                        @if($parking->id == 1)
                            <div class="notice-text">{{$property->parking_spots}}</div>
                        @elseif($parking->id == 2)
                            <div class="notice-text">{{$property->parking_spots_ex}}</div>
                        @endif
                    </div>
                @else
                    @if((int)$property->parking_id==$parking->id)
                        <div class="notice">
                            <div class="notice-title">{{$parking->parking_ru . ' ' .__('messages.parking')}}</div>
                            <div class="notice-text">{{$property->parking_spots}}</div>
                        </div>    
                    @endif
                @endif
            @endif
        @endforeach
    @endif
    @if(!is_null($property->pool_in_building))
    <div class="notice">
        <div class="notice-title">{{__('messages.pool')}}</div>
        <div class="notice-text">
            @if((int)$property->pool_in_building == 1)
                {{__('messages.outdoor')}}
            @elseif((int)$property->pool_in_building == 2 )    
                {{__('messages.indoor')}}
            @endif
        </div>
    </div>
    @endif
@endif
@if(count($property->image) > 0)
    <br>
    <br>
    <div class="basic_information m-b-20">
        <h4 class="inner-title">{{__('messages.photos')}}</h4>
    </div>
    <div class="row">
        @foreach($property->image as $img)
            <div class="col-md-3 col-xs-12">
                <img class="img-responsive img-thumbnail" src="{{asset('/img/property_grid/'. $img->name)}}">
            </div>
        @endforeach        
    </div>
@endif
@if(!is_null($property->description->description))
    <br>
    <br>
    <div class="basic_information m-b-20">
        <h4 class="inner-title">{{__('messages.description')}}</h4>
    </div>
    <div class="notice">{{ $property->description->description }}</div>
    
@endif
<br>
<br>
<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.price_terms')}}</h4>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.price')}}</div>
    <div class="notice-text">{{number_format($property->price, 0, '.', " ")}} {{$property->price_unit_id == 1 ? __('messages.cu') : 'TMT'}}</div>
</div>
@if(!is_null($property->sale_type_id))
<div class="notice">
    <div class="notice-title">{{__('messages.sale_type')}}</div>
    <div class="notice-text">
        @foreach($sale_types as $sale_type)
            @if($property->sale_type_id == $sale_type->id)
                {{$sale_type->type_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
<div class="notice">
    <div class="notice-title">{{__('messages.property_state')}}</div>
    <div class="notice-text">
        @if($property->house_purchase_status == 1)
            {{__('messages.redeemed')}}
        @else
            {{$property->house_purchase_debt_amount . ' TMT '}}<span class="text-lowercase">{{__('messages.with_debt')}}</span>
        @endif
    </div>
</div>
<br>
<br>
<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.address')}}</h4>
</div>
<div class="notice">
    {{ $property->address}}<br>
    @foreach($cities as $city)
        @if($city->id == $property->city_id)
            {{$city->city_ru}}
            @break
        @endif
    @endforeach /
    @foreach($velayats as $velayat)
        @if($velayat->id == $property->velayat_id)
            {{$velayat->velayat_ru}} @if((int)$property->velayat_id != 6) {{__('messages.vel')}} @endif 
            @break
        @endif
    @endforeach        
</div>    