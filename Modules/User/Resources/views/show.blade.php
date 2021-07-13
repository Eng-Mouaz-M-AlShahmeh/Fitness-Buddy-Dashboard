@extends('dashboard::layouts.master')

@section('content')
<div class="page-content">

    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN THEME PANEL -->

    <!-- END THEME PANEL -->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{route('dashboard.index')}}">{{__('dashboard.Home')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{route('user.index')}}">{{__('dashboard.Users')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{__('dashboard.User Details')}}</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">{{__('dashboard.User Details Form')}}
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->


    <div class="row">
        <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">{{__('dashboard.Basic Data')}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form id="form_sample_1" class="form-horizontal" >

                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Name')}}
                                </label>
                                <div class="col-md-4">
                                    <input type="text" data-required="1"
                                           value="{{$user->name}}"
                                           class="form-control" name="name" readonly/> </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Email')}}

                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           value="{{$user->email}}"
                                           class="form-control" name="email" readonly/> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Phone')}}

                                </label>
                                <div class="col-md-4">
                                    <input type="number"
                                           value="{{$user->mobile}}"
                                           class="form-control" name="mobile" readonly/> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.length')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="number"
                                            value="{{$user->length}}"
                                            class="form-control" name="length" readonly/> </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.weight')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="number"
                                            value="{{$user->weight}}"
                                            class="form-control" name="weight" readonly/> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Date of Birth')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="text"
                                            value="{{$user->age}}"
                                            class="form-control" name="age" readonly/> </div>
                            </div>


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{route('user.index')}}" type="submit" class="btn green">{{__('dashboard.Back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>


</div>
@endsection
