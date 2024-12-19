@foreach (RouteService::routes() as $secName => $routes)

    @canany($routes['permission_group'])
    <li class="menu-section">
        <h4 class="menu-text">{{ __("cms.{$secName}") }}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    @endcanany
    @foreach ($routes['route_group'] as $k => $route)
        @canany($route['permissions'])

        @php
            foreach($route['routes'] as $r){
                $isActive = $r['active'];
                if($isActive) break;
            }
        @endphp
        
            <li class="menu-item menu-item-submenu {{$isActive ? 'menu-item-open' : ''}}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path
                                    d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                    fill="#000000" fill-rule="nonzero" />
                                <path
                                    d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>

                    <span class="menu-text">{{ $route['groupTitle'] }}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav ">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">{{ $route['groupTitle'] }}</span>
                            </span>
                        </li>
                        @foreach ($route['routes'] as $route)
                            @can($route['permission'])
                                <li class="menu-item {{$route['active'] ? 'menu-item-active' : ''}}" aria-haspopup="true">
                                    <a href="{{ $route['route'] }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">{{ $route['title'] }}</span>
                                    </a>
                                </li>
                            @endcan
                        @endforeach
                    </ul>
                </div>
            </li>
        @endcanany
    @endforeach
@endforeach


{{-- @canany(['Read-Roles', 'Create-Role', 'Read-Permissions'])
    <li class="menu-section">
        <h4 class="menu-text">{{ __('cms.roles_permissions') }}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>
    @canany(['Read-Roles', 'Create-Role'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Shield-thunder.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path
                                d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                fill="#000000" opacity="0.3" />
                            <polygon fill="#000000" opacity="0.3"
                                points="11.3333333 18 16 11.4 13.6666667 11.4 13.6666667 7 9 13.6 11.3333333 13.6" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-text">{{ __('cms.roles') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.roles') }}</span>
                        </span>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('roles.create') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.create') }}</span>
                        </a>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.index') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcanany
    @canany(['Read-Permissions'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\legacy\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Clipboard.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path
                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                fill="#000000" opacity="0.3" />
                            <path
                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                fill="#000000" />
                            <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2"
                                rx="1" />
                            <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2"
                                rx="1" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                <span class="menu-text">{{ __('cms.permissions') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.permissions') }}</span>
                        </span>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('permissions.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.index') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcanany
@endcanany --}}


{{-- @canany(['Read-Admins', 'Create-Admin', 'Read-Users', 'Create-User', 'Read-Studio', 'Create-Studio', 'Read-StudioBranch', 'Create-StudioBranch', 'Create-Delivary', 'Read-Delivary'])
    <li class="menu-section">
        <h4 class="menu-text">{{ __('cms.hr') }}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li>

    @canany(['Read-Admins', 'Create-Admin'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.admins') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.admins') }}</span>
                        </span>
                    </li>
                    @can('Create-Admin')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('admins.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Admins')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('admins.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany



    @canany(['Read-Studio', 'Create-Studio'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.studio') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.studio') }}</span>
                        </span>
                    </li>
                    @can('Create-Studio')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('studios.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Studio')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('studios.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany

    @canany(['Read-StudioBranch', 'Create-StudioBranch'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.sub_branch') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.sub_branch') }}</span>
                        </span>
                    </li>
                    @can('Create-StudioBranch')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('studio_branches.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-StudioBranch')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('studio_branches.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany


    @canany(['Read-Delivary', 'Create-Delivary'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.delivary') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.sub_branch') }}</span>
                        </span>
                    </li>
                    @can('Create-Delivary')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('delivaries.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Delivary')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('delivaries.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany
@endcanany --}}


{{-- @canany(['Read-Postcard', 'Create-Postcard', 'Read-Poster', 'Create-Poster', 'Read-Passport', 'Create-Passport',
    'Read-FrameAlbum', 'Create-FrameAlbum'])
    <li class="menu-section">
        <h4 class="menu-text">{{ __('cms.services') }}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li> --}}

    {{-- @canany(['Read-Postcard', 'Create-Postcard'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.postcard_services') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.postcard_services') }}</span>
                        </span>
                    </li>
                    @can('Create-Postcard')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('postcard_services.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Postcard')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('postcard_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Postcard')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('option_postcard_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.size_or_type') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Postcard')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('sub_option_postcard_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.package') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany

    @canany(['Read-Poster', 'Create-Poster'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.poster') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.poster') }}</span>
                        </span>
                    </li>
                    @can('Create-Poster')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('posterprint_services.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Poster')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('posterprint_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan



                    @can('Create-Poster')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('option_posterprint_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.size_or_type') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Read-Poster')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('packge_poster_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.package') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-Poster')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('sub_option_posterprint_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.options') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-Passport', 'Create-Passport'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.passport') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.passport') }}</span>
                        </span>
                    </li>
                    @can('Create-Passport')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('passport_services.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Passport')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('passport_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Create-Passport')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('passport_types.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.type') }}</span>
                            </a>
                        </li>
                    @endcan
                    
                    @can('Read-Passport')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('passport_options.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.options') }}</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        </li>
    @endcanany --}}


    {{-- @canany(['Read-BookingStudioService', 'Create-BookingStudioService'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.booking_studio') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.booking_studio') }}</span>
                        </span>
                    </li>
                    
                    @can('Read-BookingStudioService')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('booking_studio_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>


                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('services_booking_studios.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.serviceStudio') }}</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        </li>
    @endcanany --}}

    

    {{-- @canany(['Read-SoftCopyService', 'Create-SoftCopyService'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.softcopy') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.softcopy') }}</span>
                        </span>
                    </li>
                    @can('Create-SoftCopyService')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('soft_copy_services.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-SoftCopyService')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('soft_copy_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}


    {{-- @canany(['Read-FrameAlbum', 'Create-FrameAlbum'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.frameAlbum') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.frameAlbum') }}</span>
                        </span>
                    </li>
                    @can('Create-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('frame_album_services.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('frame_album_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('option_frame_album_services.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.type_frame_album') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('frames_or_albums.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.choices_frame_album') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('frames_sizes.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.frames_sizes') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('album_sizes.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.album_sizes') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('Create-FrameAlbum')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('qs_frames_albums.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.qs_booking') }}</span>
                            </a>
                        </li>
                    @endcan


                </ul>
            </div>
        </li>
    @endcanany --}}


{{-- @endcanany --}}


{{-- @canany(['AcceptStudio', 'Read-ServiceStudio', 'Create-ServiceStudio', 'Create-StoreHouse', 'Read-StoreHouse',
    'Create-Ads', 'Read-Ads'])
    <li class="menu-section">
        <h4 class="menu-text">{{ __('cms.content_management') }}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li> --}}
    {{-- @canany(['Read-ServiceStudio', 'Create-ServiceStudio'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.serviceStudio') }}</span>
                        </span>
                    </li>
                    @can('Create-ServiceStudio')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('service_studios.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-ServiceStudio')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('service_studios.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-StoreHouse', 'Create-StoreHouse'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.storehouse') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.storehouse') }}</span>
                        </span>
                    </li>
                    @can('Create-StoreHouse')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('store_houses.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-StoreHouse')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('store_houses.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-Products', 'Create-Product'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.products') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.products') }}</span>
                        </span>
                    </li>
                    @can('Create-Product')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('products.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Products')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('products.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['AcceptStudio'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.request_studio') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.request_studio') }}</span>
                        </span>
                    </li>
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('request-studio.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.index') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-Ads', 'Create-Ads'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.ads') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.ads') }}</span>
                        </span>
                    </li>
                    @can('Create-Ads')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('ads.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Ads')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('ads.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-PromoCode', 'Create-PromoCode'])
    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:;" class="menu-link menu-toggle">
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

            <span class="menu-text">{{ __('cms.PromoCode') }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">{{ __('cms.PromoCode') }}</span>
                    </span>
                </li>
                @can('Create-PromoCode')
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('promo_codes.create') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.create') }}</span>
                        </a>
                    </li>
                @endcan
                @can('Read-PromoCodes')
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('promo_codes.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.index') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcanany --}}

{{-- @endcanany --}}


{{-- @canany(['Read-BookingStudio', 'Create-BookingStudio'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.booking_studio') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.booking_studio') }}</span>
                        </span>
                    </li>
                    
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('services_booking_studios.services') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.services_booking_studios') }}</span>
                            </a>
                        </li>

                </ul>
            </div>
        </li>
    @endcanany --}}


{{-- @canany(['Read-Order', 'Create-Order'])
    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:;" class="menu-link menu-toggle">
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

            <span class="menu-text">{{ __('cms.orders') }}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">{{ __('cms.orders') }}</span>
                    </span>
                </li>

                @can('Read-Order')
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ route('order_studios.index') }}" class="menu-link">
                            <i class="menu-bullet menu-bullet-dot">
                                <span></span>
                            </i>
                            <span class="menu-text">{{ __('cms.index') }}</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcanany --}}

{{-- @canany(['Read-Countries', 'Create-Country', 'Update-Country', 'Delete-Country', 'Read-Cities', 'Create-City',
    'Update-City', 'Delete-City', 'Read-Payments', 'Create-Payment', 'Create-About', 'Read-About', 'Read-Currency',
    'Create-Currency'])
    <li class="menu-section">
        <h4 class="menu-text">{{ __('cms.settings') }}</h4>
        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
    </li> --}}

    {{-- @canany(['Read-QsOrder', 'Create-QsOrder'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.qs_order') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.qs_order') }}</span>
                        </span>
                    </li>
                    @can('Create-QsOrder')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('qs_general_orders.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.qs_general') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Create-QsOrder')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('qs_date_orders.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.qs_date_order') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-QsOrder', 'Create-QsOrder'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.order_status') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.order_status') }}</span>
                        </span>
                    </li>
                    @can('Create-QsOrder')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('order_statuses.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Create-QsOrder')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('order_statuses.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-About', 'Create-About'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.aboutus') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.aboutus') }}</span>
                        </span>
                    </li>
                    @can('Create-About')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('about_us.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-About')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('about_us.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-Term', 'Create-Term'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.term') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.term') }}</span>
                        </span>
                    </li>
                    @can('Create-Term')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('term_users.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Term')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('term_users.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}


    {{-- @canany(['Read-Privacy', 'Create-Privacy'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.privacy') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.privacy') }}</span>
                        </span>
                    </li>
                    @can('Create-Privacy')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('privecies.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Privacy')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('privecies.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-FAQs', 'Create-FAQ'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.faqs') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.faqs') }}</span>
                        </span>
                    </li>
                    @can('Create-FAQ')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('faqs.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-FAQs')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('faqs.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}


{{-- 
    @canany(['Read-Payments', 'Create-Payment'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.payments') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.payments') }}</span>
                        </span>
                    </li>
                    @can('Create-Payment')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('payment_gat_ways.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Payments')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('payment_gat_ways.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}


    {{-- @canany(['Read-Currency', 'Create-Currency'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.currency') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.currency') }}</span>
                        </span>
                    </li>
                    @can('Create-Currency')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('currencies.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Currency')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('currencies.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany

    @canany(['Read-Countries', 'Create-Country'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.countries') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.countries') }}</span>
                        </span>
                    </li>
                    @can('Create-Country')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('countries.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Countries')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('countries.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-Cities', 'Create-City'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.cities') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.cities') }}</span>
                        </span>
                    </li>
                    @can('Create-City')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('cities.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Cities')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('cities.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}

    {{-- @canany(['Read-Regions', 'Create-Region'])
        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
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

                <span class="menu-text">{{ __('cms.regions') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">{{ __('cms.regions') }}</span>
                        </span>
                    </li>
                    @can('Create-Region')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('regions.create') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.create') }}</span>
                            </a>
                        </li>
                    @endcan
                    @can('Read-Regions')
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{ route('regions.index') }}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">{{ __('cms.index') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany --}}
{{-- @endcanany --}}

@if (auth('admin')->check())
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
@endif

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

<li class="menu-item" aria-haspopup="true">
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
</li>
