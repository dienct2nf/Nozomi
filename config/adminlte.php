<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'Nozomi',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>Nozomi</b>',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image-xl',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Nozomi',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Extra Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#66-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#67-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#68-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => 'admin',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#69-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#610-menu
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => true,
            'topnav' => true,
        ],
        [
            'text' => 'BLOG',
            'url'  => 'admin/blog',
            'can'  => 'article-create',
        ],
        [
            'text'        => 'dashboard',
            'url'         => 'admin',
            'icon'        => 'fas fa-fw fa-tachometer-alt',
            'label_color' => 'success',
        ],
        [
            'header' => 'blog',
            'can'  => 'article-create',
        ],
        [
            'text' => 'add_article',
            'url' => 'admin/post/create',
            'icon' => 'fas fa-fw fa-plus-square'
        ],
        [
            'text' => 'add_product',
            'url' => 'admin/product/create',
            'icon' => 'fas fa-fw fa-file-upload'
        ],
        [
            'text' => 'add_category',
            'url' => 'admin/category/create',
            'icon' => 'fas fa-fw fa-folder-plus'
        ],
        [
            'text' => 'add_album',
            'url' => 'admin/album/create',
            'icon' => 'fas fa-fw fa-border-all'
        ],
        [
            'text' => 'my_site',
            'url' => '/',
            'target' => '_blank',
            'icon' => 'fab fa-fw fa-internet-explorer'
        ],
        [
            'header' => 'list',
            'can'  => 'article-create',
        ],
        [
            'text' => 'article',
            'url'  => 'admin/post',
            'icon' => 'fas fa-fw fa-newspaper',
            'active' => ['/admin/post', '/admin/post/*/edit', 'regex:@^/admin/post/[0-9]+$@']
        ],
        [
            'text' => 'product',
            'url'  => 'admin/product',
            'icon' => 'fas fa-fw fa-dice-d6',
        ],
        [
            'text' => 'customer',
            'url'  => 'admin/customer',
            'icon' => 'fas fa-fw fa-user-tag',
        ],
        [
            'text' => 'category',
            'url'  => 'admin/category',
            'icon' => 'fas fa-fw fa-folder-open',
        ],
        [
            'text' => 'Từ khóa',
            'url'  => 'admin/tag',
            'icon' => 'fas fa-fw fa-tags',
        ],

        [
            'text' => 'album',
            'url'  => 'admin/album',
            'icon' => 'fas fa-fw fa-address-book',
        ],
        [
            'text' => 'widget',
            'url'  => 'admin/widget/create',
            'icon' => 'fas fa-fw fa-text-width',
        ],
        [
            'text' => 'media',
            'url'  => 'admin/media',
            'icon' => 'fas fa-fw fa-camera-retro',
            'submenu' => [
                [
                    'text' => 'image',
                    'url'  => 'admin/media',
                    'icon_color' => 'info',
                    'active' => ['/admin/media*', 'regex:@^/admin/media/[0-9]+$@']
                ],
                [
                    'text' => 'file',
                    'url'  => '/admin/file',
                    'icon_color' => 'warning',
                    'active' => ['/admin/file*', 'regex:@^/admin/file/[0-9]+$@']
                ]
            ]
        ],
        ['header' => 'work'],
        [
            'text'  => 'creatework',
            'icon'  => 'fas fa-fw fa-plus',
            'url'   => '/admin/work/worklist/create',
            'can'  => 'work-show',
        ],
        [
            'text'  => 'workwe',
            'icon'  => 'fas fa-fw fa-hands-helping',
            'url'   => '/admin/work/worklist/todo/list',
            'target' => '_blank',
            'can'  => 'work-show',
        ],
        [
            'text'  => 'listwork',
            'icon'  => 'fas fa-fw fa-list',
            'url'   => '/admin/work/worklist',
            'can'  => 'work-show',
        ],
        [
            'text' => 'Công việc theo phòng',
            'url'  => '/admin/media',
            'icon' => 'fas fa-fw fa-building',
            'can'  => 'work-show',
            'submenu' => [
                [
                    'text' => 'Phòng Truyền Thông',
                    'url'  => '/admin/work/department/showlist/1',
                    'icon_color' => 'info',
                    'target' => '_blank',
                ],
                [
                    'text' => 'Phòng Tuyển Dụng',
                    'url'  => '/admin/work/department/showlist/5',
                    'icon_color' => 'warning',
                    'target' => '_blank',
                ],
                [
                    'text' => 'Phòng Tư Vấn',
                    'url'  => '/admin/work/department/showlist/3',
                    'icon_color' => 'info',
                    'target' => '_blank',
                ],
                [
                    'text' => 'Phòng Quản Sinh',
                    'url'  => '/admin/work/department/showlist/6',
                    'icon_color' => 'warning',
                    'target' => '_blank',
                ],
                [
                    'text' => 'Phòng Nghiệp Vụ',
                    'url'  => '/admin/work/department/showlist/2',
                    'icon_color' => 'info',
                    'target' => '_blank',
                ],
                [
                    'text' => 'Phòng Đối Ngoại',
                    'url'  => '/admin/work/department/showlist/4',
                    'icon_color' => 'warning',
                    'target' => '_blank',
                ],
                [
                    'text' => 'Phòng Kế Toán',
                    'url'  => '/admin/work/department/showlist/7',
                    'icon_color' => 'info',
                    'target' => '_blank',
                ]
            ]
        ],
        [
            'text'  => 'Danh sách phòng ban',
            'icon'  => 'fas fa-fw fa-mail-bulk',
            'url'   => '/admin/work/department',
            'can'  => 'work-show',
        ],
        ['header' => 'system'],
        [
            'text'  => 'setting',
            'icon'  => 'fas fa-fw fa-cogs',
            'url'   => '/admin/setting',
            'can'  => 'admin-create',
        ],
        [
            'text'  => 'slider',
            'icon'  => 'fas fa-fw fa-images',
            'url'   => '/admin/slider',
            'active' => ['/admin/slider*', 'regex:@^/admin/slider/[0-9]+$@']
        ],
        [
            'text'    => 'management',
            'icon'    => 'fas fa-fw fa-users-cog',
            'submenu' => [
                [
                    'text' => 'user',
                    'url'  => '/admin/user',
                    'icon' => 'fas fa-fw fa-users',
                    'active' => ['/admin/user*', 'regex:@^/admin/user/[0-9]+$@']
                ],
                [
                    'text' => 'menu',
                    'url'  => '/admin/menu',
                    'icon' => 'fas fa-fw fa-bars',
                    'active' => ['/admin/menu*', 'regex:@^/admin/menu/[0-9]+$@']
                ],
                [
                    'text' => 'role',
                    'url'  => '/admin/role',
                    'icon' => 'fas fa-fw fa-key',
                    'active' => ['/admin/role*', 'regex:@^/admin/role/[0-9]+$@'],
                    'can'  => 'admin-create',
                ],
                [
                    'text' => 'permission',
                    'url'  => '/admin/permission',
                    'icon' => 'fas fa-fw fa-user-lock',
                    'active' => ['/admin/permission*', 'regex:@^/admin/permission/[0-9]+$@'],
                    'can'  => 'admin-create',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#611-plugins
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        [
            'name' => 'CountChar',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/count_char/jquery-input-char-count.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/count_char/input-char-count.css',
                ],
            ],
        ],
        [
            'name' => 'CKEditor',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js',
                ]
            ],
        ],
        [
            'name' => 'Select2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        [
            'name' => 'Fileinput',
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/css/fileinput.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/custom/font/glyphicon.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/plugins/piexif.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/plugins/sortable.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/plugins/purify.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/fileinput.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/themes/fa/theme.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/js/locales/vi.js',
                ],
            ],
        ],
        [
            'name' => 'SeoPreview',
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/seo-preview/js/jquery-seopreview.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/seo-preview/css/jquery-seopreview.css',
                ],
            ],
        ],
    ],
];
