@extends('layouts.frontend')
@section('content')
<main class="mt-5 pt-5">
        <div class="container">

            <!--Section: Post-->
            <section class="mt-4">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-8 mb-4">

                        <!--Featured Image-->
                        <div class="card mb-4 wow fadeIn">

                            <img src="{{$post->featured}}" class="img-fluid" alt="">

                        </div>
                        <!--/.Featured Image-->

                        

                        <!--Card-->
                        <div class="card mb-4 wow fadeIn">

                            <!--Card content-->
                            <div class="card-body">

                                <p class="h5 my-4">{{$post->title}} </p>


                                {!! $post->content !!}

                            </div>

                        </div>
                        <!--/.Card-->

                        

                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-4 mb-4">

                        <!--Card: Jumbotron-->
                        <div class="card gradient-custom mb-4 wow fadeIn">

                            <!-- Content -->
                            <div class="card-body text-white text-center">

                                <h4 class="mb-4">
                                    <strong>Athens Cats CMS</strong>
                                </h4>
                                <p>
                                    <strong>1st Serious Project from Athens Cats</strong>
                                </p>
                                <p class="mb-4">
                                    <strong>Based on Laravel 5.6</strong>
                                </p>
                                <a target="_blank" href="" class="btn btn-outline-white btn-md">Free Button
                                    <i class="fa fa-graduation-cap ml-2"></i>
                                </a>

                            </div>
                            <!-- Content -->
                        </div>
                        <!--Card: Jumbotron-->                    

                        <!--Card-->
                        <div class="card mb-4 wow fadeIn">

                            <div class="card-header">Related articles</div>

                            <!--Card content-->
                            <div class="card-body">

                                <ul class="list-unstyled">
                                    <li class="media">
                                        <img class="d-flex mr-3" src="https://mdbootstrap.com/img/Photos/Others/placeholder7.jpg" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <a href="">
                                                <h5 class="mt-0 mb-1 font-weight-bold">List-based media object</h5>
                                            </a>
                                            Cras sit amet nibh libero, in gravida nulla (...)
                                        </div>
                                    </li>                                    
                                </ul>

                            </div>

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

            </section>
            <!--Section: Post-->

        </div>
    </main>
    <!--Main layout-->
@stop