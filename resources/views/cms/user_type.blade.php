<!DOCTYPE html>

<html lang="{{App::isLocale('en') ? 'en' : 'ar'}}" direction="{{App::isLocale('en') ? 'ltr' : 'rtl'}}"
	style="direction: {{App::isLocale('en') ? 'ltr' : 'rtl'}};">
<head>
	<meta charset="utf-8" />
	<title>{{__('cms.app_name')}} </title>
	<meta name="description" content="{{__('cms.app_name')}} CMS" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="#" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
		type="text/css" />
	<!--end::Page Vendors Styles-->
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
	<link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{asset('assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
			<!--end::Global Stylesheets Bundle-->
		</head>
		<!--end::Head-->
		<!--begin::Body-->
		<body id="kt_body" class="bg-body">
			<!--begin::Main-->
			<!--begin::Root-->
			<div class="d-flex flex-column flex-root">
				<!--begin::Authentication - Two-stes -->
				<div class="d-flex flex-column flex-lg-row flex-column-fluid">
					<!--begin::Aside-->
					<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
						<!--begin::Wrapper-->
						<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
							<!--begin::Content-->
							<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
								<!--begin::Logo-->
								<a href="../../demo1/dist/index.html" class="py-9 mb-5">
									<img alt="Logo" src="{{asset('assets/media/logos/logo-1.png')}}" class="h-60px" />
								</a>
								<!--end::Logo-->
								<!--begin::Title-->
								<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to Metronic</h1>
								<!--end::Title-->
								<!--begin::Description-->
								<p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Metronic
								<br />with great build tools</p>
								<!--end::Description-->
							</div>
							<!--end::Content-->
							<!--begin::Illustration-->
							<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{asset('assets/media/illustrations/sketchy-1/13.png')}})"></div>
							<!--end::Illustration-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Aside-->
					<!--begin::Body-->
					<div class="d-flex flex-column flex-lg-row-fluid py-10">
						<!--begin::Content-->
						<div class="d-flex flex-center flex-column flex-column-fluid">
							<!--begin::Wrapper-->
							<div class="row w-75" style="
							font-size: 16px;
							font-weight: bold;
						">
								
								


								<div class="col-xl-4">
									<!--begin::Statistics Widget 5-->
									<a href="/cms/admin/login" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
											<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"/>
													<path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"/>
													<path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"/>
													</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-white fw-bolder fs-2 mb-2 mt-5">{{__('cms.admins')}}</div>
											<div class="fw-bold text-white"></div>

										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>


								<div class="col-xl-4">
									<!--begin::Statistics Widget 5-->
									<a href="/cms/studio/login" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
											<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"/>
													<path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"/>
													<path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"/>
													</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-white fw-bolder fs-2 mb-2 mt-5">{{__('cms.owner_studio')}}</div>
											<div class="fw-bold text-white"></div>
											
										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>

								<div class="col-xl-4">
									<!--begin::Statistics Widget 5-->
									<a href="/cms/studiobranch/login" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
										<!--begin::Body-->
										<div class="card-body">
											<!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
											<span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"/>
													<path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"/>
													<path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"/>
													</svg>
											</span>
											<!--end::Svg Icon-->
											<div class="text-white fw-bolder fs-2 mb-2 mt-5">{{__('cms.studio')}}</div>
											<div class="fw-bold text-white"></div>
										</div>
										<!--end::Body-->
									</a>
									<!--end::Statistics Widget 5-->
								</div>
								
							</div>
							<!--end::Wrapper-->
						</div>
						<!--end::Content-->
						<!--begin::Footer-->
						
						<!--end::Footer-->
					</div>
					<!--end::Body-->
				</div>
				<!--end::Authentication - Two-stes-->
			</div>
			<!--end::Root-->
			<!--end::Main-->
			<!--begin::Javascript-->
			<script>var hostUrl = "assets/";</script>
			<!--begin::Global Javascript Bundle(used by all pages)-->
			<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
			<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
			<!--end::Global Javascript Bundle-->
			<!--begin::Page Custom Javascript(used by this page)-->
			<!--end::Page Custom Javascript-->
			<!--end::Javascript-->
		</body>
		<!--end::Body-->
	</html>