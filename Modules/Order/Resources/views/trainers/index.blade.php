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
                    <a href="{{route('order.trainers.index')}}">{{__('dashboard.Trainers Orders')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Trainers Orders Datatable')}}
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
                                    <th> {{__('dashboard.User Name')}} </th>
                                    <th> {{__('dashboard.Trainer')}} </th>
                                    <th> {{__('dashboard.Total')}} </th>
                                    <th> {{__('dashboard.Accepted')}} </th>
                                    <th>{{__('dashboard.payment status')}} </th>
                                    <th>{{__('dashboard.Created At')}}</th>
                                    <th>{{__('dashboard.Actions')}}  </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $key=>$order)
                                 @if(App::isLocale('ar'))
                                    <tr>
                                        <td> {{$key+1}} </td>
                                         <td> {{$order->id}} </td>
                                        <td> {{$order->user->name}} </td>
                                        <td> {{$order->trainer->translate('ar')->name}} </td>
                                        <td> {{$order->total}} </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
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

                                        <td>
{{--                                            <a href="{{ route('order.trainers.edit',[$order->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>--}}
                                            <a href="{{ route('order.trainers.show',[$order->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $order->id }}" action="{{ route('order.trainers.destroy',$order->id) }}" style="display: none;" method="POST">
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
                                        <td> {{$order->trainer->translate('en')->name}} </td>
                                        <td> {{$order->total}} </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
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

                                        <td>
{{--                                            <a href="{{ route('order.trainers.edit',[$order->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>--}}
                                            <a href="{{ route('order.trainers.show',[$order->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $order->id }}" action="{{ route('order.trainers.destroy',$order->id) }}" style="display: none;" method="POST">
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
            $.post('{{ route('order.trainers.status',isset($order) ? $order->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, accepted:accepted}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.trainer accepted status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
@endsection
