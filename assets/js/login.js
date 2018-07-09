$('document').ready(function()
{
     /* validation */

     // valid email pattern
		 var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		 $.validator.addMethod("validemail", function( value, element ) {
		     return this.optional( element ) || eregex.test( value );
		 });


	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			email: {
            required: true,
            validemail: true
            },
	   },
       messages:
	   {
            password:{
                required: "Please enter your Password"
            },
            email: {
            	required: "Please enter your Email Address",
            	validemail: "Please enter a valid email address."
            },
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
	   /* validation */

	   /* login submit */
	   function submitForm()
	   {
			var data = $("#login-form").serialize();

			$.ajax({

			type : 'POST',
			url  : 'ajax-login.php',
			data : data,
			beforeSend: function()
			{
				$("#error").fadeOut();
				$("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Processing ...');
			},
			success :  function(response)
			   {
					if(response=="ok"){

						$("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Logging In ...');
						setTimeout(' window.location.href = "home.php"; ',4000);
					}
					else{

						$("#error").fadeIn(1000, function(){
							$("#error").html('<div class="alert alert-danger">  '+response+' !</div>');
							$("#btn-login").html('Log In');
						});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});
