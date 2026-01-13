<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.property_type')}}</div>
    <div class="notice-text">
        @foreach($business_types_property as $btp)
            @if($btp->id == $property->business_type_property_id)
                {{$btp->type_ru}}
                @break
            @endif
        @endforeach
    </div>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.area')}}</div>
    <div class="notice-text">{{$property->area}} {{__('messages.meter')}}<sup>2</sup></div>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.floor')}}</div>
    <div class="notice-text">{{$property->floor . ' ' . __('messages.from') . ' ' . $property->floors_in_home}}</div>
</div>
@if(!is_null($property->ceil_height))
<div class="notice">
    <div class="notice-title">{{ __('messages.ceil_height') }}</div>
    <div class="notice-text">{{$property->ceil_height . ' ' . __('messages.meter')}}</div>
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
@if(!is_null($property->equipment))
<div class="notice">
    <div class="notice-title">{{__('messages.equip')}}</div>
    <div class="notice-text">
        @if((int)$property->equipment == 1)
            {{__('messages.exist')}}
        @else
            {{__('messages.no_exist')}}
        @endif
    </div>
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
@if(count($property->business_type) > 0 || count($extra_possible_business_types) > 0)
<br>
<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.f_activity')}}</h4>
</div>
<div class="notice">
    @php $iterator=1; @endphp
    @if(count($property->business_type) > 0)
        @foreach ($property->business_type as $bus_type)
            <div class="{{$iterator % 2 == 1 ? 'notice-title1':'notice-text'}}">
                <i class="fa fa-check"></i>
                {{$bus_type->type_ru}}
            </div>
            @php $iterator++; @endphp
        @endforeach
    @endif
    @if(count($extra_possible_business_types) > 0)
        @foreach ($extra_possible_business_types as $extra_appoint)
            <div class="{{$iterator % 2 == 1 ? 'notice-title1':'notice-text'}}">
                <i class="fa fa-check"></i>
                {{$extra_appoint->type}}
            </div>
            @php $iterator++; @endphp
        @endforeach
    @endif
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

@if(!is_null($property->monthly_profit))
<div class="notice">
    <div class="notice-title">{{__('messages.mon_profit')}}</div>
    <div class="notice-text">{{$property->monthly_profit . ' TMT'}}</div>
</div>
@endif
@if(!is_null($property->land_owning_type_id))
<div class="notice">
    <div class="notice-title">{{__('messages.properties')}}</div>
    <div class="notice-text">
        @foreach($land_owning_types as $land_owning_type)
            @if($land_owning_type->id!==3)
                @if($property->land_owning_type_id == $land_owning_type->id)
                    {{$land_owning_type->type_ru}}
                    @break
                @endif
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
            @php break; @endphp
        @endif
    @endforeach /
    @foreach($velayats as $velayat)
        @if($velayat->id == $property->velayat_id)
            {{$velayat->velayat_ru}}
            @php break; @endphp
        @endif
    @endforeach        
</div>