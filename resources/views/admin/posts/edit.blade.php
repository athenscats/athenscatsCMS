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
                    <h3 class="box-title">@lang('general.posts_add')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{ route('posts.update',$data->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="title" >@lang('posts.title')</label>
                            <input type="text" name="title" class="form-control" value="{{$data->title}}">

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                <div class="form-group">
                                    <label for="category_id">@lang('categories.name')</label>
                                    <select class="form-control category_id" name="category_id" style="width: 100%;">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" 
                                                @if($category->id == $data->category_id)
                                                selected
                                                @endif>
                                                {{$category->name}}</option>
                                        @endforeach
                                    </select>
        
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-6">
                                <div class="form-group">
                                    <label for="featured" >Post Featured Image</label>
                                    <input type="file" name="featured" class="form-control">
                                    <img src="{{$data->featured}}" alt="{{$data->title}}" height="100px">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <label for="content">Content</label>
                            <textarea name="content" id="" cols="5" rows="5" class="form-control">{{$data->content}}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <div class="form-group">

                                    <a class="btn btn-danger" href="{{route ('posts.index')}}">@lang('general.cancel')</a>


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