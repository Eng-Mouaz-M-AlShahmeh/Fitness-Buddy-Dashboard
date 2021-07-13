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
                    <a href="{{route('order.resturants.index')}}">{{__('dashboard.Resturants Orders')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Restaurant Order Details')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <h5>{{__('dashboard.Main Details')}} </h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> {{__('dashboard.User Name')}} </th>
                                    <th> {{__('dashboard.Resturant')}} </th>
                                    <th> {{__('dashboard.Total')}} </th>
                                    <th>{{__('dashboard.Status')}}  </th>
                                    <th>{{__('dashboard.Order Number')}}   </th>
                                    <th>{{__('dashboard.payment status')}} </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> {{$order->user->name}} </td>
                                    <td> {{$order->resturant->name}} </td>
                                    <td> {{$order->total}} </td>
                                    <td>
                                        @if($order->status=='0')
                                            <span class="label label-info">{{__('dashboard.in processing')}}</span>
                                        @elseif($order->status=='1')
                                            <span class="label label-warning">{{__('dashboard.in delivery')}} </span>
                                        @elseif($order->status=='2')
                                            <span class="label label-success">{{__('dashboard.delivered')}}</span>
                                        @else
                                            <span class="label label-danger">{{__('dashboard.cancelled')}}</span>
                                        @endif

                                    </td>
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
                            <h5>{{__('dashboard.Meals Order')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Meal')}}</th>
                                    <th> {{__('dashboard.quantity')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderCarts as $key=>$cart)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$cart->meal->name}} </td>
                                        <td> {{$cart->quantity}} </td>
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

        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <h5>{{__('dashboard.Modifiers Order')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Modifier')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderModifiers as $key=>$order)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$order->modifier->modifier}} </td>
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
        

              <a href="{{ route('order.resturants.pdf',[$order->id]) }}" class="btn btn-info"><i class="fa fa-download"></i> {{__('dashboard.Generate PDF')}}</a>                      
                                   
                                   
                                   
    </div>
@endsection

