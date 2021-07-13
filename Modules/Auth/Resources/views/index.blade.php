@extends('auth::layouts.master')

@section('content')

        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" action="{{route('admins.login')}}" method="post">
            @csrf
            <h3 class="form-title font-green">Sign In</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any email and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
            <div class="form-actions" style="text-align: center;">
                <button type="submit" class="btn green uppercase">Login</button>
            </div>

        </form>
        <!-- END LOGIN FORM -->


@endsection
