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
                    <span>{{__('dashboard.Settings')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->

        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Settings Form')}}
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
                        <form id="form_sample_1" class="form-horizontal" action="{{route('settings.update',$settings->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.Privacy In Arabic')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="ar[privacy]" rows="6" data-error-container="#editor2_error">
                                            {{$settings->translate('ar')->privacy}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.Privacy In English')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="en[privacy]" rows="6" data-error-container="#editor2_error">
                                            {{$settings->translate('en')->privacy}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>


                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.About In Arabic')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="ar[about]" rows="6" data-error-container="#editor2_error">
                                            {{$settings->translate('ar')->about}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.About In English')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="en[about]" rows="6" data-error-container="#editor2_error">
                                            {{$settings->translate('en')->about}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.App English Name')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="en[name]" value=" {{$settings->translate('en')->name}}" data-required="1" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.App Arabic Name')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="ar[name]" value=" {{$settings->translate('ar')->name}}" data-required="1" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Image')}}
                                    </label>
                                    <div class="col-md-4">
                                        <img class="img-responsive img-thumbnail" src="{{ $settings->logo }}" style="height: 100px; width: 100px" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.upload Image')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="logo" id="exampleInputFile1">
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
