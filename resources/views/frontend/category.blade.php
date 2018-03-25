@extends('layouts.frontend')
@section('content')
<!--Main layout-->
    <main class="mt-5 pt-5">
        <div class="container">

            

            <!--Section: Cards-->
            <section class="pt-5">

                <!-- Heading & Description -->
                <div class="wow fadeIn">
                    <!--Section heading-->
                    <h2 class="h1 text-center mb-5">{{$category->name}}</h2>
                    <!--Section description-->                  
                
                </div>
                <!-- Heading & Description -->
               
                @foreach($posts as $post)
        
                <!--Grid row-->
                <div class="row wow fadeIn">
                        <!--Grid column-->
                        <div class="col-lg-5 col-xl-4 mb-4">
                            <!--Featured image-->
                            <div class="view overlay rounded z-depth-1">
                                <img src="{{$post->featured}}" class="img-fluid" alt="">
                                <a href="{{route('post.single', ['slug' => $post->slug])}}" target="_self">
                                    <div class="mask"></div>
                                </a>
                            </div>
                        </div>
                        <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                        <h3 class="mb-3 font-weight-bold dark-grey-text">
                            <strong>{{$post->title}}</strong>
                        </h3>
                        <p class="grey-text">{{strip_tags(str_limit($post->content,100,'...'))}}</p>
                        
                        <a href="{{route('post.single', ['slug' => $post->slug])}}" target="_self" class="btn btn-primary btn-md">Read more
                            <i class="fa fa-play ml-2"></i>
                        </a>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->
                <hr class="mb-5">
                @endforeach

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