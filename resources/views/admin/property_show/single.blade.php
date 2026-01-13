@section('header')    	
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
@endsection
@extends('admin.app')
@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor title_accepted_property">{{$property->title}}</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">                            
                        <li class="breadcrumb-item">Опубликовано объявление от <span class="active">{{$property->user->profile->first_name . ' ' . $property->user->profile->last_name}}</span></li>
                    </ol>                        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">                        
                    <div class="card-body">
                        @switch($property_full_type_id)
                            @case('11')                                
                                @include('admin.property_show.apartment_rent')    
                                @break
                            @case('21')                                
                                @include('admin.property_show.apartment_sale')
                                @break
                            @case('12')
                                @include('admin.property_show.elite_aparment_rent')    
                                @break
                            @case('22')
                                @include('admin.property_show.elite_aparment_sale')    
                                @break
                            @case('13')
                            @case('24')
                                @include('admin.property_show.house_rent')    
                                @break
                            @case('23')
                            @case('24')
                                @include('admin.property_show.house_sale')
                                @break
                            @case('15')
                                @include('admin.property_show.parthouse_rent')    
                                @break
                            @case('25')
                                @include('admin.property_show.parthouse_sale')    
                                @break
                            @case('16')
                                @include('admin.property_show.office_rent')    
                                @break
                            @case('26')
                                @include('admin.property_show.office_sale')    
                                @break
                            @case('17')
                                @include('admin.property_show.building_rent')
                                @break
                            @case('27')
                                @include('admin.property_show.building_sale')
                                @break
                            @case('18')
                                @include('admin.property_show.trade_point_rent')
                                @break
                            @case('28')
                                @include('admin.property_show.trade_point_sale')
                                @break
                            @case('29')
                                @include('admin.property_show.manufacture_sale')
                                @break
                            @case('110')
                                @include('admin.property_show.warehouse_rent')
                                @break
                            @case('210')
                                @include('admin.property_show.warehouse_sale')
                                @break
                            @case('111')                            
                                @include('admin.property_show.business_rent')
                                @break
                            @case('211')
                                @include('admin.property_show.business_sale')
                                @break
                        @endswitch
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/dashboard/custom.min.js') }}"></script>
@endsection