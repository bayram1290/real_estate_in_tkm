@extends('layouts.front')

@section('content')
    <!-- Banner Section Start -->
    <section id="banner">
        <div class="container">
            <div class="page_location">
                <a href="{{route('index')}}">{{__('messages.home')}}</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="it_cap">{{__('messages.complaint_form')}}</span>
            </div>
            <h3 class="page_title m-b-0">{{__('messages.complaint_form')}}</h3>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Complaint Section Start -->
    <section id="report">
        <div class="container">
            <div class="modal-dialog report_wrapper">
                <div class="modal-header toggle_header">
                    <h4 class="inner-title">{{__('messages.complaint_header')}}</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('report.complain',['id' => $id])}}" method="post" id="complaint-form"  class="contact_message">
                        {{csrf_field()}}
                        <div class="row">

                            <div class="form-group{{$errors->has('fullName') ? ' has-error' : ''}}">
                                <input type="text" class="form-control" id="full_name" name="fullName" placeholder="{{__('messages.full_name')}}" value="{{Auth::id() ? Auth::user()->name : ''}}" required>
                                @if($errors->has('fullName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fullName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{__('messages.email_address')}}" value="{{Auth::id() ? Auth::user()->email : ''}}" required>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                
                            </div>
                            <div class="form-group{{$errors->has('phone') ? 'has-error' : '' }}">
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="{{__('messages.phone_number')}}" value="{{Auth::id() ? Auth::user()->phone : ''}}" required>
                                @if($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                            <div class="form-group">
                                <select name="subject" class="form-control selectpicker" required>
                                    <option selected disabled style="display:none" value> {{__('messages.complain_subject')}}</option>
                                    @foreach( $m_comps as $c_m )
                                        <option class="comSub{{ $c_m->id }}" value="{{ $c_m->id }}">@if(Lang::locale() == 'ru') {{$c_m->ru }}
                                        @elseif(Lang::locale() == 'en') {{$c_m->en }}
                                        @else {{$c_m->tm }}
                                        @endif</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="detail" class="form-control selectpicker" required>
                                    <option selected disabled class="def_com_detail hide" value> {{__('messages.complain_detail')}}</option>
                                    @foreach($d_comps as $c_d)
                                        <option class="comDet{{$c_d->complaint_id}} hide" value="{{ $c_d->id }}">@if(Lang::locale() == 'ru') {{$c_d->ru}}
                                        @elseif(Lang::locale() == 'en') {{$c_d->en}}
                                        @else {{$c_d->tm}}
                                        @endif</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="submit_area">
                                <button type="submit" name="submit" class="btn btn-default">{{__('messages.send')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Complaint Section End -->
@endsection
@section('scripts')    
    <script src="/js/mask.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', 'a[class^="comSub"]', function(){
                var com_sub_no = $(this).attr('class');
                com_sub_no = com_sub_no.substr(6, com_sub_no.length - 6);
                
                $('a[class^="comDet"]').addClass('hide');
                $('a.comDet' + com_sub_no).removeClass('hide');

                $('select[name="detail"]').val('');//Assign default value to the complaint detail select
                var def_val = $('li a.def_com_detail');
                
                $('a.def_com_detail').parents('.bootstrap-select').find('button .filter-option').text(def_val.text());
                def_val.parents('ul').find('li').each(function(i){
                    $(this).removeClass('selected').find('a').prop('aria-selected', false);
                    if( i==0 ) $(this).addClass('selected').find('a').prop('aria-selected', true);
                });
            });
        });
    </script>
@endsection
