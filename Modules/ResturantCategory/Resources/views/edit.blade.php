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
                    <a href="{{route('resturant.index')}}">{{__('dashboard.Restaurants')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Edit Resturant Category')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Edit Resturant Category Form')}}
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
                            <span class="caption-subject font-red sbold uppercase">{{__('dashboard.Resturant Category Basic Validation')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('resturant.categories.update',$restCats->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input name="resturant_id" type="hidden" value="{{$restCats->resturant_id}}">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Name AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[name]" value="{{$restCats->translate('ar')->name}}" name="ar[name]" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Name EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[name]" value="{{$restCats->translate('en')->name}}" id="en[name]" class="form-control" /> </div>
                                </div>



{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label col-md-3">{{__('dashboard.Select Resturant')}}--}}
{{--                                        <span class="required"> * </span>--}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <select class="form-control" name="resturant_id" id="resturant_id">--}}
{{--                                            @foreach($rests as $resturant)--}}
{{--                                                <option {{ $resturant->id == $restCats->resturant->id ? 'selected' : '' }} value="{{$resturant->id}}">{{$resturant->name}} - {{$resturant->plan->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Monthly Meal')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="meal_day_id" id="meal_day_id">
                                            @foreach($mealsdays as $day)
                                              @if(App::isLocale('ar'))
                                                <option value="{{$day->id}}">{{$day->translate('ar')->name}}</option>
                                              @else
                                                <option value="{{$day->id}}">{{$day->translate('en')->name}}</option>
                                              @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('dashboard.Submit')}} </button>
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
