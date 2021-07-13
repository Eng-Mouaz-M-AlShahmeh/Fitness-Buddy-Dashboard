@extends('dashboard::layouts.master')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">{{__('dashboard.Home')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Cities')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Cities Datatable')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('city.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>{{__('dashboard.Cities')}} </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('dashboard.city')}} </th>
                                <th> {{__('dashboard.status')}} </th>
                                <th>{{__('dashboard.Created At')}}</th>
                                <th> {{__('dashboard.more')}} </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $key=>$city)
                            <tr>
                                <td> {{$key+1}}</td>
                                <td> {{$city->name}} </td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <input type="checkbox" onchange="update_status(this)"
                                                   <?php if($city->status == 1) echo "checked";?>
                                                   class="make-switch"
                                                   value="{{ $city->id }}"
                                                   data-size="small">

                                        </div>
                                    </div>
                                </td>
                                <td> {{$city->created_at}} </td>
                                <td>
                                    <a href="{{ route('city.edit',[$city->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                    <form id="delete-form-{{ $city->id }}" action="{{ route('city.destroy',$city->id) }}" style="display: none;" method="POST">
                                        @csrf
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                        event.preventDefault();
                                        document.getElementById('delete-form-{{ $city->id }}').submit();
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
                <!-- END EXAMPLE TABLE PORTLET-->
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
            $.post('{{ route('city.status',isset($city) ? $city->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.city status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
@endsection

