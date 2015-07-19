class B3.DisplayArticleList
  constructor:(@container)->
    @readArticle(@container.find('#readArticle'))

  readArticle:(item) ->
    item.on 'click', =>
      @getArticleList()
      return

  getArticleList: ->
    $.ajax '/b2v3/getArticleList',
      type: 'GET',
      data:{},
      success:(data) =>
        data="<ul>"+data+"</ul>"
        @container.find('#read-title').html('Articles')
        @initListOnClick(data)
        @container.find('#listView-read').html(data)
        return


  initListOnClick:(list) ->
      $(list).each(i,li) ->
        listItem=$(li)
        listItem.on 'click', =>
          @showArticle(@listItem.find('#articleId').val())
          return


  showArticle:(id) ->
    $.ajax '/b2v3/getArticle',
      type: 'GET',
      data:{id:id},
      success:(data) =>
        if data !=null
          @container.find('#showArticle-title').html(msg['title'])
          @container.find('#showArticle-content').html(msg['content'])
          @showEdit(data)
        else
          @container.find('#showArticle-title').html('Sorry');
          @container.find('#showArticle-content').html('No content available');
        @animatePage()
        return


  animatePage:() ->
    page=@container.find('#showArticle')
    @container.find(".menu li").not(page).removeClass("active");
    @container.find(".page").not(page).removeClass("active").hide()
    page.show()
    totop = ->
      setInterval ->
        @container.find(".pages").animate({scrollTop:0}, 0)
      ,1
    anotherShow = () ->
      page.addClass("active")
      clear = () ->
        clearInterval(totop)
      setTimeOut(clear,1000)
    setTimeout(anotherShow, 100)
    return


  showEdit:(value) ->
    if value['allow']
      modify=new B3.ModifyArticle(@container,value['id']);
    else
      @container.find('#showArticle-edit').css("display","none")
