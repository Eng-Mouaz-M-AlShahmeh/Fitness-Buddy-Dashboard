@extends('dashboard::layouts.master')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('dashboard.index')}}">{{__('dashboard.Home')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{route('club.sliders.index')}}">{{__('dashboard.Departments sliders')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.edit department slider Form')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.edit department slider Form')}}
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
                            <span class="caption-subject font-red sbold uppercase">{{__('dashboard.edit department slider Form')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('dept.slider.update',$deptSlider->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Department')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="dept_id" id="dept_id">
                                            @foreach($depts as $dept)
                                                <option {{ $dept->id == $deptSlider->department->id ? 'selected' : '' }}  value="{{$dept->id}}">{{$dept->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Title AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[title]" name="ar[title]" value="{{$deptSlider->translate('ar')->title}}" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Title EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[title]" id="en[title]" value="{{$deptSlider->translate('en')->title}}" class="form-control" /> </div>
                                </div>


                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.Description In Arabic')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="ar[desc]" rows="6" data-error-container="#editor2_error">
                                        {{$deptSlider->translate('ar')->desc}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.Description In English')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="en[desc]" rows="6" data-error-container="#editor2_error">
                                      {{$deptSlider->translate('en')->desc}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Image')}}
                                    </label>
                                    <div class="col-md-4">
                                        <img class="img-responsive img-thumbnail" src="{{$deptSlider->slider }}" style="height: 100px; width: 100px" alt="">                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.upload Image')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="slider" id="exampleInputFile1">
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
