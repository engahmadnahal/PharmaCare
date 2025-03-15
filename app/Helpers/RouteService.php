<?php

namespace App\Helpers;

class RouteService
{
    public static function routes()
    {
        return [
            "roles_permissions" => [
                'permission_group' => ['Read-Roles', 'Create-Role', 'Read-Permissions'],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.roles_permissions'),
                        'permissions' => ['Read-Roles', 'Create-Role', 'Read-Permissions'],
                        'routes' => [
                            [
                                'title' => __('cms.roles'),
                                'route' => route('roles.index'),
                                'permission' => 'Read-Roles',
                                'active' => request()->routeIs('roles.index'),
                            ],
                            [
                                'title' => __('cms.permissions'),
                                'route' => route('permissions.index'),
                                'permission' => 'Read-Permissions',
                                'active' => request()->routeIs('permissions.index'),

                            ]
                        ],
                    ]

                ],
            ],


            "hr" => [
                'permission_group' => [
                    'Read-Admins',
                    'Create-Admin',
                    'Read-Users',
                    'Create-User',
                    'Read-Studio',
                    'Create-Studio',
                    'Read-StudioBranch',
                    'Create-StudioBranch',
                    'Create-Delivary',
                    'Read-Delivary',
                    'Read-User'
                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.hr'),
                        'permissions' => [
                            'Read-Admins',
                            'Create-Admin',
                            'Read-Users',
                            'Create-User',
                            'Read-Studio',
                            'Create-Studio',
                            'Read-StudioBranch',
                            'Create-StudioBranch',
                            'Create-Delivary',
                            'Read-Delivary'
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.admins'),
                                'route' => route('admins.index'),
                                'permission' => 'Read-Admins',
                                'active' => request()->routeIs('admins.index'),

                            ],
                            [
                                'title' => __('cms.employees'),
                                'route' => route('employees.index'),
                                'permission' => 'Read-Employee',
                                'active' => request()->routeIs('employees.index'),

                            ],
                            [
                                'title' => __('cms.pharmaceutical'),
                                'route' => route('pharmaceuticals.index'),
                                'permission' => 'Read-Pharma',
                                'active' => request()->routeIs('pharmaceuticals.index'),

                            ],

                            [
                                'title' => __('cms.users'),
                                'route' => route('users.index'),
                                'permission' => 'Read-User',
                                'active' => request()->routeIs('users.index'),

                            ]
                        ],
                    ]
                ],
            ],


            "categories" => [
                'permission_group' => [
                    'Read-Category',
                    'Create-Category',
                    'Read-Category',
                    'Create-Category',
                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.categories'),
                        'permissions' => [
                            'Read-Category',
                            'Create-Category',
                            'Update-Category',
                            'Delete-Category',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.categories'),
                                'route' => route('categories.index'),
                                'permission' => 'Read-Category',
                                'active' => request()->routeIs('categories.index'),
                            ],

                            [
                                'title' => __('cms.medicine_types'),
                                'route' => route('medicine-types.index'),
                                'permission' => 'Read-Category',
                                'active' => request()->routeIs('medicine-types.index'),
                            ],
                            


                        ],
                    ],

                ],
            ],


            "order" => [
                'permission_group' => [
                    'Read-OrderSoftcopy',
                    'Create-OrderSoftcopy',
                    'Read-Order',
                    'Create-Order',
                    'Read-ServicesBookinStudio',
                    'Read-Users',
                    'Update-User'
                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.order'),
                        'permissions' => [
                            'Read-OrderSoftcopy',
                            'Create-OrderSoftcopy',
                            'Read-Order',
                            'Create-Order',
                            'Read-ServicesBookinStudio'
                        ],
                        'routes' => [
                            // [
                            //     'title' => __('cms.delete_account_request'),
                            //     'route' => route('delete_account_users.index'),
                            //     'permission' => 'Read-Users',
                            //     'active' => request()->routeIs('delete_account_users.index'),

                            // ],


                        ],
                    ],



                ],
            ],


            "settings" => [
                'permission_group' => [
                    'Read-Countries',
                    'Create-Country',
                    'Update-Country',
                    'Delete-Country',
                    'Read-Cities',
                    'Create-City',
                    'Update-City',
                    'Delete-City',
                    'Create-About',
                    'Read-About',
                    'Read-Currency',
                    'Create-Currency'
                ],
                'route_group' => [

                    [
                        'groupTitle' => __('cms.aboutus'),
                        'permissions' => [
                            'Read-About',
                            'Create-About',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('about_us.index'),
                                'permission' => 'Read-About',
                                'active' => request()->routeIs('about_us.index'),

                            ],

                        ],
                    ],



                    [
                        'groupTitle' => __('cms.currency'),
                        'permissions' => [
                            'Read-Currency',
                            'Create-Currency',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('currencies.index'),
                                'permission' => 'Read-Currency',
                                'active' => request()->routeIs('currencies.index'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.countries'),
                        'permissions' => [
                            'Read-Countries',
                            'Create-Country',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('countries.index'),
                                'permission' => 'Read-Countries',
                                'active' => request()->routeIs('countries.index'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.cities'),
                        'permissions' => [
                            'Read-Cities',
                            'Create-City',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('cities.index'),
                                'permission' => 'Read-Cities',
                                'active' => request()->routeIs('cities.index'),

                            ],

                        ],
                    ],

                    [
                        'groupTitle' => __('cms.regions'),
                        'permissions' => [
                            'Read-Regions',
                            'Create-Region',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('regions.index'),
                                'permission' => 'Read-Regions',
                                'active' => request()->routeIs('regions.index'),

                            ],

                        ],
                    ],

                    [
                        'groupTitle' => __('cms.settings'),
                        'permissions' => [
                            'Read-Setting',
                            'Create-Setting',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('settings.index'),
                                'permission' => 'Read-Setting',
                                'active' => request()->routeIs('settings.index'),

                            ],

                        ],
                    ],


                ],
            ],

        ];
    }
}
