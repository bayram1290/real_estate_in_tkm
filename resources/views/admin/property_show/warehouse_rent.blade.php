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
@if(!is_null($property->floor_material_id))
<div class="notice">
    <div class="notice-title">{{__('messages.floor_mat')}}</div>
    <div class="notice-text">
        @foreach($floor_materials as $floor_material)
            @if($property->floor_material_id == $floor_material->id)
                {{$floor_material->material_ru}}
                @break
            @endif
        @endforeach
    </div>
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
@if(!is_null($property->gates_id))
<div class="notice">
    <div class="notice-title">{{__('messages.ent_gate')}}</div>
    <div class="notice-text">
        @foreach($gates as $gate)
            @if($property->gates_id == $gate->id)
                {{$gate->gate_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
@if(!is_null($property->electric_power))
<div class="notice">
    <div class="notice-title">{{__('messages.elec_pow')}}</div>
    <div class="notice-text">{{$property->electric_power . ' ' . __('messages.kW')}}</div>
</div>
@endif
@if(!is_null($property->parking_id))
    @foreach($parkings as $parking)
        @if($parking->id > 2 && $parking->id < 5)
            @if((int)$property->parking_id==$parking->id)
                <div class="notice">
                    <div class="notice-title">{{__('messages.parking')}}</div>
                    <div class="notice-text">{{$parking->parking_ru . ' с ' . $property->parking_spots . ' мест.'}}</div>
                </div>    
            @endif
        @endif
    @endforeach
@endif
@if(!is_null($property->parking_type_id))
<div class="notice">
    <div class="notice-title">{{__('messages.parking_type')}}</div>
    <div class="notice-text">
        @foreach($parking_types as $parking_type)
            @if($property->parking_type_id == $parking_type->id)
                {{$parking_type->type_ru}}
                @break    
            @endif
        @endforeach
    </div>
</div>
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
@if(!is_null($property->construction_year) || !is_null($property->building_type_id) || !is_null($property->building_area) || !is_null($property->land_area) || !is_null($property->building_category) || !is_null($property->ventilation_id) || !is_null($property->conditioning_id) || !is_null($property->heating_id) || !is_null($property->firefighting_id))
    <br>
    <div class="basic_information m-b-20">
        <h4 class="inner-title">{{__('messages.a_building')}}</h4>
    </div>
    @if(!is_null($property->construction_year))
    <div class="notice">
        <div class="notice-title">{{__('messages.const_year')}}</div>
        <div class="notice-text">{{$property->construction_year . " г."}}</div>
    </div>
    @endif
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
    @if(!is_null($property->building_category))
    <div class="notice">
        <div class="notice-title">{{__('messages.category')}}</div>
        <div class="notice-text">
            @switch((int)$property->building_category)
                @case(1)
                    {{__('messages.active')}}
                    @break
                @case(2)
                    {{__('messages.project')}}
                    @break
                @default
                    {{__('messages.un_const')}}
            @endswitch
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
    <div class="notice-title">{{__('messages.price_per_msq')}}<sup>2</sup></div>
    <div class="notice-text">{{number_format($property->price_rate, 0, '.', " ")}}
        {{$property->price_unit_id == 1 ? __('messages.cu') : 'TMT'}} ({{__('messages.per_year')}})
    </div>
</div>
@if(!is_null($property->comm_payment_included) || !is_null($property->explat_payment_included))
<div class="notice">
    <div class="notice-title">{{__('messages.price_incl')}}</div>
    <div class="notice-text">
        @if(!is_null($property->comm_payment_included) && !is_null($property->explat_payment_included))
            {{__('messages.comm_payment')}}, <span class="text-lowercase">{{__('messages.oper_costs')}}</span> 
        @elseif(!is_null($property->comm_payment_included))
            {{__('messages.comm_payment')}}
        @else
            {{__('messages.oper_costs')}}
        @endif
    </div>
</div>
@endif
@if(!is_null($property->rent_type_id))
<div class="notice">
    <div class="notice-title">{{__('messages.rent_type')}}</div>
    <div class="notice-text">
        @foreach($rent_types as $rent_type)
            @if($rent_type->id==$property->rent_type_id)
                {{$rent_type->type_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
@if(!is_null($property->rent_term_id))
<div class="notice">
    <div class="notice-title">{{__('messages.rent_period')}}</div>
    <div class="notice-text">
        @foreach($rent_terms as $rent_term)
            @if($rent_term->id==$property->rent_term_id)
                {{$rent_term->term_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
@endif
@if(!is_null($property->min_term))
<div class="notice">
    <div class="notice-title">{{__('messages.min_per_rent')}}</div>
    <div class="notice-text">{{$property->min_term .' ' . __('messages.month')}}</div>
</div>
@endif
@if(!is_null($property->deposit_payment))
<div class="notice">
    <div class="notice-title">{{__('messages.sec_deposit')}}</div>
    <div class="notice-text">{{$property->deposit_payment .' TMT'}}</div>
</div>
@endif
@if(!is_null($property->prepayment))
<div class="notice">
    <div class="notice-title">{{__('messages.prepayment')}}</div>
    <div class="notice-text">@if( $property->prepayment < 12 )
        {{ $property->prepayment }}
        @if( $property->prepayment < 2 )
            {{__('messages.month1')}}
        @elseif( $property->prepayment < 5 )
            {{__('messages.month2')}}
        @else
            {{__('messages.month3')}}
        @endif
    @else
        1 {{__('messages.year')}}
    @endif</div>
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