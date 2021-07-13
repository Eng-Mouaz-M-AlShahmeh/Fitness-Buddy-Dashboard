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
        <h1 class="page-title">{{__('dashboard.Clubs Orders Datatable')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th> # </th>
                                     <th> {{__('dashboard.Order ID')}} </th>
                                    <th> {{__('dashboard.User Name')}}  </th>
                                    <th> {{__('dashboard.Club')}} </th>
                                    <th> {{__('dashboard.Subscription')}} </th>
                                    <th> {{__('dashboard.Total')}} </th>
                                    <th> {{__('dashboard.Accepted')}}  </th>
                                    <th>{{__('dashboard.payment status')}}  </th>
                                    <th>{{__('dashboard.Created At')}}</th>

                                    <th>{{__('dashboard.Ended At')}}</th>
                                    <th>{{__('dashboard.Updated At')}}</th>

                                    <th>{{__('dashboard.Pause Period in Days')}}</th>

                                   <!--
                                   <th>{{__('dashboard.Remaining Time Counter for Subscription End')}}</th>
                                   -->
                                   
                                    <th> {{__('dashboard.Actions')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $key=>$order)
                                  @if(App::isLocale('ar'))
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$order->id}} </td>
                                        <td> {{$order->user->name}} </td>
                                        <td> {{$order->club->translate('ar')->name}} </td>
                                        <td> {{$order->subscription->translate('ar')->name}} </td>
                                        <td> {{$order->total}} </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="pause({{$order->id}})"
                                                           <?php if($order->accepted == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $order->id }}"
                                                           data-size="small">

                                                </div>
                                            </div>
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
                                        <td>  {{$order->created_at}} </td>


                                        <td>  {{$order->ended_at}} </td>

                                        <td>  {{$order->updated_at}} </td>

                                        <td>  {{$order->pause_period}} </td>

<!--
                                        <td>
                                            <span id="demo"></span>

                                        </td>

-->

                                        <td>
                                            
                                            
                                            
                        <!--

                                            <a href="{{ route('order.club.edit',[$order->id]) }}" class="btn btn-info btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" class="bi bi-pause-circle" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path fill-rule="evenodd" d="M5 6.25a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5zm3.5 0a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5z"/>
                                                </svg>
                                            </a>
                                            
                                     -->
                                            
                                            
                                            
                                            
                                            {{--  <a href="{{ route('order.clubs.show',[$order->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>--}}





                                            {{--                                            <a href="{{ route('order.clubs.edit',[$order->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>--}}
                                            <a href="{{ route('order.clubs.show',[$order->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $order->id }}" action="{{ route('order.clubs.destroy',$order->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $order->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons"><i class="fa fa-trash"></i></i></button>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$order->id}} </td>
                                        <td> {{$order->user->name}} </td>
                                        <td> {{$order->club->translate('en')->name}} </td>
                                        <td> {{$order->subscription->translate('en')->name}} </td>
                                        <td> {{$order->total}} </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="pause({{$order->id}})"
                                                           <?php if($order->accepted == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $order->id }}"
                                                           data-size="small">

                                                </div>
                                            </div>
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
                                        <td>  {{$order->created_at}} </td>


                                        <td>  {{$order->ended_at}} </td>

                                        <td>  {{$order->updated_at}} </td>

                                        <td>  {{$order->pause_period}} </td>

<!--
                                        <td>
                                            <span id="demo"></span>

                                        </td>

-->

                                        <td>

<!--
                           
                                            <a href="{{ route('order.club.edit',[$order->id]) }}" class="btn btn-info btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12px" height="12px" fill="currentColor" class="bi bi-pause-circle" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path fill-rule="evenodd" d="M5 6.25a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5zm3.5 0a1.25 1.25 0 1 1 2.5 0v3.5a1.25 1.25 0 1 1-2.5 0v-3.5z"/>
                                                </svg>
                                            </a>
                                            
                                            
                                    -->
                                            
                                            
                                            
                                            {{--  <a href="{{ route('order.clubs.show',[$order->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>--}}





                                            {{--                                            <a href="{{ route('order.clubs.edit',[$order->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>--}}
                                            <a href="{{ route('order.clubs.show',[$order->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $order->id }}" action="{{ route('order.clubs.destroy',$order->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $order->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons"><i class="fa fa-trash"></i></i></button>
                                        </td>
                                    </tr>
                                
                                  
                                  @endif
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
@section('myjsfile')
    <script>
        function update_status(el){
            if(el.checked){
                var accepted = 1;
            }
            else{
                var accepted = 0;
            }
            $.post('{{ route('order.clubs.status',isset($order) ? $order->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, accepted:accepted}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.club accepted status changed')}}');

                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>


<script>
    
function pause(id){
  location.replace("https://fitness-buddy.com/order/edit/"+id)
}

</script>

    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("{{$order->ended_at}}").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = days + " {{__('dashboard.Days')}} " + hours + " {{__('dashboard.Hours')}} "
                + minutes + " {{__('dashboard.Minutes')}} " + seconds + " {{__('dashboard.Seconds')}} ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "{{__('dashboard.Subscription EXPIRED')}}";
            }
        }, 1000);
    </script>



@endsection
