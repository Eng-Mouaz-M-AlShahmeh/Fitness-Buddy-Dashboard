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
                    <a href="{{route('order.clubs.index')}}">{{__('dashboard.Clubs Orders')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Club Order Details')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <h5>{{__('dashboard. Main Details')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> {{__('dashboard.User Name')}}  </th>
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
                            <h5>{{__('dashboard.Club Details')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.name')}}</th>
                                    <th> {{__('dashboard.logo')}} </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.Type')}} </th>
                                    <th> {{__('dashboard.City')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($clubDetails as $key=>$club)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$club->name}} </td>
                                        <td><img class="img-responsive img-thumbnail" src="{{ asset($club->logo) }}" style="height: 100px; width: 100px" alt=""></td>
                                        <td><img class="img-responsive img-thumbnail" src="{{ asset($club->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                        <td>  @if($club->type == '1')
                                                <span class="label label-info">{{__('dashboard.Female')}} </span>
                                            @else
                                                <span class="label label-danger">{{__('dashboard.male')}}</span>
                                            @endif </td>
                                        <td> {{$club->city->translate('en')->name}}
                                            - {{$club->city->translate('ar')->name}} </td>
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
                            <h5>{{__('dashboard.Subscription Details')}}</h5>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Price')}}</th>
                                    <th> {{__('dashboard.Name')}}</th>
                                    <th> {{__('dashboard.Currency')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($subDetails as $key=>$sub)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$sub->price}} </td>
                                        <td> {{$sub->name}} </td>
                                        <td> {{$sub->currency}} </td>
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
        

              <a href="{{ route('order.clubs.pdf',[$order->id]) }}" class="btn btn-info"><i class="fa fa-download"></i> {{__('dashboard.Generate PDF')}}</a>                      
                                   
                                                          
                                        
                                        
                                        
    </div>
@endsection

