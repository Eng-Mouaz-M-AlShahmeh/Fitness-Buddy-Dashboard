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
                    <a href="{{route('order.trainers.index')}}">{{__('dashboard.trainers Orders')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.trainers Order Details')}}
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
                                    <th> {{__('dashboard.User Name')}} </th>
                                    <th> {{__('dashboard.Total')}} </th>
                                    <th> {{__('dashboard.Order Number')}} </th>
                                    <th> {{__('dashboard.payment status ')}} </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> {{$order->user->name}} </td>
                                    <td> {{$order->total}} </td>
                                    <td>
                                        {{$order->order_number}}
                                    </td>
                                    <td>
                                        @if($order->payment_status=='0')
                                            <span class="label label-info">{{__('dashboard.cash')}}</span>
                                        @elseif($order->payment_status=='1')
                                            <span class="label label-danger">{{__('dashboard.card')}}</span>
                                        @else
                                            <span class="label label-warning">{{__('dashboard.not paied yet')}}</span>
                                        @endif
                                    </td>
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
                            <h5>{{__('dashboard.Trainer Details')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.English About')}} </th>
                                    <th> {{__('dashboard.Arabic About ')}}</th>
                                    <th> {{__('dashboard.Level')}} </th>
                                    <th> {{__('dashboard.currency')}} </th>
                                    <th> {{__('dashboard.class')}} </th>
                                    <th> {{__('dashboard.Plan')}} </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th>{{__('dashboard.Price')}}  </th>
                                    <th> {{__('dashboard.Date of Birth')}} </th>
                                    <th> {{__('dashboard.City')}}</th>
                                    <th> {{__('dashboard.Gender')}}</th>
                                    <th> {{__('dashboard.Nationality')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <td> {{$order->trainer->translate('en')->name}}
                                    - {{$order->trainer->translate('ar')->name}} </td>
                                <td> {{$order->trainer->translate('en')->about}} </td>
                                <td> {{$order->trainer->translate('ar')->about}} </td>
                                <td> {{$order->trainer->translate('en')->level}}
                                    -
                                    {{$order->trainer->translate('ar')->level}}
                                </td>
                                <td> {{$order->trainer->translate('en')->currency}}
                                    -
                                    {{$order->trainer->translate('ar')->currency}}
                                </td>
                                <td> {{$order->trainer->translate('en')->class}}
                                    -
                                    {{$order->trainer->translate('ar')->class}}
                                </td>
                                <td> {{$order->trainer->plan->translate('en')->name}}
                                    -
                                    {{$order->trainer->plan->translate('ar')->name}}
                                </td>
                                <td><img class="img-responsive img-thumbnail" src="{{ asset($order->trainer->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                <td>{{$order->trainer->price}}</td>
                                <td>{{$order->trainer->age}}</td>
                                <td>{{$order->trainer->city->translate('en')->name}}
                                    - {{$order->trainer->city->translate('ar')->name}}</td>
                                <td>  @if($order->trainer->type == '1')
                                        <span class="label label-info">{{__('dashboard.Female')}}</span>
                                    @else
                                        <span class="label label-danger">{{__('dashboard.male')}}</span>
                                    @endif </td>
                                <td> {{$order->trainer->nationality->translate('en')->name}}
                                    -
                                    {{$order->trainer->nationality->translate('ar')->name}}
                                </td>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>



              <a href="{{ route('order.trainers.pdf',[$order->id]) }}" class="btn btn-info"><i class="fa fa-download"></i> {{__('dashboard.Generate PDF')}}</a>                      
                                                                
    </div>
@endsection

