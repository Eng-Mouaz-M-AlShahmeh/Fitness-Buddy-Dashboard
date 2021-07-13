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
                    <a href="{{route('resturant.index')}}">{{__('dashboard.Resturants')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Resturants Datatable')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="{{ route('resturant.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.Plan')}} </th>
                                    <th> {{__('dashboard.Price Delivery')}} </th>
                                    <th> {{__('dashboard.Icon')}} </th>
                                    <th> {{__('dashboard.Status')}} </th>
                                    <th>{{__('dashboard.Created At')}}</th>
                                    <th> {{__('dashboard.Actions')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($resturants as $key=>$resturant)
                                 
                                    <tr>
                                        <td> {{$key+1}} </td>
                                      @if(App::isLocale('ar'))
                                        <td><a href="{{ route('resturant.info',[$resturant->id]) }}" class="btn btn-warning btn-sm">{{$resturant->translate('ar')->name}} </a></td>
                                        <td> {{$resturant->plan->translate('ar')->name}} </td>
                                      @else
                                        <td><a href="{{ route('resturant.info',[$resturant->id]) }}" class="btn btn-warning btn-sm">{{$resturant->translate('en')->name}} </a></td>
                                        <td> {{$resturant->plan->translate('en')->name}} </td>
                                      @endif
                                        <td> {{$resturant->price_delivery}} {{$resturant->price}} </td>
                                        <td><img class="img-responsive img-thumbnail" src="{{ asset($resturant->icon) }}" style="height: 100px; width: 100px" alt=""></td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
                                                           <?php if($resturant->status == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $resturant->id }}"
                                                           data-size="small">
                                                </div>
                                            </div>
                                        </td>
                                        <td> {{$resturant->created_at}} </td>

                                        <td>
                                            <a href="{{ route('resturant.edit',[$resturant->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('resturant.show',[$resturant->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <form id="delete-form-{{ $resturant->id }}" action="{{ route('resturant.destroy',$resturant->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $resturant->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons"><i class="fa fa-trash"></i></i></button>
                                        </td>
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
@section('myjsfile')
    <script>
        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('resturant.status',isset($resturant) ? $resturant->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.resturant status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
@endsection
