// valid email pattern
var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$.validator.addMethod("validemail", function(value, element) {
  return this.optional(element) || eregex.test(value);
});

// name validation
var nameregex = /^[a-zA-Z0-9_\.\-\+ ]+$/;

$.validator.addMethod("validname", function(value, element) {
  return this.optional(element) || nameregex.test(value);
});

// Valid URL pattern
var urlregex = /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;

$.validator.addMethod("validurl", function(value, element) {
  return this.optional(element) || urlregex.test(value);
});

// phone number validation
var pregex = /^07/;

$.validator.addMethod("validphone", function(value, element) {
  return this.optional(element) || pregex.test(value);
});

$("document").ready(function() {
  /* validation */
  $("#forgot-password-form").validate({
    rules: {
      fEmail: {
        required: true,
        validemail: true
      },
      some: {}
    },
    messages: {
      fEmail: {
        required: "Email is required.",
        validemail: "Please enter a valid email address."
      },
      some: {}
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

  /* Create new company submit */
  function submitForm() {
    $.ajax({
      url: "forgot-password-ajax.php",
      type: "POST",
      data: $("#forgot-password-form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("input,#forgot-password-form,#btn-forgot-password").prop(
          "disabled",
          true
        );
        $("body").loading({
          theme: "dark",
          message: "SENDING RESET PASSWORD EMAIL...",
          onStart: function(loading) {
            loading.overlay.slideDown(400);
          },
          onStop: function(loading) {
            loading.overlay.slideUp(200);
          }
        });
      }
    })
      .done(function(data) {
        setTimeout(function() {
          if (data.status === "success") {
            $("#fpassErrorDiv")
              .slideDown("fast", function() {
                $("input,#forgot-password-form,#btn-forgot-password").prop(
                  "disabled",
                  false
                );
                // $("#fpassErrorDiv").html(
                //   '<div class="alert alert-success">' + data.message + "</div>"
                // );
                swal("Success!", data.message, "success");
                $("#forgot-password-form").trigger("reset");
                $("#btn-forgot-password")
                  .html("Reset Password")
                  .prop("disabled", false);
              })
              .delay(5000)
              .slideUp("fast");
            $("body").loading("stop");
          } else if (data.status === "error") {
            $("#fpassErrorDiv")
              .slideDown("fast", function() {
                $("input,#forgot-password-form,#btn-forgot-password").prop(
                  "disabled",
                  false
                );
                // $("#fpassErrorDiv").html(
                //   '<div class="alert alert-danger">' + data.message + "</div>"
                // );
                swal("Error!", data.message, "error");
                $("#forgot-password-form").trigger("reset");
                $("#btn-forgot-password")
                  .html("Reset Password")
                  .prop("disabled", false);
              })
              .delay(5000)
              .slideUp("fast");
            $("body").loading("stop");
          }
        }, 3000);
      })
      .fail(function() {
        $("#forgot-password-form").trigger("reset");
        swal(
          "Error!",
          "An unknown error occoured, Please try again later...",
          "error"
        );
      });
  }
  /* Create new User */
});
