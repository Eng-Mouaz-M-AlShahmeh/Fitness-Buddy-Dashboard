<html lang="ar">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Order Restaurant Document</title>


    </head>
    <body>

        <h6>FITNESS BUDDY</h6>
        <hr>
        <h1>Order Restaurant Details </h1>
        <h3><u>Main Details of Order</u></h3>
        <h4>User Name: </h4>
        <p>{{$order->user->name}}</p> 
        <h4>Resturant: </h4>
        <p>{{$order->resturant->name}}</p> 
        <h4>Total: </h4>
        <p>{{$order->total}}</p>
        <h4>Status: </h4>
        <p>
            @if($order->status=='0')
                {{__('In Processing')}}
            @elseif($order->status=='1')
                {{__('In Delivery')}}
            @elseif($order->status=='2')
                {{__('Delivered')}}
            @else
                {{__('Cancelled')}}
            @endif
        </p>
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
        <h3><u>Meals Order</u></h3>
        @foreach ($orderCarts as $key=>$cart)
            <h4>Meal: </h4>
            <p>{{$cart->meal->name}}</p>
            <h4>Quantity: </h4>
            <p>{{$cart->quantity}}</p>
        @endforeach
        
        <hr>
        <h3><u>Modifiers Order</u></h3>
        @foreach ($orderModifiers as $key=>$order)
            <h4>Modifier: </h4>
            <p>{{$order->modifier->modifier}}</p>
        @endforeach
        
        
        <hr>
        <h6><small>{{$ldate = date('Y-m-d H:i:s')}}</small> </h6>
                
    </body>
</html>

