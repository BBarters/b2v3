@extends('parent.parent')

@section('content')

<div class="row">

    <div id="navbar" class="shadow-z-2 col-xs-12">

        <div class="container-fluid">
            <h3>
                Welcome to our shitty website
            </h3>
            <h5>
                Nothing gets done around here
            </h5>

        </div>
    </div>


    <div class="col-xs-4 col-xs-offset-4" >

        <div class="container-fluid" style="margin-top: 50px">

            <div class="well active" id="about" style="display: block;">

                <h1 class="header" >Login</h1>

                <div class="inputs" style="margin-top: 36px">

                    <div class="form-group">

                        <input id="username" type="text" class="form-control" placeholder="username">
                        <br>
                        <input id="password" type="text" class="form-control" placeholder="password">
                        <br>
                        <input id="email" type="text" class="form-control" placeholder="email">
                        <br>
                        <button class="btn btn-primary" id="submit">Signup</button>

                   </div>

            </div>

        </div>

    </div>

        @include('parent.message')

    </div>

    <script>
        testingObject=new B3.Signup($('.row'))
    </script>

@stop