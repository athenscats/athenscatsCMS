@extends('layouts.frontend')
@section('content')
<!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="container">

            <!--Section: Jumbotron-->
            <section class="card wow fadeIn" style="background-image: url({{$first_post->featured}});">

                <!-- Content -->
                <div class="card-body text-white text-center py-5 px-5 my-5">

                    <h1 class="mb-4">
                        <strong>{{$first_post->title}}</strong>
                    </h1>
                
                    <p class="mb-4">
                        <strong>{{strip_tags(str_limit($first_post->content,300,'...'))}}</strong>
                    </p>
                    <a target="_self" href="{{route('post.single', ['slug' => $first_post->slug])}}" class="btn btn-outline-white btn-lg">Read More
                        <i class="fa fa-graduation-cap ml-2"></i>
                    </a>

                </div>
                <!-- Content -->
            </section>
            <!--Section: Jumbotron-->

            <hr class="my-5">

            <!--Section: Cards-->
            <section class="text-center">

                <!--Grid row-->
                <div class="row mb-4 wow fadeIn">
                    @foreach($posts as $post)
                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4">

                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <div class="view overlay hm-white-slight">
                                <img src="{{$post->featured}}" class="img-fluid" alt="">
                                <a href="{{route('post.single', ['slug' => $post->slug])}}" target="_self">
                                    <div class="mask"></div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">{{$post->title}}</h4>
                                <!--Text-->
                                <p class="card-text">{{strip_tags(str_limit($first_post->content,100,'...'))}}</p>
                                <a href="{{route('post.single', ['slug' => $post->slug])}}" target="_self" class="btn btn-primary btn-md">Read more
                                    <i class="fa fa-play ml-2"></i>
                                </a>
                            </div>

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->

                    @endforeach

                </div>
                <!--Grid row-->

                

                <!--Pagination-->
                <div class="d-flex justify-content-center wow fadeIn">
                        {{ $posts->links() }}
                </div>
                <!--Pagination-->

            </section>
            <!--Section: Cards-->

        </div>
    </main>
    <!--Main layout-->
@stop