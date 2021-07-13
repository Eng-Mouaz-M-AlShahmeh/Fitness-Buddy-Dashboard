<html lang="ar">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Nutritionist Order Document</title>


    </head>
    <body>

        <h6>FITNESS BUDDY</h6>
        <hr>
        <h1>Nutritionist Order Details </h1>
        <h3><u>Main Details of Order</u></h3>
        <h4>User Name: </h4>
        <p>{{$order->user->name}}</p> 
        <h4>Total: </h4>
        <p>{{$order->total}}</p>
        <h4>Order Number: </h4>
        <p>{{$order->order_number}}</p> 
        <h4>Payment Status: </h4>
        <p>
            @if($order->payment_status=='0')
                {{__('Cash')}}
            @elseif($order->payment_status=='1')
                {{__('Card')}}
            @else
                {{__('Not Paied Yet')}}
            @endif
        </p>
        <hr>
        <h3><u>Nutritionist Details</u></h3>
        <h4>Name: </h4>
        <p>{{$order->nutritionist->translate('en')->name}}</p>
        <h4>About: </h4>
        <p>{{$order->nutritionist->translate('en')->about}}</p>
        <h4>Level: </h4>
        <p>{{$order->nutritionist->translate('en')->level}}</p>
        <h4>Currency: </h4>
        <p>{{$order->nutritionist->translate('en')->currency}}</p>
        <h4>Class: </h4>
        <p>{{$order->nutritionist->translate('en')->class}}</p>
        <h4>Plan: </h4>
        <p>{{$order->nutritionist->plan->translate('en')->name}}</p>
        <h4>Price: </h4>
        <p>{{$order->nutritionist->price}}</p>
        <h4>Date Of Birth: </h4>
        <p>{{$order->nutritionist->age}}</p>
        <h4>City: </h4>
        <p>{{$order->nutritionist->city->translate('en')->name}}</p>
        <h4>Gender: </h4>
        <p>
            @if($order->nutritionist->type == '1')
                {{__('Female')}}
            @else
                {{__('Male')}}
            @endif
        </p>
        <h4>Nationality: </h4>
        <p>{{$order->nutritionist->nationality->translate('en')->name}}</p>
        
        <hr>
        <h6><small>{{$ldate = date('Y-m-d H:i:s')}}</small> </h6>
                
    </body>
</html>

