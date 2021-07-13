<html lang="ar">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Order Club Document</title>


    </head>
    <body>

        <h6>FITNESS BUDDY</h6>
        <hr>
        <h1>Order Club Details </h1>
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
        <h3><u>Club Details</u></h3>
        @foreach ($clubDetails as $key=>$club)
            <h4>Name: </h4>
            <p>{{$club->name}}</p>
            <h4>Gender: </h4>
            <p>
                @if($club->type == '1')
                    {{__('Female')}}
                @else
                    {{__('Male')}}
                @endif
            </p>
            <h4>City: </h4>
            <p>{{$club->city->translate('en')->name}}</p>
        @endforeach
        
        <hr>
        <h3><u>Subscription Details</u></h3>
        @foreach ($subDetails as $key=>$sub)
            <h4>Price: </h4>
            <p>{{$sub->price}}</p>
            <h4>Name: </h4>
            <p>{{$sub->name}}</p>
            <h4>Currency: </h4>
            <p>{{$sub->currency}}</p>
        @endforeach
        
        
        <hr>
        <h6><small>{{$ldate = date('Y-m-d H:i:s')}}</small> </h6>
                
    </body>
</html>

