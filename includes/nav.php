<nav class="navbar navbar-inverse">
	<ul class="nav navbar-nav">
		<div class=" logo navbar-header"><a class="logo" href=""><span class="glyphicon glyphicon-yen"></span>&nbsp;Bank Management System</a></div>
		<li><a href=""><span class="glyphicon glyphicon-wrench"></span>&nbsp;Services</a></li>
		<li><a href=""><span class="glyphicon glyphicon-info-sign"></span>&nbsp;About</a></li>
		<li><a href=""><span class="glyphicon glyphicon-phone"></span>&nbsp;Contact Us</a></li>
		<li></li>
	</ul>

	<section class="sign">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#signin"><span class="glyphicon glyphicon-user"></span>&nbsp;Sign In</button>

	<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="false">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title text-center" id="modalLabel"><span class="glyphicon glyphicon-user"></span>&nbsp;Sign In</h2>
				</div>
				<div class="modal-body">
					<form method="post" id="login-form" >
						<!-- json response will be here -->
					<div class="error-message" id="error"></div>
					<!-- json response will be here -->

						<div class="form-group">
							<label for="Username">Username</label>
							<input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email"  />
							<span class="help-block" id="check-e"></span>
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control br-radius-zero" name="password" id="password" placeholder="Password" />
							<span class="help-block" id="check-e"></span>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-success" name="btn-login" id="btn-login">
								Log In
							</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

		<button type="button" class="btn btn-warning " data-toggle="modal" data-target="#register"><span class="glyphicon glyphicon-edit"></span>&nbsp;Register</button>

		<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="modalLabel" data-backdrop="false">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h2 class="modal-title text-center" id="modalLabel"><span class="glyphicon glyphicon-edit"></span>&nbsp;Register</h2>
					</div>
					<div class="modal-body">
						<form method="post" role="form" id="register-form" autocomplete="off">

							<?php
								// Load required JS file for validation in the footer
								$requiredJS2 = 'js/register.js';
							?>
							<!-- json response will be here -->
						<div id="errorDiv"></div>
						<!-- json response will be here -->

							<div class="form-group col-lg-4">
									<label for="Username">First Name</label>
									<input type="text" name="firstName" class="form-control br-radius-zero" id="firstName" placeholder="First Name" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-4">
									<label for="Username">Mid Name</label>
									<input type="text" name="midName" class="form-control br-radius-zero" id="midName" placeholder="Middle Name" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-4">
									<label for="Username">Sur Name</label>
									<input type="text" name="surName" class="form-control br-radius-zero" id="surName" placeholder="Sur Name" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-6">
									<label for="Username">Email</label>
									<input type="email" name="userEmail" class="form-control br-radius-zero" id="userEmail" placeholder="Email Address" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-4">
									<label for="Username">Address</label>
									<input type="number" name="userAddress" class="form-control br-radius-zero" id="userAddress" placeholder="Address" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-2">
									<label for="Username">Post Code</label>
									<input type="number" name="postCode" class="form-control br-radius-zero" id="postCode" placeholder="Post Code" />
									<span class="help-block" id="error"></span>
							</div>

							<div class="form-group col-lg-2">
									<label for="Username">Gender</label>
										<select class="form-control br-radius-zero" name="gender" id="gender">
											<option value=""> -- </option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
										</select>
									<span class="help-block" id="error"></span>
							</div>

							<div class="form-group col-lg-2">
									<label for="Username">Date of Birth</label>
									<input type="date" name="dateOfBirth" class="form-control br-radius-zero" id="dateOfBirth" placeholder="Date of Birth" />
									<span class="help-block" id="error"></span>
							</div>

							<div class="form-group col-lg-4">
									<label for="Username">Password</label>
									<input type="password" name="userPass" class="form-control br-radius-zero" id="userPass" placeholder="Password" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-4">
									<label for="Username">Confirm Password</label>
									<input type="password" name="confirmPass" class="form-control br-radius-zero" id="confirmPass" placeholder="Confirm Password" />
									<span class="help-block" id="error"></span>
							</div>
							<div class="form-group col-lg-12">
									<input type="checkbox" name="checkBox" id="checkBox" >&nbsp;<labe>I have read and accept the <a href="terms.php">Terms and Conditions</a></label>
									<span class="help-block" id="error"></span>
							</div>
							<div class="modal-footer">
								<div class="form-group col-lg-12">
									<button type="submit" class="btn btn-success" id="btn-signup">
										Register
									</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	</nav>
