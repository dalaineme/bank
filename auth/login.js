// valid email pattern
var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$.validator.addMethod("validemail", function(value, element) {
  return this.optional(element) || eregex.test(value);
});

$("document").ready(function() {
  /* validation */
  $("#login-form").validate({
    rules: {
      logPassword: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      logEmail: {
        required: true,
        validemail: true
      }
    },
    messages: {
      logPassword: {
        required: "Please enter your password.",
        minlength: "Password should be at least 6 characters",
        maxlength: "Password should be less than 15"
      },
      logEmail: {
        required: "Please enter your email address.",
        validemail: "Please enter a valid email address."
      }
    },
    errorPlacement: function(error, element) {
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html(error.html());
    },
    highlight: function(element) {
      $(element)
        .closest(".form-group")
        .removeClass("has-success")
        .addClass("has-error");
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element)
        .closest(".form-group")
        .removeClass("has-error");
      $(element)
        .closest(".form-group")
        .find(".help-block")
        .html("");
    },
    submitHandler: submitForm
  });
  /* validation */

  /* login submit */
  function submitForm() {
    $.ajax({
      url: "login-ajax.php",
      type: "POST",
      data: $("#login-form").serialize(),
      dataType: "json"
    })
      .done(function(data) {
        $("input,#btn-login,#btn-signup").prop("disabled", true);
        $("body").loading({
          theme: "dark",
          message: "LOGGING IN...",
          onStart: function(loading) {
            loading.overlay.slideDown(400);
          },
          onStop: function(loading) {
            loading.overlay.slideUp(200);
          }
        });
        setTimeout(function() {
          if (data.status === "success") {
            $("body").loading("stop");
            window.location.href = "../index";
            $("body").loading("stop");
          } else if (data.status === "error") {
            $("#logErrorDiv")
              .slideDown("fast", function() {
                swal("Error!", data.message, "error");
                $("#login-form").trigger("reset");
                $("input,#btn-login,#btn-signup").prop("disabled", false);
                $("#btn-login")
                  .html("Login")
                  .prop("disabled", false);
              })
              .delay(3000)
              .slideUp("fast");
            $("body").loading("stop");
          }
        }, 3000);
      })
      .fail(function() {
        $("#login-form").trigger("reset");
        alert("An unknown error occoured, Please try again Later...");
      });
  }
  /* login submit */
});
