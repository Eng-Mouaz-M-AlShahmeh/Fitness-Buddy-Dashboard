@extends('dashboard::layouts.master')

@section('content')
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('dashboard.index')}}">{{__('dashboard.Home')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{route('resturant.index')}}">{{__('dashboard.Restaurants')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    @if(App::isLocale('ar'))
                    <span>{{$resturant->translate('ar')->name}}</span>
                    @else
                    <span>{{$resturant->translate('en')->name}}</span>
                    @endif
                </li>
            </ul>

        </div>
        @if(App::isLocale('ar'))
        <h1 class="page-title"> بيانات {{$resturant->translate('ar')->name}} 
        </h1>
        @else
        <h1 class="page-title"> {{$resturant->translate('en')->name}} Data
        </h1>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_0" data-toggle="tab"> {{__('dashboard.Sliders')}} </a>
                        </li>
                        <li>
                            <a href="#tab_1" data-toggle="tab"> {{__('dashboard.Branches')}} </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab"> {{__('dashboard.Category')}} </a>
                        </li>
                        <li>
                            <a href="#tab_3" data-toggle="tab"> {{__('dashboard.Meal')}} </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.Sliders')}}</div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Begin: life time stats -->
                                        <div class="portlet light portlet-fit portlet-datatable bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <a href="{{ route('resturant.sliders.create',$resturant->id) }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                </div>

                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-container">
                                                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                        <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> {{__('dashboard.Resturant Name')}}  </th>
                                                            <th> {{__('dashboard.Image')}} </th>
                                                            <th> {{__('dashboard.status')}}</th>
                                                            <th>{{__('dashboard.created At')}}</th>
                                                            <th>{{__('dashboard.Actions')}}  </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($sliders as $key=>$resturant)
                                                            <tr>
                                                                <td> {{$key+1}} </td>
                                                            @if(App::isLocale('ar'))
                                                                <td> {{$resturant->resturant->translate('ar')->name}} </td>
                                                            @else
                                                                <td> {{$resturant->resturant->translate('en')->name}} </td>
                                                            @endif
                                                                <td><img class="img-responsive img-thumbnail" src="{{ asset($resturant->image) }}" style="height: 100px; width: 100px" alt=""></td>

                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="col-md-9">
                                                                            <input type="checkbox" onchange="update_status_one(this)"
                                                                                   <?php if($resturant->status == 1) echo "checked";?>
                                                                                   class="make-switch"
                                                                                   value="{{ $resturant->id }}"
                                                                                   data-size="small">

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>  {{$resturant->created_at}} </td>

                                                                <td>
                                                                    <a href="{{ route('resturant.sliders.edit',[$resturant->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                                    <form id="delete-form-{{ $resturant->id }}" action="{{ route('resturant.sliders.destroy',$resturant->id) }}" style="display: none;" method="POST">
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

                        </div>
                        <div class="tab-pane" id="tab_1">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.Branches')}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Begin: life time stats -->
                                        <div class="portlet light portlet-fit portlet-datatable bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <a href="{{ route('resturant.branches.create',$resturant_id->id) }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                </div>

                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-container">
                                                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                        <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> {{__('dashboard.Name')}} </th>
                                                            <th> {{__('dashboard.restaurant')}} </th>
                                                            <th> {{__('dashboard.status')}} </th>
                                                            <th>{{__('dashboard.Created At')}}</th>
                                                            <th> {{__('dashboard.Actions')}} </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($branches as $key=>$branch)
                                                            <tr>
                                                                <td> {{$key+1}} </td>
                                                            @if(App::isLocale('ar'))
                                                                <td> {{$branch->translate('ar')->name}} </td>
                                                                <td> {{$branch->resturant->translate('ar')->name}}</td>
                                                            @else
                                                                <td> {{$branch->translate('en')->name}} </td>
                                                                <td> {{$branch->resturant->translate('en')->name}}</td>
                                                            @endif

                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="col-md-9">
                                                                            <input type="checkbox" onchange="update_status_two(this)"
                                                                                   <?php if($branch->status == 1) echo "checked";?>
                                                                                   class="make-switch"
                                                                                   value="{{ $branch->id }}"
                                                                                   data-size="small">

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>  {{$branch->created_at}} </td>

                                                                <td>
                                                                    <a href="{{ route('branch.edit',[$branch->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                                                                    <form id="delete-form-{{ $branch->id }}" action="{{ route('branch.destroy',$branch->id) }}" style="display: none;" method="POST">
                                                                        @csrf
                                                                    </form>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                                        event.preventDefault();
                                                                        document.getElementById('delete-form-{{ $branch->id }}').submit();
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

                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.Category')}}</div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Begin: life time stats -->
                                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <a href="{{ route('resturant.categories.create',$resturantId->id) }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                            <thead>
                                                            <tr>
                                                                <th> # </th>
                                                                <th> {{__('dashboard.Resturant Name')}}  </th>
                                                                <th> {{__('dashboard.Category Name')}} </th>
                                                                <th> {{__('dashboard.status')}}</th>
                                                                <th>{{__('dashboard.Created At')}}</th>
                                                                <th>{{__('dashboard.Actions')}}  </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($restCats as $key=>$rest)
                                                                <tr>
                                                                    <td> {{$key+1}} </td>
                                                                @if(App::isLocale('ar'))
                                                                    <td> {{$rest->resturant->translate('ar')->name}} </td>
                                                                    <td> {{$rest->translate('ar')->name}}</td>
                                                                @else
                                                                    <td> {{$rest->resturant->translate('en')->name}} </td>
                                                                    <td> {{$rest->translate('en')->name}}</td>
                                                                @endif

                                                                    <td>
                                                                        <div class="form-group">
                                                                            <div class="col-md-9">
                                                                                <input type="checkbox" onchange="update_status_three(this)"
                                                                                       <?php if($rest->status == 1) echo "checked";?>
                                                                                       class="make-switch"
                                                                                       value="{{ $rest->id }}"
                                                                                       data-size="small">

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>  {{$rest->created_at}} </td>

                                                                    <td>
                                                                        <a href="{{ route('resturant.categories.edit',[$rest->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                                        <form id="delete-form-{{ $rest->id }}" action="{{ route('resturant.categories.destroy',$rest->id) }}" style="display: none;" method="POST">
                                                                            @csrf
                                                                        </form>
                                                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}} ')){
                                                                            event.preventDefault();
                                                                            document.getElementById('delete-form-{{ $rest->id }}').submit();
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
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.Meal')}}</div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Begin: life time stats -->
                                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <a href="{{ route('resturant.meals.create',$resturantid->id) }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                            <thead>
                                                            <tr>
                                                                <th> # </th>
                                                                <th> {{__('dashboard.Name')}}  </th>
                                                                <th> {{__('dashboard.calories')}} </th>
                                                                <th> {{__('dashboard.Image')}} </th>
                                                                <th> {{__('dashboard.Status')}}</th>
                                                                <th>{{__('dashboard.Created At')}}</th>
                                                                <th> {{__('dashboard.Actions')}} </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($meals as $key=>$meal)
                                                                <tr>
                                                                    <td> {{$key+1}} </td>
                                                                @if(App::isLocale('ar'))
                                                                    <td><a href="{{ route('resturant.meal.info',[$meal->id]) }}" class="btn btn-warning btn-sm">{{$meal->translate('ar')->name}}  </a> </td>
                                                                @else
                                                                    <td><a href="{{ route('resturant.meal.info',[$meal->id]) }}" class="btn btn-warning btn-sm">{{$meal->translate('en')->name}}  </a> </td>
                                                                @endif
                                                                    <td> {{$meal->calories}} </td>
                                                                    <td><img class="img-responsive img-thumbnail" src="{{ asset($meal->image) }}" style="height: 100px; width: 100px" alt=""></td>

                                                                    <td>
                                                                        <div class="form-group">
                                                                            <div class="col-md-9">
                                                                                <input type="checkbox" onchange="update_status_four(this)"
                                                                                       <?php if($meal->status == 1) echo "checked";?>
                                                                                       class="make-switch"
                                                                                       value="{{ $meal->id }}"
                                                                                       data-size="small">

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>  {{$meal->created_at}} </td>

                                                                    <td>
                                                                        <a href="{{ route('meals.edit',[$meal->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                                        <form id="delete-form-{{ $meal->id }}" action="{{ route('meals.destroy',$meal->id) }}" style="display: none;" method="POST">
                                                                            @csrf
                                                                        </form>
                                                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                                            event.preventDefault();
                                                                            document.getElementById('delete-form-{{ $meal->id }}').submit();
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
                                    <!-- END FORM-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myjsfile')
    <script>
        function update_status_one(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('resturant.sliders.status',isset($resturant) ? $resturant->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.resturant slider status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
    <script>
        function update_status_two(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('branch.status',isset($branch) ? $branch->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.branch status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
    <script>
        function update_status_three(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('resturant.categories.status',isset($rest) ? $rest->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.resturant category status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
    <script>
        function update_status_four(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('meals.status',isset($meal) ? $meal->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.meal status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
    
    <script>
    /*
        if ( $.fn.dataTable.isDataTable( '#sample_1' ) ) {
            table = $('#sample_1').DataTable( {
                paging: true,
                searching: true,
            } );
        }
        else if ( $.fn.dataTable.isDataTable( '#sample_2' ) ) {
            table = $('#sample_2').DataTable( {
                paging: true,
                searching: true,
            } );
        }
        else if ( $.fn.dataTable.isDataTable( '#sample_3' ) ) {
            table = $('#sample_3').DataTable( {
                paging: true,
                searching: true,
            } );
        }
        else {
            table = $('#sample_4').DataTable( {
                paging: true,
                searching: true,
            } );
        }

*/
    </script>
@endsection
