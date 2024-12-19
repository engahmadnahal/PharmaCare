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
                    'Read-Admins', 'Create-Admin', 'Read-Users', 'Create-User', 'Read-Studio', 'Create-Studio',
                    'Read-StudioBranch', 'Create-StudioBranch', 'Create-Delivary', 'Read-Delivary','Read-User'
                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.hr'),
                        'permissions' => [
                            'Read-Admins', 'Create-Admin', 'Read-Users', 'Create-User', 'Read-Studio', 'Create-Studio',
                            'Read-StudioBranch', 'Create-StudioBranch', 'Create-Delivary', 'Read-Delivary'
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.admins'),
                                'route' => route('admins.index'),
                                'permission' => 'Read-Admins',
                                'active' => request()->routeIs('admins.index'),

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

            "notifications" => [
                'permission_group' => ['Read-FCM', 'Create-FCM'],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.notifications_FCM'),
                        'permissions' => ['Read-FCM', 'Create-FCM'],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('notification_fcm_users.index'),
                                'permission' => 'Read-FCM',
                                'active' => request()->routeIs('notification_fcm_users.index'),

                            ],
                            [
                                'title' => __('cms.create'),
                                'route' => route('notification_fcm_users.create'),
                                'permission' => 'Create-FCM',
                                'active' => request()->routeIs('notification_fcm_users.create'),
                            ],

                        ],
                    ]

                ],
            ],

            "order" => [
                'permission_group' => [
                    'Read-OrderSoftcopy', 'Create-OrderSoftcopy',
                    'Read-Order', 'Create-Order', 'Read-ServicesBookinStudio',
                    'Read-Users' , 'Update-User'
                ],
                'route_group' => [
                    [
                        'groupTitle' => __('cms.order'),
                        'permissions' => [
                            'Read-OrderSoftcopy', 'Create-OrderSoftcopy',
                            'Read-Order', 'Create-Order', 'Read-ServicesBookinStudio'
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
                    'Read-Countries', 'Create-Country', 'Update-Country', 'Delete-Country', 'Read-Cities', 'Create-City',
                    'Update-City', 'Delete-City', 'Read-Payments', 'Create-Payment', 'Create-About', 'Read-About', 'Read-Currency',
                    'Create-Currency','Read-ServicesBookinStudio'
                ],
                'route_group' => [

                    [
                        'groupTitle' => __('cms.services_booking_studios'),
                        'permissions' => [
                            'Read-ServicesBookinStudio',
                        ],
                        'routes' => [
                            
                            
                    [
                        'title' => __('cms.index'),
                        'route' => route('services_booking_studios.services'),
                        'permission' => 'Read-ServicesBookinStudio',
                        'active' => request()->routeIs('services_booking_studios.services'),

                    ],

                        ],
                    ],

                    

                    [
                        'groupTitle' => __('cms.qs_general'),
                        'permissions' => [
                            'Read-QsOrder', 'Create-QsOrder',
                        ],
                        'routes' => [
                            
                            [
                                'title' => __('cms.qs_general'),
                                'route' => route('qs_general_orders.index'),
                                'permission' => 'Read-QsOrder',
                                'active' => request()->routeIs('qs_general_orders.index'),

                            ],

                            [
                                'title' => __('cms.qs_date_order'),
                                'route' => route('qs_date_orders.index'),
                                'permission' => 'Read-QsOrder',
                                'active' => request()->routeIs('qs_date_orders.index'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.order_status'),
                        'permissions' => [
                            'Read-QsOrder', 'Create-QsOrder',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('order_statuses.index'),
                                'permission' => 'Read-QsOrder',
                                'active' => request()->routeIs('order_statuses.index'),

                            ],

                            [
                                'title' => __('cms.create'),
                                'route' => route('order_statuses.create'),
                                'permission' => 'Read-QsOrder',
                                'active' => request()->routeIs('order_statuses.create'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.aboutus'),
                        'permissions' => [
                            'Read-About', 'Create-About',
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
                        'groupTitle' => __('cms.term'),
                        'permissions' => [
                            'Read-Term', 'Create-Term',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('term_users.index'),
                                'permission' => 'Read-Term',
                                'active' => request()->routeIs('term_users.index'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.privacy'),
                        'permissions' => [
                            'Read-Privacy', 'Create-Privacy',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('privecies.index'),
                                'permission' => 'Read-Privacy',
                                'active' => request()->routeIs('privecies.index'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.faqs'),
                        'permissions' => [
                            'Read-FAQs', 'Create-FAQs',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('faqs.index'),
                                'permission' => 'Read-FAQs',
                                'active' => request()->routeIs('faqs.index'),

                            ],

                        ],
                    ],


                    [
                        'groupTitle' => __('cms.payments'),
                        'permissions' => [
                            'Read-Payments', 'Create-Payment',
                        ],
                        'routes' => [
                            [
                                'title' => __('cms.index'),
                                'route' => route('payment_gat_ways.index'),
                                'permission' => 'Read-Payments',
                                'active' => request()->routeIs('payment_gat_ways.index'),

                            ],

                        ],
                    ],



                    [
                        'groupTitle' => __('cms.currency'),
                        'permissions' => [
                            'Read-Currency', 'Create-Currency',
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
                            'Read-Countries', 'Create-Country',
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
                            'Read-Cities', 'Create-City',
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
                            'Read-Regions', 'Create-Region',
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
                            'Read-Setting', 'Create-Setting',
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
