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
                    <a href="{{route('nutritionist.language.index')}}">{{__('dashboard.Nutritionists Languages')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Add New Nutritionist Languages')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Add New Nutritionist Language')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('nutritionist.language.store')}}" method="post" id="form_sample_1" class="form-horizontal">
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
                                             @if(App::isLocale('ar'))
                                                <option value="{{ $nutritionist->id }}">{{ $nutritionist->translate('ar')->name }}</option>
                                                @else
                                                 <option value="{{ $nutritionist->id }}">{{ $nutritionist->translate('en')->name }}</option>
                                             @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Language')}}
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="language_id">
                                            @foreach($languages as $language)
                                             @if(App::isLocale('ar'))
                                                <option value="{{ $language->id }}">{{ $language->translate('ar')->name }}</option>
                                                @else
                                                 <option value="{{ $language->id }}">{{ $language->translate('en')->name }}</option>
                                             @endif
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
