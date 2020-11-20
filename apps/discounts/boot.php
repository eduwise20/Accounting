<?php
$admin_discount_sub_menus = [
    [
        'name' => 'Add Discount',
        'link' => U.'discounts/app/add/'
    ],
    [
        'name' => 'List Discounts',
        'link' => U.'discounts/app/list/'
    ]
];

add_menu_admin('Discounts',U.'discounts/app','discounts','fal fa-file',2, $admin_discount_sub_menus);