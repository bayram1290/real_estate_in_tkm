@section('header')    	
	<link href="{{ asset('css/dashboard/tablesaw.css') }}" rel="stylesheet">
	<link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
@endsection
@extends('admin.app')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Список разрешённых объявлений</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">                            
                            <li class="breadcrumb-item active">Опубликовано</li>
                        </ol>                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">                        
                        <div class="card-body">
                            @if( count($properties) > 0 )
                                <table class="table-hover table accept_table" data-tablesaw-mode="swipe" data-tablesaw-minimap>
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>{{__('Собственник')}}</th>
                                            <th>{{__('Недвижимость')}}</th>
                                            <th class="acc_tr3">{{__('Срок действия')}}</th>
                                            <th class="acc_tr3">{{__('Дата создания')}}</th>
                                            <th class="tacc_tr5">{{__('Действие')}}</th>            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($properties as $property)
                                            <tr class="cursor" onclick="window.location='{{route('accepted.property.show', ['id' => $property->id])}} ';" role="button">
                                                <td>{{$property->user->profile->first_name . ' ' . $property->user->profile->last_name }}</td>
                                                <td>
                                                    <div class="max-txt">
                                                        <span class="label label-info mr-2">{{$p_deals_ru[$property->saleOrRent] . ' ' . $p_objects_ru[$property->object_names_id - 1]}}</span>
                                                        {{$property->title}}
                                                    </div>
                                                </td>
                                                <td>{{Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($property->expiring_at),false)}} 
                                                    @php $expiry = Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($property->expiring_at),false) % 10;  @endphp
                                                    @if($expiry == 1)
                                                        день
                                                    @elseif($expiry == 2 || $expiry == 3 || $expiry == 4)
                                                        дня
                                                    @else
                                                        дней
                                                    @endif</td>
                                                <td>{{date('d.m.Y', strtotime($property->created_at))}}</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-danger py-1">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>                                        
                                </table>                                
                            @else
                                {{__('Пока нет объявлений')}}
                            @endif
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