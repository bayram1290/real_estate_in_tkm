@extends('layouts.front')

@section('content')
    <section id="submit_property">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <form action="{{route('profile.edit.submit',['id' => $profile->user_id])}}" method="post" class="submit_form" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="basic_information">
                            <h4 class="inner-title">Basic Information</h4>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="First Name" name="first_name" value="{{$profile->first_name}}" class="form-control" required>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="Last Name" name="last_name" value="{{$profile->last_name}}" class="form-control" required>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <input type="text" placeholder="Phone" name="phone" value="{{$profile->add_phone}}" class="form-control" required>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                            </div>
                            <div class="alert alert-warning">Please input the correct information of your property. Because it will effect on property search.</div>
                        </div>
                        <div class="description">
                            <h4 class="inner-title">Description</h4>
                            <textarea name="about" placeholder="About" class="form_description" required>{{$profile->about}}</textarea>
                            <div class="alert alert-warning">Need a proper description about the property. So that client can easily understand about the property.</div>
                        </div>
                        <div class="browse_submit">
                            <button name="submit" class="btn btn-default">submit changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection