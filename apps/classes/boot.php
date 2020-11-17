<?php

$admin_class_sub_menus = [
    [
        'name' => 'Add Class',
        'link' => U.'classes/app/add/'
    ],
    [
        'name' => 'List Classes',
        'link' => U.'classes/app/list/'
    ]
];

add_menu_admin('Classes',U.'classes/app','classes','fal fa-chalkboard-teacher',2,$admin_class_sub_menus);