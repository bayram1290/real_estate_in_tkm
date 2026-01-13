@extends('layouts.front')

@section('content')
    <!-- Profile Setting Start -->
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">                
            <div class="page_location">
                <a href="{{route('index')}}">{{__('messages.home')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="it_cap">{{__('messages.my_properties')}}</span>
            </div>
            <h3 class="page_title m-b-0">{{__('messages.my_properties')}}</h3>
        </div>
    </section>
    <!-- Profile Setting Start -->
    <section id="profile_setting">
        <div class="container">
            <div class="row">
                @include('layouts.profile')
                <div class="col-lg-9 col-md-9 col-sm-12 ozel_p-l-0 ozel_p-r-0">                    
                    @if($properties->count() == 0)
                        <div class="panel panel-success">
                            <div class="panel-heading">{{__('messages.my_properties')}}</div>                        
                            <div class="panel-body">
                                <div class="verify-msg">
                                    <div class="msg-wrapper">
                                        <span style="font-weight: 500;font-size: 18px">{{__('messages.no_announs')}}</span>
                                        <div class="add_prop_file">
                                            <span style="padding-right:15px;padding-top:15px">
                                                <svg height="48" width="45" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 48">
                                                    <path fill-rule="evenodd" d="M31 39c-7.73 0-14-6.27-14-14s6.27-14 14-14 14 6.27 14 14-6.27 14-14 14zm0-25c-6.08 0-11 4.93-11 11s4.92 11 11 11 11-4.93 11-11-4.92-11-11-11zm2 18h-4v-5h-5v-4h5v-5h4v5h5v4h-5v5zm1-24V3H15v10H3v32h31v-4l3-1v8H0V10.57L11.26 0l25.75.01L37 9l-3-1z"></path>
                                                </svg>
                                            </span>  
                                        </div>
                                        <span><a class="btn btn-default text-center" href="{{route('property.submit.page')}}">{{__('messages.submit_property')}}</a></span>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="cus_table">
                            <div class="thead_back"></div>
                            <div class="cus_table-body">
                                <div class="table-responsive">                                
                                    <table class="table" border="0" cellpadding="0" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>{{__('messages.properties')}}</th>
                                            <th>{{__('messages.added_date')}}</th>
                                            <th>{{__('messages.days_left')}}<br>({{__('messages.day')}})</th>
                                            <th>{{__('messages.views')}}</th>
                                            <th>{{__('messages.edit')}}</th>
                                            <th>{{__('messages.delete')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($properties as $property)                                        
                                                <tr>                                            
                                                    <td colspan="6" class="prop_list_title">
                                                        <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}" target="_blank">{{$property->title}}</a>
                                                        <span>
                                                            @if( app()->isLocale('en')  )
                                                                ( {{$property->velayat->velayat_en}}
                                                                    @if( $property->velayat_id == 6 )
                                                                        {{ ' city' }},
                                                                    @else
                                                                        {{ ' velayat' }},
                                                                    @endif
                                                                     {{$property->city->city_en}}, {{$property->address}} )
                                                            @elseif( app()->isLocale('ru') )
                                                                    @if( $property->velayat_id == 6 )
                                                                        ( {{ 'г. ' . $property->velayat->velayat_ru }},
                                                                    @else
                                                                        ( {{$property->velayat->velayat_ru . ' велаят'}},
                                                                    @endif
                                                                 {{$property->city->city_ru}}, {{$property->address}} )
                                                            @elseif(app()->isLocale('tm'))
                                                                ( {{$property->velayat->velayat_tm}}
                                                                @if( $property->velayat_id == 6 )
                                                                    {{ ' şäheri' }},
                                                                @else
                                                                    {{ ' welaýaty'}},
                                                                @endif
                                                                {{$property->city->city_tm}}, {{$property->address}} )
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr class="prop_list_detail">
                                                    <td>
                                                        <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}" target="_blank">
                                                            <div class="property-text">
                                                                <div class="c_img_frame">
                                                                    <div class="prop_img" style="background-image:url('{{$property->img}}')"></div>
                                                                </div>
                                                            </div>
                                                            <div class="listing_price">{{number_format($property->price, 0, '.', " ")}} {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{$property->saleOrRent ? '' : ' / ' . __('messages.mon_short')}}</div>
                                                        </a>
                                                    </td>
                                                    <td>                                                        
                                                        <span style="{{$property->expired() ? 'color:red' : ''}}">
                                                            @if( $property->expired() )
                                                                <form action="{{route('property.return.expired', ['id' => $property->id, 'type' => 2])}}" method="post" id="myClass">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-prolong">{{__('messages.renew')}}</button>
                                                                </form>    
                                                            @endif
                                                            {{$property->expired() ? __('messages.ann_expired') : $property->created_at->toFormattedDateString()}}
                                                        </span>
                                                        
                                                    </td>
                                                    <td><span>{{abs($property->expiring_at())}}</span></td>
                                                    <td>
                                                        <span>{{$property->views}}</span>
                                                    </td>
                                                    <td>
                                                        <span><a href="{{route('property.edit.page',['id' => $property->id ])}}"><i class="fa fa-lg fa-edit" aria-hidden="true"></i></a></span>                                                
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <a href="javascript:void(0);" id="delete" data-id="{{$property->id}}" onclick="confirmationDelete();">
                                                                <i class="fa fa-lg fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                
                                </div>
                            </div>
                        </div>
                    @endif
                    @foreach($properties as $property)
                        <div class="t_prop_table_wrap">
                            <div class="c_dropdown">
                                <a href="javascript:void(0);" class="c_dropbtn" role="button" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="{{route('property.edit.page', ['id' => $property->id ])}}"><i class="fa fa-edit" aria-hidden="true"></i></a>                                            
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="delete" data-id="{{$property->id}}" onclick="confirmationDelete();"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="property-text t_prop_tab_cont_1">
                                <div class="prop_list_detail">
                                    <a href="{{route($property->type_id == 1 ? 'single.living' : 'single.commercial', ['id' => $property->id])}}">
                                        <div class="property-text">
                                            <div class="c_img_frame">
                                                <div class="prop_img" style="background-image:url('{{$property->img}}')"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>                            
                            <div class="t_prop_tab_cont_2">
                                <div class="t_prop_table_price"><b>{{number_format($property->price, 0, '.', " ")}}</b>&nbsp;&nbsp; {{ $property->price_unit->unit === 'TMT' ? 'TMT' : __('messages.cu')}} {{$property->saleOrRent ? '' : '/' . __('messages.mon_short')}}</div>
                                <div>{{$property->title}}</div>
                                @php
                                    if( app()->isLocale('en')  ){
                                        $temp_add = $property->velayat->velayat_en;

                                        if( $property->velayat_id == 6 ){
                                            $temp_add .= ' city, '; 
                                        } else {
                                            $temp_add .= ' velayat, ';
                                        }

                                        $temp_add .= $property->city->city_en . ', ' .$property->address;

                                    } elseif( app()->isLocale('ru') ) {
                                        
                                        if( $property->velayat_id == 6 ){
                                            $temp_add = 'г. ' . $property->velayat->velayat_ru;
                                        } else {
                                            $temp_add = $property->velayat->velayat_ru . ' велаят';
                                        }                                                                                    

                                        $temp_add .= ', ' . $property->city->city_ru . ', ' . $property->address;

                                    } elseif( app()->isLocale('tm') ){
                                        $temp_add = $property->velayat->velayat_tm;

                                        if( $property->velayat_id == 6 ) {
                                            $temp_add .= ' şäheri, ';
                                        } else {
                                            $temp_add .= ' welaýaty, ';
                                        }

                                        $temp_add .= $property->city->city_tm . ', ' . $property->address;
                                    }
                                @endphp
                                <div>{{ substr($temp_add, 0, 60) . '...' }}</div>
                            </div>
                            <div class="t_prop_tab_footer">
                                <span class="t_prop_tab_footer_tag"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;&nbsp;{{$property->expired() ? __('messages.ann_expired') : $property->created_at->toFormattedDateString()}}</span>
                                <span class="t_prop_tab_footer_tag"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{abs($property->expiring_at())}} {{$property->expired() ? 'ago' : ''}}</span>
                                <span class="t_prop_tab_footer_tag"><i class="fa fa-eye"></i>&nbsp;&nbsp;{{$property->views}}</span>
                            </div>
                        </div>
                    @endforeach
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

                location.href = "http://localhost/edit/" + id;
            });
        });
    </script>
    <script>
        document.getElementById('avata-upload').onchange = function (ev) {
            document.querySelector('.avata-form').submit();
        }
    </script>
    <script>
       function confirmationDelete(){
           const icon = event.target;
           const id = icon.parentNode;
            $.confirm({
                theme:'supervan',
                title: 'Confirm!',
                content: 'Вы действительно хотите удалить свое объявление?',
                buttons: {
                    confirm: function () {
                        window.location.href = '/property/delete/' + id.getAttribute('data-id');
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    },
                }
            });
        }

        $(document).ready(function(){

            $('tr .prop_list_title').mouseover( function(){
                $(this).css({'background-color':'#f5f5f5'}).parent().next().css({'background-color':'#f5f5f5'}); 
            }).mouseout(function(){ 
                $(this).removeAttr('style').parent().next().removeAttr('style');
            });

            $('.prop_list_detail').mouseover( function(){
                $(this).css({'background-color':'#f5f5f5'}).prev().css({'background-color':'#f5f5f5'});
            }).mouseout( function(){
                $(this).removeAttr('style').prev().removeAttr('style');
            });

            $('.c_dropbtn').on('click', function(){ 
                
                var dr_ul = $(this).next('myDropdown');

                if( dr_ul.hasClass('show') ){
                    $(this).attr("aria-expanded",  "true");
                    $(this).parent().addClass('m_dr_back');
                    dr_ul.removeClass('show');
                    
                } else {
                    $(this).attr("aria-expanded",  "false");
                    $(this).parent().removeClass('m_dr_back');
                    dr_ul.addClass('show');
                    
                }
            });

            // Tablet version, close the custom dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
                if( !document.getElementsByClassName('c_dropbtn')[0].contains(event.target) ){
                    
                    document.getElementsByClassName("c_dropbtn")[0].setAttribute("aria-expanded", "false");
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;

                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if( openDropdown.classList.contains('show') ){
                            openDropdown.classList.remove('show');                            
                        }
                    }
                }
            }
        });
    </script>
@endsection