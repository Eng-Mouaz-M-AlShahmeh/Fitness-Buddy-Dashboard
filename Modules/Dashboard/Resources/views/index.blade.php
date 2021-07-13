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
                    <a href="index.html">{{__('dashboard.Home')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Dashboard')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Dashboard')}}
            <small>{{__('dashboard.dashboard & statistics')}}</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{ \Modules\Resturant\Entities\Resturant::all()->count() }}">{{ \Modules\Resturant\Entities\Resturant::all()->count() }}</span>
                        </div>
                        <div class="desc">{{__('dashboard.Restaurants')}}  </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{ \Modules\FitnessClub\Entities\FitnessClub::all()->count() }}">{{ \Modules\FitnessClub\Entities\FitnessClub::all()->count() }}</span>
                        </div>
                        <div class="desc"> {{__('dashboard.Fitness Clubs')}} </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{ \Modules\Nutritionist\Entities\Nutritionist::all()->count() }}">{{ \Modules\Nutritionist\Entities\Nutritionist::all()->count() }}</span>
                        </div>
                        <div class="desc"> {{__('dashboard.Nutritionist')}} </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="{{ \Modules\Trainer\Entities\Trainer::all()->count() }}">{{ \Modules\Trainer\Entities\Trainer::all()->count() }}</span> </div>
                        <div class="desc"> {{__('dashboard.Trainers')}} </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->









      
          
<div class="row">
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3>{{__('dashboard.Graphic Charts')}}</h3></div>
            <div class="panel-body">
                <table class="table table-condensed" style="border-collapse:collapse;">

          

                <tbody>
                    
                    
                    
                    
                     <!--------------------          chart 1 -------> 
                     
                     
                     
                    <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                        
                            <td>
                                <div class="caption">
                                    <i class=" icon-layers font-green"></i>
                                    <span class="caption-subject font-green bold uppercase">{{__('dashboard.Users Chart')}}</span>
                                </div>
                            </td>

                    </tr>
                    <tr>
                        <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo1"> 
                            <table class="table table-striped">
                         
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="container">
                                            <div id="userGraph" style="height:500px;"></div>
                                            </div>
                                        </td>
                                    </tr>
                    
                                </tbody>
               	            </table>
              
                        </div> </td>
                    </tr>
                    
                    
                     <!--------------------          chart 2 -------> 
                     
                     
                     
                    <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                       
                        <td>
                            <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Resturants Orders Chart')}}</span>
                        </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="6" class="hiddenRow"><div id="demo2" class="accordian-body collapse">
                        
                        <div class="container">
                                            <div id="restsOrdersGraph" style="height:500px;"></div>
                                            </div>
                                            
                                            </div></td>
                    </tr>
                    
                    
                     <!--------------------          chart 3 -------> 
                     
                     
                    <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
                      
                        <td>
                             <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Clubs Orders Chart')}}</span>
                        </div>
                        </td>
                       
                    </tr>
                    <tr>
                        <td colspan="6" class="hiddenRow"><div id="demo3" class="accordian-body collapse">
                        
                        
                        <div class="container">
                                            <div id="clubsOrdersGraph" style="height:500px;"></div>
                                            </div>
                                            
                                            </div></td>
                    </tr>
                    
                    
                     <!--------------------          chart 4 -------> 
                    
                     <tr data-toggle="collapse" data-target="#demo4" class="accordion-toggle">
                       
                        <td> 
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Trainers Orders Chart')}}</span>
                        </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="6" class="hiddenRow"><div id="demo4" class="accordian-body collapse">
                        
                        
                        <div class="container">
                                            <div id="trainersOrdersGraph" style="height:500px;"></div>
                                            </div>
                                            
                                            
                                            </div></td>
                    </tr>
                    
                    
                    
                    
                   <!--------------------          chart 5 -------> 
                     <tr data-toggle="collapse" data-target="#demo5" class="accordion-toggle">
                      
                        <td>
                             <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Nutritionists Orders Chart')}}</span>
                        </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td colspan="6" class="hiddenRow"><div id="demo5" class="accordian-body collapse">
                        
                        
                        <div class="container">
                                            <div id="nutritionistsOrdersGraph" style="height:500px;"></div>
                                            </div>
                                            
                                            
                                            </div></td>
                    </tr>
                    
                    
                </tbody>
                </table>
            </div>
        
          </div> 
        
      </div>
  
     </div>

   
   
   
   
   
   
   <!--
   
   
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Users Chart')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="userGraph" style="height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        
        
        <!--
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Resturants Orders Chart')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="restsOrdersGraph" style="height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        
        
            <!--
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Clubs Orders Chart')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="clubsOrdersGraph" style="height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        
            <!--
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Trainers Orders Chart')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="trainersOrdersGraph" style="height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>




        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        
            <!--
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">{{__('dashboard.Nutritionists Orders Chart')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="nutritionistsOrdersGraph" style="height:500px;"></div>
                    </div>
                </div>
            </div>
        </div>

-->




        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">{{__('dashboard.Last 5 Resturants')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr class="uppercase">
                                    <th>{{__('dashboard.Icon')}}  </th>
                                    <th>{{__('dashboard.Name')}}  </th>
                                    <th> {{__('dashboard.Type')}} </th>
                                    <th> {{__('dashboard.Price Delivery')}} </th>
                                    <th> {{__('dashboard.CLOSED')}} </th>
                                    <th> {{__('dashboard.Min Delivery')}}</th>
                                </tr>
                                </thead>
                                @foreach (\Modules\Resturant\Entities\Resturant::orderBy('id', 'desc')->take(5)->get() as $rest)
                                    @if(App::isLocale('ar'))
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$rest->icon}}"> </td>
                                        <td>
                                            <a href="{{route('resturant.show',$rest->id)}}" class="primary-link">{{$rest->translate('ar')->name}}</a>
                                        </td>
                                        <td> @if($rest->type=='0')رجال @else نساء @endif</td>
                                        <td> {{$rest->price_delivery}} </td>
                                        <td> @if($rest->closed=='0')لا @else نعم @endif </td>
                                        <td>
                                            {{$rest->min}}
                                        </td>
                                    </tr>
                                    @else
                                    
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$rest->icon}}"> </td>
                                        <td>
                                            <a href="{{route('resturant.show',$rest->id)}}" class="primary-link">{{$rest->translate('en')->name}}</a>
                                        </td>
                                        <td> @if($rest->type=='0')Male @else Female @endif</td>
                                        <td> {{$rest->price_delivery}} </td>
                                        <td> @if($rest->closed=='0')No @else Yes @endif </td>
                                        <td>
                                            {{$rest->min}}
                                        </td>
                                    </tr>
                                    
                                    @endif
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">{{__('dashboard.Last 5 Fitness Clubs')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr class="uppercase">
                                    <th> {{__('dashboard.Logo')}} </th>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.Type')}} </th>
                                    <th> {{__('dashboard.City')}} </th>
                                </tr>
                                </thead>
                                @foreach (\Modules\FitnessClub\Entities\FitnessClub::orderBy('id', 'desc')->take(5)->get() as $club)
                                    @if(App::isLocale('ar'))
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$club->logo}}"> </td>
                                        <td>
                                            <a href="{{route('fitness.club.show',$club->id)}}" class="primary-link">{{$club->translate('ar')->name}}</a>
                                        </td>
                                        <td> @if($club->type=='0')رجال @else نساء @endif</td>
                                        <td>{{$club->city->translate('ar')->name}}</td>

                                    </tr>
                                    @else
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$club->logo}}"> </td>
                                        <td>
                                            <a href="{{route('fitness.club.show',$club->id)}}" class="primary-link">{{$club->translate('en')->name}}</a>
                                        </td>
                                        <td> @if($club->type=='0')Male @else Female @endif</td>
                                        <td>{{$club->city->translate('en')->name}}</td>

                                    </tr>
                                    @endif
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">{{__('dashboard.Last 5 Nutritionist')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr class="uppercase">
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.Type')}} </th>
                                    <th> {{__('dashboard.Price')}} </th>
                                    <th> {{__('dashboard.Nationlaity')}} </th>
                                    <th> {{__('dashboard.Date of Birth')}} </th>
                                    <th> {{__('dashboard.Plan')}} </th>
                                </tr>
                                </thead>
                                @foreach (\Modules\Nutritionist\Entities\Nutritionist::orderBy('id', 'desc')->take(5)->get() as $nutri)
                                    @if(App::isLocale('ar'))
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$nutri->image}}"> </td>
                                        <td>
                                            <a href="{{route('nutritionist.show',$nutri->id)}}" class="primary-link">{{$nutri->translate('ar')->name}}</a>
                                        </td>
                                        <td> @if($nutri->type=='0')رجال @else نساء @endif</td>
                                        <td> {{$nutri->price}} </td>
                                        <td> {{$nutri->nationality->translate('ar')->name}} </td>
                                        <td> {{$nutri->age}} </td>
                                        <td>
                                            @if(isset($rest->plan->name))
                                            {{$rest->plan->translate('ar')->name}}
                                            @else
                                            لا يوجد خطط
                                            @endif
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$nutri->image}}"> </td>
                                        <td>
                                            <a href="{{route('nutritionist.show',$nutri->id)}}" class="primary-link">{{$nutri->translate('en')->name}}</a>
                                        </td>
                                        <td> @if($nutri->type=='0')Male @else Female @endif</td>
                                        <td> {{$nutri->price}} </td>
                                        <td> {{$nutri->nationality->translate('en')->name}} </td>
                                        <td> {{$nutri->age}} </td>
                                        <td>
                                            @if(isset($rest->plan->name))
                                            {{$rest->plan->translate('en')->name}}
                                            @else
                                            No plan found
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">{{__('dashboard.Last 5 Trainers')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr class="uppercase">
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.Type')}} </th>
                                    <th> {{__('dashboard.Price')}} </th>
                                    <th> {{__('dashboard.Nationality')}} </th>
                                    <th> {{__('dashboard.Date of Birth')}} </th>
                                    <th> {{__('dashboard.City')}} </th>
                                </tr>
                                </thead>
                                @foreach (\Modules\Trainer\Entities\Trainer::orderBy('id', 'desc')->take(5)->get() as $trainer)
                                    @if(App::isLocale('ar'))
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$trainer->image}}"> </td>
                                        <td>
                                            <a href="{{route('trainer.show',$trainer->id)}}" class="primary-link">{{$trainer->translate('ar')->name}}</a>
                                        </td>
                                        <td> @if($club->type=='0')رجال @else نساء @endif</td>
                                        <td>{{$trainer->price}}</td>
                                        <td>{{$trainer->nationality->translate('ar')->name}}</td>
                                        <td>{{$trainer->age}}</td>
                                        <td>{{$trainer->city->translate('ar')->name}}</td>

                                    </tr>
                                    @else
                                    <tr>
                                        <td class="fit">
                                            <img class="user-pic rounded" src="{{$trainer->image}}"> </td>
                                        <td>
                                            <a href="{{route('trainer.show',$trainer->id)}}" class="primary-link">{{$trainer->translate('en')->name}}</a>
                                        </td>
                                        <td> @if($club->type=='0')Male @else Female @endif</td>
                                        <td>{{$trainer->price}}</td>
                                        <td>{{$trainer->nationality->translate('en')->name}}</td>
                                        <td>{{$trainer->age}}</td>
                                        <td>{{$trainer->city->translate('en')->name}}</td>

                                    </tr>
                                    @endif
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
@endsection
@section('myjsfile')
    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'userGraph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    @foreach($numbers_of_users as $user)
                { y: '{{$user->date}}', a: '{{$user->count}}' }
                @endforeach
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['user number']
        });
    </script>


    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'restsOrdersGraph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    @foreach($numbers_of_rests_orders as $rests_orders)
                { y: '{{$rests_orders->date}}', a: '{{$rests_orders->count}}' }
                @endforeach
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['rests Order number']
        });
    </script>




    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'clubsOrdersGraph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    @foreach($numbers_of_clubs_orders as $clubs_orders)
                { y: '{{$clubs_orders->date}}', a: '{{$clubs_orders->count}}' }
                @endforeach
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['clubs Order number']
        });
    </script>





    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'nutritionistsOrdersGraph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    @foreach($numbers_of_nutritionists_orders as $nutritionists_orders)
                { y: '{{$nutritionists_orders->date}}', a: '{{$nutritionists_orders->count}}' }
                @endforeach
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['nutritionists Order number']
        });
    </script>



    <script>
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'trainersOrdersGraph',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                    @foreach($numbers_of_trainers_orders as $trainers_orders)
                { y: '{{$trainers_orders->date}}', a: '{{$trainers_orders->count}}' }
                @endforeach
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'y',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['trainers Order number']
        });
    </script>
@stop
