@extends('dashboard::layouts.master')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">{{__('dashboard.Home')}} </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Nutritionist Contacts')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Nutritionist Contacts Datatable')}}
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->

        <div class="row">
            <div class="col-md-12">

                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>{{__('dashboard.Nutritionist Contacts')}}  </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{__('dashboard.Complaint ID')}}  </th>
                                <th> {{__('dashboard.Nutritionist')}} </th>
                                <th> {{__('dashboard.User')}}  </th>
                                <th> {{__('dashboard.Phone')}} </th>
                                <th> {{__('dashboard.Email')}} </th>
                                <th> {{__('dashboard.Subject')}} </th>
                               
                                <th> {{__('dashboard.Created At')}} </th>
                                <th> {{__('dashboard.More')}} </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $key=>$contact)
                                <tr>
                                    <td> {{$key+1}}</td>
                                      <td> {{$contact->id}} </td>
                                    <td> {{$contact->nutri->name}} </td>
                                    <td>
                                        {{$contact->user->name}}
                                    </td>
                                     <td>
                                        {{$contact->user->mobile}}
                                    </td>
                                    <td>
                                        {{$contact->user->email}}
                                    </td>
                                    <td>
                                        {{$contact->subject}}
                                    </td>
                                  
                                    <td> {{$contact->created_at}} </td>
                                    <td>
                                        
                                                    <a href="{{ route('nutritionistcontact.show',[$contact->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                        
                                        
                                        
                                        <form id="delete-form-{{ $contact->id }}" action="{{ route('nutritionistcontact.destroy',$contact->id) }}" style="display: none;" method="POST">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $contact->id }}').submit();
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

