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