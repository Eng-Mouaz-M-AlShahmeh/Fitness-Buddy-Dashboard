<html lang="ar">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Nutritionist Contact Document</title>


    </head>
    <body>

        <h6>FITNESS BUDDY</h6>
        <hr>
        <h1>Nutritionists Contact Details </h1>
        <h3><u>Basic Data of Contact</u></h3>
        <h4>Complaint ID: </h4>
        <p>{{$contacts->id}}</p> 
        <h4>Nutritionist Name: </h4>
        <p>{{$contacts->nutri->name}}</p> 
        <h4>Subject: </h4>
        <p>{{$contacts->subject}}</p>
        <h4>Message: </h4>
        <p>{{$contacts->msg}}</p>
        <h4>Created At: </h4>
        <p>{{$contacts->created_at}}</p> 
        <h4>Username: </h4>
        <p>{{$contacts->user->name}}</p>
        <h4>Mobile Phone: </h4>
        <p>{{$contacts->user->mobile}}</p> 
        <h4>Email: </h4>
        <p>{{$contacts->user->email}}</p>
        
        <hr>
        <h6><small>{{$ldate = date('Y-m-d H:i:s')}}</small> </h6>
                
    </body>
</html>

