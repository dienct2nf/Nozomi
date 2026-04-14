<?php

return [
    'app' => [
        'title' => 'General',
        'desc' => 'All the general settings for application.',
        'icon' => 'fas fa-cogs',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'title', // unique name for field
                'label' => 'Title', // you know what label it is
                'rules' => 'required|min:2|max:80', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => 'Nozomi' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'description', // unique name for field
                'label' => 'Decription', // you know what label it is
                'rules' => 'required|min:2|max:350', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => 'Nozomi' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'keywords', // unique name for field
                'label' => 'Keywords', // you know what label it is
                'rules' => 'required|min:2|max:350', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => 'Nozomi' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'slogan', // unique name for field
                'label' => 'Slogan', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => 'Nozomi' // default value if you want
            ]
        ]
    ],
    'image' => [

        'title' => 'Logo',
        'desc' => 'Set logo, thumb web default',
        'icon' => 'fas fa-file-image',

        'elements' => [
            [
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'logo', // unique name for field
                'label' => 'Logo', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-4', // any class for input
                'value' => '/vendor/image/noimage.jpg' // default value if you want
            ],
            [
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'logo_footer', // unique name for field
                'label' => 'Logo footer', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-4', // any class for input
                'value' => '/vendor/image/noimage.jpg' // default value if you want
            ],
            [
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'thumbnail', // unique name for field
                'label' => 'Thumbnail default', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-4', // any class for input
                'value' => '/vendor/image/noimage.jpg' // default value if you want
            ],
            [
                'type' => 'image', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'noimage', // unique name for field
                'label' => 'No image default', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-4', // any class for input
                'value' => '/vendor/image/noimage.jpg' // default value if you want
            ],
        ]
    ],
    'slider' => [

        'title' => 'Slider',
        'desc' => 'Slider settings on the homepage',
        'icon' => 'fas fa-images',

        'elements' => [
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'introduce', // unique name for field
                'label' => 'Giới thiệu', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'video_featured', // unique name for field
                'label' => 'Video tiêu biểu', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'slider', // unique name for field
                'label' => 'Slider trang chủ', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'team', // unique name for field
                'label' => 'Team trang chủ', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'video', // unique name for field
                'label' => 'Video tin tức', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'partner', // unique name for field
                'label' => 'Đối tác home', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'review', // unique name for field
                'label' => 'Review trang chủ', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'progress', // unique name for field
                'label' => 'Quy trình trang chủ', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'album', // unique name for field
                'label' => 'Album thi tuyển', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],

        ]
    ],
    'seo' => [

        'title' => 'Seo',
        'desc' => 'Config google web master tool, gooole anlytics',
        'icon' => 'fas fa-chart-bar',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'author', // unique name for field
                'label' => 'Author', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'google_master', // unique name for field
                'label' => 'Verify Google Webmaster Tools', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'google_analytics', // unique name for field
                'label' => 'Verify Google Analytics', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'title_length', // unique name for field
                'label' => 'The meta title length ', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '78' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'description_length', // unique name for field
                'label' => 'The meta description length ', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '180' // default value if you want
            ],
        ]
    ],
    'contact' => [

        'title' => 'Contact',
        'desc' => 'Contact settings for web',
        'icon' => 'fas fa-address-book',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'phone', // unique name for field
                'label' => 'Number phone', // you know what label it is
                'rules' => 'required|min:9', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'email', // unique name for field
                'label' => 'Email Adress', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'address', // unique name for field
                'label' => 'Address', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'iframe', // unique name for field
                'label' => 'iframe Address Google Map', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'facebook', // unique name for field
                'label' => 'Facebook', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'goooleplus', // unique name for field
                'label' => 'Gooole Plus', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'twitter', // unique name for field
                'label' => 'Twitter', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'instagram', // unique name for field
                'label' => 'Instagram', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'youtube', // unique name for field
                'label' => 'Youtube', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'skype', // unique name for field
                'label' => 'Skype', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'linkedin', // unique name for field
                'label' => 'Linkedin', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'pinterest', // unique name for field
                'label' => 'Pinterest', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ]
        ]
    ],
    'contact_custom' => [

        'title' => 'Contact Custom',
        'desc' => 'Contact custom settings for web',
        'icon' => 'fas fa-map-marked-alt',

        'elements' => [
            [
                'type' => 'textarea_custom', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'location_custom', // unique name for field
                'label' => 'Location', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea_custom', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'phone_custom', // unique name for field
                'label' => 'Phone', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea_custom', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'email_custom', // unique name for field
                'label' => 'Email', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea_custom', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'working_custom', // unique name for field
                'label' => 'Working', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ]
        ]
    ],
    'wechooseus' => [

        'title' => 'Thống kê số lượng',
        'desc' => 'Đoạn mô tả thống kê',
        'icon' => 'fas fa-map-marked-alt',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'info_product', // unique name for field
                'label' => 'Số đơn hàng', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'text_product', // unique name for field
                'label' => 'Mô tả đơn hàng', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'info_fly', // unique name for field
                'label' => 'Số lượng bay', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'text_fly', // unique name for field
                'label' => 'Mô tả bay', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'info_like', // unique name for field
                'label' => 'Số lượng thích', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'text_like', // unique name for field
                'label' => 'Mô tả thích', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'info_comment', // unique name for field
                'label' => 'Số lượng phản hồi', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'text_comment', // unique name for field
                'label' => 'Mô tả phản hồi', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ]
        ]
    ],
    'application_embed' => [

        'title' => 'Ứng dụng nhúng',
        'desc' => 'Zalo, facebook ...',
        'icon' => 'fas fa-map-marked-alt',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_facebook', // unique name for field
                'label' => 'ID Facebook', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_zalo', // unique name for field
                'label' => 'ID Zalo', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_fanpage', // unique name for field
                'label' => 'ID Fapage Facebook', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_messenger', // unique name for field
                'label' => 'ID Messenger', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
        ]
    ],
    'contact_location' => [

        'title' => 'Địa chỉ vùng miền',
        'desc' => 'Hà Nội, TpHCM, Nhật Bản ...',
        'icon' => 'fas fa-map-marker',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'location_hanoi', // unique name for field
                'label' => 'Miền Bắc', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'location_tphcm', // unique name for field
                'label' => 'Miền Nam', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'location_japan', // unique name for field
                'label' => 'Nhật Bản', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
        ]
    ],
    'widget' => [

        'title' => 'Widget',
        'desc' => 'Widget settings on the homepage',
        'icon' => 'fas fa-text-width',

        'elements' => [
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_contact', // unique name for field
                'label' => 'Liên hệ', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_product', // unique name for field
                'label' => 'Đơn hàng', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_news', // unique name for field
                'label' => 'Tin tức', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_letter', // unique name for field
                'label' => 'Thư ngỏ', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_vision', // unique name for field
                'label' => 'Tầm nhìn - sứ mệnh', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_staff', // unique name for field
                'label' => 'Đội ngũ cán bộ nhân viên', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_legal', // unique name for field
                'label' => 'Hồ sơ pháp lý', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],
            [
                'type' => 'select_widget', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'widget_branch', // unique name for field
                'label' => 'Trụ sở và chi nhánh', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '' // default value if you want
            ],


        ]
    ],
    'event_block' => [

        'title' => 'Block Trang chủ',
        'desc' => 'Cấu hình/Cài đặt block trang chủ',
        'icon' => 'fas fa-home',

        'elements' => [

            [
                'type' => 'form_group', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'article_health', // unique name for field
                'label' => 'Section 1', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '', // default value if you want,
                'fields' => [
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'article_health_title', // unique name for field
//                        'label' => 'Tiêu đề', // you know what label it is
//                        'rules' => 'required|min:2|max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section1_title', // unique name for field
                        'label' => 'Tiêu đề', // you know what label it is
                        'rules' => 'required|min:2|max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],

                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section1_desc', // unique name for field
                        'label' => 'Mô tả', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
//                    [
//                        'type' => 'image', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'article_health_icon', // unique name for field
//                        'label' => 'Hình ảnh', // you know what label it is
//                        'rules' => '', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                            'value' => '/vendor/image/noimage.jpg' // default value if you want
//                    ],
//                    [
//                        'type' => 'image', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section1_icon', // unique name for field
//                        'label' => 'Hình ảnh', // you know what label it is
//                        'rules' => '', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '/vendor/image/noimage.jpg' // default value if you want
//                    ],
//                    [
//                        'type' => 'textarea_custom', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'article_health', // unique name for field
//                        'label' => 'Nội dung', // you know what label it is
//                        'rules' => 'required', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'textarea_custom2', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section1_text', // unique name for field
//                        'label' => 'Nội dung', // you know what label it is
//                        'rules' => 'required', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],

                    [
                        'type' => 'checkbox', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section1_active', // unique name for field
                        'label' => 'Kích hoạt', // you know what label it is
                        'rules' => '',
                        'class' => 'col-md-12', // any class for input
                        'value' => 'on' // default value if you want
                    ],
                ]
            ],
            [
                'type' => 'form_group', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'section2', // unique name for field
                'label' => 'Section 2', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '', // default value if you want,
                'fields' => [
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section2_title', // unique name for field
                        'label' => 'Tiêu đề', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '', // default value if you want
                    ],
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section2_desc', // unique name for field
                        'label' => 'Mô tả', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],


//                    [
//                        'type' => 'image', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section2_icon', // unique name for field
//                        'label' => 'Hình ảnh', // you know what label it is
//                        'rules' => '', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '/vendor/image/noimage.jpg' // default value if you want
//                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section2_video_link', // unique name for field
//                        'label' => 'Video link', // you know what label it is
//                        'rules' => 'max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'textarea_custom2', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section2_text', // unique name for field
//                        'label' => 'Nội dung', // you know what label it is
//                        'rules' => 'required', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],

                    [
                        'type' => 'checkbox', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section2_active', // unique name for field
                        'label' => 'Kích hoạt', // you know what label it is
                        'rules' => '',
                        'class' => 'col-md-12', // any class for input
                        'value' => 'on' // default value if you want
                    ],
                ]
            ],
            [
                'type' => 'form_group', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'section3', // unique name for field
                'label' => 'Section 3', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '', // default value if you want,
                'fields' => [
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section3_title', // unique name for field
                        'label' => 'Tiêu đề', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section3_desc', // unique name for field
                        'label' => 'Mô tả', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],

                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section3_form_label', // unique name for field
                        'label' => 'Nhãn form đăng ký', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],

                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section3_form_btn_label', // unique name for field
                        'label' => 'Nhãn nút đăng ký', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
//
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section3_limit', // unique name for field
//                        'label' => 'Giới hạn hiển thị', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '8' // default value if you want
//                    ],

                    [
                        'type' => 'checkbox', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section3_active', // unique name for field
                        'label' => 'Kích hoạt', // you know what label it is
                        'rules' => '',
                        'class' => 'col-md-12', // any class for input
                        'value' => 'on' // default value if you want
                    ],
                ]
            ],
            [
                'type' => 'form_group', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'section4', // unique name for field
                'label' => 'Section 4', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '', // default value if you want,
                'fields' => [
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section4_title', // unique name for field
                        'label' => 'Tiêu đề', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section4_desc', // unique name for field
                        'label' => 'Mô tả', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],

                    [
                        'type' => 'checkbox', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section4_active', // unique name for field
                        'label' => 'Kích hoạt', // you know what label it is
                        'rules' => '',
                        'class' => 'col-md-12', // any class for input
                        'value' => 'on' // default value if you want
                    ],

                ]
            ],
            [
                'type' => 'form_group', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'section5', // unique name for field
                'label' => 'Section 5', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '', // default value if you want,
                'fields' => [
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section5_title', // unique name for field
                        'label' => 'Tiêu đề', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section5_desc', // unique name for field
                        'label' => 'Mô tả', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section5_limit', // unique name for field
//                        'label' => 'Giới hạn hiển thị', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '3' // default value if you want
//                    ],

                    [
                        'type' => 'checkbox', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section5_active', // unique name for field
                        'label' => 'Kích hoạt', // you know what label it is
                        'rules' => '',
                        'class' => 'col-md-12', // any class for input
                        'value' => 'on' // default value if you want
                    ],
                ]
            ],

            [
                'type' => 'form_group', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'section6', // unique name for field
                'label' => 'Section 6', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => 'col-md-6', // any class for input
                'value' => '', // default value if you want,
                'fields' => [
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section6_title', // unique name for field
                        'label' => 'Tiêu đề', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
                    [
                        'type' => 'text', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section6_desc', // unique name for field
                        'label' => 'Mô tả', // you know what label it is
                        'rules' => 'max:255', // validation rule of laravel
                        'class' => 'col-md-12', // any class for input
                        'value' => '' // default value if you want
                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section6_limit', // unique name for field
//                        'label' => 'Giới hạn hiển thị', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '4' // default value if you want
//                    ],

                    [
                        'type' => 'checkbox', // input fields type
                        'data' => 'string', // data type, string, int, boolean
                        'name' => 'section6_active', // unique name for field
                        'label' => 'Kích hoạt', // you know what label it is
                        'rules' => '',
                        'class' => 'col-md-12', // any class for input
                        'value' => 'on' // default value if you want
                    ],
                ]
            ],

//            [
//                'type' => 'form_group', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'section7', // unique name for field
//                'label' => 'Section 7', // you know what label it is
//                'rules' => 'required', // validation rule of laravel
//                'class' => 'col-md-6', // any class for input
//                'value' => '', // default value if you want,
//                'fields' => [
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section7_title', // unique name for field
//                        'label' => 'Tiêu đề', // you know what label it is
//                        'rules' => 'required|min:2|max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section7_desc', // unique name for field
//                        'label' => 'Mô tả', // you know what label it is
//                        'rules' => 'max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section7_limit', // unique name for field
//                        'label' => 'Giới hạn hiển thị', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '6' // default value if you want
//                    ],
//
//                    [
//                        'type' => 'checkbox', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section7_active', // unique name for field
//                        'label' => 'Kích hoạt', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => 'on' // default value if you want
//                    ],
//                ]
//            ],
//
//            [
//                'type' => 'form_group', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'section8', // unique name for field
//                'label' => 'Section 8', // you know what label it is
//                'rules' => 'required', // validation rule of laravel
//                'class' => 'col-md-6', // any class for input
//                'value' => '', // default value if you want,
//                'fields' => [
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section8_title', // unique name for field
//                        'label' => 'Tiêu đề', // you know what label it is
//                        'rules' => 'required|min:2|max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section8_desc', // unique name for field
//                        'label' => 'Mô tả', // you know what label it is
//                        'rules' => 'max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section8_limit', // unique name for field
//                        'label' => 'Giới hạn hiển thị', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '6' // default value if you want
//                    ],
//
//                    [
//                        'type' => 'checkbox', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section8_active', // unique name for field
//                        'label' => 'Kích hoạt', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => 'on' // default value if you want
//                    ],
//                ]
//            ],
//            [
//                'type' => 'form_group', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'section9', // unique name for field
//                'label' => 'Section 9', // you know what label it is
//                'rules' => 'required', // validation rule of laravel
//                'class' => 'col-md-6', // any class for input
//                'value' => '', // default value if you want,
//                'fields' => [
//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section9_title', // unique name for field
//                        'label' => 'Tiêu đề', // you know what label it is
//                        'rules' => 'required|min:2|max:255', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],
//                    [
//                        'type' => 'textarea_custom2', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section9_desc', // unique name for field
//                        'label' => 'Mô tả', // you know what label it is
//                        'rules' => '', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '' // default value if you want
//                    ],

//                    [
//                        'type' => 'text', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section9_phone', // unique name for field
//                        'label' => 'Liên hệ', // you know what label it is
//                        'rules' => '', // validation rule of laravel
//                        'class' => 'col-md-12', // any class for input
//                        'value' => '1800 6510' // default value if you want
//                    ],
//
//                    [
//                        'type' => 'checkbox', // input fields type
//                        'data' => 'string', // data type, string, int, boolean
//                        'name' => 'section9_active', // unique name for field
//                        'label' => 'Kích hoạt', // you know what label it is
//                        'rules' => '',
//                        'class' => 'col-md-12', // any class for input
//                        'value' => 'on' // default value if you want
//                    ],
//                ]
//            ],
//            [
//                'type' => 'textarea_custom2', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'article_make_up', // unique name for field
//                'label' => 'Hãy sống trọn vẹn mỗi ngày', // you know what label it is
//                'rules' => 'required', // validation rule of laravel
//                'class' => 'col-md-6', // any class for input
//                'value' => '' // default value if you want
//            ],


        ]
    ],
];
