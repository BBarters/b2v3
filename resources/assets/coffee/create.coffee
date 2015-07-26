class B3.Create
  constructor:(@articleContainer,@messageDialog)->
    @init()

  init: ->
    @articleContainer.find('#submit').on 'click', =>
      @createArticle()
      return


  createArticle: ->
    title=@articleContainer.find('#title').val()
    description=@articleContainer.find('#description').val()
    content=@articleContainer.find('#content').val()
    token=@articleContainer.find('#token').val()
    $.ajax '/b2v3/create',
      type: 'POST',
      data:{title:title,description:description,content:content,_token:token},
      success:(data) =>
        if data['value']='success'
          @messageDialog.find('#message-title').html('Sucess')
          @messageDialog.find('#message-body').html('Successfuly created article')
          @messageDialog.find('#message-dialog').modal('show');
        else
          @messageDialog.find('#message-title').html('error');
          @messageDialog.find('#message-body').html(data['error']);
          @messageDialog.find('#message-dialog').modal('show');

