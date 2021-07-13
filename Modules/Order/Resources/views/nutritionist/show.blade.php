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
                    <a href="{{route('order.nutritionists.index')}}">{{__('dashboard.Nutritionists Orders')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Nutritionist Order Details')}}
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
                                    <th>{{__('dashboard.payment status')}} </th>

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
                            <h5>{{__('dashboard.Nutritionist Details')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.English About')}} </th>
                                    <th> {{__('dashboard.Arabic About')}}</th>
                                    <th> {{__('dashboard.Level')}} </th>
                                    <th> {{__('dashboard.currency')}}  </th>
                                    <th> {{__('dashboard.class')}} </th>
                                    <th> {{__('dashboard.Plan')}} </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.Price')}} </th>
                                    <th> {{__('dashboard.Age')}} </th>
                                    <th> {{__('dashboard.City')}}</th>
                                    <th> {{__('dashboard.Type')}}</th>
                                    <th> {{__('dashboard.Nationality')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <td> {{$order->nutritionist->translate('en')->name}}
                                    - {{$order->nutritionist->translate('ar')->name}} </td>
                                <td> {{$order->nutritionist->translate('en')->about}} </td>
                                <td> {{$order->nutritionist->translate('ar')->about}} </td>
                                <td> {{$order->nutritionist->translate('en')->level}}
                                    -
                                    {{$order->nutritionist->translate('ar')->level}}
                                </td>
                                <td> {{$order->nutritionist->translate('en')->currency}}
                                    -
                                    {{$order->nutritionist->translate('ar')->currency}}
                                </td>
                                <td> {{$order->nutritionist->translate('en')->class}}
                                    -
                                    {{$order->nutritionist->translate('ar')->class}}
                                </td>
                                <td> {{$order->nutritionist->plan->translate('en')->name}}
                                    -
                                    {{$order->nutritionist->plan->translate('ar')->name}}
                                </td>
                                <td><img class="img-responsive img-thumbnail" src="{{ asset($order->nutritionist->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                <td>{{$order->nutritionist->price}}</td>
                                <td>{{$order->nutritionist->age}}</td>
                                <td>{{$order->nutritionist->city->translate('en')->name}}
                                    - {{$order->nutritionist->city->translate('ar')->name}}</td>
                                <td>  @if($order->nutritionist->type == '1')
                                        <span class="label label-info">{{__('dashboard.Female')}}</span>
                                    @else
                                        <span class="label label-danger">{{__('dashboard.male')}}</span>
                                    @endif </td>
                                <td> {{$order->nutritionist->nationality->translate('en')->name}}
                                    -
                                    {{$order->nutritionist->nationality->translate('ar')->name}}
                                </td>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
        </div>
        
        
              <a href="{{ route('order.nutritionists.pdf',[$order->id]) }}" class="btn btn-info"><i class="fa fa-download"></i> {{__('dashboard.Generate PDF')}}</a>
              
              
              
    </div>
@endsection

