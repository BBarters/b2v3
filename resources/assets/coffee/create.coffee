class B3.Create
  constructor:(@container)->
    @init()

  init: ->
    @container.find('#submit').on 'click', =>
      @create()
      return

  create: ->
    title=@container.find('#title').val()
    description=@container.find('#description').val()
    content=@container.find('#content').val()
    token=@container.find('#token').val()
    $.ajax 'b2v3/create',
      type: 'POST',
      data:{title:title,description:description,content:content,_token:token},
      success:(data) =>
        if data='success'
          @container.find('#message-title').html('Sucess')
          @container.find('#message-body').html('Successfuly created article')
        else
          @container.find('#message-title').html('error');
          @container.find('#message-body').html(data['error']);
          @container.find('#message-dialog').modal('show');

