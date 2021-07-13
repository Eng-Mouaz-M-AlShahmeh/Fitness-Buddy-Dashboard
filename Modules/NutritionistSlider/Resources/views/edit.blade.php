@extends('dashboard::layouts.master')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('dashboard.index')}}">{{__('dashboard.Home')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{route('nutritionist.sliders.index')}}">{{__('dashboard.Nutritionists')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Edit nutritionist slider')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Edit nutritionist slider Form')}}
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
                            <span class="caption-subject font-red sbold uppercase">{{__('dashboard.nutritionist slider Basic Validation')}} </span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('nutritionist.sliders.update',$nutritionistSlider)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Title AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[title]" name="ar[title]" value="{{$nutritionistSlider->translate('ar')->title}}" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Title EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[title]" id="en[title]" value="{{$nutritionistSlider->translate('en')->title}}" class="form-control" /> </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.description AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text" rows="6"  id="ar[description]" name="ar[description]" class="form-control" >
                                            {{$nutritionistSlider->translate('ar')->description}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.description EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <textarea type="text" rows="6"  name="en[description]" id="en[description]" class="form-control" >
                                        {{$nutritionistSlider->translate('en')->description}}
                                        </textarea>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select nutritionist')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="nutritionist_id" id="nutritionist_id">
                                            @foreach($nutritionists as $nutritionist)
                                                <option  {{ $nutritionist->id == $nutritionistSlider->nutritionist->id ? 'selected' : '' }}  value="{{$nutritionist->id}}">{{$nutritionist->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Image')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <img class="img-responsive img-thumbnail" src="{{$nutritionistSlider->image }}" style="height: 100px; width: 100px" alt="">                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.upload Image')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" name="image" id="exampleInputFile1">
                                    </div>
                                </div>






                            </div>
                            
                                     
                            <script>
function cancel() {
  location.replace("https://fitness-buddy.com/nutritionist/slider")
}
</script>



                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('dashboard.Submit')}}</button>
                                        <button type="button" onclick="cancel()" class="btn grey-salsa btn-outline">{{__('dashboard.Cancel')}}</button>
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

