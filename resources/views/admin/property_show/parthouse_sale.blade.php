<div class="basic_information m-b-20">
    <h4 class="inner-title">{{__('messages.ob_property')}}</h4>
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
<div class="notice">
    <div class="notice-title">{{__('messages.share_size')}}</div>
    <div class="notice-text">{{$property->rent_part}}</div>
</div>
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
<div class="notice">
    <div class="notice-title">{{__('messages.tot_area')}}</div>
    <div class="notice-text">{{$property->area . ' ' . __('messages.meter')}}<sup>2</sup></div>
</div>
@if(!is_null($property->floors_in_home))
<div class="notice">
    <div class="notice-title">{{__('messages.total_floor1')}}</div>
    <div class="notice-text">{{$property->floors_in_home}}</div>
</div>
@endif
@if(!is_null($property->num_beds))
<div class="notice">
    <div class="notice-title">{{__('messages.num_beds')}}</div>
    <div class="notice-text">{{$property->num_beds}}</div>
</div>
@endif
@if(!is_null($property->bathroom_id))
<div class="notice">
    <div class="notice-title">{{__('messages.bath')}}</div>
    <div class="notice-text">
        @if($property->bathroom_id == 3)
            @foreach($bathrooms as $bathroom)
                @if($bathroom->id < 3)
                    @if($bathroom->id == 1)
                        {{$bathroom->bathroom_ru}},
                    @else
                        <span class="text-lowercase">{{$bathroom->bathroom_ru}}</span>
                    @endif    
                @endif
            @endforeach
        @else
            @foreach($bathrooms as $bathroom)
                @if($property->bathroom_id == $bathroom->id)
                    {{$bathroom->bathroom_ru}}
                    @break    
                @endif
            @endforeach    
        @endif
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
@if (count($property->feature) > 0)
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
<div class="notice">
    <div class="notice-title">{{__('messages.land_area')}}</div>
    <div class="notice-text">{{$property->land_area}}
        @foreach($land_area_types as $land_area_type)
            @if( $property->land_area_type_id == $land_area_type->id )
                {{$land_area_type->type_ru}}
                @break
            @endif
        @endforeach 
    </div>
</div>
<div class="notice">
    <div class="notice-title">{{__('messages.land_status')}}</div>
    <div class="notice-text">
        @foreach($land_statuses as $land_status)
            @if( $property->land_status_id == $land_status->id )
                {{$land_status->status_ru}}
                @break
            @endif
        @endforeach 
    </div>
</div>
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
    <div class="notice-text">{{number_format($property->price, 0, '.', " ")}} {{$property->price_unit_id == 1 ? __('messages.cu') : 'TMT'}}        
    </div>
</div>
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