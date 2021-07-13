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
                    <a href="{{route('trainer.index')}}">{{__('dashboard.Trainers')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Trainer Details')}}
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
                                    <th> {{__('dashboard.English About')}} </th>
                                    <th> {{__('dashboard.Arabic About')}} </th>
                                    <th> {{__('dashboard.Level')}}  </th>
                                    <th> {{__('dashboard.currency')}} </th>
                                    <th> {{__('dashboard.class')}} </th>
                                    <th> {{__('dashboard.Plan')}} </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.Price')}} </th>
                                    <th> {{__('dashboard.date of birth')}} </th>
                                    <th> {{__('dashboard.City')}}</th>
                                    <th> {{__('dashboard.Type')}}</th>
                                    <th> {{__('dashboard.Nationality')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> {{$trainer->translate('en')->name}}
                                        - {{$trainer->translate('ar')->name}} </td>
                                    <td> {{$trainer->translate('en')->about}} </td>
                                    <td> {{$trainer->translate('ar')->about}} </td>
                                    <td> {{$trainer->translate('en')->level}}
                                        -
                                        {{$trainer->translate('ar')->level}}
                                    </td>
                                    <td> {{$trainer->translate('en')->currency}}
                                        -
                                        {{$trainer->translate('ar')->currency}}
                                    </td>
                                    <td> {{$trainer->translate('en')->class}}
                                        -
                                        {{$trainer->translate('ar')->class}}
                                    </td>
                                    <td> {{$trainer->plan->translate('en')->name}}
                                        -
                                        {{$trainer->plan->translate('ar')->name}}
                                    </td>
                                    <td><img class="img-responsive img-thumbnail" src="{{ asset($trainer->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                    <td>{{$trainer->price}}</td>
                                    <td>{{$trainer->age}}</td>
                                    <td>{{$trainer->city->translate('en')->name}}
                                        - {{$trainer->city->translate('ar')->name}}</td>
                                    <td>  @if($trainer->type == '1')
                                            <span class="label label-info">{{__('dashboard.Female')}}</span>
                                        @else
                                            <span class="label label-danger">{{__('dashboard.male')}}</span>
                                        @endif </td>
                                    <td> {{$trainer->nationality->translate('en')->name}}
                                        -
                                        {{$trainer->nationality->translate('ar')->name}}
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
                                        <td> {{$rate->rate}} </td>
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

