class B3.Signup
  constructor:(@container)->
    @init()

  init: ->
    @container.find('#submit').on 'click', =>
      @signUpAjax()
      return

  signUpAjax: ->
    $.ajax 'signup',
      type: 'GET',
      data:{username:@container.find('#username').val(),password:@container.find('#password').val(),email:@container.find('#email').val()},
      success:(data) =>
        if data='success'
         window.location.href = 'http://localhost/b2v3/'
        else
         @container.find('#message-title').html('error');
         @container.find('#message-body').html(data['error']);

