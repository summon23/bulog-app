<?php $assetpath = base_url()."themes/metronic/";?>
<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title><?php echo APPNAME;?> - Login</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

		<!--end::Web font -->

		<!--begin:: Global Mandatory Vendors -->
		<link href="<?php echo $assetpath?>/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<link href="<?php echo $assetpath?>/vendors/tether/dist/css/tether.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/animate.css/animate.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/morris.js/morris.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/vendors/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/vendors/flaticon/css/flaticon.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/vendors/metronic/css/styles.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $assetpath?>/vendors/vendors/fontawesome5/css/all.min.css" rel="stylesheet" type="text/css" />

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Styles -->
		<link href="<?php echo $assetpath?>/demo/base/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="<?php echo $assetpath?>/demo/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="<?php echo $assetpath?>/demo/media/img/logo/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<br><br>
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(<?php echo $assetpath;?>app/media/img//bg/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img style="max-width:100%;" src="<?php echo base_url()."themes/app/"?>logo.jpeg">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<!-- <h3 class="m-login__title">Sign In</h3> -->
							</div>
							<form class="m-login__form m-form" action="<?php echo base_url();?>auth/doAuth" method="POST">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="username" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								<!-- <div class="row m-login__form-sub">
									<div class="col m--align-left m-login__form-left">
										<label class="m-checkbox  m-checkbox--focus">
											<input type="checkbox" name="remember"> Remember me
											<span></span>
										</label>
									</div>
									<div class="col m--align-right m-login__form-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">Forget Password ?</a>
									</div>
								</div> -->
								<?php if($this->session->flashdata('warning') != '') :?>
									<div class="form-group m-form__group" style="margin-top:20px;">
										<center>
											<span class="m-badge m-badge--warning m-badge--wide m-badge--rounded" style="font-size: 12px;background-color: #ffb822;"><?php echo $this->session->flashdata('warning');?></span>
										</center>
									</div>
								<?php endif;?>

								<div class="m-login__form-action">
									<button  type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">Sign In</button>
								</div>
							</form>
						</div>
						<div class="m-login__signup" style="display:none;">
							<div class="m-login__head">
								<h3 class="m-login__title">Sign Up</h3>
								<div class="m-login__desc">Enter your details to create your account:</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="password" placeholder="Password" name="password">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
								</div>
								<div class="row form-group m-form__group m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--focus">
											<input type="checkbox" name="agree">I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
											<span></span>
										</label>
										<span class="m-form__help"></span>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">Sign Up</button>&nbsp;&nbsp;
									<button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">Cancel</button>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">Forgotten Password ?</h3>
								<div class="m-login__desc">Enter your email to reset your password:</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primaryr">Request</button>&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">Cancel</button>
								</div>
							</form>
						</div>
						<div class="m-login__account" style="display:none;">
							<span class="m-login__account-msg">
								Don't have an account yet ?
							</span>&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">Sign Up</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!--begin:: Global Mandatory Vendors -->
		<script src="<?php echo $assetpath?>vendors/jquery/dist/jquery.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/popper.js/dist/umd/popper.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js-cookie/src/js.cookie.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/moment/min/moment.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/wnumb/wNumb.js" type="text/javascript"></script>

		<!--end:: Global Mandatory Vendors -->

		<!--begin:: Global Optional Vendors -->
		<script src="<?php echo $assetpath?>vendors/jquery.repeater/src/lib.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/jquery.repeater/src/repeater.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/block-ui/jquery.blockUI.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/forms/bootstrap-datepicker.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/forms/bootstrap-timepicker.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/forms/bootstrap-switch.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/select2/dist/js/select2.full.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/handlebars/dist/handlebars.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/inputmask/dist/inputmask/inputmask.phone.extensions.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/nouislider/distribute/nouislider.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/autosize/dist/autosize.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/dropzone/dist/dropzone.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/summernote/dist/summernote.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/markdown/lib/markdown.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/forms/bootstrap-markdown.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/forms/jquery-validation.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/base/bootstrap-notify.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/toastr/build/toastr.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/jstree/dist/jstree.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/raphael/raphael.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/morris.js/morris.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/chartist/dist/chartist.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/charts/chart.init.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/counterup/jquery.counterup.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
		<script src="<?php echo $assetpath?>vendors/js/framework/components/plugins/base/sweetalert2.init.js" type="text/javascript"></script>

		<!--end:: Global Optional Vendors -->

		<!--begin::Global Theme Bundle -->
		<script src="<?php echo $assetpath?>demo/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="<?php echo $assetpath?>snippets/custom/pages/user/login.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
	</body>

	<!-- end::Body -->
</html>