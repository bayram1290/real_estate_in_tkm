<div class="col-lg-3 col-md-3 col-sm-12 cBr">
    <div class="settings_links">
        <ul>
            <li><span>{{__('messages.settings_account')}}</span></li>
            <li class="{{Request::url() === route('profile.user') ? 'active' : ''}}"><a href="{{route('profile.user')}}"><i class="flaticon-user"></i>{{__('messages.my_profile')}}</a></li>
        </ul>
        <ul>
            <li><span>{{__('messages.manage_settings')}}</span></li>
            <li class="{{Request::url() === route('my_properties') ? 'active' : ''}}"><a href="{{route('my_properties')}}"><i class="flaticon-home"></i>{{__('messages.my_properties')}} <span class="props_count">{{Auth::user()->properties()->count()}}</span></a></li>
            <li class="{{Request::url() === route('favorite.properties') ? 'active' : ''}}"><a href="{{route('favorite.properties')}}"><i class="flaticon-star"></i>{{__('messages.favorited_properties')}}</a></li>
            <li><a href="{{route('property.submit.page')}}"><i class="flaticon-pencil-and-paper"></i>{{__('messages.submit_property')}}</a></li>
        </ul>
        <ul>
            <li class="{{Request::url() === route('user.change_pswd') ? 'active' : ''}}"><a href="{{route('user.change_pswd')}}"><i class="flaticon-locked"></i>{{__('messages.change_password')}}</a></li>
            <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"><i class="flaticon-upload"></i>{{__('messages.logout')}}</a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>