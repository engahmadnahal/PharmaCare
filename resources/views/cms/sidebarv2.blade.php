<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
        data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
            class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
            <!--begin:Menu item-->

            @foreach (RouteService::routes() as $secName => $routes)
                @foreach ($routes['route_group'] as $k => $route)
                    @canany($route['permissions'])
                        <div data-kt-menu-trigger="click" class="menu-item  menu-accordion">
                            <!--begin:Menu link-->
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="fonticon-house fs-2"></i>
                                </span>
                                <span class="menu-title">{{ $route['groupTitle'] }}</span>
                                <span class="menu-arrow"></span>
                            </span>
                            @foreach ($route['routes'] as $route)
                                @can($route['permission'])
                                    <div class="menu-sub menu-sub-accordion">
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link-->
                                            <a class="menu-link activ" href="{{ $route['route'] }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ $route['title'] }}</span>
                                            </a>
                                            <!--end:Menu link-->
                                        </div>
                                    </div>
                                @endcan
                            @endforeach
                        </div>
                    @endcanany
                @endforeach
            @endforeach



        </div>

    </div>
    <!--end::Wrapper-->
</div>


{{-- @if (auth('admin')->check())
    <li class="menu-item" aria-haspopup="true">
        <a href="{{ route('cms.profile.personal-information') }}" class="menu-link">
            <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Edit.svg--><svg
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path
                            d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) " />
                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15"
                            height="2" rx="1" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-text">{{ __('cms.edit_profile') }}</span>
        </a>
    </li>
@endif --}}

{{-- @if (auth('studio')->check())
<li class="menu-item" aria-haspopup="true">
    <a href="{{ route('studios.show_services')}}" class="menu-link">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Shield-user.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path
                        d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                        fill="#000000" opacity="0.3" />
                    <path
                        d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z"
                        fill="#000000" opacity="0.3" />
                    <path
                        d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                        fill="#000000" opacity="0.3" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-text">{{ __('cms.serviceStudio') }}</span>
    </a>
</li>
@endif --}}

{{-- <li class="menu-item" aria-haspopup="true">
    <a href="{{ route('cms.logout') }}" class="menu-link">
        <span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Electric\Shutdown.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24" />
                    <path
                        d="M7.62302337,5.30262097 C8.08508802,5.000107 8.70490146,5.12944838 9.00741543,5.59151303 C9.3099294,6.05357769 9.18058801,6.67339112 8.71852336,6.97590509 C7.03468892,8.07831239 6,9.95030239 6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,9.99549229 17.0108275,8.15969002 15.3875704,7.04698597 C14.9320347,6.73472706 14.8158858,6.11230651 15.1281448,5.65677076 C15.4404037,5.20123501 16.0628242,5.08508618 16.51836,5.39734508 C18.6800181,6.87911023 20,9.32886071 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 C4,9.26852332 5.38056879,6.77075716 7.62302337,5.30262097 Z"
                        fill="#000000" fill-rule="nonzero" />
                    <rect fill="#000000" opacity="0.3" x="11" y="3" width="2"
                        height="10" rx="1" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-text">{{ __('cms.logout') }}</span>
    </a>
</li> --}}
