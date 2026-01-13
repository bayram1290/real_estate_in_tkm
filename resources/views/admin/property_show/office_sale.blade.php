<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.area')}}</div>
    <div class="notice-text">{{$property->area}} {{__('messages.meter')}}<sup>2</sup></div>
</div>
@if(!is_null($property->in_parts))
<div class="notice">
    <div class="notice-title">{{__('messages.in_parts')}}</div>
    <div class="notice-text">
        @if((int)$property->in_parts == 1)
            {{__('messages.yes')}}
        @else
            {{__('messages.no')}}
        @endif
    </div>
</div>
@endif
<div class="notice">
    <div class="notice-title">{{__('messages.floor')}}</div>
    <div class="notice-text">{{$property->floor . ' ' . __('messages.from') . ' ' . $property->floors_in_home}}</div>
</div>
@if(!is_null($property->legal_address))
<div class="notice">
    <div class="notice-title">{{__('messages.leg_add')}}</div>
    <div class="notice-text">
        @if((int)$property->legal_address == 1)
            {{__('messages.provided')}}
        @else
            {{__('messages.not_provided')}}
        @endif
    </div>
</div>
@endif
@if(!is_null($property->ceil_height))
<div class="notice">
    <div class="notice-title">{{ __('messages.ceil_height') }}</div>
    <div class="notice-text">{{$property->ceil_height . ' ' . __('messages.meter')}}</div>
</div>
@endif
@if(!is_null($property->occupied))
<div class="notice">
    <div class="notice-title">{{__('messages.occup')}}</div>
    <div class="notice-text">
        @if((int)$property->occupied == 1)
        {{__('messages.occupied') . ' до ' . $months_ru[$property->occup_month_id-1] .'. ' . $property->occup_year . ' г.'}}
        @else
            {{__('messages.free1')}}
        @endif
    </div>
</div>
@endif
@if(!is_null($property->office_repair_id))
<div class="notice">
    <div class="notice-title">{{__('messages.layout')}}</div>
    <div class="notice-text">
        @foreach($office_repairs as $office_repair)
            @if($property->office_repair_id == $office_repair->id)
                {{$office_repair->repair_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
@if(!is_null($property->wet_points))
<div class="notice">
    <div class="notice-title">{{__('messages.num_wet_points')}}</div>
    <div class="notice-text">{{$property->wet_points==0 ? __('messages.no_exist') : $property->wet_points}}</div>
</div>
@endif
@if(!is_null($property->electric_power))
<div class="notice">
    <div class="notice-title">{{__('messages.elec_pow')}}</div>
    <div class="notice-text">{{$property->electric_power . ' ' . __('messages.kW')}}</div>
</div>
@endif
@if(!is_null($property->office_condition_id))
<div class="notice">
    <div class="notice-title">{{__('messages.condition')}}</div>
    <div class="notice-text">
        @foreach($office_conditions as $office_condition)
            @if($property->office_condition_id == $office_condition->id)
                {{$office_condition->condition_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
@if(!is_null($property->furniture))
<div class="notice">
    <div class="notice-title">{{__('messages.furniture')}}</div>
    <div class="notice-text">
        @if((int)$property->furniture == 1)
            {{__('messages.exist')}}
        @else
            {{__('messages.no_exist')}}
        @endif
    </div>
</div>
@endif
@if(!is_null($property->entrance_id))
<div class="notice">
    <div class="notice-title">{{__('messages.entrance')}}</div>
    <div class="notice-text">
            @foreach($entrances as $entrance)
            @if($property->entrance_id == $entrance->id)
                {{$entrance->entrance_ru}}
                @break
            @endif
        @endforeach
    </div>
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
@if(!is_null($property->parking_price))
<div class="notice">
    <div class="notice-title">{{__('messages.park_cost')}}</div>
    <div class="notice-text">
        @if((int)$property->parking_price == 0)
            {{__('messages.free')}}
        @else
            {{ $property->parking_price . ' TMT (' . __('messages.for_month') . ')'}}
        @endif
    </div>
</div>
@endif
@if(!is_null($property->building_type_id) || !is_null($property->building_area) || !is_null($property->land_area) || !is_null($property->ventilation_id) || !is_null($property->conditioning_id) || !is_null($property->heating_id) || !is_null($property->firefighting_id))
    <br>
    <div class="basic_information m-b-20">
        <h4 class="inner-title">{{__('messages.a_building')}}</h4>
    </div>
    @if(!is_null($property->building_type_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.t_build')}}</div>
        <div class="notice-text">
            @foreach($building_types as $building_type)
                @if($property->building_type_id == $building_type->id)
                    {{$building_type->type_ru}}
                    @break
                @endif
            @endforeach
        </div>
    </div>
    @endif
    @if(!is_null($property->building_area))
    <div class="notice">
        <div class="notice-title">{{__('messages.a_build')}}</div>
        <div class="notice-text">{{$property->building_area}} {{__('messages.meter')}}<sup>2</sup></div>
    </div>    
    @endif
    @if(!is_null($property->land_area))
    <div class="notice">
        <div class="notice-title">{{__('messages.land')}}</div>
        <div class="notice-text">{{$property->land_area}} {{__('messages.ga') . ' '}}
            @if(!is_null($property->land_owning_type_id))
                @foreach($land_owning_types as $land_owning_type)
                    @if($property->land_owning_type_id == $land_owning_type->id)
                        ({{$land_owning_type->type_ru}})
                        @break
                    @endif
                @endforeach    
            @endif        
        </div>
    </div>
    @endif
    @if(!is_null($property->ventilation_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.ventilation')}}</div>
        <div class="notice-text">
            @foreach($ventilations as $vent)
                @if($vent->id == $property->ventilation_id)
                    {{$vent->ventilation_ru}}
                    @break
                @endif
            @endforeach        
        </div>
    </div>
    @endif
    @if(!is_null($property->conditioning_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.air_cond')}}</div>
        <div class="notice-text">
            @foreach($conditionings as $cond)
                @if($cond->id == $property->conditioning_id)
                    {{$cond->conditioning_ru}}
                    @break
                @endif
            @endforeach        
        </div>
    </div>
    @endif
    @if(!is_null($property->heating_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.heating_system')}}</div>
        <div class="notice-text">
            @foreach($heatings as $heat)
                @if($heat->id == $property->heating_id)
                    {{$heat->heating_ru}}
                    @break
                @endif
            @endforeach        
        </div>
    </div>
    @endif
    @if(!is_null($property->firefighting_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.fire_extin')}}</div>
        <div class="notice-text">
            @foreach($firefightings as $firefight)
                @if($firefight->id == $property->firefighting_id)
                    {{$firefight->firefighting_ru}}
                    @break
                @endif
            @endforeach        
        </div>
    </div>
    @endif
@endif
@if(count($property->infrastructure) > 0)
<br>
<div class="basic_information">
    <h4 class="inner-title">{{__('messages.infras')}}</h4>
</div>
<div class="notice">
    @php $iterator=1; @endphp
    @foreach($property->infrastructure as $infras)
        @if($iterator % 2 == 1)
            <div class="notice-title1">
                <i class="fa fa-check"></i>
                {{$infras->infrastructure_ru}}
            </div>    
        @else
            <div class="notice-text">
                <i class="fa fa-check"></i>
                {{$infras->infrastructure_ru}}
            </div>    
        @endif
        @php $iterator++; @endphp
    @endforeach
</div>    
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
@if(!is_null($property->tax_id))
<div class="notice">
    <div class="notice-title">{{__('messages.tax')}}</div>
    <div class="notice-text">
        @foreach($taxes as $tax)
            @if($property->tax_id==$tax->id)
                {{$tax->tax_ru}}
                @break
            @endif
        @endforeach
    </div>
</div> 
@endif
@if(!is_null($property->bonus_agent_id))
    <div class="notice">
        <div class="notice-title">{{__('messages.bonus_agent')}}</div>
        <div class="notice-text">
            @foreach($bonus_agents as $bonus_agent)
                @if($bonus_agent->id == $property->bonus_agent_id)
                    {{$bonus_agent->bonus_ru}}
                    @break
                @endif
            @endforeach
        </div>
    </div>
@endif
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