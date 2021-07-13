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
                    <a href="{{route('trainer.index')}}">{{__('dashboard.Trainers')}}</a>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> {{__('dashboard.Trainers Datatable')}}
        </h1>


        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <a href="{{ route('trainer.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i></a>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{__('dashboard.Name')}} </th>
                                    <th> {{__('dashboard.Price')}} </th>
                                    <th> {{__('dashboard.Image')}} </th>
                                    <th> {{__('dashboard.status')}}</th>
                                    <th>{{__('dashboard.Created At')}}</th>
                                    <th> {{__('dashboard.Actions')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($trainers as $key=>$trainer)
                                 @if(App::isLocale('ar'))
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$trainer->translate('ar')->name}} </td>
                                        <td> {{$trainer->price}} {{$trainer->currency}} </td>
                                        <td><img class="img-responsive img-thumbnail" src="{{ asset($trainer->image) }}" style="height: 100px; width: 100px" alt=""></td>

                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
                                                           <?php if($trainer->status == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $trainer->id }}"
                                                           data-size="small">

                                                </div>
                                            </div>
                                        </td>
                                        <td>  {{$trainer->created_at}} </td>

                                        <td>
                                            <a href="{{ route('trainer.edit',[$trainer->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('trainer.show',[$trainer->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $trainer->id }}" action="{{ route('trainer.destroy',$trainer->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $trainer->id }}').submit();
                                                }else {
                                                event.preventDefault();
                                                }"><i class="material-icons"><i class="fa fa-trash"></i></i></button>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td> {{$key+1}} </td>
                                        <td> {{$trainer->translate('en')->name}} </td>
                                        <td> {{$trainer->price}} {{$trainer->currency}} </td>
                                        <td><img class="img-responsive img-thumbnail" src="{{ asset($trainer->image) }}" style="height: 100px; width: 100px" alt=""></td>

                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-9">
                                                    <input type="checkbox" onchange="update_status(this)"
                                                           <?php if($trainer->status == 1) echo "checked";?>
                                                           class="make-switch"
                                                           value="{{ $trainer->id }}"
                                                           data-size="small">

                                                </div>
                                            </div>
                                        </td>
                                        <td>  {{$trainer->created_at}} </td>

                                        <td>
                                            <a href="{{ route('trainer.edit',[$trainer->id]) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('trainer.show',[$trainer->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

                                            <form id="delete-form-{{ $trainer->id }}" action="{{ route('trainer.destroy',$trainer->id) }}" style="display: none;" method="POST">
                                                @csrf
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('{{__('dashboard.are you sure ? you want to delete this field ?')}}')){
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $trainer->id }}').submit();
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
            $.post('{{ route('trainer.status',isset($trainer) ? $trainer->id : "") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    alert('{{__('dashboard.trainer status changed')}}');
                }
                else{
                    alert('{{__('dashboard.something went wrong')}}');
                }
            });
        }
    </script>
@endsection
