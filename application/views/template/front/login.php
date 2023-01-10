    
    <body class="account-page">
        <div class="main-wrapper">
            <div class="account-content">
                <div class="container">
                    <div class="account-box">
                        <div class="account-wrapper">
							<div class="account-logo">
								<a href="<?=base_url()?>"><img src="<?= ($organisation_settings->oraganisation_logo)?$organisation_settings->oraganisation_logo:'assets/img/logo2.png' ?>" alt="" /></a>
							</div>
                            <h3 class="account-title">Login</h3>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <form id="userLogin" autocomplete="">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control" type="email" name="USER_EMAIL" required="true" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                     <input class="form-control" type="password" name="PASSWORD" required="true" />
                                    <div class="m-t-5">
                                        <a class="text-muted" href="forgotpassword.html">
                                            Forgot password?
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary account-btn" type="submit">Login</button>
                                </div>
                                <!--<div class="account-footer">
                                    <p>Don't have an account yet? <a href="register.html">Register</a></p>
                                </div>-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
