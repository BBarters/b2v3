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
          _this.showArticle();
        };
      })(this));
    };

    Signup.prototype.showArticle = function() {
      $.ajax({
        url: "/signup",
        type: 'GET',
        data: {
          username: this.container.find('#username').val(),
          password: this.container.find('#password').val(),
          email: this.container.find('#email')
        },
        success: (function(_this) {
          return function(data) {
            _this.container.find('#message-title').html('error');
            return _this.container.find('#message-body').html(data['error']);
          };
        })(this)
      });
    };

    return Signup;

  })();

}).call(this);

//# sourceMappingURL=script.js.map