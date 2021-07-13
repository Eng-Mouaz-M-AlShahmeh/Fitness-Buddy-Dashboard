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
                    <a href="{{route('nutritionist.class.index')}}">{{__('dashboard.Nutritionists Classes')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Edit Nutritionist Class')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Edit Nutritionist Class')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('nutritionist.class.update',$nutriClass->id)}}" method="post" id="form_sample_1" class="form-horizontal">
                            @csrf
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Nutritionist')}}
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="nutritionist_id">
                                            @foreach($nutritionists as $nutritionist)
                                                <option  {{ $nutritionist->id == $nutriClass->nutritionist->id ? 'selected' : '' }} value="{{ $nutritionist->id }}">{{ $nutritionist->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Class')}}
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="class_id">
                                            @foreach($classes as $class)
                                                <option {{ $class->id == $nutriClass->class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('dashboard.Submit')}}</button>
                                        <button type="button" class="btn grey-salsa btn-outline">{{__('dashboard.Cancel')}}</button>
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