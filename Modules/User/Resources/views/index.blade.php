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
                    <a href="{{route('user.index')}}">{{__('dashboard.Users')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Users Datatable')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                              <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Name')}}  </th>
                                    <th> {{__('dashboard.Email')}}</th>
                                    <th> {{__('dashboard.Phone')}}</th>
                                    <th>{{__('dashboard.Created At')}}</th>
                                    <th> {{__('dashboard.Actions')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $key=>$user)
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td> {{$user->mobile}} </td>
                                        <td>  {{$user->created_at}} </td>
                                        <td>
                                            <a href="{{ route('user.edit',[$user->id]) }}" class="btn btn-info btn-sm"><i class="icon-pencil"></i></a>
                                            
                                   
                                            
                                            <a href="{{ route('user.show',[$user->id]) }}" class="btn btn-success btn-sm"><i class="icon-eye"></i></a>
                                            
                                            
                                            
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy',$user->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $user->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons"><i class="icon-trash"></i></i></button>
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
