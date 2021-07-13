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
                    <a href="{{route('dashboard.index')}}">{{__('dashboard.Home')}} </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    @if(App::isLocale('ar'))
                    <span>{{$meal_id->translate('ar')->name}}</span>
                    <i class="fa fa-circle"></i>
                    @else
                    <span>{{$meal_id->translate('en')->name}}</span>
                    <i class="fa fa-circle"></i>
                    @endif
                </li>
                <li>
                    <a href="{{route('resturant.meal.info',$meal_id->id)}}">{{__('dashboard.Meal Modifier')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Add New Meal Modifier')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Add New Meal Modifier')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('resturant.meal.modifiers.store',$meal_id->id)}}" method="post" id="form_sample_1" class="form-horizontal">
                            @csrf
                            <input name="meal_id" type="hidden" value="{{$meal_id->id}}">
                            
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                
{{--                                <div class="form-group">--}}
{{--                                    <label class="control-label col-md-3">{{__('dashboard.Select Meal')}}--}}
{{--                                         <span class="required" aria-required="true"> * </span> --}}
{{--                                    </label>--}}
{{--                                    <div class="col-md-4">--}}
{{--                                        <select class="form-control" name="meal_id">--}}
{{--                                            @foreach($meals as $meal)--}}
{{--                                                <option value="{{ $meal->id }}">{{ $meal->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Modifier')}}
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="modifier_id">
                                            @foreach($modifiers as $modifier)
                                                <option value="{{ $modifier->id }}">{{ $modifier->modifier }}</option>
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
