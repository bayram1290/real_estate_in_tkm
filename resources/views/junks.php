<html>
    <script>
        $('.kv_pop1').text("{{__('messages.room')}}");
        $('input[id^="room_fill"], input[id^="parking"]').prop('checked', false);
        @if( isset($selected_min_price) || isset($selected_max_price) )
                    var min_pr ="{{$selected_min_price ?  $selected_min_price : 0}}", max_pr ="{{$selected_max_price ? $selected_max_price : 5000000}}"; 
                    min_pr = min_pr.replace(',', ''); 
                    max_pr = max_pr.replace(',', ''); 
                    $('.filter_price').slider('value', min_pr, max_pr); 
                @endif
                
                @if( isset($price) )
                    var prices=@json($price), n; 
                    prices=prices.toString(); 
                    n=prices.indexOf(';'); 
                    $('.filter_price').slider('value', prices.substr(0, n), prices.substring((n+1))) 
                @endif
                
                @if( isset($selected_min_area) || isset($selected_max_area) ) 
                    var min_ar="{{$selected_min_area ? $selected_min_area:0}}", max_ar="{{$selected_max_area ? $selected_max_area:10000}}"; $(".area_filter").slider('value', min_ar, max_ar); 
                @endif

                @if( isset($area) )
                    var area=@json($area), n1;
                    area=area.toString();
                    n1=area.indexOf(';');
                    $('.area_filter').slider('value', area.substr(0,n1), area.substring((n1+1)));
                @endif

                @if( isset($selected_rooms) )
                    var dumps = @json($selected_rooms), 
                        ind=0,len, 
                        cVak='';

                        for(len=dumps.length;ind<len;++ind){
                            $('input[id^="room_fill_' + dumps[ind] + '"]').prop('checked', true);
                            cVak+=dumps[ind].toString() + ', '; 
                        }

                    switch(len){
                        case 1: 
                            $('.kv_pop1').text(dumps[0] +'-{{__('messages.roomed')}}'); 
                            break;
                        case 2: 
                            $('.kv_pop1').text(dumps[0] + ', ' + dumps[1]  + ' {{__("messages.room_sh1")}}'); 
                            break;
                        default: 
                            $('.kv_pop1').text(cVak.substring(0, cVak.length - 2) + '   ' + '{{__("messages.room_sh2")}}');
                    }
                @endif
                
                @if( isset($sel_pr_terr) && ($selected_deal == 0) ) 
                    $('#rent_pr_terr div .btn:eq(' + ({{$sel_pr_terr}}) + ')').addClass('active').find('input').prop('checked',true);
                    console.log('1'); 
                @endif

                @if( isset($sel_pr_terr) && ($selected_deal==1) ) 
                    $('#sale_pr_terr div .btn:eq(' + {{$sel_pr_terr}} + ')').addClass('active').find('input').prop('checked',true); 
                @endif 

                @if( isset($selected_t_rents) ) 
                    $('select[name="t_rents"]').next().find('.c_opt:eq(' + {{ $selected_t_rents }} + ')').trigger('click'); 
                @endif

                @if( isset($selected_decor) ) 
                    $('select[name="decor"]').next().find('.c_opt:eq(' + {{ $selected_decor }} + ')').trigger('click'); 
                @endif

                @if( isset($selected_res_park) ) 
                    $('#s_res_parking .btn:eq(' + ({{$selected_res_park}} < 2 ? {{$selected_res_park}} : 2) + ')').trigger('click'); 
                @endif

                @if( isset($selected_com_park) )
                    $('#s_com_parking .btn:eq(' + {{$selected_com_park}} + ')').trigger('click');
                @endif 

                @if( isset($selected_buss_t_prop) )  
                    $('select[name="buss_t_prop"]').next().find('.c_opts').find('.option:eq(' + {{$selected_buss_t_prop}} + ')').trigger('click'); 
                @endif

                @if( isset($selected_prop_status) )
                    $('select[name="prop_status"]').next().find('.c_opts').find('.option:eq(' + {{$selected_prop_status}} + ')').trigger('click'); 
                @endif

                @if( isset($selected_cond) )
                    $('select[name="condition"]').next().find('.c_opts').find('.option:eq(' + {{$selected_cond}} + ')').trigger('click');
                @endif

                @if( isset($selected_filter) )
                    $('select[name="filter"]').next().find('.c_opts').find('.option:eq(' + ({{$selected_filter}} > 2 ? ({{$selected_filter}} - 2) : 0)   + ')').trigger('click');
                @endif

                @if(isset($selected_features)) 
                    var feas = @json($selected_features); feas.map(function(item){ $('.infras1:eq(' + (item - 1) + ')').find('input').prop('checked', true);}); 
                @endif 

                @if( isset($selected_infras) ) 
                    var infas = @json($selected_infras); infas.map(function(item1){ $('.infras2:eq(' + (item1 - 1) + ')').find('input').prop('checked', true);}); 
                @endif
    </script>
</html>  




<div class="form-group row">
    <label for="pkv_elite_sale" class="col-lg-4 col-md-3 col-sm-4 form-label1 p-r-0">{{__('messages.sale_type')}}<i class="fa fa-certificate pull-right"></i></label>
    <div class="btn-group toGGle col-lg-8 col-md-9 col-sm-8 dec_btns2" id="pkv_elite_sale" data-toggle="buttons">
        @foreach($sale_types as $sale_type)
            <label class="btn btn-primary {{$sale_type->id == 1 ? 'cusBorRad1' : 'cusBorRad2'}} {{ $sale_type->id == $property->sale_type_id ? 'active' : ''}}">
                <input type="radio" name="sale_type" value="{{ $sale_type->id }}" {{ $sale_type->id == $property->sale_type_id ? 'checked=checked' : ''}} required>@if(Lang::locale() == 'ru') {{$sale_type->type_ru}}
                    @elseif(Lang::locale() == 'en') {{$sale_type->type_en}}
                    @else {{$sale_type->type_tm}}
                    @endif
                    @if($sale_type->id==2)
                        <div class="hide tool_tab_max1" style="right:-22px;top:-2px" data-tooltip="{{ __('messages.form_feed19') }}" data-tooltip-position="right"></div>
                        <div class="rad_btn_err1 sel_err_invis">{{ __('messages.form_feed19') }}</div>
                    @endif</label>
                    @if($sale_type->id==2)
                    <span class="diff_tooltip_wrap"><a class="diff_tooltip" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-html="true" title="<div class='text-left'><b>{{ __('messages.free1') }}</b> {{ __('messages.free1_sale_exp') }}</div><br><div class='text-left'><b>{{ __('messages.alternative') }}</b> {{ __('messages.alt_sale_exp') }}</div>">{{ __('messages.what_diff') }}</a></span>
                    @endif
        @endforeach
    </div>
</div>