class B3.ModifyArticle
  constructor:(@container,id)->
    @init(id)

  init:(id) ->
    @container.find('#showArticle-edit').css('display','block').on 'click', =>
      @editModel(id)

  editModel:(id) ->
    $.ajax '/b2v3/getArticle',
      type: 'GET',
      data:{id:id},
      success:(data) =>
        if data !=null
          @container.find('#update-update').on 'click', =>
            @updateArticle(id)
          @container.find('#update-delete').on 'click', =>
            @deleteArticle(id)
          @container.find('#update-title').val(data['title'])
          @container.find('#update-description').val(data['description'])
          @container.find('#update-content').val(data['content'])
          @container.find('#update-dialog').modal('show')
        return

  upadteArticle:(id) ->
    title=@container.find('#update-title').val()
    description=@container.find('#update-description').val()
    content=@container.find('#update-content').val()
    token=@container.find('#token').val()
    $.ajax 'b2v3/updateArticle',
      type: 'POST',
      data:{title:title,description:description,content:content,_token:token},
      success:(data) =>
        if data='success'
          @container.find('#message-title').html('Success');
          @container.find('#message-body').html('Article has been successfully updated');
          @container.find('#message-dialog').modal('show');

  deleteArticle:(id) ->
    $.ajax 'b2v3/deleteArticle',
      type: 'GET',
      data:{id:id},
      success:(data) =>
        if data='success'
          @container.find('.menu').find('li[data-target=#read]').trigger('click')
          @container.find('#message-title').html('Success');
          @container.find('#message-body').html('Article has been successfully deleted');
          @container.find('#message-dialog').modal('show');
        else
          @container.find('#message-title').html('Error');
          @container.find('#message-body').html('Error while deleting article');
          @container.find('#message-dialog').modal('show');
