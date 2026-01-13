@extends('layouts.front')

@section('content')
    <!-- Profile Setting Start -->
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="page_location">
                <a href="{{route('index')}}">{{__('messages.home')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="it_cap">{{__('messages.my_favs')}}</span>
            </div>
            <h3 class="page_title m-b-0">{{__('messages.my_favs')}}</h3>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Profile Setting Start -->
    <section id="profile_setting">
        <div class="container">
            <div class="row">
                @include('layouts.profile')
                <div class="col-md-9 col-sm-12">
                    @if($properties->count() == 0)
                        <div class="panel panel-success m-b-0">
                            <div class="panel-heading">{{__('messages.my_favs')}}</div>
                            <div class="panel-body empty_fav_body">
                                <div class="verify-msg">
                                    <div class="msg-wrapper">
                                        <span style="font-weight: 500;font-size: 18px">{{__('messages.no_fav_announs')}}</span>
                                        <div class="add_prop_file">
                                            <span style="padding-right:15px;padding-top:15px">
                                                <svg height="48" width="60" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 48 60" style="enable-background:new 0 0 48 60;" xml:space="preserve">
                                                    <g>
                                                        <path d="M36.5,22h-25c-0.553,0-1,0.448-1,1s0.447,1,1,1h25c0.553,0,1-0.448,1-1S37.053,22,36.5,22z"/>
                                                        <path d="M11.5,16h10c0.553,0,1-0.448,1-1s-0.447-1-1-1h-10c-0.553,0-1,0.448-1,1S10.947,16,11.5,16z"/>
                                                        <path d="M37.5,31c0-0.552-0.447-1-1-1h-25c-0.553,0-1,0.448-1,1s0.447,1,1,1h25C37.053,32,37.5,31.552,37.5,31z"/>
                                                        <path d="M29.5,39c0-0.552-0.447-1-1-1h-17c-0.553,0-1,0.448-1,1s0.447,1,1,1h17C29.053,40,29.5,39.552,29.5,39z"/>
                                                        <path d="M11.5,46c-0.553,0-1,0.448-1,1s0.447,1,1,1h14c0.553,0,1-0.448,1-1s-0.447-1-1-1H11.5z"/>
                                                        <path d="M2.5,2h29v14h14v17h2V14.586L32.914,0H0.5v60h33v-2h-31V2z M33.5,3.414L44.086,14H33.5V3.414z"/>
                                                        <path d="M59.453,45.101c-0.116-0.367-0.434-0.634-0.814-0.688l-7.777-1.089l-3.472-6.779c-0.342-0.669-1.438-0.669-1.779,0   l-3.472,6.779l-7.777,1.089c-0.381,0.053-0.698,0.321-0.814,0.688s-0.012,0.768,0.269,1.032l5.605,5.266L38.1,58.825   c-0.066,0.374,0.084,0.752,0.388,0.978c0.305,0.226,0.711,0.26,1.049,0.089l6.964-3.529l6.964,3.529   C53.607,59.964,53.762,60,53.916,60c0.211,0,0.421-0.067,0.597-0.197c0.304-0.226,0.454-0.604,0.388-0.978l-1.321-7.426   l5.605-5.266C59.465,45.869,59.569,45.467,59.453,45.101z M51.815,50.312c-0.246,0.231-0.359,0.572-0.3,0.904l1.064,5.986   l-5.628-2.852c-0.143-0.072-0.297-0.108-0.452-0.108s-0.31,0.036-0.452,0.108l-5.628,2.852l1.064-5.986   c0.06-0.333-0.054-0.673-0.3-0.904l-4.479-4.208l6.225-0.872c0.322-0.045,0.603-0.245,0.751-0.535l2.818-5.503l2.818,5.503   c0.148,0.29,0.429,0.49,0.751,0.535l6.225,0.872L51.815,50.312z"/>
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                        <span><a class="btn btn-default text-center" href="{{ route('list') }}">{{__('messages.go_prop_page')}}</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="my_property_list">
                            <table class="list_table" border="0" cellpadding="0" cellspacing="0">                            
                                <tbody>
                                @foreach($properties as $property)
                                    @if(Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($property->expiring_at),false) >= 1)
                                        <div class="column mix mix_all house {{$property->type_id}} appartment col-md-6 col-sm-6 col-xs-12">
                                            <div class="property_grid">
                                                <div class="img_area">
                                                    <div class="sale_btn">{{$property->saleOrRent ? __('messages.sale') : __('messages.rent')}}</div>
                                                    @if($property->featured)
                                                        <div class="featured_btn">{{ __('messages.premium') }}</div>
                                                    @endif
                                                    <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}"><img src="{{$property->img}}" style="height: 239px"></a>
                                                    <div class="sale_amount">{{$property->created_at->diffForHumans()}}</div>
                                                    <div class="hover_property">
                                                        <ul>
                                                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                                                            <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="property-text">
                                                    <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}">
                                                        <h6 class="property-title">{{$property->title}}</h6>
                                                    </a>
                                                    <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{$property->address}}</span>
                                                    <div class="quantity">
                                                        <ul>
                                                            <li><span>{{__('messages.area')}}</span>{{$property->area}} {{__('messages.meter')}}<sup>2</sup></li>
                                                            <li><span>{{__('messages.number_of_rooms')}}</span>{{$property->rooms}}</li>
                                                            <li><span>{{__('messages.district')}}</span>@if(Lang::locale() == 'ru') {{substr($cities[$property->city_id - 1]->city_ru, 0, 29)}}
                                                                @elseif(Lang::locale() == 'en') {{substr($cities[$property->city_id - 1]->city_en, 0, 29)}}
                                                                @else {{substr($cities[$property->city_id - 1]->city_tm, 0, 29)}}
                                                                @endif ...</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="bed_area">
                                                    <ul>
                                                        <li>
                                                            ${{number_format($property->price)}} TMT @if(!$property->saleOrRent){{__('messages.mon')}} @endif</li>
                                                        @if(Auth::id())
                                                            @if($property->favorite_user->contains(Auth::id()))
                                                                <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLike()">
                                                                    <a href="javascript:void()">
                                                                        <i id="property_{{$property->id}}" style="font-size: 30px;color: #3e9e3a;vertical-align: middle" class="fa fa-star"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="flat-icon" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}"> 
                                                                        <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </li>
                                                            @else
                                                                <li class="flat-icon" id="{{$property->id}}" onclick="decreaseLike()">
                                                                    <a href="javascript:void()">
                                                                        <i id="property_{{$property->id}}"  style="font-size: 30px;color: grey;vertical-align: middle" class="fa fa-star"></i>
                                                                    </a>
                                                                </li>
                                                                <li class="flat-icon" id="{{$property->id}}">
                                                                    <a class="repBtn" href="{{route('report.property',['id' => $property->id])}}" data-toggle="tooltip" data-placement="top" title="{{__('messages.btn_complain_txt')}}">
                                                                        <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @else
                                                            @if(isset($arr_cookie))
                                                                @if(in_array($property->id,$arr_cookie))
                                                                    <li class="flat-icon" id="{{$property->id}}"
                                                                        onclick="decreaseLike()">
                                                                        <a href="javascript:void()">
                                                                            <i id="property_{{$property->id}}"
                                                                            style="font-size: 30px;color: red;vertical-align: middle"
                                                                            class="fa fa-heart"></i>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="flat-icon" id="{{$property->id}}"
                                                                        onclick="getLike()">
                                                                        <a href="javascript:void()">
                                                                            <i id="property_{{$property->id}}"
                                                                            style="font-size: 30px;color: grey;vertical-align: middle"
                                                                            class="fa fa-heart"></i>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @else
                                                                <li class="flat-icon" id="{{$property->id}}"
                                                                    onclick="getLike()">
                                                                    <a href="javascript:void()">
                                                                        <i id="property_{{$property->id}}"
                                                                        style="font-size: 30px;color: grey;vertical-align: middle"
                                                                        class="fa fa-heart"></i>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                        @endif
                                                        {{--<li class="flat-icon"><a href="#"><i--}}
                                                                        {{--class="flaticon-connections"></i></a>--}}
                                                        {{--</li>--}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        var ul = document.querySelectorAll('.list');
        ul.forEach(function (list) {
            list.addEventListener('click',function (e) {
                var id = e.target.getAttribute('id');
                //console.log(e.target.getAttribute('id'));
                location.href = "http://localhost/edit/" + id;
            });
        });
    </script>
    <script>
        document.getElementById('avata-upload').onchange = function (ev) {
            document.querySelector('.avata-form').submit();
        }
    </script>
@endsection