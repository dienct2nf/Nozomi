<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Custom
    |--------------------------------------------------------------------------
    |
    | Contains an array with the applications available.
    |
    /**
     * Default
     *
     */
    'status' => [
        'draft' => 'Bản nháp',
        'publish' => 'Công khai',
        'unpublished' => 'Không công khai'
    ],
    'status_product' => [
        'enable' => 'Đang tuyển',
        'disable' => 'Ngừng tuyển'
    ],
    'sex' => [
        'male' => 'Nam',
        'female' => 'Nữ',
        'other' => 'Khác'
    ],
    'status_order' => [
        'pending' => 'Đang chờ',
        'processing' => 'Đang xử lý',
        'completed' => 'Hoàn tất'
    ],

    'create_folder' => [
        'avatar' => 'Hình ảnh avatar',
        'category' => 'Hình ảnh thể loại',
        'product' => 'Hình ảnh đơn hàng',
        'article' => 'Hình ảnh bài viết',
        'slider' => 'Hình ảnh bài slider',
        'video' => 'Hình ảnh bài video'
    ],
];
