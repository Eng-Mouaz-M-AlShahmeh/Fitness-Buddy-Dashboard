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
                    <a href="{{route('meals.index')}}">{{__('dashboard.Meals')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Edit Meal')}}</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">{{__('dashboard.Edit Meal Form')}}
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
                            <span class="caption-subject font-red sbold uppercase">{{__('dashboard.Meal Basic Validation')}}</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form action="{{route('meals.update',$meal->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input name="resturant_id" type="hidden" value="{{$meal->resturant_id}}">
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Name AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[name]" name="ar[name]" value="{{$meal->translate('ar')->name}}" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Name EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[name]" id="en[name]" value="{{$meal->translate('en')->name}}" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Currency AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[currency]" name="ar[currency]" value="{{$meal->translate('ar')->currency}}" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Currency EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[currency]" id="en[currency]" value="{{$meal->translate('en')->currency}}" class="form-control" /> </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Calorie AR')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" id="ar[calorie]" name="ar[calorie]" value="{{$meal->translate('ar')->calorie}}" class="form-control" /> </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Calorie EN')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text"  name="en[calorie]" id="en[calorie]" value="{{$meal->translate('en')->calorie}}" class="form-control" /> </div>
                                </div>



                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.Description In Arabic')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="ar[desc]" rows="6" data-error-container="#editor2_error">
                                        {{$meal->translate('ar')->desc}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-3">{{__('dashboard.Description In English')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor form-control" name="en[desc]" rows="6" data-error-container="#editor2_error">
                                      {{$meal->translate('en')->desc}}
                                        </textarea>
                                        <div id="editor2_error"> </div>
                                    </div>
                                </div>


                                <div class="form-group" hidden>
                                    <label class="control-label col-md-3">{{__('dashboard.Select Resturant')}}
                                        <span class="required"> * </span>
                                   </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="resturant_id" id="resturant_id">
                                            @foreach($resturants as $resturant)
                                                <option {{ $resturant->id == $meal->resturant->id ? 'selected' : '' }} value="{{$resturant->id}}" status="{{$resturant->plan_id}}">{{$resturant->name}} - {{$resturant->plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                         
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Select Category')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="cat_id" id="cat_id">
                                            @foreach($cats as $cat)
                                              @if(App::isLocale('ar'))
                                                <option {{ $cat->id == $meal->category->id ? 'selected' : '' }}  value="{{$cat->id}}">{{$cat->translate('ar')->name}}</option>
                                              @else
                                                <option {{ $cat->id == $meal->category->id ? 'selected' : '' }}  value="{{$cat->id}}">{{$cat->translate('en')->name}}</option>
                                              @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                    <!--              <label class="switch" style="margin-left: 180px;margin-top:20px;display:{{$getresid->plan_id == 1 ? "none" : ""}}">-->
                                    <!--     hide monthly plans-->
                                    <!--    <input onclick="showOrHideDiv();" type="checkbox">-->
                                    <!--    <span class="slider round"></span>-->
                                    <!--</label>-->

<div id="showOrHide" style="display:{{$getresid->plan_id == 1 ? "none" : ""}}">

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.mealsday')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="meal_day_id" id="meal_day_id">
                                            @foreach($mealsdays as $day)
                                                <option {{ isset($day->id) == $meal->mealday['id'] ? 'selected' : '' }} value="{{$day->id}}">{{$day->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.day')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="day_id" id="day_id">
                                            @foreach($days as $day)
                                                <option {{ isset($day->id) == $meal->day['id'] ? 'selected' : '' }} value="{{$day->id}}">{{$day->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

</div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.price before')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" id="price_before" value="{{$meal->price_before}}" name="price_before" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.price after')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" id="price_after" value="{{$meal->price_after}}" name="price_after" class="form-control" /> </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.calories')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" id="calories" value="{{$meal->calories}}" name="calories" class="form-control" /> </div>
                                </div>

                           

                                <div class="form-group">
                                    <label class="control-label col-md-3">{{__('dashboard.Image')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-4">
                                        <img class="img-responsive img-thumbnail" src="{{$meal->image }}" style="height: 100px; width: 100px" alt="">                                    </div>
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
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">{{__('dashboard.Submit')}}</button>
                                        <button type="button" class="btn grey-salsa btn-outline">{{__('dashboard.Cancel')}}</button>
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
    @section('myjsfile')
       <script>
        $(document).on('change', '#resturant_id', function(){
            var resturant_status = $('option:selected', this).attr('status');
            showOrHideDiv2(resturant_status);
            //alert(resturant_id);
        });
    </script>
    <script>
           $(document).on('change', '#resturant_id', function(){
            var resturant_id = $(this).val();
            //alert(company_id);
            if(resturant_id){
                $.ajax({
                    type:"GET",
                     url:"/get-resturant-cats/"+resturant_id,
                    success:function(res){
                        if(res){
                            console.log(res);
                            $("#cat_id").empty();
                            $.each(res,function(key,value){
                                $("#cat_id").append('<option value="'+value.id+'" >'+value.name+'</option>');
                            });
                        }
                        if(res.length === 0){
                            $("#cat_id").empty();
                        }
                    }
                });
            }else{
                $("#cat_id").empty();
            }
        });
    </script>
    <script>
   function showOrHideDiv() {
      var v = document.getElementById("showOrHide");
      if (v.style.display === "none") {
         v.style.display = "block";
      } else {
         v.style.display = "none";
      }
   }
   function showOrHideDiv2(status) {
      var v = document.getElementById("showOrHide");
      if(status=='2'){
          v.style.display = "block";
    //   if (v.style.display === "none") {
    //      v.style.display = "block";
    //   } else {
    //      v.style.display = "none";
    //   }
      }else{
          v.style.display = "none";
      }
   }
</script>
@endsection
