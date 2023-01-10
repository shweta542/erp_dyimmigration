	
<body class="account-page">
	<div class="main-wrapper">
		<div class="account-content">
			<div class="container">
				<div class="account-logo">
					<a href="javascript:void(0)"><img src="assets/img/logoo2.png" alt="" /></a>
				</div>

				<div class="account-box">
					<div class="account-wrapper">
						<h3 class="account-title">Forgot Password?</h3>
						<p class="account-subtitle">Enter your email to get a password reset link</p>

						<form id="forgotpassword_requset">
							<div class="form-group">
								<label>Email Address</label>
								<input class="form-control" type="email" name="email" required="true" />
							</div>
							<div class="form-group text-center">
								<button  class="btn btn-primary account-btn" type="submit">Reset Password</button>
							</div>
							<div class="account-footer">
								<p>Remember your password? <a href="<?= base_url() ?>">Login</a></p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</div>
   