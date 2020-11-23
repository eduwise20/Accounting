<?php

$admin_fee_name_sub_menus = [
    [
        'name' => 'Add Fee Name',
        'link' => U.'fee_names/app/add/'
    ],
    [
        'name' => 'List Fee Names',
        'link' => U.'fee_names/app/list/'
    ]
];

add_menu_admin('Fee Names',U.'fee_names/app','fee_names', 'fal fa-file',2, $admin_fee_name_sub_menus);