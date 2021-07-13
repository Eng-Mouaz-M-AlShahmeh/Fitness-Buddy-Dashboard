@extends('dashboard::layouts.master')

@section('content')
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('dashboard.index')}}">{{__('dashboard.Home')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{route('resturant.index')}}">{{__('dashboard.Restaurants')}}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>{{__('dashboard.Meals')}}</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    @if(App::isLocale('ar'))
                    <span>{{$meal->translate('ar')->name}}</span>
                    @else
                    <span>{{$meal->translate('en')->name}}</span>
                    @endif
                </li>
            </ul>

        </div>
        @if(App::isLocale('ar'))
        <h1 class="page-title"> بيانات {{$meal->translate('ar')->name}} 
        </h1>
        @else
        <h1 class="page-title"> {{$meal->translate('en')->name}} Data
        </h1>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_0" data-toggle="tab"> {{__('dashboard.All Meals Modifiers')}} </a>
                        </li>
                        <li>
                            <a href="#tab_1" data-toggle="tab"> {{__('dashboard.Meal Modifiers')}} </a>
                        </li>
                        <li>
                            <a href="#tab_2" data-toggle="tab"> {{__('dashboard.Meal Ingredients')}} </a>
                        </li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.All Meals Modifiers')}}</div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Begin: life time stats -->
                                        <div class="portlet light portlet-fit portlet-datatable bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <a href="{{ route('modifier.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                </div>

                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-container">
                                                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                        <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> {{__('dashboard.Modifier Name')}}  </th>
                                                            <th> {{__('dashboard.Status')}}</th>
                                                            <th>{{__('dashboard.Created At')}}</th>
                                                            <th>{{__('dashboard.Actions')}}  </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($modifiers as $key=>$modifier)
                                                            <tr>
                                                                <td> {{$key+1}} </td>
                                                            @if(App::isLocale('ar'))
                                                                <td> {{$modifier->translate('ar')->modifier}} </td>
                                                            @else
                                                                <td> {{$modifier->translate('en')->modifier}} </td>
                                                            @endif
                                                               

                                                                <td>
                                                                    <div class="form-group">
                                                                        <div class="col-md-9">
                                                                            <input type="checkbox" onchange="update_status_one(this)"
                                                                                   <?php if($modifier->status == 1) echo "checked";?>
                                                                                   class="make-switch"
                                                                                   value="{{ $modifier->id }}"
                                                                                   data-size="small">

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>  {{$modifier->created_at}} </td>

                                                                <td>
                                                                    <a href="{{ route('modifier.edit',[$modifier->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                                    <form id="delete-form-{{ $modifier->id }}" action="{{ route('modifier.destroy',$modifier->id) }}" style="display: none;" method="POST">
                                                                        @csrf
                                                                    </form>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                                        event.preventDefault();
                                                                        document.getElementById('delete-form-{{ $modifier->id }}').submit();
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

                        </div>
                        <div class="tab-pane" id="tab_1">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.Meals Modifiers')}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Begin: life time stats -->
                                        <div class="portlet light portlet-fit portlet-datatable bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <a href="{{ route('resturant.meal.modifiers.create',[$meal_id->id]) }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                </div>

                                            </div>
                                            <div class="portlet-body">
                                                <div class="table-container">
                                                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                        <thead>
                                                        <tr>
                                                            <th> # </th>
                                                            <th> {{__('dashboard.Meal')}} </th>
                                                            <th> {{__('dashboard.Modifier')}} </th>
                                                            <th>{{__('dashboard.Created At')}}</th>
                                                            <th> {{__('dashboard.Actions')}} </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($mealModifiers as $key=>$mealModifier)
                                                            <tr>
                                                                <td> {{$key+1}} </td>
                                                            @if(App::isLocale('ar'))
                                                                <td> {{$mealModifier->meal->translate('ar')->name}} </td>
                                                                <td> {{$mealModifier->modifier->translate('ar')->modifier}}</td>
                                                            @else
                                                                <td> {{$mealModifier->meal->translate('en')->name}} </td>
                                                                <td> {{$mealModifier->modifier->translate('en')->modifier}}</td>
                                                            @endif

                                                                <td>  {{$mealModifier->created_at}} </td>

                                                                <td>
                                                                    <a href="{{ route('meal.modifier.edit',[$mealModifier->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                                                                    <form id="delete-form-{{ $mealModifier->id }}" action="{{ route('meal.modifier.destroy',$mealModifier->id) }}" style="display: none;" method="POST">
                                                                        @csrf
                                                                    </form>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                                        event.preventDefault();
                                                                        document.getElementById('delete-form-{{ $mealModifier->id }}').submit();
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

                        </div>
                        <div class="tab-pane" id="tab_2">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>{{__('dashboard.Meals Ingredients')}}</div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Begin: life time stats -->
                                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <a href="{{ route('resturant.meal.ingredients.create',[$mealid->id]) }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                                                            <thead>
                                                            <tr>
                                                                <th> # </th>
                                                                <th> {{__('dashboard.Meal Name')}}  </th>
                                                                <th> {{__('dashboard.Calories')}} </th>
                                                                <th> {{__('dashboard.Ingredient')}}</th>
                                                                <th>{{__('dashboard.Created At')}}</th>
                                                                <th>{{__('dashboard.Actions')}}  </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach ($mealIngredients as $key=>$meal)
                                                                <tr>
                                                                    <td> {{$key+1}} </td>
                                                                @if(App::isLocale('ar'))
                                                                    <td> {{$meal->meal->translate('ar')->name}} </td>
                                                                    <td>{{$meal->calorie}} {{$meal->translate('ar')->calories}} </td>
                                                                    <td> {{$meal->translate('ar')->ingredient}} </td>
                                                                @else
                                                                    <td> {{$meal->meal->translate('en')->name}} </td>
                                                                    <td>{{$meal->calorie}} {{$meal->translate('en')->calories}} </td>
                                                                    <td> {{$meal->translate('en')->ingredient}} </td>
                                                                @endif
                                                                    <td>  {{$meal->created_at}} </td>
                            
                                                                    <td>
                                                                        <a href="{{ route('meal.ingredient.edit',[$meal->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                                        <form id="delete-form-{{ $meal->id }}" action="{{ route('meal.ingredient.destroy',$meal->id) }}" style="display: none;" method="POST">
                                                                            @csrf
                                                                        </form>
                                                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                                            event.preventDefault();
                                                                            document.getElementById('delete-form-{{ $meal->id }}').submit();
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
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myjsfile')
    <script>
        function update_status_one(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('modifier.status',isset($modifier) ? $modifier->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.modifier status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
    <script>
        function update_status_two(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('branch.status',isset($branch) ? $branch->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.branch status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
    <script>
        function update_status_three(el){
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
    <script>
        function update_status_four(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('meals.status',isset($meal) ? $meal->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.meal status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
@endsection
