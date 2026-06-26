
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
     <meta charset="utf-8">
	
    <?php $this->load->view('title');?>
	<!-- <link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet"> -->

    <?php setting_css(LOGIN_CSS);?>

</head>

<body class="vh-100">
	<div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
				<div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
					<div class="login-form">
						<div class="text-center">
							<h3 class="title">Sign In</h3>
							<p>Sign in to your account</p>
						</div>
						<form  action="<?php echo base_url('login/loginSubmit')?>" method="POST">
							<div class="mb-4">
								<label class="mb-1 text-dark">Email</label>
								<input type="text" class="form-control" name="email" placeholder="Email" required="" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>">
							</div>
							<div class="mb-4 position-relative">
								<label class="mb-1 text-dark">Password</label>
								<input type="password" class="form-control" name="password" placeholder="Password" required="" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>">
								<span class="show-pass eye">
									<i class="fa fa-eye-slash"></i>
									<i class="fa fa-eye"></i>
								</span>
							</div>
							<div class="form-row d-flex justify-content-between mt-4 mb-2">
								<div class="mb-4">
									<div class="form-check custom-checkbox mb-3">
                                    <input id="customCheckBox1" type="checkbox" <?php if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){echo "checked='checked'"; } ?> value="1" name="remember_me" class="form-check-input">
										<!-- <input type="checkbox" class="form-check-input" id="customCheckBox1" > -->
										<label class="form-check-label mt-1" for="customCheckBox1">Remember my preference</label>
									</div>
								</div>
								<!-- <div class="mb-4">
									<a href="page-forgot-password.html" class="btn-link text-primary">Forgot Password?</a>
								</div> -->
							</div>
							<div class="text-center mb-4">
								<button type="submit" class="btn btn-primary light btn-block">Sign In</button>
							</div>
							<!-- <h6 class="login-title"><span>Or continue with</span></h6>
							
							<div class="mb-3">
								<ul class="d-flex align-self-center justify-content-center">
									<li><a target="_blank" href="https://www.facebook.com/" class="fab fa-facebook-f btn-facebook"></a></li>
									<li><a target="_blank" href="https://www.google.com/" class="fab fa-google-plus-g btn-google-plus mx-2"></a></li>
									<li><a target="_blank" href="https://www.linkedin.com/" class="fab fa-linkedin-in btn-linkedin me-2"></a></li>
									<li><a target="_blank" href="https://twitter.com/" class="fab fa-twitter btn-twitter"></a></li>
								</ul>
							</div>
							<p class="text-center">Not registered?  
								<a class="btn-link text-primary" href="page-register.html">Register</a>
							</p> -->
						</form>
					</div>
				</div>
				<?php 
								// print_r(setting_all('upload_logo'));die;
						$logo =  (setting_all('upload_logo'))?setting_all('upload_logo'):'assets/images/main_logo.svg'; 
						$darklogo =  (setting_all('darklogo'))?setting_all('darklogo'):'dark-logo.png'; 
					?>
                <div class="col-xl-6 col-lg-6">
					<div class="pages-left h-100">
						<div class="login-content">
							<a href="javascript:;"><img src="<?php echo base_url().$logo; ?>" class="mb-3" alt=""></a>
							
							<!-- <p>Your true value is determined by how much more you give in value than you take in payment. ...</p> -->
						</div>
						<div class="login-media text-center">
							<img src="<?php echo base_url("assets/");?>images/login.png" alt="">
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

<!-- <script src="./vendor/global/global.min.js"></script>
<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/deznav-init.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/demo.js"></script> -->

<?php setting_js(DASHBOARD_JS);?>

</body>
</html>