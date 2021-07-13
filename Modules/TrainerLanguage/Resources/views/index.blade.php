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
                    <span>{{__('dashboard.Trainers Languages')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Trainers Languages Datatable')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('trainer.language.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>{{__('dashboard.Trainers Languages')}} </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('dashboard.Trainer')}} </th>
                                <th> {{__('dashboard.Language')}} </th>
                                <th> {{__('dashboard.created at')}}</th>
                                <th> {{__('dashboard.more')}} </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trainersLanguages as $key=>$trainerLanguage)
                             @if(App::isLocale('ar'))
                                <tr>
                                    <td> {{$key+1}}</td>
                                    <td> {{$trainerLanguage->trainer->translate('ar')->name}} </td>
                                    <td> {{$trainerLanguage->language->translate('ar')->name}} </td>
                                    <td> {{$trainerLanguage->created_at}} </td>
                                    <td>
                                        <a href="{{ route('trainer.language.edit',[$trainerLanguage->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form id="delete-form-{{ $trainerLanguage->id }}" action="{{ route('trainer.language.destroy',$trainerLanguage->id) }}" style="display: none;" method="POST">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $trainerLanguage->id }}').submit();
                                            }else {
                                            event.preventDefault();
                                            }"><i class="material-icons"><i class="fa fa-trash"></i></i></button>
                                    </td>
                                </tr>
                                @else
                                 <tr>
                                    <td> {{$key+1}}</td>
                                    <td> {{$trainerLanguage->trainer->translate('en')->name}} </td>
                                    <td> {{$trainerLanguage->language->translate('en')->name}} </td>
                                    <td> {{$trainerLanguage->created_at}} </td>
                                    <td>
                                        <a href="{{ route('trainer.language.edit',[$trainerLanguage->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                        <form id="delete-form-{{ $trainerLanguage->id }}" action="{{ route('trainer.language.destroy',$trainerLanguage->id) }}" style="display: none;" method="POST">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $trainerLanguage->id }}').submit();
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>


    </div>
@endsection


