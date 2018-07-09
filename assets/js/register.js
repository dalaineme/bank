// JavaScript Validation For Registration Page

$('document').ready(function()
{

		 // name validation
		 var nameregex = /^[a-zA-Z ]+$/;

		 $.validator.addMethod("validname", function( value, element ) {
		     return this.optional( element ) || nameregex.test( value );
		 });

		 // valid email pattern
		 var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		 $.validator.addMethod("validemail", function( value, element ) {
		     return this.optional( element ) || eregex.test( value );
		 });

		 $("#register-form").validate({

		  rules:
		  {
				firstName: {
					required: true,
					validname: true,
					minlength: 3
				},
				midName: {
					required: true,
					validname: true,
					minlength: 3
				},
				surName: {
					required: true,
					validname: true,
					minlength: 3
				},
				userEmail : {
				required : true,
				validemail: true,
					remote: {
						url: "check-email.php",
						type: "post",
						data: {
							email: function() {
								return $( "#email" ).val();
							}
						}
					}
				},
				userAddress: {
					required: true,
					number: true,
					minlength: 3
				},
				postCode: {
					required: true,
					number: true,
					minlength: 3
				},
				gender: {
					required: true
				},
				dateOfBirth: {
					required: true
				},
				checkBox: {
					required: true
				},
				userPass: {
            required: true,
            minlength: 6
        },
        confirmPass: {
            required: true,
            minlength: 6,
            equalTo: "#userPass"
        },
				password: {
					required: true,
					minlength: 6,
					maxlength: 15
				},
				cpassword: {
					required: true,
					equalTo: '#password'
				},
		   },
		   messages:
		   {
				firstName: {
					required: "First Name is required",
					validname: "Name must contain only alphabets and space",
					minlength: "Your name is too short"
				},
				midName: {
					required: "Mid Name is required",
					validname: "Name must contain only alphabets and space",
					minlength: "Your name is too short"
				},
				surName: {
					required: "Sur Name is required",
					validname: "Name must contain only alphabets and space",
					minlength: "Your name is too short"
				},
				userEmail : {
				required : "Email is required",
				validemail : "Please enter valid email address",
				remote : "Email already exists"
				},
				userAddress: {
					required: "Address is required",
					number: "Only numbers allowed",
					minlength: "Address is too short"
				},
				postCode: {
					required: "Post code is required",
					number: "Only numbers allowed",
					minlength: "Post Code is too short"
				},
				gender: {
					required: "Gender is required"
				},
				dateOfBirth: {
					required: "Date of Birth is required"
				},
				checkBox: {
					required: "You need to agree to the Terms and Conditions"
				},
				userPass: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
        },
        confirmPass: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long",
            equalTo: "Passwords don't match"
        },
				password:{
					required: "Password is required",
					minlength: "Password at least have 6 characters"
					},
				cpassword:{
					required: "Retype your password",
					equalTo: "Password did not match !"
					}
		   },
		   errorPlacement : function(error, element) {
			  $(element).closest('.form-group').find('.help-block').html(error.html());
		   },
		   highlight : function(element) {
			  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		   },
		   unhighlight: function(element, errorClass, validClass) {
			  $(element).closest('.form-group').removeClass('has-error');
			  $(element).closest('.form-group').find('.help-block').html('');
		   },
				submitHandler: submitForm
		   });


		   function submitForm(){

			   $.ajax({
			   		url: 'ajax-register.php',
			   		type: 'POST',
			   		data: $('#register-form').serialize(),
			   		dataType: 'json'
			   })
			   .done(function(data){

			   		$('#btn-signup').html('<img src="ajax-loader.gif" /> &nbsp; Registering...').prop('disabled', true);
			   		$('input[type=text],input[type=email],input[type=password]').prop('disabled', true);

			   		setTimeout(function(){

						if ( data.status==='success' ) {

							$('#errorDiv').slideDown('fast', function(){
								$('#errorDiv').html('<div class="alert alert-info">'+data.message+'</div>');
								$("#register-form").trigger('reset');
								$('input[type=text],input[type=email],input[type=password]').prop('disabled', false);
								$('#btn-signup').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Register').prop('disabled', false);
							}).delay(3000).slideUp('fast');


					    } else {

						    $('#errorDiv').slideDown('fast', function(){
						      	$('#errorDiv').html('<div class="alert alert-danger">'+data.message+'</div>');
							  	$("#register-form").trigger('reset');
							  	$('input[type=text],input[type=email],input[type=password]').prop('disabled', false);
							  	$('#btn-signup').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign Me Up').prop('disabled', false);
							}).delay(3000).slideUp('fast');
						}

					},3000);

			   })
			   .fail(function(){
			   		$("#register-form").trigger('reset');
			   		alert('An unknown error occoured, Please try again Later...');
			   });
		   }
});
