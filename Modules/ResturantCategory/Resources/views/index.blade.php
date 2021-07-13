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
                    <a href="{{route('resturant.categories.index')}}">{{__('dashboard.Resturants Categories')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Resturants Categories Datatable')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="{{ route('resturant.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
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
                                        <td> {{$rest->resturant->name}} </td>
                                        <td> {{$rest->name}}</td>

                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
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
@endsection
