@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>{{$title}}</h1>
@stop

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('general.users')</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ route('users.create') }}" class="btn btn-app"><i
                                class="fa fa-plus"></i> @lang('general.users_add')</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12">


                    <table id="data" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>@lang('users.name')</th>
                            <th>@lang('users.email')</th>
                            <th>@lang('users.roles')</th>
                 
                            <th width="280px">@lang('general.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dat)
                            <tr>
                                <td>    {{$dat->name}}</td>
                                <td>    {{$dat->email}}</td>
                                <td> 
                                    <ul>  
                                    @foreach($dat->roles as $role)
                                    <li>
                                    {{$role->name}}
                                </li>
                                    @endforeach
                                    </ul>   
                                </td>
                    
                                
                                <td>


                                    <form class="pull-right" method="post"
                                          action="{{ route('users.destroy',$dat->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('users.edit',$dat->id) }}" data-toggle="tooltip"
                                               title="Edit User" class="btn btn-default btn-sm"><i
                                                        class='fa fa-pencil'></i></a>
                                            <button type="submit" data-toggle="tooltip" title="Delete User"
                                                    class="btn btn-default btn-sm"><i class='fa fa-trash'></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>@lang('users.name')</th>
                            <th>@lang('users.email')</th>
                            <th>@lang('users.roles')</th>
                
                            <th width="280px">@lang('general.action')</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Athens Cats CMS - 2018
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
@stop

@section('js')
    <script>
        $(function () {
            $('#data').DataTable()
        })
    </script>
@stop