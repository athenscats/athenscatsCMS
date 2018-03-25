@extends('layouts.app')

@section('content')
<div class="row">
    <div class='col-lg-12'>
        <h1><center>401<br>
        ACCESS DENIED</center></h1>
    </div>
</div>
<div class="row justify-content-md-center">
        <div class='col-lg-4 '>
          
    <a href="{{ route('admin') }}"  class="btn btn-block btn-danger btn-lg">Go Back</a>
        </div>
    </div>

@endsection