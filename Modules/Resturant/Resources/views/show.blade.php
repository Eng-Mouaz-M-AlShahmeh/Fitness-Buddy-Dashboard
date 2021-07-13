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
                    <a href="{{route('resturant.index')}}">{{__('dashboard.Resturants')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Restaurant Details')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <h5>{{__('dashboard.Main Details')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th>{{__('dashboard.Offer')}} </th>
                                    <th> {{__('dashboard.Icon')}} </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.Type')}} </th>
                                    <th> {{__('dashboard.City')}} </th>
                                    <th> {{__('dashboard.Price Delivery')}} </th>
                                    <th>{{__('dashboard.currency')}}</th>
                                    <th>{{__('dashboard.time')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$resturant->translate('en')->name}}
                                        - {{$resturant->translate('ar')->name}}</td>
                                    <td>{{$resturant->translate('en')->offer}} -
                                    {{$resturant->translate('ar')->offer}}</td>
                                    <td><img class="img-responsive img-thumbnail" src="{{ asset($resturant->icon) }}" style="height: 100px; width: 100px" alt=""></td>
                                    <td><img class="img-responsive img-thumbnail" src="{{ asset($resturant->image) }}" style="height: 100px; width: 100px" alt=""></td>

                                    <td>  @if($resturant->type == '1')
                                            <span class="label label-info">{{__('dashboard.recieved')}}</span>
                                        @else
                                            <span class="label label-danger">{{__('dashboard.delivery')}}</span>
                                        @endif </td>
                                    <td> {{$resturant->city->translate('en')->name}}
                                        - {{$resturant->city->translate('ar')->name}} </td>
                                    <td> {{$resturant->price_delivery}} </td>
                                    <td>{{$resturant->translate('en')->price}} -
                                        {{$resturant->translate('ar')->price}}</td>

                                    <td>{{$resturant->min}} {{$resturant->translate('en')->mins}} -
                                        {{$resturant->translate('ar')->mins}}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <h5>{{__('dashboard.Rates')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.User Name')}} </th>
                                    <th> {{__('dashboard.Rate')}} </th>
                                    <th>{{__('dashboard.Created At')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($rates as $key=>$rate)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$rate->user->name}} </td>
                                        <td> {{$rate->rating}} </td>
                                        <td> {{$rate->created_at}} </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>

    </div>
@endsection

