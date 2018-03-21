@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')
@include('admin.includes.errors')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <!-- small box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('general.permissions_add')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('permissions.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" >@lang('permissions.name')</label>
                            <input type="text" name="name" class="form-control">

                        </div> 
                        <div class="row">
                            <div class="col-xs-12">
                                    <label for="roles">Roles</label>
                                    @foreach($roles as $role)                               
                                    <div class="checkbox">
                                            <label>
                                              <input type="checkbox" name="roles[]" value="{{$role->id}}"> {{$role->name}}
                                            </label>
                                          </div>
                                @endforeach
                            </div>
                        </div>                      
                 
                        <br>
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">

                                    <a class="btn btn-danger" href="{{route ('permissions.index')}}">@lang('general.cancel')</a>


                                </div>
                            </div>
                            <div class="col-md-offset-4 col-md-4">
                                <div class="form-group">

                                    <button class="btn btn-success pull-right" type="submit">@lang('general.submit')</button>


                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Athens Cats CMS - 2018
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->

    </div>
    <!-- /.row -->
    <!-- Default box -->

@stop