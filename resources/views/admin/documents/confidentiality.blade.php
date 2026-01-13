@extends('admin.app')
@section('header')
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('css/dashboard/morris.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('css/dashboard/jquery.toast.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/dashboard/style.min.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('css/dashboard/dashboard1.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    @yield('header')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <form action="{{route('admin.confidentiality.post')}}" method="post">
                {{csrf_field()}}
                <label for="editor">Заполните поле</label>
                <textarea name="editor" id="editor" cols="30" rows="10">{{$confidentiality}}</textarea>
                <br>
                <button class="btn btn-success" name="submit" id="submit">Подтвердить</button>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('js/dashboard/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ asset('js/dashboard/popper.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/dashboard/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/dashboard/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/dashboard/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/dashboard/custom.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{ asset('js/dashboard/raphael-min.js') }}"></script>
    <script src="{{ asset('js/dashboard/morris.min.js') }}"></script>
    <script src="{{ asset('js/dashboard/jquery.sparkline.min.js') }}"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('js/dashboard/jquery.toast.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('js/dashboard/dashboard1.js') }}"></script>

    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endsection