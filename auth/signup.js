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
  $("#the-signup-form").validate({
    rules: {
      firstName: {
        required: true,
        validname: true,
        minlength: 3
      },
      lastName: {
        required: true,
        validname: true,
        minlength: 3
      },
      email: {
        required: true,
        validemail: true,
        remote: {
          url: "check-exists.php",
          type: "post",
          data: {
            email: function() {
              return $("#email").val();
            }
          }
        }
      },
      phoneNumber: {
        required: true,
        number: true,
        validphone: true,
        minlength: 10,
        maxlength: 10,
        remote: {
          url: "check-exists.php",
          type: "post",
          data: {
            phoneNumber: function() {
              return $("#phoneNumber").val();
            }
          }
        }
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 15
      },
      cpassword: {
        required: true,
        equalTo: "#password"
      },
      some: {}
    },
    messages: {
      firstName: {
        required: "First Name is required.",
        validname: "First Name is invalid, remember no spaces.",
        minlength: "Your First Name name is too short."
      },
      lastName: {
        required: "Last Name is required.",
        validname: "Last Name is invalid, remember no spaces.",
        minlength: "Your Last name is too short."
      },
      email: {
        required: "Email is required.",
        validemail: "Please enter a valid email address.",
        remote: "Email already exists."
      },
      phoneNumber: {
        required: "Phone Number is required.",
        number: "Only digits allowed.",
        validphone: "Phone number should start with '07'",
        minlength: "Phone number seems short.",
        maxlength: "Phone number seems long.",
        remote: "Sorry, phone number already exists."
      },
      password: {
        required: "Password is required.",
        minlength: "Password at least have 6 characters."
      },
      cpassword: {
        required: "Retype your password.",
        equalTo: "Password did not match!"
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
      url: "signup-ajax.php",
      type: "POST",
      data: $("#the-signup-form").serialize(),
      dataType: "json",
      beforeSend: function() {
        $("input,#btn-login,#btn-signup").prop("disabled", true);
        $("body").loading({
          theme: "dark",
          message: "CREATING NEW ACCOUNT...",
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
            $("#errorDiv")
              .slideDown("fast", function() {
                $("input,#btn-login,#btn-signup").prop("disabled", false);
                $("#errorDiv").html(
                  '<div class="alert alert-success">' + data.message + "</div>"
                );
                swal("Success!", data.message, "success");
                $("#the-signup-form").trigger("reset");
                $("#btn-signup")
                  .html("Register Another Account")
                  .prop("disabled", false);
              })
              .delay(5000)
              .slideUp("fast");
            $("body").loading("stop");
          } else if (data.status === "error") {
            $("#errorDiv")
              .slideDown("fast", function() {
                $("input,#btn-login,#btn-signup").prop("disabled", false);
                $("#errorDiv").html(
                  '<div class="alert alert-danger">' + data.message + "</div>"
                );
                swal("Error!", data.message, "error");
                $("#the-signup-form").trigger("reset");
                $("#btn-signup")
                  .html("Signup")
                  .prop("disabled", false);
              })
              .delay(5000)
              .slideUp("fast");
            $("body").loading("stop");
          }
        }, 3000);
      })
      .fail(function() {
        $("#the-signup-form").trigger("reset");
        swal(
          "Error!",
          "An unknown error occoured, Please try again later...",
          "error"
        );
      });
  }
  /* Create new User */
});
