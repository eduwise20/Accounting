<?php

$admin_fee_group_sub_menus = [
    [
        'name' => 'Add Fee Group',
        'link' => U.'fee_groups/app/add'
    ],
    [
        'name' => 'List Fee Groups',
        'link' => U.'fee_groups/app/list'
    ]
];

add_menu_admin('Fee Group', U.'fee_groups', 'fee_groups', 'fal fa-layer-group', 1, $admin_fee_group_sub_menus); 