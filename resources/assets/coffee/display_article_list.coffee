class B3.DisplayArticleList
  constructor:(@container)->
    @readArticle(@container.find('#readArticle'))

  readArticle:(item) ->
    item.on 'click', =>
      @getArticleList()

  getArticleList: ->
    $.ajax '/b2v3/getArticleList',
      type: 'GET',
      data:{},
      success:(data) =>
        @container.find('#read-title').html('Articles')
        data="<ul>"+data+"</ul>"
        @container.find('#listView-read').html(data)
        @initListOnClick(@container.find('#listView-read'),@)
        $.material.init()


  initListOnClick:(list,curObject) ->
    $(list).on 'click','li.withripple a', ->
      curObject.showArticle(@.id,curObject)

  showArticle:(id) ->
    $.ajax '/b2v3/getArticle/'+ id,
      type: 'GET',
      data:{},
      success:(data) =>
        if data!=null
          @container.find('#showArticle-title').html(data['title'])
          @container.find('#showArticle-content').html(data['content'])
          @showEdit(data)
        else
          @container.find('#showArticle-title').html('Sorry');
          @container.find('#showArticle-content').html('No content available');
        @animatePage()

  animatePage: ->
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


  showEdit:(value) ->
    if value['allow']
      new B3.ModifyArticle(@container,value['id']);
    else
      @container.find('#showArticle-edit').css("display","none")
