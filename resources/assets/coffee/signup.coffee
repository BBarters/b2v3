class B3.Signup
  constructor:(@container)->
    @init()

  init: ->
    @container.find('#submit').on 'click', =>
      @showArticle()
      return

  showArticle: ->
    $.ajax
      url: "/signup",
      type: 'GET',
      data:{username:@container.find('#username').val(),password:@container.find('#password').val(),email:@container.find('#email')},
      success:(data) =>
        @container.find('#message-title').html('error');
        @container.find('#message-body').html(data['error']);

    return