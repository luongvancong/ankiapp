<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 24/06/18
 * Time: 12:21
 */

return [
    "setting" => [
        'title' => 'Cấu hình',
        'icon' => 'fa fa-cog',
        'pattern_active' => 'admin/settings*', // Biểu thức xác định trạng thái menu sidebar active
        'permission' => ['setting:view'],
        'active' => 1,
        'order' => 11000,
        'items' => [
            [
                'title' => 'Thông tin website',
                'url' => '/admin/settings/website',
                'pattern_active' => 'admin/settings/website'

            ],
            [
                'title' => 'Metadata',
                'url' => '/admin/settings/metadata',
                'pattern_active' => 'admin/settings/metadata'
            ],
            [
                'title' => 'Mạng xã hội',
                'url' => '/admin/settings/social',
                'pattern_active' => 'admin/settings/social'
            ]
        ]
    ],
    "user" => [
        'title' => 'User',
        'url' => '/admin/users',
        'icon' => 'fa fa-users',
        'pattern_active' => 'admin/users*',
        'permission' => ['user:view'],
        'active' => 1,
        'order' => 10000,
        'role' => [],
        'items' => [
            [
                'title' => 'Users',
                'url' => '/admin/users',
                'pattern_active' => 'admin/users'
            ],
            [
                'title' => 'Permission',
                'url' => '/admin/users/permissions',
                'pattern_active' => 'admin/users/permissions*'
            ]
        ]
    ],
    "banner" => [
        'title' => 'Banner',
        'active' => 1,
        'url' => '/admin/banners',
        'icon' => 'fa fa-file-image-o',
        'pattern_active' => 'admin/banners',
        'order' => 10000,
        'permission' => ['banner:view'],
        'role' => []
    ],
    "feedback" => [
        'title' => 'Testimonial',
        'active' => 1,
        'url' => '/admin/testimonial/index',
        'icon' => 'fa fa-file-image-o',
        'pattern_active' => 'admin/testimonial*',
        'order' => 0,
        'permission' => ['testimonial:view'],
        'role' => []
    ],
    "menu" => [
        'title' => 'Menu',
        'active' => 1,
        'url' => '/admin/menu',
        'icon' => 'fa fa-leaf',
        'pattern_active' => 'admin/menu*',
        'order' => 10000,
        'permission' => ['menu:view'],
        'role' => [],
        'items' => [
            [
                'title' => 'Danh sách',
                'active' => 1,
                'url' => '/admin/menu',
                'pattern_active' => 'admin/menu'
            ],
            [
                'title' => 'Thiết kế',
                'active' => 1,
                'url' => '/admin/menu/design',
                'pattern_active' => 'admin/menu/design'
            ]
        ]
    ],
    "page" => [
        'title' => 'Trang tĩnh',
        'active' => 1,
        'url' => '/admin/page',
        'pattern_active' => 'admin/page*',
        'icon' => 'fa fa-newspaper-o',
        'order' => 10000,
        'permission' => ['page:view']
    ],
    "post" => [
        'title' => 'Tin tức',
        'active' => 1,
        'url' => '/admin/post/index',
        'pattern_active' => 'admin/post*',
        'icon' => 'fa fa-newspaper-o',
        'order' => 10000,
        'permission' => ['post:view'],
        'items' => [
            [
                'title' => 'Tin tức',
                'url' => '/admin/post/index',
                'pattern_active' => 'admin/post/*'
            ],
            [
                'title' => 'Danh mục',
                'url' => '/admin/post-category/index',
                'pattern_active' => 'admin/post-category*'
            ]
        ]
    ],
    "product" => [
        'title' => 'Product',
        'active' => 1,
        'url' => '/admin/product',
        'icon' => 'fa fa-product-hunt',
        'pattern_active' => 'admin/product*',
        'order' => 10000,
        'permission' => ['product:view'],
        'role' => [],

        'items' => [
            [
                'title' => 'Product',
                'active' => 1,
                'url' => '/admin/product',
                'pattern_active' => 'admin/product*'
            ],
            [
                'title' => 'Category',
                'active' => 1,
                'url' => '/admin/product-category/index',
                'pattern_active' => 'admin/product-category*'
            ]
        ]
    ],
    "qa" => [
        'title' => 'Hỏi đáp',
        'active' => 1,
        'url' => '/admin/qa',
        'icon' => 'fa fa-question-circle-o',
        'pattern_active' => 'admin/qa',
        'order' => 10000,
        'permission' => ['qa:view'],
        'role' => []
    ],
    "resource" => [
        'title' => 'Tài nguyên',
        'active' => 1,
        'url' => '/admin/resource',
        'pattern_active' => 'admin/resource*',
        'icon' => 'fa fa-database',
        'order' => 10000,
        'permission' => ['resource:view']
    ],
    "tag" => [
        'title' => 'Tag',
        'active' => 1,
        'url' => '/admin/tag',
        'icon' => 'fa fa-tag',
        'pattern_active' => 'admin/tag',
        'order' => 10000,
        'permission' => ['tag:view'],
        'role' => []
    ]
];