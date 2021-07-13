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
                    <a href="{{route('nutritionist.index')}}">{{__('dashboard.Nutritionists')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Nutritionists Datatable')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="{{ route('nutritionist.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Name')}}  </th>
                                    <th> {{__('dashboard.Plan')}}  </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.city')}} </th>
                                    <th> {{__('dashboard.status')}}</th>
                                    <th>{{__('dashboard.Created At')}}</th>
                                    <th>{{__('dashboard.Actions')}}  </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($nutritionists as $key=>$nutritionist)
                                 @if(App::isLocale('ar'))
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$nutritionist->translate('ar')->name}} </td>
                                        <td> {{$nutritionist->plan->translate('ar')->name}} </td>
                                         <td><img class="img-responsive img-thumbnail" src="{{ asset($nutritionist->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                        <td> {{$nutritionist->city->translate('ar')->name}} </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
                                                           <?php if($nutritionist->status == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $nutritionist->id }}"
                                                           data-size="small">

                                                </div>
                                            </div>
                                        </td>
                                        <td>  {{$nutritionist->created_at}} </td>

                                        <td>
                                            <a href="{{ route('nutritionist.edit',[$nutritionist->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('nutritionist.show',[$nutritionist->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $nutritionist->id }}" action="{{ route('nutritionist.destroy',$nutritionist->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $nutritionist->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons"><i class="fa fa-trash"></i></i></button>
                                        </td>
                                    </tr>
                                    @else
                                                                        <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$nutritionist->translate('en')->name}} </td>
                                        <td> {{$nutritionist->plan->translate('en')->name}} </td>
                                         <td><img class="img-responsive img-thumbnail" src="{{ asset($nutritionist->image) }}" style="height: 100px; width: 100px" alt=""></td>
                                        <td> {{$nutritionist->city->translate('en')->name}} </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
                                                           <?php if($nutritionist->status == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $nutritionist->id }}"
                                                           data-size="small">

                                                </div>
                                            </div>
                                        </td>
                                        <td>  {{$nutritionist->created_at}} </td>

                                        <td>
                                            <a href="{{ route('nutritionist.edit',[$nutritionist->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('nutritionist.show',[$nutritionist->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $nutritionist->id }}" action="{{ route('nutritionist.destroy',$nutritionist->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $nutritionist->id }}').submit();
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
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('nutritionist.status',isset($nutritionist) ? $nutritionist->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.nutritionist status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
@endsection
