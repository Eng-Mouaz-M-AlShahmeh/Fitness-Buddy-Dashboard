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
                    <a href="{{route('nutritionist.index')}}">{{__('dashboard.Nutritionists')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Create Nutritionist')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Create Nutritionist Form')}}
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
                            <span class="caption-subject font-red sbold uppercase">{{__('dashboard.Nutritionist Basic Validation')}} </span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('nutritionist.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
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
                                        <input type="text" id="ar[name]" name="ar[name]" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Name EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[name]" id="en[name]" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.About AR')}}
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text" id="ar[about]" rows="8" name="ar[about]" class="form-control"></textarea> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.About EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text"  name="en[about]" rows="8" id="en[about]" class="form-control" ></textarea> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.level AR')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[level]" name="ar[level]" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.level EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[level]" id="en[level]" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Currency AR')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[currency]" name="ar[currency]" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Currency EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[currency]" id="en[currency]" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.class Ar')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[class]" name="ar[class]" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.class EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[class]" id="en[class]" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Plan')}}
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="plan_id" id="plan_id">
                                              @foreach($plans as $plan)
                                             @if(App::isLocale('ar'))
                                                <option value="{{$plan->id}}">{{$plan->translate('ar')->name}}</option>
                                                @else
                                                   <option value="{{$plan->id}}">{{$plan->translate('en')->name}}</option>
                                             @endif
                                            @endforeach
              
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select City')}}
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="city_id" id="city_id">
                                            @foreach($cities as $city)
                                             @if(App::isLocale('ar'))
                                                <option value="{{$city->id}}">{{$city->translate('ar')->name}}</option>
                                                @else
                                                   <option value="{{$city->id}}">{{$city->translate('en')->name}}</option>
                                             @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Nationality')}}
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="nationality_id" id="nationality_id">
                                                  @foreach($nationalities as $nationality)
                                             @if(App::isLocale('ar'))
                                                <option value="{{$nationality->id}}">{{$nationality->translate('ar')->name}}</option>
                                                @else
                                                   <option value="{{$nationality->id}}">{{$nationality->translate('en')->name}}</option>
                                             @endif
                                            @endforeach
                                        </select>
            
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.price')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" id="price" name="price" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.date of birth')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="date" id="dob" name="age" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Type')}}
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="type">
                                            <option value="0">{{__('dashboard.male')}} </option>
                                            <option value="1">{{__('dashboard.female')}}</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.lat')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="lat" name="lat" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.lng')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="lng" name="lng" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.available time')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="time" id="available_time" name="available_time" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Terms AR')}}
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text" id="ar[terms]" rows="8" name="ar[terms]" class="form-control"></textarea> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Terms EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text"  name="en[terms]" rows="8" id="en[terms]" class="form-control" ></textarea> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.upload Image')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="image" id="exampleInputFile1">
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
