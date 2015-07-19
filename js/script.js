(function() {
  B3.Create = (function() {
    function Create(container) {
      this.container = container;
      this.init();
    }

    Create.prototype.init = function() {
      return this.container.find('#submit').on('click', (function(_this) {
        return function() {
          _this.create();
        };
      })(this));
    };

    Create.prototype.create = function() {
      var content, description, title, token;
      title = this.container.find('#title').val();
      description = this.container.find('#description').val();
      content = this.container.find('#content').val();
      token = this.container.find('#token').val();
      return $.ajax('b2v3/create', {
        type: 'POST',
        data: {
          title: title,
          description: description,
          content: content,
          _token: token
        },
        success: (function(_this) {
          return function(data) {
            if (data = 'success') {
              _this.container.find('#message-title').html('Sucess');
              return _this.container.find('#message-body').html('Successfuly created article');
            } else {
              _this.container.find('#message-title').html('error');
              _this.container.find('#message-body').html(data['error']);
              return _this.container.find('#message-dialog').modal('show');
            }
          };
        })(this)
      });
    };

    return Create;

  })();

}).call(this);

(function() {
  B3.DisplayArticleList = (function() {
    function DisplayArticleList(container) {
      this.container = container;
      this.readArticle(this.container.find('#readArticle'));
    }

    DisplayArticleList.prototype.readArticle = function(item) {
      return item.on('click', (function(_this) {
        return function() {
          _this.getArticleList();
        };
      })(this));
    };

    DisplayArticleList.prototype.getArticleList = function() {
      return $.ajax('/b2v3/getArticleList', {
        type: 'GET',
        data: {},
        success: (function(_this) {
          return function(data) {
            data = "<ul>" + data + "</ul>";
            _this.container.find('#read-title').html('Articles');
            _this.initListOnClick(data);
            _this.container.find('#listView-read').html(data);
          };
        })(this)
      });
    };

    DisplayArticleList.prototype.initListOnClick = function(list) {
      return $(list).each(i, li)(function() {
        var listItem;
        listItem = $(li);
        return listItem.on('click', (function(_this) {
          return function() {
            _this.showArticle(_this.listItem.find('#articleId').val());
          };
        })(this));
      });
    };

    DisplayArticleList.prototype.showArticle = function(id) {
      return $.ajax('/b2v3/getArticle', {
        type: 'GET',
        data: {
          id: id
        },
        success: (function(_this) {
          return function(data) {
            if (data !== null) {
              _this.container.find('#showArticle-title').html(msg['title']);
              _this.container.find('#showArticle-content').html(msg['content']);
              _this.showEdit(data);
            } else {
              _this.container.find('#showArticle-title').html('Sorry');
              _this.container.find('#showArticle-content').html('No content available');
            }
            _this.animatePage();
          };
        })(this)
      });
    };

    DisplayArticleList.prototype.animatePage = function() {
      var anotherShow, page, totop;
      page = this.container.find('#showArticle');
      this.container.find(".menu li").not(page).removeClass("active");
      this.container.find(".page").not(page).removeClass("active").hide();
      page.show();
      totop = function() {
        return setInterval(function() {
          return this.container.find(".pages").animate({
            scrollTop: 0
          }, 0);
        }, 1);
      };
      anotherShow = function() {
        var clear;
        page.addClass("active");
        clear = function() {
          return clearInterval(totop);
        };
        return setTimeOut(clear, 1000);
      };
      setTimeout(anotherShow, 100);
    };

    DisplayArticleList.prototype.showEdit = function(value) {
      var modify;
      if (value['allow']) {
        return modify = new B3.ModifyArticle(this.container, value['id']);
      } else {
        return this.container.find('#showArticle-edit').css("display", "none");
      }
    };

    return DisplayArticleList;

  })();

}).call(this);

(function() {
  B3.ModifyArticle = (function() {
    function ModifyArticle(container, id) {
      this.container = container;
      this.init(id);
    }

    ModifyArticle.prototype.init = function(id) {
      return this.container.find('#showArticle-edit').css('display', 'block').on('click', (function(_this) {
        return function() {
          return _this.editModel(id);
        };
      })(this));
    };

    ModifyArticle.prototype.editModel = function(id) {
      return $.ajax('/b2v3/getArticle', {
        type: 'GET',
        data: {
          id: id
        },
        success: (function(_this) {
          return function(data) {
            if (data !== null) {
              _this.container.find('#update-update').on('click', function() {
                return _this.updateArticle(id);
              });
              _this.container.find('#update-delete').on('click', function() {
                return _this.deleteArticle(id);
              });
              _this.container.find('#update-title').val(data['title']);
              _this.container.find('#update-description').val(data['description']);
              _this.container.find('#update-content').val(data['content']);
              _this.container.find('#update-dialog').modal('show');
            }
          };
        })(this)
      });
    };

    ModifyArticle.prototype.upadteArticle = function(id) {
      var content, description, title, token;
      title = this.container.find('#update-title').val();
      description = this.container.find('#update-description').val();
      content = this.container.find('#update-content').val();
      token = this.container.find('#token').val();
      return $.ajax('b2v3/updateArticle', {
        type: 'POST',
        data: {
          title: title,
          description: description,
          content: content,
          _token: token
        },
        success: (function(_this) {
          return function(data) {
            if (data = 'success') {
              _this.container.find('#message-title').html('Success');
              _this.container.find('#message-body').html('Article has been successfully updated');
              return _this.container.find('#message-dialog').modal('show');
            }
          };
        })(this)
      });
    };

    ModifyArticle.prototype.deleteArticle = function(id) {
      return $.ajax('b2v3/deleteArticle', {
        type: 'GET',
        data: {
          id: id
        },
        success: (function(_this) {
          return function(data) {
            if (data = 'success') {
              _this.container.find('.menu').find('li[data-target=#read]').trigger('click');
              _this.container.find('#message-title').html('Success');
              _this.container.find('#message-body').html('Article has been successfully deleted');
              return _this.container.find('#message-dialog').modal('show');
            } else {
              _this.container.find('#message-title').html('Error');
              _this.container.find('#message-body').html('Error while deleting article');
              return _this.container.find('#message-dialog').modal('show');
            }
          };
        })(this)
      });
    };

    return ModifyArticle;

  })();

}).call(this);

(function() {
  if (this.B3 == null) {
    this.B3 = {};
  }

}).call(this);

(function() {
  B3.Signup = (function() {
    function Signup(container) {
      this.container = container;
      this.init();
    }

    Signup.prototype.init = function() {
      return this.container.find('#submit').on('click', (function(_this) {
        return function() {
          _this.signUpAjax();
        };
      })(this));
    };

    Signup.prototype.signUpAjax = function() {
      return $.ajax('signup', {
        type: 'GET',
        data: {
          username: this.container.find('#username').val(),
          password: this.container.find('#password').val(),
          email: this.container.find('#email').val()
        },
        success: (function(_this) {
          return function(data) {
            if (data = 'success') {
              return window.location.href = 'http://localhost/b2v3/';
            } else {
              _this.container.find('#message-title').html('error');
              return _this.container.find('#message-body').html(data['error']);
            }
          };
        })(this)
      });
    };

    return Signup;

  })();

}).call(this);

//# sourceMappingURL=script.js.map