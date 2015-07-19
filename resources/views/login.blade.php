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

                        {!! Form::open(['url'=>'login']) !!}
                        <div class="form-group">
                            {!! Form::text('username',null,['class'=>'form-control empty floating-label','placeholder'=>'username']) !!}
                            <br>
                            <input name="password" type="password" class="form-control empty floating-label" placeholder="password">
                        </div>
                        {!! Form::submit('Login',['class'=>'btn','id'=>'login-button']) !!}

                        <a id="signup-button" type="btn" class="btn" href="signupView" >SignUp</a>
                        {!! Form::close()!!}


                    </div>

                </div>

                @if(isset($error))

                <script>
                        var options =  {
                            content: "Incorrect username or password",
                            style: "toast",
                            timeout: 1000
                            }
                        $.snackbar(options);
                    </script>

                @endif

            </div>

        </div>

</div>


@include('parent.message')

@stop