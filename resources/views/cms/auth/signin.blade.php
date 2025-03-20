<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{App::isLocale('en') ? 'en' : 'ar'}}" direction="{{App::isLocale('en') ? 'ltr' : 'rtl'}}"
	style="direction: {{App::isLocale('en') ? 'ltr' : 'rtl'}};">
<!--begin::Head-->

<head>
	<!-- <base href="../../../../"> -->
	<meta charset="utf-8" />
	<title> {{__('cms.login')}} | {{__('cms.app_name')}}</title>
	<meta name="description" content="{{__('cms.app_name')}}" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Custom Styles(used by this page)-->
	<link href="{{asset('assets/css/pages/login/login-4.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
	@if (App::isLocale('ar'))
	<link href="{{asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	@else
	{{-- {{dd('en');}} --}}
	<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endif
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->

	<link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="{{asset('app/images/logo.png')}}" />

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
			<!--begin::Content-->
			<div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
				<!--begin::Wrapper-->
				<div class="login-content d-flex flex-column pt-lg-0 pt-12">
					<!--begin::Logo-->
					<a href="#" class="login-logo pb-xl-20 pb-15">
						<img src="{{asset('assets/media/logos/logo-4.png')}}" class="max-h-70px" alt="" />
					</a>
					<!--end::Logo-->
					<!--begin::Signin-->
					<div class="login-form">
						<!--begin::Form-->
						<form class="form" id="kt_login_singin_form" action="">
							<!--begin::Title-->
							<div class="pb-5 pb-lg-15">
								<h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">{{__('cms.sign_in')}}</h3>
							</div>
							<!--begin::Title-->
							<!--begin::Form group-->
							<div class="form-group">
								<label class="font-size-h6 font-weight-bolder text-dark">{{__('cms.email')}}</label>
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="text" name="email" id="email" autocomplete="off" placeholder="{{__('cms.email')}}" />
							</div>
							<!--end::Form group-->
							<!--begin::Form group-->
							<div class="form-group">
								<div class="d-flex justify-content-between mt-n5">
									<label class="font-size-h6 font-weight-bolder text-dark pt-5">{{__('cms.password')}}</label>
									{{-- <a href="custom/pages/login/login-4/forgot.html" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">{{__('cms.sign_in_forget_password')}}</a> --}}
								</div>
								<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="password" name="password" id="password" placeholder="{{__('cms.password')}}" autocomplete="off" />
							</div>
							<!--end::Form group-->
							<div class="checkbox-inline">
								<label class="checkbox m-0 text-muted">
									<input type="checkbox" id="remember" name="remember" />
									<span></span>{{__('cms.sign_in_remember_me')}}</label>
							</div>
							<!--begin::Action-->
							<div class="pb-lg-0 pb-5">
								<button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3" onclick="login()">{{__('cms.sign_in')}}</button>
							</div>
							<!--end::Action-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Signin-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--begin::Content-->
			<!--begin::Aside-->
			<div class="login-aside order-1 order-lg-2 bgi-no-repeat bgi-position-x-right">

				<div class="login-conteiner bgi-no-repeat bgi-position-x-right bgi-position-y-bottom" style="background-image: url({{asset('assets/media/svg/illustrations/login-visual-4.svg')}});">
					<!--begin::Aside title-->
					<h3 class="pt-lg-40 pl-lg-20 pb-lg-0 pl-10 py-20 m-0 d-flex justify-content-lg-start font-weight-boldest display5 display1-lg text-white">We Got
						<br />PharmaCare
						<br />Auth System
					</h3>
					<!--end::Aside title-->


					<div class="row p-10 w-100">
						<div class="col-3 bg-light-danger px-6 py-8 rounded-xl mb-7 m-5">
							<a href="{{route('cms.login','admin')}}" class="text-danger font-weight-bold font-size-h6 mt-2">
								<span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
											<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
								{{__('cms.admins')}}</a>
						</div>
						<div class="col-3 bg-light-danger px-6 py-8 rounded-xl mb-7 m-5">
							<a href="{{route('cms.login','employee')}}" class="text-danger font-weight-bold font-size-h6 mt-2">
								<span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
									<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24"></polygon>
											<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
											<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
										</g>
									</svg>
									<!--end::Svg Icon-->
								</span>
								{{__('cms.employees')}}</a>
						</div>
					</div>
				</div>

			</div>
			<!--end::Aside-->
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->
	<script>
		var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
	</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1400
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3699FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#E4E6EF",
						"dark": "#181C32"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1F0FF",
						"secondary": "#EBEDF3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#3F4254",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#EBEDF3",
					"gray-300": "#E4E6EF",
					"gray-400": "#D1D3E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#7E8299",
					"gray-700": "#5E6278",
					"gray-800": "#3F4254",
					"gray-900": "#181C32"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->
	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
	<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="{{asset('assets/js/pages/custom/login/login-4.js')}}"></script>
	<script src="{{asset('assets/js/pages/features/miscellaneous/toastr.js')}}">
	</script>
	<script src="{{asset('js/axios.js')}}"></script>
	<script>
		function login() {
			let data = {
				email: document.getElementById('email').value,
				password: document.getElementById('password').value,
				remember: document.getElementById('remember').checked,
			};

			axios.post('/login', data)
				.then(function(response) {
					console.log(response.data);
					window.location.href = '';
				})
				.catch(function(error) {
					console.log(error);
					toastr.error(error.response.data.message)
				});
		}
	</script>
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>