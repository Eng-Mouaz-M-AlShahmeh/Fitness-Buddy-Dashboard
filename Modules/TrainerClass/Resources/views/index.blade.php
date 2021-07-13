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
                    <span>{{__('dashboard.Trainers Classes')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Trainers Classes Datatable')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('trainer.class.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>{{__('dashboard.Trainers Classes')}} </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('dashboard.Trainer')}}  </th>
                                <th> {{__('dashboard.class')}} </th>
                                <th> {{__('dashboard.Created At')}} </th>
                                <th> {{__('dashboard.more')}} </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainersClasses as $key=>$trainerClass)
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td> {{$trainerClass->trainer->name}} </td>
                                    <td> {{$trainerClass->class->name}} </td>
                                    <td> {{$trainerClass->created_at}} </td>
                                    <td>
                                        <a href="{{ route('trainer.class.edit',[$trainerClass->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form id="delete-form-{{ $trainerClass->id }}" action="{{ route('trainer.class.destroy',$trainerClass->id) }}" style="display: none;" method="POST">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $trainerClass->id }}').submit();
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


