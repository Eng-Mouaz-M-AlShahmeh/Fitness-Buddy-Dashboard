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
                    <a href="{{route('resturant.index')}}">{{__('dashboard.Resturants')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Edit Resturant')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Edit Resturant Form')}}
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
                            <span class="caption-subject font-red sbold uppercase">{{__('dashboard.Resturant Basic Validation')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('resturant.update',$resturant->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
                                        <input type="text" id="ar[name]" value="{{$resturant->translate('ar')->name}}" name="ar[name]" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Name EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[name]" id="en[name]" value="{{$resturant->translate('en')->name}}" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Offer AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[offer]" name="ar[offer]" value="{{$resturant->translate('ar')->offer}}" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Offer EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[offer]" id="en[offer]" value="{{$resturant->translate('en')->offer}}" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Currency AR')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[price]" name="ar[price]" value="{{$resturant->translate('ar')->price}}" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Currency EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[price]" id="en[price]" value="{{$resturant->translate('en')->price}}" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Time AR')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="time" id="ar[mins]" name="ar[mins]" value="{{$resturant->translate('ar')->mins}}" class="form-control" /> </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Time EN')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="time"  name="en[mins]" value="{{$resturant->translate('en')->mins}}" id="en[mins]" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Plan')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="plan_id" id="plan_id">
                                            @foreach($plans as $plan)
                                                <option {{ $plan->id == $resturant->plan->id ? 'selected' : '' }} value="{{$plan->id}}">{{$plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select City')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="city_id" id="city_id">
                                            @foreach($cities as $city)
                                                <option {{ $city->id == $resturant->city->id ? 'selected' : '' }} value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Price Delivery')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" id="price_delivery" value="{{$resturant->price_delivery}}" name="price_delivery" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Type')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="type">
                                            <option value="0" {{ isset($resturant) && $resturant->{'type'} == 0 ? 'selected'  :'' }}>{{__('dashboard.delivery')}} </option>
                                            <option value="1" {{ isset($resturant) && $resturant->{'type'} == 1 ? 'selected'  :'' }}>{{__('dashboard.recieved')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.CLOSED')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="closed">
                                            <option value="0" {{ isset($resturant) && $resturant->{'closed'} == 0 ? 'selected'  :'' }}>{{__('dashboard.no')}}</option>
                                            <option value="1" {{ isset($resturant) && $resturant->{'closed'} == 1 ? 'selected'  :'' }}>{{__('dashboard.yes')}}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.lat')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="lat" value="{{$resturant->lat}}" name="lat" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.lng')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="lng" value="{{$resturant->lng}}" name="lng" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.min')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" id="min" name="min" value="{{$resturant->min}}"  class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Terms AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text" id="ar[terms]" rows="8" name="ar[terms]" class="form-control">{{$resturant->translate('ar')->terms}}</textarea> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Terms EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text"  name="en[terms]" rows="8" id="en[terms]" class="form-control" >{{$resturant->translate('en')->terms}}</textarea> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Icon')}}
                                    </label>
                                    <div class="col-md-4">
                                        <img class="img-responsive img-thumbnail" src="{{$resturant->icon }}" style="height: 100px; width: 100px" alt="">                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.upload Icon')}}
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="icon" id="exampleInputFile1">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Image')}}
                                    </label>
                                    <div class="col-md-4">
                                        <img class="img-responsive img-thumbnail" src="{{$resturant->image }}" style="height: 100px; width: 100px" alt="">                                    </div>
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
