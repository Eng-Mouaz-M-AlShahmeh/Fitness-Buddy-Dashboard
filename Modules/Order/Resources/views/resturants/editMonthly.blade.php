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
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Pause Resturants Orders')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Pause Resturants Orders')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">

                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('order.resturants.updateMonthly',$order->id)}}" method="post" id="form_sample_1" class="form-horizontal">
                            @csrf
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>




                                <div class="form-group">
                                    <div class="alert alert-info" role="alert">
                                      {{__('dashboard.If you change the value of the pausing period to zero, the subscription status will automatically change to the activating subscription status, and vice versa if you add a pause period greater than zero for days, the subscription status will be changed to paused automatically.')}}
                                    </div>
                                </div>






                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Remaining Time')}}
                                    </label>
                                    <div class="col-md-4">
                                        <button type="button" class="btn blue btn-outline"><span id="demo"></span></button>
                                    </div>
                                </div>
                                
                                
                                
                                





                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Pause Period in Days')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" name="pause_period"
                                               value="{{$order->pause_period}}"
                                               data-required="1" class="form-control" /> </div>
                                </div>
                                



                            </div>
                            
                            
                                                        
<script>
function cancel() {
  location.replace("https://fitness-buddy.com/order/resturants/monthly")
}
</script>




                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('dashboard.Submit')}}</button>
                                        <button type="button" onclick="cancel()" class="btn grey-salsa btn-outline">{{__('dashboard.Cancel')}}</button>
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

@section('myjsfile')

    <script>
       /* $(document).ready(function(){
            $("#datetime1").focus( function() {
        	    $(this).attr({type: 'datetime-local'});
              });
        });
        */
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
