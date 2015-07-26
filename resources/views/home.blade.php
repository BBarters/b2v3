@extends('parent.parent')

@section('content')

@include('parent.cus-navbar')

<div id="container" class="container-fluid main" style="height: 631px;">

    <div class="row" style="margin-top: 30px">

                <nav class="col-xs-3 menu" id="sideNav" >
                    <ul>
                        <li class="active withripple" data-target="#create">Create</li>
                        <li class="withripple" data-target="#read" id="readArticle">Read</li>
                    </ul>
                 </nav>

                <div class="pages col-xs-9" >

                    <div class="col-xs-10">

                    <div class="well page active" id="create" >
                         <h2>Create</h2> <br><br>

                        <input type="text" id="title" class="form-control floating-label" placeholder="Title">
                        <br>
                        <input type="text" id="description" class="form-control floating-label" placeholder="Description">
                        <br> <br>
                        <textarea id="content" class="form-control" placeholder="Content" style="height: 300px"></textarea>
                        <br><br>
                        <button class="btn btn-primary shadow-z-2" id="submit">Submit</button>
                        <input id="token" type="hidden" name="_token" value="{{{ csrf_token() }}}" />

                    </div>

                    <div class="well page" id="read" style="display: none" >
                        <h2 id="read-title">Loading</h2><br><br>

                        <div id="listView-read" class="list-group" >

                    </div>

                    </div>

                    <div class="well page" id="showArticle">


                        <div style="background-color: #2196F3; margin-right: -20px; margin-left: -20px; margin-top: -20px; display: block">

                            <h2 id="showArticle-title"  style="color: #ffffff; margin: 0px; padding: 26px"></h2>

                            <button id="showArticle-edit" class="btn btn-fab btn-raised btn-danger" style=" float: right; margin-top: -30px; margin-right: 16px"><i class="mdi-image-edit"></i></button>

                        </div>

                            <p id="showArticle-content" style="margin-top: 20px"></p>

                    </div>

                  </div>

                </div>
        </div>

    <div id="update-dialog" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="msg-title">Modify</h4>
                </div>
                <div class="modal-body" style="margin-top: 26px">

                    <div class="form-group">

                        <input type="text" id="update-title" class="form-control" placeholder="Title">
                        <br>
                        <input type="text" id="update-description" class="form-control" placeholder="Description">
                        <br> <br>
                        <textarea id="update-content" class="form-control" placeholder="Content" style="height: 200px"></textarea>
                        <br><br>
                        <button class="btn btn-primary shadow-z-2" id="update-update">Update</button>
                        <button class="btn btn-warning shadow-z-2" id="update-delete">Delete</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="username" value="{{Auth::user()->username}}">

    @include('parent.message')

</div>

<script>
    creating=new B3.Create($('#create'),$('#message'));
    displayArticleList=new B3.DisplayArticleList($("#container"));
</script>



<script>
    window.page = window.location.hash || "#create";
    $(document).ready(function() {
        if (window.page != "#create") {
            $(".menu").find("li[data-target=" + window.page + "]").trigger("click");
        }
    });

    $(".menu li").click(function() {
        // Menu
        if (!$(this).data("target")) return;
        if ($(this).is(".active")) return;
        $(".menu li").not($(this)).removeClass("active");
        $(".page").not(page).removeClass("active").hide();
        window.page = $(this).data("target");
        var page = $(window.page);
        window.location.hash = window.page;
        $(this).addClass("active");
        page.show();
        var totop = setInterval(function() {
            $(".pages").animate({scrollTop:0}, 0);
        }, 1);

        setTimeout(function() {
            page.addClass("active");
            setTimeout(function() {
                clearInterval(totop);
            }, 1000);
        }, 100);
    });
</script>

@stop