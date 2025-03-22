<?php

namespace App\Helpers;

class RouteService
{
    public static function routes()
    {
        return [
            "roles_permissions" => [
                'permission_group' => ['Read-Roles', 'Create-Role', 'Read-Permissions', 'Read-Employee-Role', 'Create-Employee-Role',],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.roles_permissions'),
                        'permissions' => ['Read-Roles', 'Create-Role', 'Read-Permissions', 'Read-Employee-Role', 'Create-Employee-Role',],
                        'routes' => [

                            // admin routes
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

                            ],

                            // employee routes
                            [
                                'title' => __('cms.roles'),
                                'route' => route('cms.employee.roles.index'),
                                'permission' => 'Read-Employee-Role',
                                'active' => request()->routeIs('cms.employee.roles.index'),
                            ],
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
                    'Read-User',
                    'Read-Pharma',
                    'Read-Employee',
                    'Read-Employee-User',
                    'Read-Employee-Employee',

                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.hr'),
                        'permissions' => [
                            'Read-Admins',
                            'Create-Admin',
                            'Read-Users',
                            'Create-User',
                            'Read-Employee-User',
                            'Read-Employee-Employee',
                        ],
                        'routes' => [

                            // admin routes
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

                            ],

                            // employee routes

                            // [
                            //     'title' => __('cms.users'),
                            //     'route' => route('cms.employee.users.index'),
                            //     'permission' => 'Read-Employee-User',
                            //     'active' => request()->routeIs('cms.employee.users.index'),

                            // ],

                            [
                                'title' => __('cms.employees'),
                                'route' => route('cms.employee.employees.index'),
                                'permission' => 'Read-Employee-Employee',
                                'active' => request()->routeIs('cms.employee.employees.index'),

                            ]
                        ],
                    ]
                ],
            ],


            "management" => [
                'permission_group' => [
                    'Read-Employee-Product',
                    'Create-Employee-Product',
                    'Read-Employee-Promocode',
                    'Create-Employee-Promocode',
                    'Read-Employee-Order',
                    'Create-Employee-Order',

                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.products'),
                        'permissions' => [
                            'Read-Employee-Product',
                            'Create-Employee-Product',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.products'),
                                'route' => route('cms.employee.products.index'),
                                'permission' => 'Read-Employee-Product',
                                'active' => request()->routeIs('cms.employee.products.index'),
                            ],

                        ],
                    ],

                    [
                        'groupTitle' => __('cms.promocodes'),
                        'permissions' => [
                            'Read-Employee-Coupon',
                            'Create-Employee-Coupon',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.promocodes'),
                                'route' => route('cms.employee.coupons.index'),
                                'permission' => 'Read-Employee-Coupon',
                                'active' => request()->routeIs('cms.employee.coupons.index'),
                            ],

                        ],
                    ],

                    [
                        'groupTitle' => __('cms.orders'),
                        'permissions' => [
                            'Read-Employee-Order',
                            'Create-Employee-Order',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.orders'),
                                'route' => route('cms.employee.orders.index'),
                                'permission' => 'Read-Employee-Order',
                                'active' => request()->routeIs('cms.employee.orders.index'),
                            ],

                        ],
                    ],

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



            "settings" => [
                'permission_group' => [
                    // 'Read-Countries',
                    // 'Create-Country',
                    // 'Update-Country',
                    // 'Delete-Country',
                    // 'Read-Cities',
                    // 'Create-City',
                    // 'Update-City',
                    // 'Delete-City',
                    // 'Read-Currency',
                    // 'Create-Currency'
                ],
                'route_group' => [


                    // [
                    //     'groupTitle' => __('cms.currency'),
                    //     'permissions' => [
                    //         'Read-Currency',
                    //         'Create-Currency',
                    //     ],
                    //     'routes' => [
                    //         [
                    //             'title' => __('cms.index'),
                    //             'route' => route('currencies.index'),
                    //             'permission' => 'Read-Currency',
                    //             'active' => request()->routeIs('currencies.index'),

                    //         ],

                    //     ],
                    // ],

                    // [
                    //     'groupTitle' => __('cms.countries'),
                    //     'permissions' => [
                    //         'Read-Countries',
                    //         'Create-Country',
                    //     ],
                    //     'routes' => [
                    //         [
                    //             'title' => __('cms.index'),
                    //             'route' => route('countries.index'),
                    //             'permission' => 'Read-Countries',
                    //             'active' => request()->routeIs('countries.index'),

                    //         ],

                    //     ],
                    // ],

                    // [
                    //     'groupTitle' => __('cms.cities'),
                    //     'permissions' => [
                    //         'Read-Cities',
                    //         'Create-City',
                    //     ],
                    //     'routes' => [
                    //         [
                    //             'title' => __('cms.index'),
                    //             'route' => route('cities.index'),
                    //             'permission' => 'Read-Cities',
                    //             'active' => request()->routeIs('cities.index'),

                    //         ],

                    //     ],
                    // ],

                    // [
                    //     'groupTitle' => __('cms.regions'),
                    //     'permissions' => [
                    //         'Read-Regions',
                    //         'Create-Region',
                    //     ],
                    //     'routes' => [
                    //         [
                    //             'title' => __('cms.index'),
                    //             'route' => route('regions.index'),
                    //             'permission' => 'Read-Regions',
                    //             'active' => request()->routeIs('regions.index'),

                    //         ],

                    //     ],
                    // ],

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
