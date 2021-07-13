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
                <a href="{{route('trainercontact.index')}}">{{__('dashboard.Trainers Contacts')}}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>{{__('dashboard.Trainers Contacts Details')}}</span>
            </li>
        </ul>

    </div>
    <!-- END PAGE BAR -->

    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">{{__('dashboard.Trainers Contacts Details Form')}}
    </h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->


    <div class="row">
        <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">{{__('dashboard.Basic Data')}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form id="form_sample_1" class="form-horizontal" >

                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                            <div class="alert alert-success display-hide">
                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>









                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Complaint ID')}}
                                </label>
                                <div class="col-md-4">
                                    <input type="text" data-required="1"
                                           value="{{$contacts->id}}"
                                           class="form-control" name="id" readonly/> </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Trainer')}}

                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           value="{{$contacts->trainer->name}}"
                                           class="form-control" name="clubname" readonly/> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Subject')}}

                                </label>
                                <div class="col-md-4">
                                    <input type="text"
                                           value="{{$contacts->subject}}"
                                           class="form-control" name="subject" readonly/> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Message')}}

                                </label>
                                <div class="col-md-4">
                                    <textarea  rows="8" type="text"
                                            value=""
                                            class="form-control" name="msg" readonly/>{{$contacts->msg}}
                                    </textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Created At')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="text"
                                            value="{{$contacts->created_at}}"
                                            class="form-control" name="created_at" readonly/> </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.User')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="text"
                                            value="{{$contacts->user->name}}"
                                            class="form-control" name="user" readonly/> </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Phone')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="text"
                                            value="{{$contacts->user->mobile}}"
                                            class="form-control" name="phone" readonly/> </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">{{__('dashboard.Email')}}

                                </label>
                                <div class="col-md-4">
                                    <input  type="text"
                                            value="{{$contacts->user->email}}"
                                            class="form-control" name="email" readonly/> </div>
                            </div>
                            
                            
                            
                        
                                         





                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        
                                           
                               <!--
                                        <a href="{{ route('clubcontact.show',[$contacts->id]) }}" class="btn btn-warning"><i class="fa fa-print"></i> {{__('dashboard.Print')}}</a>
                               -->         
                                        
                                        
                                    <a href="{{ route('trainercontact.pdf',[$contacts->id]) }}" class="btn btn-info"><i class="fa fa-download"></i> {{__('dashboard.Generate PDF')}}</a>
                                        
                                   
                                         
                                        
                                        
                                        <a href="{{route('trainercontact.index')}}" type="submit" class="btn green">{{__('dashboard.Back')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>


</div>
@endsection
